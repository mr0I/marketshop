<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Color;
use phpDocumentor\Reflection\Types\This;
use Toastr;
use Validator;


class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colors = Color::all();
        return view('admin.colors.list', compact('colors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.colors.create');
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
            'name' => 'required|max:100|unique:colors',
            'colorcode' => 'required'
        ]);

        Color::create($request->all());
        Toastr::success('رنگ جدید ثبت شد', $title = '', $options = []);
        return redirect()->route('colors.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $color = Color::findorfail($id);
        return view('admin.colors.edit', compact('color'));
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
        $old_value = Color::where('id', $id)->first();
        if ($old_value->name == $request->name) {
            $this->validate($request, [
                'name' => 'required|max:100',
                'colorcode' => 'required'
            ]);
        } else {
            $this->validate($request, [
                'name' => 'required|max:100|unique:colors',
                'colorcode' => 'required'
            ]);
        }

        $res = Color::findorfail($id)->update($request->all());
        if ($res) {
            Toastr::info('رنگ ویرایش شد', $title = '', $options = []);
            return redirect('admin/colors');
        } else {
            Toastr::error('خطا در عملیات', $title = '', $options = []);
            return redirect('admin/colors');
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
        $res = Color::findorfail($id)->delete();
        if ($res) {
            return back()->with('delete_success', 'رنگ پاک شد');
        } else {
            return back()->with('delete_unsuccess', 'رنگ پاک نشد');
        }
    }
}