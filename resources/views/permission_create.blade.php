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
                    <div class="card-header"> <a href="{{ route('permission') }}"> {{ __('kembali') }}</a>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="{{ route('permission.store') }}" method="POST" class="row">
                            @csrf
                            <div class="form-group col-md-12">
                                <label for="">Permission</label>
                                <input type="text" class="form-control" name="name">
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
