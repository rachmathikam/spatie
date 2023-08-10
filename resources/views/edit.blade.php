@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="{{ route('users.update') }}" method="POST" class="row">
                            @csrf
                            <div class="form-group col-md-6">
                                <label for="">Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $users->name }}">
                                <input type="hidden" class="form-control" name="id" value="{{ $users->id }}">

                            </div>
                            <div class="form-group col-md-6">
                                <label for="">email</label>
                                <input type="email" class="form-control" name="email" value="{{ $users->email }}">
                            </div>

                            @if (Auth::user()->hasRole('admin'))
                                <div class="form-group col-md-6">
                                @else
                                    <div class="form-group col-md-12">
                            @endif

                            <label for="">password</label>
                            <input type="password" class="form-control" name="password" value="{{ $users->password }}">
                    </div>
                    @if (Auth::user()->hasRole('admin'))
                        <div class="form-group col-md-6">
                            <label for="">Role</label>
                            <select name="roles" class="form-control">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                    <a href="{{ route('home') }}" class="btn btn-secondary mt-3">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
