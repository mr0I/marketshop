<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    //protected $guarded = [];
    protected $fillable = ['name', 'status', 'video'];
}
