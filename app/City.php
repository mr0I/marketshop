<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $guarded =[];

    public function getParent()
    {
        return $this->hasOne(City::class, 'id', 'parent_id')
            ->withDefault(['city' => '---']);
    }

    public function getChild()
    {
        return $this->hasMany(City::class, 'parent_id');
    }
}
