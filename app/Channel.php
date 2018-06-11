<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $fillable = [
    	'name',
    	'slug',
    	'description',
    	'image'
    ];


    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function videos()
    {
        return $this->hasMany('App\Video');
    }

    public function getImage()
    {
        if (!$this->image) {
            return '/uploads/default.jpg';
        }

        return $this->image;
    }
}
