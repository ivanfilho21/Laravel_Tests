@extends('adminlte::page')
@section('title', __('titles.users_create'))

@section('content_header')
    <h1>{{ __('titles.users_create') }}</h1>
@endsection

@section('content')

<form action="{{ route('users.store') }}" method="post" class="form-horizontal">
    @csrf

    <div class="form-group">
        <div class="row">
            <label for="" class="col-sm-2 control-label">{{ __('attribs.name') }}:</label>
            <div class="col-sm-10">
                <input type="text" name="name" value="{{ old('name') }}" class="form-control">
            </div>
            @error('name')
            <div class="col-sm-2"></div>
            <div class="col-sm-10">
                <span style="color: #dd4b39;">{{ $message }}</span>
            </div>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <label for="" class="col-sm-2 control-label">{{ __('attribs.email') }}:</label>
            <div class="col-sm-10">
                <input type="email" name="email" value="{{ old('email') }}" class="form-control">
            </div>
            @error('email')
            <div class="col-sm-2"></div>
            <div class="col-sm-10">
                <span style="color: #dd4b39;">{{ $message }}</span>
            </div>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <label for="" class="col-sm-2 control-label">{{ __('attribs.password') }}:</label>
            <div class="col-sm-10">
                <input type="password" name="password" class="form-control">
            </div>
            @error('password')
            <div class="col-sm-2"></div>
            <div class="col-sm-10">
                <span style="color: #dd4b39;">{{ $message }}</span>
            </div>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <label for="" class="col-sm-2 control-label">{{ __('attribs.password_confirmation') }}:</label>
            <div class="col-sm-10">
                <input type="password" name="password_confirmation" class="form-control">
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <label for="" class="col-sm-2 control-label"></label>
            <div class="col-sm-10">
                <input type="submit" value="{{ __('util.create') }}" class="btn btn-success">
            </div>
        </div>
    </div>
</form>
@endsection
