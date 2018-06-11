@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 offset-md-1">
            Video Player

            <div class="card mt-2">
                <h2>{{ $video->title }}</h2>
                <div class="card-body">
                <div class="float-right">video views</div>
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
                {{ $video->description }}
            </div>

            <div class="card mt-2">
            	@if($video->allowComments())
                	Comments
                @else
                	Comments are disabled for this video
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
