@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
	            <div class="card">
	                <div class="card-header">Videos</div>
	                @if($videos->count() > 0)
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
			                    		<p>{{ $video->created_at }}</p>
			                    	</div>
			                    	<div class="col">{{ $video->visibility }}</div>
			                    	<div class="col">
			                    		<form action="{{ route('video.delete', $video->uid) }}" method="post">
			                    			<a href="/videos/{{ $video->uid }}/edit" class="btn btn-sm btn-info">Edit</a>
			                    			<button class="btn btn-sm btn-danger" type="submit">Delete</button>

			                    			@csrf
			                    			@method('DELETE')
			                    		</form>
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

	            	{{ $videos->links() }}
        </div>
    </div>
</div>
@endsection
