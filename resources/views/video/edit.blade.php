@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit video "{{ $video->title }}"</div>

                <div class="card-body">
                <form action="{{ route('video.update', ['video' => $video->uid]) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') ? old('title') : $video->title }}">
                         @if ($errors->has('title'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" rows="3">{{ old('description') ? old('description') : $video->description }}</textarea>

                         @if ($errors->has('description'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                    </div>

                     <div class="form-group">
                        <label for="visibility">Visibility:</label>
                        
                        <select name="visibility" id="visibility" class="form-control
                        ">
                            @foreach(['public', 'private', 'unlisted'] as $visibility)
                                <option value="{{ $visibility }}" {{ $video->visibility == $visibility ? 'selected' : '' }}>
                                    {{ ucfirst($visibility) }}
                                </option>
                            @endforeach
                        </select>

                         @if ($errors->has('visibility'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('visibility') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="allow_votes">
                            Allow_votes:
                            <input type="checkbox" name="allow_votes" {{ $video->allowVotes() ? 'checked' : ''}}>
                        </label>
                        <label for="allow_comments">
                            Allow_comments:
                            <input type="checkbox" name="allow_comments" {{ $video->allowComments() ? 'checked' : ''}} >
                        </label>
                    </div>
                    
                    <input type="submit" class="btn btn-default" value="Update">  

                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
