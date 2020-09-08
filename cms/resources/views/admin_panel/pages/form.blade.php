@extends('adminlte::page')
@section('title', $pageTitle)

@section('content_header')
    <h1>{{ $pageTitle }}</h1>
@endsection

@section('content')

<form action="{{ $formAction }}" method="post" class="form-horizontal">
    @csrf
    @if ($editMode)
        @method('PUT')
    @endif

    <div class="card">
        <div class="card-body">
            <div class="form-group row">
                <label for="" class="col-sm-2 control-label">{{ __('attribs.title') }}:</label>
                <div class="col-sm-10">
                    <input type="text" autocomplete="off" name="title" value="{{ old('title', $page->title) }}" @if (! $editMode) autofocus @endif class="form-control @error('title') is-invalid @enderror">
                </div>
                @error('title')
                <div class="col-sm-2"></div>
                <div class="col-sm-10">
                    <span style="color: #dd4b39;">{{ $message }}</span>
                </div>
                @enderror
            </div>

            <div class="form-group row">
                <label for="" class="col-sm-2 control-label">{{ __('attribs.body') }}:</label>
                <div class="col-sm-10">
                    <textarea name="body" id="" cols="30" rows="10" class="form-control">{{ old('body', $page->body) }}</textarea>
                </div>
            </div>

        <div class="card-footer">
            <div class="form-group row">
                <div class="row">
                    <label for="" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <input type="submit" value="{{ __('util.' .($editMode ? 'edit' : 'create')) }}" class="btn btn-success">
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
