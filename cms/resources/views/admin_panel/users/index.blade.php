@extends('adminlte::page')
@section('title', __('titles.users'))

@section('content_header')
    <h1>{{ __('titles.users') }}</h1>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>{{ __('attribs.name') }}</th>
                    <th>{{ __('attribs.email') }}</th>
                    <th>{{ __('util.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $u)
                <tr>
                    <td>{{ $u->id }}</td>
                    <td>{{ $u->name }}</td>
                    <td>{{ $u->email }}</td>
                    <td>
                        <a class="btn btn-sm btn-info" href="{{ route('users.edit', ['user' => $u->id]) }}">{{ __('util.edit') }}</a>
                        <a class="btn btn-sm btn-danger" href="{{ route('users.destroy', ['user' => $u->id]) }}">{{ __('util.delete') }}</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            
        </table>
    </div>
    {{ $users->links() }}
</div>
<a class="btn btn-primary" href="{{ route('users.create') }}" style="width: 56px; height: 56px; line-height: 42px; margin: 1em; border-radius: 50%; position: absolute; bottom: 0; right: 0;"><span class="fas fa-plus"></span></a>
@endsection
