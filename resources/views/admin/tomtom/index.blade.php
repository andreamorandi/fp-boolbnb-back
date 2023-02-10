@extends('layouts.admin')

@section('content')
    <div>
        <h1>Test mappa</h1>
        <div id="map" style="width: 500px; height: 500px;"></div>
    </div>

    <script>
        const apiKey = "icqraNKAcD0A91G90JmWxaTl0MOJPR3a"
        const address = encodeURIComponent("Viale Trastevere 45, 00153 Roma")

        axios.get(`https://api.tomtom.com/search/2/geocode/${address}.json?key=${apiKey}`).then(response => {
                console.log(response);
                let latitude = response.data.results[0].position.lat;
                let longitude = response.data.results[0].position.lon;

                console.log(`latitudine ${latitude}`);
                console.log(`longitudine ${longitude}`);


                let map = tt.map({
                    key: apiKey,
                    container: "map",
                    center: [longitude, latitude],
                    zoom: 10
                })

                map.on("load", () => {
                    new tt.Marker().setLngLat([longitude, latitude]).addTo(map)
                })
            })
            .catch(error => {
                console.log(error);
            });
    </script>
@endsection
