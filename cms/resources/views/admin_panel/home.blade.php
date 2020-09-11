@extends('adminlte::page')
@section('title', __('titles.dashboard'))

@section('css')
@endsection

@section('plugins.Chartjs', true)

@section('content_header')
<h1>{{ __('titles.dashboard') }}</h1>
@endsection

@section('content')

<div class="row">
    <div class="col-lg-3">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $visits }}</h3>
                <p>{{ __('titles.visits') }}</p>
            </div>
            <div class="icon">
                <i class="far fa-fw fa-eye"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="small-box @if ($online > 0) bg-success @endif bg-secondary">
            <div class="inner">
                <h3>{{ $online }}</h3>
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
                <h3>{{ $pages }}</h3>
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
                <h3>{{ $users }}</h3>
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
                <h5>Most Visited</h5>
            </div>
            <div class="card-body">
                <canvas id="pagesPie"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>About</h5>
            </div>
            <div class="card-body">
                ...
            </div>
        </div>
    </div>
</div>

<script>
    window.onload = () => {
        let ctx = document.querySelector('#pagesPie').getContext('2d');
        window.pagePie = new Chart(ctx, {
            type: 'pie',
            data: {
                datasets: [{
                    data: {!! $pageValues !!},
                    backgroundColor: {!! $pageColors !!},
                }],
                labels: {!! $pageLabels !!}
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: false
                }
            }
        })
    }
</script>

@endsection
@section('js')
@endsection