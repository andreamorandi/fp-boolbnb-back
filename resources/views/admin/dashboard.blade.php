@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-4">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('Benvenuto nella tua dashboard') }}



                        <a href="{{ route('admin.tomtom') }}" class="btn btn-primary">MAPPA</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
