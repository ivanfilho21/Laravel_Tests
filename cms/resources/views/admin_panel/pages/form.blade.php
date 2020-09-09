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
                    <textarea name="body" cols="30" rows="10" class="form-control">{{ old('body', $page->body) }}</textarea>
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

<script src="https://cdn.tiny.cloud/1/5rvi4e9sj64xykloqo2untzya5o4m38tmzpl8r21jou4m7ae/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
      selector: 'textarea.form-control',
      menubar: false,
      plugins: ['link', 'table', 'image', 'autoresize', 'lists'],
      toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright justify',
      toolbar_mode: 'floating',
    });
  </script>
@endsection
