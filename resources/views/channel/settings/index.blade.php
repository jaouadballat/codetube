@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('channel.update', $channel->slug) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">Settings</div>

                    <div class="card-body">
                        <div class="form-group row" style="margin-left: -90px">
                            <label for="name" class="col-sm-4 col-form-label text-md-right">Name: </label>

                            <div class="col-md-6">
                                <input id="name" type="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') ? old('name') : $channel->name }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row" style="margin-left: -90px">
                            <label for="slug" class="col-sm-4 col-form-label text-md-right">Slug: </label>

                            <div class="col-md-6">
                                <div class="input-group">
                                <div class="input-group-prepend">
                                     <span class="input-group-text" id="basic-addon3">{{ config('app.url') . 'channel/' }}</span>
                                 </div>
                                <input id="slug" type="slug" class="form-control{{ $errors->has('slug') ? ' is-invalid' : '' }}" name="slug" value="{{ old('slug') ? old('slug') : $channel->slug }}" required autofocus>

                                @if ($errors->has('slug'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('slug') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group row" style="margin-left: -90px">
                            <label for="name" class="col-sm-4 col-form-label text-md-right">Description: </label>

                            <div class="col-md-6">

                                 <textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" rows="3">{{ old('description') ? old('description') : $channel->description }}</textarea>

                                @if ($errors->has('description'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                                <input type="file" name="thumbnail" class="form-control mt-2">
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Update">

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
