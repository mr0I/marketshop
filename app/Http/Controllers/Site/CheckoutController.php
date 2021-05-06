<?php

namespace App\Http\Controllers\Site;

use App\Cart;
use App\Offer;
use App\Discount;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{
    public function index()
    {
        (Auth::check())? $user_id= Auth::user()->id : $user_id=0;
        $user_ip = request()->ip();
        $cart_products = Cart::where('userip', $user_ip)->get();
        // Calc prices
        $offerId = rand(1000000 , 9999999);
        $sum =0;
        $tax =0;
        $sumTotal =0;
        $finalPrice =0;
        foreach ($cart_products as $product){
            $sum += ($product->count)*($product->unitprice);
        }
        $tax = $sum*0.08;
        $sumTotal = $sum+$tax;
        $finalPrice=$sumTotal;
        session()->forget('offer_id');
        $data = ['offer_id' => $offerId, 'sum'=> $sum , 'sumprice' => $sumTotal,
            'sendprice'=> 0, 'discount' => 0, 'tax' => $tax, 'total' => $finalPrice,
            'description'=> '', 'user_id' => $user_id,'userIp'=> $user_ip , 'status' => 0];
        if (! session()->has('offer_id')){
            $old_offer = Offer::where('userIp', $user_ip)->where('status', 0)->first();
            if ($old_offer) $old_offer->delete();
            Offer::create($data);
            session()->put('offer_id', $offerId);
        }
        $offer = Offer::where('offer_id', session()->get('offer_id'))->first();

        return view('site.checkout',compact('cart_products', 'offer'));
    }

    public function discount_check(Request $request)
    {
        //return response()->json(['success'=> $request->code]);
        $code_name = $request->code;
        $discount = Discount::where('name', $code_name)->first();
        if ($discount) {
            echo $discount->percent;
            $offer = Offer::where('offer_id', session()->get('offer_id'))->first();
            $array =[];
            $offer->update(array_merge($array, ['discount' => $discount->percent]));
        } else {
            echo 0;
        }
    }

    public function clearCoupon(){
        $offer = Offer::where('offer_id', session()->get('offer_id'))->first();
        $array =[];
       $res = $offer->update(array_merge($array, ['discount' => 0]));
        if ($res) echo 1;
    }


    public function refreshCart()
    {
        $offer = Offer::where('offer_id', session()->get('offer_id'))->first();
        $sum_price = $offer->sum + $offer->tax + $offer->sendprice;
        $total_price = $sum_price - ((($offer->discount)/100)*$sum_price);
        (Auth::check())? $user_id= Auth::user()->id : $user_id=0;
        $array =[];
        $res = $offer->update(array_merge($array, [
            'sumprice' => $sum_price,
            'total'=>$total_price,
            'user_id' => $user_id
        ]));
        if($res){
            $updated_offer = Offer::where('offer_id', session()->get('offer_id'))->first();
            echo $updated_offer;
        }
    }

    public function delivery_method(Request $request){
        $send_method = $request->send_method;

        $price =0;
        switch ($send_method){
            case 0:
                $price=0;
                break;
            case 1:
                $price=8;
                break;
            case 2:
                $price=15;
                break;
        }
        if (! session()->has('offer_id')){
            echo 0;
        }else{
            $offer = Offer::where('offer_id', session()->get('offer_id'))->first();
            $array =[];
            $offer->update(array_merge($array, ['sendprice' => $price]));
            echo $send_method;
        }
    }

    public function store(Request $request){
        $offer = Offer::find($request->id);
        $array=[];
        $res = $offer->update(array_merge($array, [
            'status'=> 1,
            'description'=> $request->description
        ]));
        if ($res){
            $user_ip = $request->userIp;
            $carts = Cart::where('userip',$user_ip)->get();

            $count1 = Cart::where('userip',$user_ip)->count();
            $count2 = 0;
            foreach ($carts as $cart){
                $productId = $cart->product_id;
                $count = $cart->count;
                $product = Product::find($productId);
                $old_sellCount = $product->sellCount;
                $new_sellCount = $count + $old_sellCount;
                $product->sellCount = $new_sellCount;
                $update = $product->save();
                if ($update) $count2 ++;
            }

            if ($count1 == $count2){
                $carts = Cart::where('userip',$user_ip);
                $carts->delete();
                session()->forget('offer_id');
                Toastr::success('سفارش شما ثبت شد');
                return redirect('/');
            }
        }


    }

}