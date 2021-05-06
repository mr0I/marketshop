<?php

namespace App\Http\Controllers\Admin;

use App\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Toastr;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slides = Slider::all();
        return view('admin.sliders.list', compact('slides'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sliders.create');

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
           'name' => 'required|max:255',
           'image' => 'required|image',
           'url' => 'required|url|max:255'
        ]);

        $file = $request->file('image');
        if ($request->hasFile('image')) {
            $image_url = $this->uploadImage($file);
        }
        $slider = Slider::create(array_merge(
            $request->all(),
            ['image' => $image_url]
        ));
        Toastr::success('محصول جدید ثبت شد');
        return redirect('admin/sliders/create');
    }

    public function uploadImage($file)
    {
        $year = Carbon::now()->year;
        $filename = microtime() . '-' . $year . '-' . $file->getClientOriginalName();
        $file = $file->move(public_path().'\uploads\images\slides', $filename);
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
        $slide = Slider::find($id);
        return view('admin.sliders.edit', compact('slide'));
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
        $slide = Slider::find($id);
        $old_image = $slide->image;

        $this->validate($request, [
            'name' => 'required|max:255',
            'url' => 'required|url|max:255'
        ]);

        $file = $request->file('image');
        if ($request->hasFile('image')) {
            $this->validate($request, ['image' => 'required|image']);
            $image_url = $this->uploadImage($file);
            @unlink('uploads/images/slides/' . $old_image);
        } else {
            $image_url = $old_image;
        }

        $res = $slide->update(array_merge($request->all(), [
            'image' => $image_url
        ]));

        if ($res){
            Toastr::success('اسلاید ویرایش شد');
            return redirect('admin/sliders');
        }else{
            Toastr::error('error');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slide = Slider::find($id);
        $old_image = $slide->image;


        $res = $slide->delete();
        if ($res){
            @unlink('uploads/images/slides/' . $old_image);
            Toastr::success('حذف انجام شد.');
            return redirect()->back();
        }else{
            Toastr::error('error');
        }
    }
}
