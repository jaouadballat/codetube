@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
	            <div class="card">
	                <div class="card-header">{{ $channel->name }}'s channel</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="media">
                                    <img class="mr-3" src="{{ asset($channel->image) }}">
                                    <div class="media-body">
                                        <h5 class="mt-0">{{ $channel->name }}
                                        </h5>
                                            <subscribe-button channel-slug="{{ $channel->slug }}" />
                                        <hr>
                                        @if($channel->description)
                                            <p>{{ $channel->description }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
	            </div>
        </div>
    </div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Videos</div>
            @if($channel->videos->count() > 0)
                @foreach($channel->videos->where('visibility', 'public') as $video)
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                @if(file_exists(public_path('/uploads/' . $video->uid . '.png')))
                                    <img src="{{ asset('/uploads/' . $video->uid . '.png')}}" width="150" height="100">
                                @else
                                    <img src="{{ asset('/uploads/default.jpg') }}" width="150" height="100">
                                @endif
                            </div>
                            <div class="col">
                                <a href="/video/{{ $video->uid }}">
                                    {{ $video->title }}
                                </a>
                                <p>{{ $video->created_at }}</p>
                            </div>
                            <div class="col">{{ $video->visibility }}</div>
                        </div>
                    </div>
                @endforeach
            @else
            <p class="text-center">
                You have no videos here !
            </p>
            @endif
        </div>
    </div>
    </div>

</div>
@endsection
