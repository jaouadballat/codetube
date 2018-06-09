<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Video extends Model
{
	use SoftDeletes;

	protected $fillable = [
		'title',
		'description',
		'uid',
		'video_filename',
		'video_id',
		'processed',
		'visibility',
		'allow_votes',
		'allow_comments',
		'processed_percentage'
	];

    public function channel()
    {
    	return $this->belongsTo('App\Channel');
    }

    public function getRouteKeyName()
    {
    	return 'uid';
    }

    public function scopeLatestFirst($query)
    {
    	return $query->orderBy('created_at', 'desc');
    }
}
