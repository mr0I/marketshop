<?php

namespace App;

use App\User;
use App\Color;
use App\Offer;
use App\Review;
use App\Category;
use App\ProductGallery;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{

    use Sluggable;

    protected $fillable = [
        'title', 'code', 'brand', 'availablity', 'specialOffer', 'price', 'indexImage',
        'offprice', 'description', 'category_id', 'vote', 'sellCount'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class)->select('id', 'name', 'parent_id');
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class);
    }
    public function offers()
    {
        return $this->belongsToMany(Offer::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function product_galleries()
    {
        return $this->hasMany(ProductGallery::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}