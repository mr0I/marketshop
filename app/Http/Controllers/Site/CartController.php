<?php

namespace App\Http\Controllers\Site;

use App\Cart;
use App\Color;
use App\Product;
use App\Offer;
use Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_ip = request()->ip();
        $cart_products = Cart::where('userip', $user_ip)->get();
        return view('site.cart', compact('cart_products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { }

    public function addToCart(Request $request)
    {

        $product = Product::find($request->id);
        $count = $request->count;
        $color = Color::find($request->color_id);
        $user_ip = request()->ip();
        if (Auth::guest()) {
            $userID =0;
        }else{
            $userID =Auth::user()->id;
        }

        $data = ([
            'title' => $product->title,
            'brand' => $product->brand,
            'image' => $product->indexImage,
            'count' => $count,
            'color' => $color->name,
            'unitprice' => $product->offprice,
            'user_id' => $userID,
            'product_id' => $product->id,
            'userip' => $user_ip,
            'slug' => $product->slug
        ]);

        $cart = Cart::where('title', $product->title)
            ->where('userip', $user_ip)->first();

        if ($cart != null) {
            if ($cart->title == $product->title && $cart->userip == $user_ip) {
                echo 0;
            } else {
                Toastr::success('محصول به سبد خرید اضافه شد');
                echo 1;
                Cart::create($data);
                $this->updateOffer();
            }
        } else {
            Toastr::success('محصول به سبد خرید اضافه شد');
            echo 1;
            Cart::create($data);
            $this->updateOffer();
        }
    }


    public function updateOffer()
    {
        if(session()->has('offer_id')){
            (Auth::check())? $user_id= Auth::user()->id : $user_id=0;
            $user_ip = request()->ip();
            $cart_products = Cart::where('userip', $user_ip)->get();
            $offerId = rand(1000000 , 9999999);
            $sum =0;
            $tax =0;
            $sumTotal =0;
            $finalPrice =0;
            $offer = Offer::where('userIp', $user_ip)->where('status', 0)->first();
            $deliveryPrice = $offer->sendprice;
            $discount = $offer->discount;
            foreach ($cart_products as $product){
                $sum += ($product->count)*($product->unitprice);
            }
            $tax = $sum*0.08;
            $sumTotal = $sum+$tax+$deliveryPrice;
            $finalPrice=$sumTotal - ($sumTotal*($discount/100));
            $data = ['offer_id' => $offerId, 'sum'=> $sum , 'sumprice' => $sumTotal,
                'sendprice'=> 0, 'discount' => 0, 'tax' => $tax, 'total' => $finalPrice,
                'description'=> '', 'user_id' => $user_id,'userIp'=> $user_ip , 'status' => 0];

            if ($offer){
                $array =[];
                $offer->update(array_merge($array, [
                    'sum'=> $sum,
                    'sumprice'=> $sumTotal,
                    'tax'=> $tax,
                    'total'=> $finalPrice,
                    'user_id'=> $user_id,
                    'userIp'=> $user_ip
                ]));
            }

        }
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        $cartproduct = Cart::findOrFail($id);
        $cartproduct->count = $request->quantity;
        $res = $cartproduct->save();
        // Bad method //
//        $count = $request->quantity;
//        $array = [];
//        $res = $cartproduct->update(array_merge($array, [
//            'count' => $count
//        ]));
        // Bad method //
        if ($res) {
            $this->updateOffer();
            return redirect()->back()->with('update-success', '');
            //return redirect()->back()->with('message','<script>alert("بروزرسانی موفق!")</script>');
        } else {
            return redirect()->back()->with('update-unsuccess', '');
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
        $cartproduct = Cart::findOrFail($id);
        $res = $cartproduct->delete();
        if ($res){
            $this->updateOffer();
            echo 'ok';
        }
    }

}