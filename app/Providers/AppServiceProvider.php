<?php

namespace App\Providers;

use App\Cart;
use App\brand;
use App\Review;
use App\Product;
use App\Category;
use App\Slider;
use App\UserProducts;
use App\Video;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        view()->composer(['site.layouts.master', 'auth.layouts.master'], function ($view) {
            $categories = Category::where('parent_id', 0)->get();
            $brands = brand::all();
            $user_ip = request()->ip();
            $products = Cart::where('userip', $user_ip)->get();
            $count = 0;
            $price = 0;
            foreach ($products as $product) {
                $count += $product->count;
                $price += $product->unitprice * $product->count;
            }
            $cart_products = Cart::where('userip', $user_ip)->get();

            $fav_count = 0;
            if(Auth::check()){
                $favs = UserProducts::where('user_id', Auth::user()->id)->where('isFavorite', 1)->get();
                foreach ($favs as $fav){
                    $fav_count++;
                }
            }

            $view->with(compact('categories', 'brands', 'count', 'price',
                'cart_products', 'fav_count'));
        });

        view()->composer(['site.category'], function ($view) {
            $categories = Category::where('parent_id', 0)->get();
            $sellproducts = Product::orderBy('sellCount', 'DESC')->get();
            $specproducts = Product::where('specialOffer', 1)->get();
            $review = new Review();
            $view->with(compact('categories', 'sellproducts', 'specproducts', 'review'));
        });

        view()->composer(['site.brand'], function ($view) {
            $categories = Category::where('parent_id', 0)->get();
            $sellproducts = Product::orderBy('sellCount', 'DESC')->get();
            $specproducts = Product::where('specialOffer', 1)->get();
            $view->with(compact('categories', 'sellproducts', 'specproducts'));
        });

        view()->composer(['admin.index'], function ($view) {
            $reviewCount = Review::where('confirmed', '0')->count();
            $view->with(compact('reviewCount'));
        });

        view()->composer(['site.index' ], function ($view) {
            if ( session()->has('login_redirect') ){
                $login_redirect = session()->get('login_redirect');
                if ($login_redirect == 'checkout'){
                    return redirect('/checkout');
                }
            }

            if (Auth::check()) {
                $userIp = request()->ip();
                $cart = Cart::where('userip', $userIp);
                if ($cart){
                    $user_id = Auth::user()->id;
                    $array =[];
                    $cart->update(array_merge($array, [
                        'user_id' => $user_id
                    ]));
                }
            }

            $video = Video::where('status', 1)->first();

            $slides = Slider::all();


            $sellproducts = Product::orderBy('sellCount', 'DESC')->get();

            // لوازم الکتونیکی //
            //$mycats = Category::where('id', 1)->orWhere('parent_id', 1)->get();
            $mycats = Category::Where('parent_id', 1)->get();
            $tab_cat10_products = Product::where('category_id', 10)->get();
            $tab_cat12_products = Product::where('category_id', 12)->get();
            $tab_cat13_products = Product::where('category_id', 13)->get();
            $tab_cat15_products = Product::where('category_id', 15)->get();

            // لوازم الکتونیکی //
            $brands = Brand::all();

            $view->with(compact('video', 'slides', 'brands',
                'sellproducts', 'mycats', 'tab_cat10_products','tab_cat12_products',
                'tab_cat13_products', 'tab_cat15_products'));
        });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}