@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2 class="text-center">Modifica {{ $apartment->title }}</h2>
        <div class="row justify-content-center">
            <div class="col-8">
                <form action="{{ route('admin.apartments.update', $apartment->slug) }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group mb-3">
                        <label for="title">Titolo</label>
                        <input type="text" id="title" name="title" class="form-control"
                            value="{{ old('title', $apartment->title) }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="room_number">Numero di stanze</label>
                        <input type="text" id="room_number" name="room_number" class="form-control"
                            value="{{ old('room_number', $apartment->room_number) }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="bathroom_number">Numero di bagni</label>
                        <input type="text" id="bathroom_number" name="bathroom_number" class="form-control"
                            value="{{ old('bathroom_number', $apartment->bathroom_number) }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="surface_sqm">Superficie in metri quadri</label>
                        <input type="text" id="surface_sqm" name="surface_sqm" class="form-control"
                            value="{{ old('surface_sqm', $apartment->surface_sqm) }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="full_address">Indirizzo</label>
                        <input type="text" id="full_address" name="full_address" class="form-control"
                            value="{{ old('full_address', $apartment->full_address) }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="image">Immagine</label>
                        <input type="file" id="image" name="image" class="form-control"
                            value="{{ old('image', $apartment->image) }}">
                        <div class="mt-3">
                            <img id="image_preview" src="{{ asset('storage/' . $apartment->image) }}"
                                alt="{{ 'Immagine di ' . $apartment->title }}" style="max-height: 200px;">
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="is_visible">Visibile</label>
                        <input type="checkbox" name="is_visible" id="is_visible" class="form-check-input"
                            {{ old('is_visible', $apartment->is_visible) ? 'checked' : '' }}>
                    </div>

                    <button type="submit" class="btn btn-warning">Salva</button>
                </form>
            </div>
        </div>
    </div>
@endsection
