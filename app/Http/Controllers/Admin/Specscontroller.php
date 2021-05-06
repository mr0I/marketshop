<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\ProductData;
use Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Specscontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { }

    public function specifications($id)
    {
        $product = Product::findorfail($id);
        $specifications = ProductData::where('product_id', $product->id)->get();

        return view(
            'admin.products.specifications',
            compact('product', 'specifications')
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'title' => 'bail|required|string|max:100',
            'spec1' => 'required|string|max:100',
            'desc1' => 'required|string|max:300',
            'spec2' => 'max:100',
            'desc2' => 'max:300',
            'spec3' => 'max:100',
            'desc3' => 'max:300'
        ]);

        $res = ProductData::create(array_merge($request->all(), [
            'product_id' => $request->product_id
        ]));

        if ($res) {
            Toastr::success('ویژگی جدید افزوده شد', $title = '', $options = []);
            return redirect()->back();
        }
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
        $spec = ProductData::findorfail($id);
        $data = [];
        $data['title'] = $spec->title;
        $data['spec1'] = $spec->spec1;
        $data['spec2'] = $spec->spec2;
        $data['spec3'] = $spec->spec3;
        $data['desc1'] = $spec->desc1;
        $data['desc2'] = $spec->desc2;
        $data['desc3'] = $spec->desc3;
        $data['product_id'] = $spec->product_id;
        $data['spec_id'] = $spec->id;

        echo json_encode($data);
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
        $spec = ProductData::findorfail($id);

        $this->validate($request, [
            'title' => 'bail|required|string|max:100',
            'spec1' => 'required|string|max:100',
            'desc1' => 'required|string|max:300',
            'spec2' => 'max:100',
            'desc2' => 'max:300',
            'spec3' => 'max:100',
            'desc3' => 'max:300'
        ]);

        $res = $spec->update($request->all());
        if ($res) {
            Toastr::info('ویژگی جدید ویرایش شد');
            return redirect()->back();
        } else {
            Toastr::eror('خطا در عملیات');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { }

    public function deleteSpecification($id)
    {
        $spec = ProductData::findorfail($id);
        $res = $spec->delete();
        if ($res) {
            return response(json_encode('حذف موفق'));
        } else {
            return response(json_encode('حذف ناموفق'));
        }
    }
}