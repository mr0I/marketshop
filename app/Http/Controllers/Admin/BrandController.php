<?php

namespace App\Http\Controllers\Admin;

use App\brand;
use App\Review;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use nilsenj\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use nilsenj\Toastr\Toastr as NilsenjToastr;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = brand::all();
        return view('admin.brands.list', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:100|unique:brands',
            'image' => 'required|image'
            //     'image' => 'mimes:jpeg,jpg,png,gif,bmp'
        ]);

        $file = $request->file('image');
        if ($request->hasFile('image')) {
            $image_url = $this->uploadImage($file);
        }
        $brand = brand::create(array_merge($request->all(), ['image' => $image_url]));
        if ($brand) {
            Toastr::success('برند جدید ثبت شد', $title = '', $options = []);
        }
        return redirect('admin/brands/create');
    }

    public function uploadImage($file)
    {
        $year = Carbon::now()->year;
        $image_path = "\uploads\images";
        $filename = microtime() . '-' . $year . '-' . $file->getClientOriginalName();
        $file = $file->move(public_path($image_path), $filename);
        return $filename;
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = brand::findorfail($id);
        return view('admin.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $brand = brand::findorfail($id);
        //$old_name = ucfirst($brand->name);
        $old_name = $brand->name;
        if ($old_name == $request->name) {
            $this->validate($request, ['name' => 'required|max:100']);
        } else {
            $this->validate($request, ['name' => 'required|max:100|unique:brands']);
        }

        $file = $request->file('image');
        $old_image = $brand->image;
        if ($request->hasFile('image')) {
            $this->validate($request, ['image' => 'required|image']);
            $image_url = $this->uploadImage($file);
        } else {
            if($old_image == '') {
                $image_url = '';
            }else{
                $image_url = $old_image;
            }
        }

        $res = $brand->update(array_merge($request->all(), ['image' => $image_url]));
        if ($res) {
            if ($request->hasFile('image')) {
                @unlink('uploads/images/' . $old_image);
            }
            Toastr::info('برند ویرایش شد', $title = '', $options = []);
        }
        return redirect('admin/brands');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $brand = brand::find($id);
        $image = $brand->image;
        $res = $brand->delete();
        if ($res) {
            @unlink('uploads/images/' . $image);
            return back()->with('delete_success', 'آیتم با موفقیت پاک شد.');
        } else {
            return back()->with('delete_unsuccess', 'مشکل در پاک کردن آیتم!');
        }
    }



    public function del_brand_pic($id)
    {
        $brand = brand::find($id);
        $image = $brand->image;
        @unlink('uploads/images/' . $image);
        $brand->update(array_merge(['image' => '']));
        return back();
    }
}