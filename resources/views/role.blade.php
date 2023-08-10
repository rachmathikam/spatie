@extends('layouts.app')

@section('content')
    <style>
        a {
            text-decoration: none;
            color: #000000;
        }
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><a href="{{ route('home') }}"> {{ __('Dashboard') }}</a> | {{ __('Role') }}
                        | <a href="{{ route('permission') }}"> {{ __('Permission') }}</a></div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table class="table">
                            @can('user-create')
                                <a href="{{ route('role.create') }}" class="btn btn-primary btn-sm me-3">Tambah Role</a>
                            @endcan
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($role as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            @can('user-delete')
                                                <a href="{{ route('role.edit', $item->id) }}"
                                                    class="btn btn-warning btn-sm">Edit Role</a>
                                            @endcan
                                            @can('user-delete')
                                                <a href="{{ route('role.delete', $item->id) }}"
                                                    class="btn btn-danger btn-sm">Delete
                                                    Role</a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
