@extends('adminlte::page')

@section('title', __('titles.menus'))

@section('content_header')
    <h1>{{ __('titles.menus') }}</h1>
@endsection

@section('content')
    @if (session('success'))
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-check"></i>{{ __('util.alert') }}</h5>
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ $formRoute }}" method="post">
        @csrf
        @if ($editMode)
            @method('PUT')
        @endif

        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="" class="col-form-label">{{ __('attribs.name') }}:</label>
                    <input type="text" name="name" id="" value="{{ old('name', $menu->name ?? '') }}" class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="col-form-label">{{ __('attribs.page') }}:</label>

                    <div class="form-group row mb-3">
                        <label class="col-md-2 text-right form-check-label">
                            <input type="radio" name="page_type" value="0" @if (count($pages)) checked @endif class="form-check-input">
                            {{ __('attribs.from_website') }}:
                        </label>
                        
                        <div class="col-md-10">
                            <select name="page_site" class="form-control @error('page_site') is-invalid @enderror" @if (! count($pages)) disabled @endif>
                            @foreach ($pages as $k => $page)
                                <option value="{{ $k }}">{{ $page->title }}</option>
                            @endforeach
                            </select>

                            @error('page_site')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 text-right form-check-label">
                            <input type="radio" name="page_type" value="1" @if (! count($pages)) checked @endif class="form-check-input">
                            {{ __('attribs.external') }}:
                        </label>

                        <div class="col-md-10">
                            <input type="text" name="page_url" value="{{ old('page_url', $menu->page_url ?? '') }}" class="form-control @error('page_url') is-invalid @enderror">

                            @error('page_url')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer text-center">
                <button type="submit" class="btn btn-success">{{ __('util.save') }}</button>
            </div>
        </div>
    </form>
@endsection