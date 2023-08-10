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
                        <form action="{{ route('role.addpermission') }}" method="POST" class="row">
                            @csrf

                            <div class="form-group col-md-12">
                                <label for="">Role</label>
                                <select name="role" class="form-control">
                                    <option selected>-- Pilih Role --</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="">Hak Akses</label>
                                <br>
                                @foreach ($permissions as $item)
                                    <label for="flexCheckDefault"
                                        class="form-check-label ms-3 me-2">{{ $item->name }}</label>
                                    <input type="checkbox" name="permission[]" class="form-check-input"
                                        value="{{ $item->name }}" id="flexCheckDefault">
                                @endforeach
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                            <a href="{{ route('home') }}" class="btn btn-secondary mt-3">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
