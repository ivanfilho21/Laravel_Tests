@extends('layouts.app')
@section('page-title', 'Início')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div>
                    <h4>Mensagem Inicial:</h4>
                    <p>{{ $config->message ?? '' }}</p>
                </div>

                @guest
                    <p>
                        Use this to login:
                        admin@email.com
                        4321
                    </p>
                @else
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Welcome').' '.$user->name }}
                </div>
                @endguest
            </div>
        </div>
    </div>
</div>
@endsection
