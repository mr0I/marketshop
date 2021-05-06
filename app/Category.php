<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Category extends Model
{
    protected $guarded = [];


    public function getParent()
    {
        return $this->hasOne(Category::class, 'id', 'parent_id')
            ->withDefault(['name' => '---']);
    }

    public function getChild()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function products()
    {
        return $this->belongsTomany(Product::class);
    }

    public function getRouteKeyName()
    {
        return 'name';
    }
}
