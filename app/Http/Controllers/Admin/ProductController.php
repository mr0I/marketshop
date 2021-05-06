<?php

namespace App\Http\Controllers\Admin;

use App\brand;
use App\Cart;
use App\UserProducts;
use Toastr;
use App\Color;
use App\Product;
use App\Category;
use App\ProductGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Requests\product_request;
use App\ProductData;
use PhpParser\Node\Stmt\Foreach_;
use Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.products.list', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all()->pluck('name', 'id');
        $colors = Color::all()->pluck('name', 'id');
        $brands = brand::all()->pluck('name', 'id');
        return view('admin.products.create', compact('category', 'colors', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(product_request $request)
    {
        $file = $request->file('indexImage');
        if ($request->hasFile('indexImage')) {
            $image_url = $this->uploadImage($file);
        }
        $product = Product::create(array_merge(
            $request->all(),
            ['indexImage' => $image_url]
        ));
        $product->colors()->sync($request->color_id);
        Toastr::success('محصول جدید ثبت شد', $title = '', $options = []);
        return redirect('admin/products/create');
    }

    public function uploadImage($file)
    {
        $year = Carbon::now()->year;
        $filename = microtime() . '-' . $year . '-' . $file->getClientOriginalName();
        $file = $file->move(public_path().'\uploads\images\indexes', $filename);
        return $filename;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findorfail($id);
        $colors = Color::all();
        $category = Category::all()->pluck('name', 'id');
        $brands = brand::all()->pluck('name', 'id');
        return view('admin.products.edit', compact('product', 'colors',
            'category', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'title' => 'bail|required|string|max:50',
            'brand' => 'required|max:50',
            'price' => 'required|numeric',
            'offprice' => 'numeric',
            'availablity' => 'required',
            'color_id' => 'required',
            'description' => 'string|max:2000',
        ]);

        $product = Product::find($id);
        $old_code = $product->code;
        if ($old_code == $request->code) {
            $this->validate($request, ['code' => 'required']);
        } else {
            $this->validate($request, ['code' => 'required|unique:products']);
        }

        $old_image = $product->indexImage;
        $file = $request->file('indexImage');
        if ($request->hasFile('indexImage')) {
            $this->validate($request, ['indexImage' => 'required|image']);
            $image_url = $this->uploadImage($file);
            @unlink('uploads/images/indexes/' . $old_image);
        } else {
            $image_url = $old_image;
        }
        //$desc = strip_tags($request->description);

        $product->update(array_merge($request->all(), [
            'indexImage' => $image_url
        ]));
        $res = $product->colors()->sync($request->color_id);
        if ($res) {
            Toastr::info('محصول ویرایش شد', $title = 'نتیجه', $options = []);
        }
        return redirect('admin/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findorfail($id);
        $old_index_image = $product->indexImage;
        $old_galleries = ProductGallery::where('product_id', $id)->get();

        $product->delete();
        $res = $product->colors()->detach();
        if ($res) {
            foreach ($old_galleries as $old_gallery){
                $old_gallery->delete();
                @unlink('uploads/images/gallery/' . $old_gallery->image);
            }
            @unlink('uploads/images/indexes/' . $old_index_image);
            return back()->with('product_del_success', 'محصول مورد نظر پاک شد!');
        } else {
            return back()->with('product_del_unsuccess', 'خطا در پاک کردن محصول !');
        }
    }

    public function gallery($id)
    {
        $product = Product::findorfail($id);
        return view('admin.products.gallery', compact('product'));
    }
    public function addGallery(Request $request)
    {
        $files = $request->file('images');
        foreach ($files as $file) {
            $image_url = $this->uploadGalleryImage($file);
            ProductGallery::create([
                'product_id' => $request->productid,
                'image' => $image_url
            ]);
        }
        Toastr::success('گالری افزوده شد', $title = '', $options = []);
        return redirect('admin/products');
    }

    public function uploadGalleryImage($file)
    {
        $year = Carbon::now()->year;
        $image_path = "\uploads\images\gallery";
        $filename = microtime() . '-' . $year . '-' . $file->getClientOriginalName();
        $file = $file->move(public_path($image_path), $filename);
        return $filename;
    }
}