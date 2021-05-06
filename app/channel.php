<?php

namespace App;

use App\User;
use App\Subscription;
use App\ChannelModels\Video;
use Illuminate\Database\Eloquent\Model;

class channel extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'cover', 'avatar'];



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
    public function subscriptionsCount()
    {
        return $this->subscriptions->count();
    }
}
