@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="text-start mt-4">
            <a class="btn btn-success" href="{{ url()->previous() }}">
                <i class="fa-solid fa-arrow-left">Indietro</i>
            </a>
        </div>
        <h1 class="text-center mt-3 text-primary">{{ $apartment->title }}</h1>
        <h4 class="text-center mt-3">
            Numero di stanze: {{ $apartment->room_number }}
        </h4>
        <h4 class="text-center mt-3">
            Numero di letti: {{ $apartment->bed_number }}
        </h4>
        <h4 class="text-center mt-3">
            Numero di bagni: {{ $apartment->bathroom_number }}
        </h4>
        <h4 class="text-center mt-3">
            Superficie in metri quadri: {{ $apartment->surface_sqm }}
        </h4>
        <h4 class="text-center mt-3">
            Indirizzo: {{ $apartment->full_address }}
        </h4>
        <h4 class="text-center mt-3">
            Superficie in metri quadri: {{ $apartment->surface_sqm }}
        </h4>
        <div class="text-center text-danger mt-3">
            @if ($apartment->image)
                <img src="{{ asset('storage/' . $apartment->image) }}" alt="{{ 'Immagine di ' . $apartment->title }}">
            @else
                <div class="w-50 bg-secondary py-4 text-center d-inline-block">
                    <h3>No image yet</h3>
                </div>
            @endif
        </div>
    </div>
@endsection
