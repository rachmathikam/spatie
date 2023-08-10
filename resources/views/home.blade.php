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
                    <div class="card-header"> {{ __('Dashboard') }}
                        @can('role-list')
                            |
                            <a href="{{ route('role') }}"> {{ __('Role') }}</a>
                        @endcan
                        @can('role-list')
                            |<a href="{{ route('permission') }}"> {{ __('Permission') }}</a>
                        @endcan
                    </div>


                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table class="table">
                            @can('user-create')
                                <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm me-3">Tambah User</a>
                            @endcan
                            @can('permission-list')
                                <a href="{{ route('role') }}" class="btn btn-primary btn-sm">Tambah Permission
                                    pengguna</a>
                            @endcan
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>
                                            @can('user-delete')
                                                <a href="{{ route('users.edit', $item->id) }}"
                                                    class="btn btn-warning btn-sm">Edit User</a>
                                            @endcan
                                            @can('user-delete')
                                                <a href="{{ route('users.delete', $item->id) }}"
                                                    class="btn btn-danger btn-sm">Delete
                                                    User</a>
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
