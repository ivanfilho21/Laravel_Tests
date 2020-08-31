@extends('adminlte::page')
@section('title', __('titles.profile'))

@section('content_header')
<h1>{{ __('titles.profile') }}</h1>
@endsection

@section('content')

@if (session('success'))
<div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fas fa-check"></i>{{ __('util.alert') }}</h5>
    {{ session('success') }}
</div>
@endif

<form action="{{ route('panel.profile.save') }}" method="post">
    @csrf
    @method('PUT')

    <div class="card">
        <div class="card-body">
            <div class="image text-center">
                <img src="{{ asset('profile.jpg') }}" alt="Profile Picture" class="img-circle">
            </div>

            <div class="form-group">
                <label for="" class="col-label">{{ __('attribs.name') }}:</label>
                <input type="text" name="name" id="" value="{{ old('name', $user->name) }}" class="form-control">
            </div>

            <div class="form-group">
                <label for="" class="col-label">{{ __('attribs.email') }}:</label>
                <input type="email" name="email" disabled id="" value="{{ old('email', $user->email) }}" class="form-control">
            </div>

            <div class="form-group">
                <label for="" class="col-label">{{ __('attribs.password') }}:</label>
                <input type="password" name="password" id="" class="form-control">
            </div>

            <div class="form-group">
                <label for="" class="col-label">{{ __('attribs.password_confirmation') }}:</label>
                <input type="password" name="password_confirmation" id="" class="form-control">
            </div>
        </div>

        <div class="card-footer text-center">
            <button type="submit" class="btn btn-success">{{ __('util.update_profile') }}</button>
        </div>
    </div>
</form>
@endsection