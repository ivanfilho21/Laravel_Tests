@extends('layouts.app')
@section('page-title', 'Login')

@section('content')
<h1>Login</h1>

<form method="POST">
    @csrf

    <p>Login Tries: {{ $tries }}</p>

    @if (session('warning'))
        <div class="warning">
            @slot('alertType', 'Aviso')
            {{ session('warning') }}
        </div>
    @endif

    <label for="email">{{ __('E-Mail Address') }}</label><br>
    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
    <br>

    <label for="password">{{ __('Password') }}</label><br>
    <input id="password" type="password" name="password" required autocomplete="current-password">
    <br>

    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

    <label class="form-check-label" for="remember">
        {{ __('Remember Me') }}
    </label>
    
    <br>
    <button type="submit" class="btn btn-primary">
        {{ __('Login') }}
    </button>
</form>
@endsection
