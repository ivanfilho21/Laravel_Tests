@extends('layouts.app')
@section('page-title', 'Register')

@section('content')
<h1>Register</h1>

<form method="POST">
    @csrf

    <label for="name">{{ __('Name') }}</label><br>
    <input id="name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

    @error('name')
        <span>
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    <br>

    <label for="email">{{ __('E-Mail Address') }}</label><br>
    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email">

    @error('email')
        <span>
            <strong>{{ $message }}</strong>
        </span>
    @enderror
   
    <br>
    <label for="password">{{ __('Password') }}</label><br>
    <input id="password" type="password" name="password" required autocomplete="current-password">

    @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

    <br>
    <label for="password-confirm">{{ __('Confirm the Password') }}</label><br>
    <input id="password-confirm" type="password" name="password_confirmation" required>

    <br>
    <button type="submit" class="btn btn-primary">
        {{ __('Register') }}
    </button>
</form>
@endsection
