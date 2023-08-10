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
                        <form action="{{ route('role.update') }}" method="POST" class="row">
                            @csrf
                            <div class="form-group col-md-12">
                                <label for="">Role</label>
                                <input type="text" class="form-control" name="role" value="{{ $role->name }}">
                                <input type="hidden" class="form-control" name="id" value="{{ $role->id }}">
                            </div>
                            @foreach ($permissions as $permission)
                                <label>
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                        {{ $user->hasPermissionTo($permission) ? 'checked' : '' }}>
                                    {{ $permission->name }}
                                </label><br>
                            @endforeach
                            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                            <a href="{{ route('role') }}" class="btn btn-secondary mt-3">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
