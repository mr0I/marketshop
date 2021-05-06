<?php

namespace App\Http\Controllers\Admin;

use App\brand;
use App\Category;
use App\City;
use App\Color;
use App\Product;
use App\Review;
use App\User;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use nilsenj\Toastr\Facades\Toastr;
use Validator;

class AdmController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('isAdmin');
    // }


    public function index()
    {
        if(Auth::user()->is_admin == 1){
            $products_count = Product::all()->count();
            $cats_count = Category::all()->count();
            $colors_count = Color::all()->count();
            $brands_count = brand::all()->count();
            $reviews_count = Review::all()->count();
            return view('admin.dash', compact('products_count', 'cats_count', 'colors_count',
                'brands_count', 'reviews_count'));
        }else{
            $states = City::where('parent_id', 0)->get();
            $cities = City::where('parent_id', Auth::user()->country)->get();
            return view('admin.edit_profile', compact('states', 'cities'));
        }
    }

    public function edit_profile()
    {
        $states = City::where('parent_id', 0)->get();
        $cities = City::where('parent_id', Auth::user()->country)->get();
        return view('admin.edit_profile', compact('states', 'cities'));
    }

    public function editProfile(Request $request, $user_id)
    {
        $user = User::find($user_id);

        if(isset($request->old_pass) && !Hash::check( $request->old_pass, $user->password)){
            Toastr::error('رمز عبور قبلی اشتباه است!');
            return redirect()->back();
        }

        if($request->newsletter == 'on'){
            $newsletter = 1;
        }else{
            $newsletter = 0;
        }

        $this->validate($request, [
            'name' => 'required|string',
            'lastname' => 'required|string',
            'telephone' => 'required|digits:11|starts_with:09',
            'zone' => 'required',
            'country' => 'required',
        ]);

        if(isset($request->old_pass)){
            $this->validate($request, ['old_pass' => 'required|string']);
        }
        if(isset($request->password)){
            $this->validate($request, ['password' => [
                'required', 'string', 'min:6', 'confirmed',
                'regex:/^(?=.*[0-9])(?=.*[a-zA-Z])(?=.*[!,@,#,$,&,*])([a-zA-Z0-9!,@,#,$,&,*]+)$/'
            ]]);
        }

        $password= Hash::make($request->password , ['rounds'=>12]);

        $file = $request->file('profilepic');
        if ($request->hasFile('profilepic')) {
            $this->validate($request, ['profilepic' => 'image']);
            $image_url = $this->uploadImage($file);
            $old_pic = $user->profilepic;
            @unlink('uploads/images/profile_pics/'. $old_pic);
        }else{
            if ($user->profilepic == ''){
                $image_url = '';
            }else{
                $image_url = $user->profilepic;
            }
        }


        $res = $user->update(array_merge( $request->all(), [
            'profilepic'=>$image_url,
            'password' => $password,
            'newsletter' => $newsletter
        ] ));

        if ($res){
            Toastr::success('اطلاعات ویرایش شد');
        }
        return redirect()->back();
    }

    public function uploadImage($file)
    {
        $year = Carbon::now()->year;
        $image_path = "\uploads\images\profile_pics";
        $filename = microtime() . '-' . $year . '-' . $file->getClientOriginalName();
        $file = $file->move(public_path($image_path), $filename);
        return $filename;
    }


    public function remove_profile_pic(Request $request)
    {
        $user = User::findOrFail($request->id);
        $old_pic = $user->profilepic;
        $array = [];
        $res = $user->update(array_merge($array, ['profilepic'=>''] ));
        if ($res){
            @unlink('uploads/images/profile_pics/'. $old_pic);
            return 1;
        }else{
            return 0;
        }
    }

    public function reviews()
    {
        $reviews = Review::all();
        return view('admin.reviews.list', compact('reviews'));
    }
}