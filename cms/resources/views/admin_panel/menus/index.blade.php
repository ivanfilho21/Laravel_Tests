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

<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>{{ __('attribs.name') }}</th>
                    <th class="text-center">{{ __('attribs.submenu') }}</th>
                    <th class="text-center">{{ __('util.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($menus as $m)
                <tr>
                    <td>{{ $m->id }}</td>
                    <td><a href="{{ $m->page_slug ?? $m->page_url }}" target="_blank">{{ $m->name }}</a></td>
                    <td class="text-center">{{ $m->submenus ? 'Yes' : '' }}</td>
                    <td class="text-center">
                        <a class="btn btn-sm btn-info" href="{{ route('menus.edit', ['menu' => $m->id]) }}">{{ __('util.edit') }}</a>

                        <form class="d-inline" action="{{ route('menus.destroy', ['menu' => $m->id]) }}" method="post" onsubmit="return confirm('{{ __('util.confirm_delete_menus', ['menu' => $m->title]) }}');">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="{{ __('util.delete') }}" class="btn btn-sm btn-danger">
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            
        </table>
    </div>
    {{ $menus->links() }}
</div>
<a class="btn btn-primary" href="{{ route('menus.create') }}" style="width: 56px; height: 56px; line-height: 42px; margin: 1em; border-radius: 50%; position: absolute; bottom: 0; right: 0;"><span class="fas fa-plus"></span></a>
@endsection
