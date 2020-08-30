@extends('adminlte::page')
@section('title', __('titles.profile'))

@section('content_header')
<h1>{{ __('titles.profile') }}</h1>
@endsection

@section('content')
<div class="card">

    <div class="card-body">
        <div class="row">
            <form action="{{ route('panel.profile.save') }}" method="post">
                @csrf
                @method('PUT')

                <label for="">{{ __('attribs.name') }}</label>
                <input type="text" name="" id="" value="{{ old('name', $user->name) }}">

                <input type="submit" class="btn btn-success" value="{{ __('util.save') }}">
            </form>
        </div>

        <div class="row">
            Email
        </div>
    </div>
</div>
@endsection