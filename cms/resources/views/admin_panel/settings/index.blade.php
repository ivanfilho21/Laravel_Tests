@extends('adminlte::page')

@section('title', __('titles.settings'))

@section('content_header')
    <h1>{{ __('titles.settings') }}</h1>
@endsection

@section('content')
    <form action="{{ route('panel.settings.save') }}" method="post">
        @csrf
        @method('PUT')

        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="" class="col-form-label">{{ __('site_settings.title') }}:</label>
                    <input type="text" name="title" id="" value="{{ old('title', $settings['title']) }}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="" class="col-form-label">{{ __('site_settings.subtitle') }}:</label>
                    <input type="text" name="subtitle" id="" value="{{ old('subtitle', $settings['subtitle']) }}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="" class="col-form-label">{{ __('site_settings.bg_color') }}:</label>
                    <input type="color" name="bg_color" id="" value="{{ old('bg_color', $settings['bg_color']) }}" class="form-control" style="width: 50px;">
                </div>

                <div class="form-group">
                    <label for="" class="col-form-label">{{ __('site_settings.pri_txt_color') }}:</label>
                    <input type="color" name="pri_txt_color" id="" value="{{ old('pri_txt_color', $settings['pri_txt_color']) }}" class="form-control" style="width: 50px;">
                </div>
            </div>

            <div class="card-footer text-center">
                <input type="submit" value="{{ __('util.save') }}" class="btn btn-success">
            </div>
        </div>
    </form>
@endsection