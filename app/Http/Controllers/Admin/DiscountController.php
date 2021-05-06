<?php

namespace App\Http\Controllers\Admin;

use App\Discount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Toastr;

class DiscountController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $discounts = Discount::all();
        return view('admin.discounts.list', compact('discounts'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('admin.discounts.create');
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
            'name' => 'required|max:100|unique:discounts',
            'percent' => 'required'
            ]);

            $res = Discount::create($request->all());
            if ($res) {
                Toastr::success('کد جدید ثبت شد');
                return redirect()->route('discounts.create');
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
            $discount = Discount::findOrFail($id);
            return view('admin.discounts.edit', compact('discount'));
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
            $this->validate($request, [
                'name' => 'required|max:100',
                'percent' => 'required'
                ]);

                $discount = Discount::findOrFail($id);
                $res = $discount->update($request->all());
                if ($res) {
                    Toastr::success('کد جدید ویرایش شد');
                    return redirect()->route('discounts.index');
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
                $discount = Discount::findOrFail($id);
                $res = $discount->delete();
                if ($res) {
                    Toastr::success('کد تخفیف پاک شد');
                    return redirect()->back();
                }
            }
        }