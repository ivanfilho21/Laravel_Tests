@extends('adminlte::page')

@section('title', __('titles.layout'))

@section('content_header')
    <h1>{{ __('titles.layout') }}</h1>
@endsection

@section('content')
    @if (session('success'))
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-check"></i>{{ __('util.alert') }}</h5>
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('panel.layout.save') }}" method="post">
        @csrf
        @method('PUT')

        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="" class="col-form-label">{{ __('layout.title') }}:</label>
                    <input type="text" name="title" id="" value="{{ old('title', $layout['title']) }}" class="form-control @error('title') is-invalid @enderror">
                    @error('title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="" class="col-form-label">{{ __('layout.subtitle') }}:</label>
                    <input type="text" name="subtitle" id="" value="{{ old('subtitle', $layout['subtitle']) }}" class="form-control @error('subtitle') is-invalid @enderror">
                    @error('subtitle')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="card-footer text-center">
                <button type="submit" class="btn btn-success">{{ __('util.save') }}</button>
            </div>
        </div>
    </form>
@endsection