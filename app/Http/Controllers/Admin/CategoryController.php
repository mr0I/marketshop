<?php

namespace App\Http\Controllers\Admin;

use Toastr;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();

        return view('admin.category.list', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::pluck('name', 'id');
        return view('admin.category.create', compact('category'));
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
            'name' => 'required|max:100|unique:categories',
            'parent_id' => 'required'
        ]);
        Category::create($request->all());
        Toastr::success('دسته جدید ثبت شد', $title = '', $options = []);
        return redirect('admin/category/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cat = Category::find($id);
        $category = Category::pluck('name', 'id');
        return view('admin.category.edit', compact('cat', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cat = Category::find($id);
        if ($cat->name == $request->name) {
            $this->validate($request, [
                'name' => 'required|max:100',
                'parent_id' => 'required'
            ]);
        } else {
            $this->validate($request, [
                'name' => 'required|max:100|unique:categories',
                'parent_id' => 'required'
            ]);
        }
        $cat->update($request->all());
        Toastr::info('دسته ویرایش شد');
        return redirect('admin/category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $res = $category->delete();
        if ($res) {		
            return back()->with('delete_success', 'آیتم با موفقیت پاک شد.');
        } else {
            return back()->with('delete_unsuccess', 'مشکل در پاک کردن آیتم!');
        }
    }


    public function cat_bulk_delete(Request $request){
        $counter = 0;
        $catLength = 0;
        foreach (json_decode($request['ids']) as $data => $value)
        {
            $counter++;
            $cats = Category::where('id', $value);
            $res = $cats->delete();
            if ($res){
                $catLength++;
            }
        }
        if ($counter === $catLength){
            echo 1;
            Toastr::success('delete success');
        }else{
            echo 0;
        }

    }







}