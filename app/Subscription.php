<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'channel_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
