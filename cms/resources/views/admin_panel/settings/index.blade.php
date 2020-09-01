@extends('adminlte::page')

@section('title', __('titles.settings'))

@section('content_header')
    <h1>{{ __('titles.settings') }}</h1>
@endsection

@section('content')
    @if (session('success'))
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-check"></i>{{ __('util.alert') }}</h5>
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('panel.settings.save') }}" method="post">
        @csrf
        @method('PUT')

        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="" class="col-form-label">{{ __('site_settings.title') }}:</label>
                    <input type="text" name="title" id="" value="{{ old('title', $settings['title']) }}" class="form-control @error('title') is-invalid @enderror">
                    @error('title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="" class="col-form-label">{{ __('site_settings.subtitle') }}:</label>
                    <input type="text" name="subtitle" id="" value="{{ old('subtitle', $settings['subtitle']) }}" class="form-control @error('subtitle') is-invalid @enderror">
                    @error('subtitle')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="" class="col-form-label">{{ __('site_settings.bg_color') }}:</label>
                    <input type="color" name="bg_color" id="" value="{{ old('bg_color', $settings['bg_color']) }}" class="form-control" style="width: 50px;">
                    @error('bg_color')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="" class="col-form-label">{{ __('site_settings.pri_txt_color') }}:</label>
                    <input type="color" name="pri_txt_color" id="" value="{{ old('pri_txt_color', $settings['pri_txt_color']) }}" class="form-control" style="width: 50px;">
                    @error('pri_txt_color')
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