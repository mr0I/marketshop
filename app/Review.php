<?php

namespace App;

use App\User;
use App\Product;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //protected $fillable = ['name', 'text', 'vote'];
    protected $guarded = [];



    public function user()
    {
        return $this->belongsTo(User::class)->select('id', 'name');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function count()
    {
        $counter = 0;
        $reviews = Review::all();
        foreach ($reviews as $key => $value) {
            $counter++;
        }
        return $counter;
    }
}