<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoView extends Model
{
    protected $fillable = ['user_id', 'ip'];
}
