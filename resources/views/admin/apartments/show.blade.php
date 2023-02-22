@extends('layouts.admin')

@section('content')
    <div class="text-start mt-4">
        <a class="btn btn-success" href="{{ url()->previous() }}">
            Indietro
        </a>
    </div>
    <div class="container">
        <input type="hidden" id="apartment-id" value="{{ $apartment->id }}">
        <div class="row justify-content-center">
            <div class="col-auto">
                <h1>{{ $apartment->title }}</h1>
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-lg-6 col-sm-12">
                @if ($apartment->image)
                    <img src="{{ asset('storage/' . $apartment->image) }}" alt="{{ 'Immagine di ' . $apartment->title }}"
                        style="max-width: 100%">
                @else
                    <div class="">
                        <img class="w-100"src="{{ Vite::asset('public/images/no-image.jpg') }}" alt="">
                    </div>
                @endif
            </div>
            <div class="col-lg-6 col-sm-12">
                <div class="row justify-content-center mb-3">
                    <div class="col-auto">
                        <h4>Servizi disponibili</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <h6>
                            <i class="fa-solid fa-sign-hanging"></i> {{ $apartment->room_number }} Numero di stanze
                            <hr>
                        </h6>
                        <h6>
                            <i class="fa-solid fa-bed"></i> {{ $apartment->bed_number }} Numero di letti
                            <hr>
                        </h6>
                        <h6>
                            <i class="fa-solid fa-bath"></i> {{ $apartment->bathroom_number }} Numero di bagni
                            <hr>
                        </h6>
                        <h6>
                            <i class="fa-solid fa-crop-simple"></i>
                            {{ $apartment->surface_sqm }} Superfice in mq
                            <hr>
                        </h6>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        @forelse ($apartment->services as $service)
                            <h6>{{ $service->name }}</h6>
                            <hr>
                        @empty
                            <span>Nessun servizio</span>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-auto">
                    <a href="{{ route('admin.apartments.sponsorship', $apartment->slug) }}"
                        class="link-dark text-decoration-none btn btn-warning mt-3 ">Attiva
                        la Sponsorizzazione
                    </a>
                </div>
            </div>
            <h5 class=" mt-3 mb-3">
                <i class="fa-solid fa-location-dot"></i> {{ $apartment->full_address }}
            </h5>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div id="map" style="height: 300px;"></div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="chart-container" style="height: 300px;">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <style lang="scss" scoped>
        h1,
        h4 {
            color: #c9e265;
            font-weight: bold
        }
    </style>


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

@push('scripts')
    @vite('resources/js/statistics.js')
@endpush
