@extends('adminlte::page')
@section('title', __('titles.dashboard'))

@section('css')
@endsection

@section('plugins.Chartjs', true)

@section('content_header')
<h1>{{ __('titles.dashboard') }}</h1>
@endsection

@section('content')

<form action="{{ route('panel.storePeriod') }}" method="POST">
	@csrf
	@method('PUT')

	<div class="form-group">
		<div class="row">
			<label class="col-sm-1 col-form-label text-center">{{ __('attribs.dashboard_period') }}:</label>
			
			<div class="col-sm-9">
				<select name="period" class="form-control">
				@foreach ($options as $k => $v)
					<option value="{{ $k }}" {{ $k == $dashboardPeriod ? 'selected' : '' }}>{{ $v['title'] }}</option>
				@endforeach
				</select>
			</div>

			<div class="col-sm-2 text-center">
				<button type="submit" class="btn btn-default">{{ __('util.set') }}</button>
			</div>
		</div>
	</div>
</form>

<div class="card">
    <div class="card-body">
        <div class="row">
			<!-- Total de Usuários Online -->
            <div class="col-md-3">
                <div class="small-box @if ($online > 0) bg-success @else bg-secondary @endif">
                    <div class="inner">
                        <h3>{{ $online }}</h3>
                        <p>{{ __('titles.online_users') }}</p>
                    </div>
                    <div class="icon">
                        <i class="far fa-fw fa-play-circle"></i>
                    </div>
				</div>
            </div>
		
			<!-- Total de Visitas -->
            <div class="col-md-3">
				<div class="small-box @if ($visits > 0) bg-info @else bg-secondary @endif">
                    <div class="inner">
                        <h3>{{ $visits }}</h3>
                        <p>{{ __('titles.visits') }}</p>
                    </div>
                    <div class="icon">
                        <i class="far fa-fw fa-eye"></i>
                    </div>
                </div>
            </div>
		
			<!-- Total de Páginas -->
            <div class="col-md-3">
                <div class="small-box @if ($pages > 0) bg-danger @else bg-secondary @endif">
                    <div class="inner">
                        <h3>{{ $pages }}</h3>
                        <p>{{ __('titles.pages') }}</p>
                    </div>
                    <div class="icon">
                        <i class="far fa-fw fa-copy"></i>
                    </div>
                </div>
            </div>
		
			<!-- Total de Usuários -->
            <div class="col-md-3">
                <div class="small-box @if ($users > 0) bg-primary @else bg-secondary @endif">
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
    </div>
</div>

<div class="row">
	<!-- Gráfico de Páginas mais Visitadas -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5>{{ __('titles.pages_most_visited') }}</h5>
            </div>
            <div class="card-body">
                <canvas id="pagesPie"></canvas>
            </div>
        </div>
	</div>
	
	<!-- Sidebar, últimas páginas adicionadas -->
	<div class="col-md-4">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">{{ __('titles.pages_last_added') }}</h3>
			</div>

			<div class="card-body p-0">
				<ul class="products-list product-list-in-card pl-2 pr-2">

					<li class="item">
						<div class="product-img"></div>
						<div class="product-info">
							<a href="#" class="product-title">Page</a>
							<span class="product-description">...</span>
						</div>
					</li>
				</ul>
			</div>

			<div class="card-footer text-center">
				<a href="#" style="text-transform: uppercase">{{ __('titles.pages_view_all') }}</a>
			</div>
		</div>
	</div>
</div>

@endsection

@section('js')
<script>
    window.onload = () => {
        let ctx = document.querySelector('#pagesPie').getContext('2d');
        window.pagePie = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: {!! $pageLabels !!},
                datasets: [
                    {
                        data: {!! $pageValues !!},
                        backgroundColor: {!! $pageColors !!},
                    }
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: true
                }
            }
        })
    }
</script>
@endsection