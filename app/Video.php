<?php

namespace App;

use App\Traits\Orderable;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;


class Video extends Model
{
	use SoftDeletes, Orderable;

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

    public function views()
    {
        return $this->hasMany('App\VideoView');
    }

    public function viewCount()
    {
        return $this->views()->count();
    }

    public function scopeSearch($query, $q)
    {
        return $query->where('title', 'like', '%'. $q .'%')
                     ->where('visibility', 'public')->get();
    }

    public function votes()
    {
        return $this->morphMany('App\Vote', 'voteable');
    }

    public function upVotes()
    {
        return $this->votes()->where('type', 'up');
    }

    public function downVotes()
    {
        return $this->votes()->where('type', 'down');
    }

    public function voteFromUser(User $user)
    {
        return $this->votes()->where('user_id', $user->id);
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    
}
