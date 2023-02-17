@extends('layouts.admin')

@section('content')
    <div class="text-start mt-4">
        <a class="btn btn-success" href="{{ url()->previous() }}">
            <i class="fa-solid fa-arrow-left">Indietro</i>
        </a>
    </div>
    <div class="container">
        <h1 class="text-center mt-3 text-primary">{{ $apartment->title }}</h1>
        <div class="row row-cols-2">
            <div class="col">
                <div class="text-center w-100 ">
                    @if ($apartment->image)
                        <img src="{{ asset('storage/' . $apartment->image) }}" alt="{{ 'Immagine di ' . $apartment->title }}"
                            style="max-height: 100%">
                    @else
                        <div class="w-100 bg-secondary ">
                            <img style="max-width:100%" src="{{ Vite::asset('public/images/no-image.jpg') }}"
                                alt="">
                        </div>
                    @endif
                </div>
            </div>
            <div class="col">
                <h5 class="mt-3">
                    Numero stanze: {{ $apartment->room_number }}
                </h5>
                <h5 class="mt-3">
                    Numero letti: {{ $apartment->bed_number }}
                </h5>
                <h5 class=" mt-3">
                    Numero bagni: {{ $apartment->bathroom_number }}
                </h5>
                <h5 class=" mt-3">
                    Superficie in metri quadri: {{ $apartment->surface_sqm }}
                </h5>
                <h5 class=" mt-3">
                    Servizi:
                    @forelse ($apartment->services as $service)
                        <span>#{{ $service->name }}</span>
                    @empty
                        <span>Nessun servizio specificato</span>
                    @endforelse
                </h5>
            </div>
        </div>
        <h5 class=" mt-5">
            Indirizzo: {{ $apartment->full_address }}
        </h5>
        <div class="mt-3 d-inline-block" id="map" style="width: 500px; height: 500px;"></div>
    </div>
    <script>
        const apiKey = "icqraNKAcD0A91G90JmWxaTl0MOJPR3a"
        const address = encodeURIComponent("<?php echo $apartment->full_address; ?>")

        axios.get(`https://api.tomtom.com/search/2/geocode/${address}.json?key=${apiKey}`).then(
                response => {
                    console.log(response);
                    let latitude = response.data.results[0].position.lat;
                    let longitude = response.data.results[0].position.lon;

                    console.log(`latitudine ${latitude}`);
                    console.log(`longitudine ${longitude}`);
                    // axios.get(
                    //     `https://api.tomtom.com/search/2/poiSearch/${address}.json?lat=${latitude}&lon=${longitude}&radius={20000}&key=${apiKey}`
                    // ).then(response => {
                    //     console.log(response);
                    // });


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
