<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = ['user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
