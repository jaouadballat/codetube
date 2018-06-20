@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
	            <div class="card">
	                <div class="card-header">Videos</div>
	                @if($channels->flatMap->videos->count() > 0)
		        		@foreach($channels->flatMap->videos as $video)
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
										<p>{{ $video->description }}</p>
									</div>
									<div class="col">
										<a href="/channel/{{ $video->channel->slug }}">{{ $video->channel->name }}</a>
										<p>{{ $video->viewCount() }} View</p>
									</div>
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
