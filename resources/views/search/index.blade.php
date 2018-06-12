@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Search for "{{ Request::get('q') }}"</div>

                <div class="card-body">

                    @if($channels->count() > 0)
                        @foreach($channels as $channel)
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        @if(file_exists(public_path('/uploads/' . $channel->image . '.png')))
                                            <img src="{{ asset('/uploads/' . $channel->image . '.png')}}" width="150" height="100">
                                        @else
                                            <img src="{{ asset('/uploads/default.jpg') }}" width="150" height="100">
                                        @endif
                                    </div>
                                    <div class="col">
                                        <a href="/channel/{{ $channel->slug }}">
                                            {{ $channel->name }}
                                        </a>
                                    </div>
                                    <div class="col">
                                        Subscripers count
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    @elseif($videos->count() > 0)
                        @foreach($videos as $video)
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
                                        <p>{{ $video->created_at->diffForHumans() }}</p>
                                    </div>
                                    <div class="col">{{ $video->description }}</div>
                                    <div class="col">{{ str_plural('view', $video->viewCount()) }} {{ $video->viewCount() }}</div>

                                </div>
                            </div>
                        @endforeach
                    @else
                    <p class="text-center">
                        No much result.
                    </p>
                    @endif
            </div>
        </div>
    </div>
</div>
@endsection
