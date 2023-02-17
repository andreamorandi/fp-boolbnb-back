@extends('layouts.admin')

@section('content')
    <div class="text-start mt-4">
        <a class="btn btn-success" href="{{ url()->previous() }}">
            <i class="fa-solid fa-arrow-left">Indietro</i>
        </a>
    </div>
    <div class="container d-flex align-items-center flex-column">
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
            Indirizzo: {{ $apartment->full_address }}
        </h4>
        <h4 class="text-center mt-3">
            Superficie in metri quadri: {{ $apartment->surface_sqm }}
        </h4>
        <div class="text-center text-danger mt-5">
            @if ($apartment->image)
                <img src="{{ asset('storage/' . $apartment->image) }}" alt="{{ 'Immagine di ' . $apartment->title }}"
                    style="max-height: 200px">
            @else
                <div class="w-50 bg-secondary py-4 text-center d-inline-block">
                    <h3>No image yet</h3>
                </div>
            @endif
        </div>
        <h4 class="text-center mt-3">
            Servizi:
            @forelse ($apartment->services as $service)
                <span>#{{ $service->name }}</span>
            @empty
                <span>Nessun servizio specificato</span>
            @endforelse
        </h4>
        <div class="mt-4 d-inline-block" id="map" style="width: 500px; height: 500px;"></div>
    </div>
    <script>
        const apiKey = "icqraNKAcD0A91G90JmWxaTl0MOJPR3a"
        const address = encodeURIComponent("<?php echo $apartment->full_address; ?>")

        axios.get(`https://api.tomtom.com/search/2/geocode/${address}.json?key=${apiKey}`).then(
                response => {
                    let latitude = response.data.results[0].position.lat;
                    let longitude = response.data.results[0].position.lon;

                    let map = tt.map({
                        key: apiKey,
                        container: "map",
                        center: [longitude, latitude],
                        zoom: 16
                    })

                    map.on("load", () => {
                        new tt.Marker().setLngLat([longitude, latitude]).addTo(map)
                    });
                })
            .catch(error => {

                console.log(error);
            });
    </script>
@endsection
