@extends('adminlte::page')
@section('title', __('titles.dashboard'))

@section('css')
@endsection

@section('content_header')
<h1>{{ __('titles.dashboard') }}</h1>
@endsection

@section('content')

<div class="row">
    <div class="col-lg-3">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>999</h3>
                <p>{{ __('titles.visitors') }}</p>
            </div>
            <div class="icon">
                <i class="far fa-fw fa-eye"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>999</h3>
                <p>{{ __('titles.online_users') }}</p>
            </div>
            <div class="icon">
                <i class="far fa-fw fa-play-circle"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>999</h3>
                <p>{{ __('titles.pages') }}</p>
            </div>
            <div class="icon">
                <i class="far fa-fw fa-copy"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>999</h3>
                <p>{{ __('titles.users') }}</p>
            </div>
            <div class="icon">
                <i class="fas fa-fw fa-users"></i>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3>Most Visited</h3>
            </div>
            <div class="card-body">
                ...
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3>About</h3>
            </div>
            <div class="card-body">
                ...
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
@endsection