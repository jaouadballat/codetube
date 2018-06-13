<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Comment extends Model
{

    use softDeletes;

    protected $fillable = ['body', 'user_id', 'video_id'];

    public function video()
    {
        return $this->belongsTo('App\Video');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function replies()
    {
        return $this->hasMany('App\Reply');
    }
}
