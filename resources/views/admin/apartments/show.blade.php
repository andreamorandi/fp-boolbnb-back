@extends('layouts.admin')

@section('content')
    <div class="text-start mt-4">
        <a class="btn btn-success" href="{{ url()->previous() }}">
            <i class="fa-solid fa-arrow-left">Indietro</i>
        </a>
    </div>
    <div class="container">
        <h1 class="text-center mt-3 text-primary">{{ $apartment->title }}</h1>
        <div class="row w-100 d-flex flex-column flex-md-row">
            <div class="col">
                <div class="text-center w-100 ">
                    @if ($apartment->image)
                        <img src="{{ asset('storage/' . $apartment->image) }}" alt="{{ 'Immagine di ' . $apartment->title }}"
                            style="max-width: 100%">
                    @else
                        <div class="w-100 bg-secondary ">
                            <img style="max-width:100%" src="{{ Vite::asset('public/images/no-image.jpg') }}"
                                alt="">
                        </div>
                    @endif
                </div>
            </div>
            <div class="col">
                <div class="w-100 h-100 d-flex flex-row flex-md-column pt-5">
                    <h5 class="mt-3 me-3">
                        <i class="fa-solid fa-sign-hanging"></i> {{ $apartment->room_number }}
                    </h5>
                    <h5 class="mt-3 me-3">
                        <i class="fa-solid fa-bed"></i> {{ $apartment->bed_number }}
                    </h5>
                    <h5 class=" mt-3 me-3">
                        <i class="fa-solid fa-bath"></i> {{ $apartment->bathroom_number }}
                    </h5>
                    <h5 class=" mt-3">
                        <i class="fa-solid fa-crop-simple"></i> {{ $apartment->surface_sqm }}mq
                    </h5>
                </div>
            </div>
            <div class="mb-3 mt-3">
                <h5>
                    @forelse ($apartment->services as $service)
                        <span>#{{ $service->name }}</span>
                    @empty
                        <span>Nessun servizio</span>
                    @endforelse
                </h5>
            </div>
        </div>
        <h5 class=" mt-5">
            <i class="fa-solid fa-location-dot"></i> {{ $apartment->full_address }}
        </h5>
        <div class="mt-3 d-inline-block w-75" id="map" style=" height: 250px;"></div>
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
