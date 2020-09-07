@extends('adminlte::page')
@section('title', __('titles.pages'))

@section('content_header')
    <h1>{{ __('titles.pages') }}</h1>
@endsection

@section('content')

@if (session('success'))
<div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fas fa-check"></i>{{ __('util.alert') }}</h5>
    {{ session('success') }}
</div>
@endif

<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>{{ __('attribs.title') }}</th>
                    <th>{{ __('util.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pages as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>{{ $p->title }}</td>
                    <td>
                        <a class="btn btn-sm btn-info" href="{{ route('pages.edit', ['page' => $p->id]) }}">{{ __('util.edit') }}</a>
                        @if (Auth::id() != $p->id)
                        <form class="d-inline" action="{{ route('pages.destroy', ['page' => $p->id]) }}" method="post" onsubmit="return confirm('{{ __('util.confirm_delete_pages', ['page' => $p->title]) }}');">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="{{ __('util.delete') }}" class="btn btn-sm btn-danger">
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
            
        </table>
    </div>
    {{ $pages->links() }}
</div>
<a class="btn btn-primary" href="{{ route('pages.create') }}" style="width: 56px; height: 56px; line-height: 42px; margin: 1em; border-radius: 50%; position: absolute; bottom: 0; right: 0;"><span class="fas fa-plus"></span></a>
@endsection
