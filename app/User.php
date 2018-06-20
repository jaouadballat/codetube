<?php

namespace App;

use App\Channel;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function channel()
    {
        return $this->hasMany('App\Channel');
    }

    public function videos()
    {
        return $this->hasManyThrough('App\Video', 'App\Channel');
    }

    public function subscriptions()
    {
        return $this->hasMany('App\Subscription');
    }

    public function isSubscribedTo(Channel $channel)
    {
        return (bool)$this->subscriptions->where('channel_id', $channel->id)->count();
    }

    public function isOwnChannel(Channel $channel)
    {
        return (bool) $this->channel->where('id', $channel->id)->count();
    }


    public function subscribers()
    {
        return $this->belongsToMany('App\Channel', 'subscriptions');
    }
}
