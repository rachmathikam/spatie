@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('edit') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="{{ route('permission.update') }}" method="POST" class="row">
                            @csrf
                            <div class="form-group col-md-12">
                                <label for="">Permission</label>
                                <input type="text" class="form-control" name="permission"
                                    value="{{ $permission->name }}">
                                <input type="hidden" class="form-control" name="id" value="{{ $permission->id }}">
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                            <a href="{{ route('permission') }}" class="btn btn-secondary mt-3">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
