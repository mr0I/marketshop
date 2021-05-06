<?php

namespace App\Http\Controllers\Site;

use App\Product;
use App\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Toastr;


class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'text' => 'required|max:200',
            'vote' => 'required',
        ]);


        if ($validator->fails()) {
            $request->session()->flash('review_error', 'خطا در وارد کردن پارامترها');
            return redirect()->back();
        }

        $res = Review::create($request->all());
        if ($res) {
            $request->session()->flash('review_message');
            return redirect()->back();
        }
    }

    private function update_vote($productId){
        $votes = Review::where('product_id', $productId)
            ->where('confirmed', true)->get();
        //return dd($votes);
        $averVote=0;
        $sumVotes=0;$counter=0;
        foreach ($votes as $vote){
            $counter++;
            $sumVotes += $vote->vote;
        }
        if ($counter!=0){
            $averVote = $sumVotes/$counter;
        }else{
            $averVote =0;
        }
        $product = Product::find($productId);
        $array2=[];
        $update = $product->update(array_merge($array2, ['vote'=> $averVote]));
    }

    public function accept_review($id)
    {
        $review = Review::findOrFail($id);
        //return dd($review);
        $confirmed = true;
        $array = [];
        $res = $review->update(array_merge($array, ['confirmed' => $confirmed]));
        if ($res) {
            $this->update_vote($review->product_id);

            Toastr::success('نظر تایید شد', $title = '', $options = []);
        }
    }


    public function reject_review($id)
    {
        $review = Review::findOrFail($id);
        $confirmed = false;
        $array = [];
        $res = $review->update(array_merge($array, ['confirmed' => $confirmed]));
        if ($res) {
            $this->update_vote($review->product_id);

            Toastr::error('نظر رد شد', $title = '', $options = []);
        }
    }
}