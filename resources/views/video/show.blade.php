@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 offset-md-1">
        @if($video->isPrivate() && Auth::check() && $video->ownedByUser(Auth::user()))
            <div class="alert alert-info">
                This video is private.Only you can see it.
            </div>
            <div>
                <video-player 
                    :video-uid="'{{ $video->uid }}'"
                    :video-url="'{{ $video->getVideoUrl() }}'"
                    :video-thumbnail="'{{ $video->getThumbnail() }}'"
                />
            </div>
        @else
            <div class="video_placeholder">
                <p>
                    this video is private
                </p>
            </div>
        @endif
            <div class="card mt-2">
                <div class="card-body">
                <h2>{{ $video->title }}</h2>
                <div class="float-right">{{ $video->viewCount() }} {{ str_plural('view', $video->viewCount()) }}</div>
                	<div class="media">
					  <img class="mr-3" src="{{ $video->channel->getImage() }}">
					  <div class="media-body">
					  	<a href="/channel/{{ $video->channel->slug }}">
					    	<h5 class="mt-0">{{ $video->channel->name }}</h5>
					    </a>
					    <span>Subscrib button</span>
					    Cras 
					  </div>
					</div>
                </div>
            </div>

            <div class="card mt-2">
                <div class="card-body">
                    {{ $video->description }}
                </div>
            </div>

            <div class="card mt-2">
            	<div class="card-body">
                    @if($video->allowComments())
                        Comments
                    @else
                        Comments are disabled for this video
                    @endif   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection