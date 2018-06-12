<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;


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

    public function allowVotes()
    {
    	return $this->allow_votes;
    }

    public function allowComments()
    {
    	return $this->allow_comments;
    }

    public function isPrivate()
    {
        return $this->visibility === 'private';
    }

    public function ownedByUser(User $user)
    {
        return $this->channel->user_id == $user->id;
    }

    public function getThumbnail()
    {
        if(file_exists(public_path('/uploads/' . $this->uid . '.png'))){
            return '/uploads/' . $this->uid . '.png';
        }

        return '/uploads/default.jpg';
    }

    public function getVideoUrl()
    {
        return Storage::url('uploads/' . $this->video_filename);
    }
}
