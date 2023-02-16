<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApartmentController extends Controller
{
    public function index(Request $request)
    {

        if ($request->has("full_address")) {
            //Chiamo api tomtom per latitudine e longitudine dell'indirizzo della ricerca
            $address = $request->full_address;
            $urlTomTom = "https://api.tomtom.com/search/2/geocode/" . $address . ".json?key=icqraNKAcD0A91G90JmWxaTl0MOJPR3a";
            $response = Http::withOptions(['verify' => false])->get($urlTomTom);
            $data = json_decode($response->body(), true);

            //Setto latitudie e longitudine
            $latitude = $data["results"][0]["position"]["lat"];
            $longitude = $data["results"][0]["position"]["lon"];

            // checking the range 
            if ($request->has("range")) {
                $range = $request->range;
            } else {
                $range = 20;
            }

            // $apartments = Apartment::with(['services'])
            // $apartments = Apartment::join('addresses', 'apartments.id', '=', 'addresses.apartment_id')
            //     ->selectRaw("apartments.*, ( 6371 * acos( cos( radians({$latitude}) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians({$longitude}) ) + sin( radians({$latitude}) ) * sin( radians( latitude ) ) ) ) AS distance")
            //     ->havingRaw("distance < {$range}");
            // dd($apartments);

            $apartments = Apartment::selectRaw('apartments.*, 6371 * 2 * ASIN(SQRT(POWER(SIN((' . $latitude . ' - abs(apartments.latitude)) * pi()/180 / 2), 2) + COS(' . $latitude . ' * pi()/180 ) * COS( abs(apartments.latitude) * pi()/180) * POWER(SIN((' . $longitude . ' - apartments.longitude) * pi()/180 / 2), 2) )) as distance')
                ->having('distance', '<', $range);

            // if ($request->has('rooms_number')) {
            //     $rooms_number = $request->rooms_number;
            //     $apartments = $apartments->where('rooms_number', '>=', $rooms_number);
            // }

            // if ($request->has('beds_number')) {
            //     $beds_number = $request->beds_number;
            //     $apartments = $apartments->where('beds_number', '>=', $beds_number);
            // }

            // if ($request->has('services')) {
            //     $services = $request->services;
            //     $apartments = $apartments->whereHas('services', function ($query) use ($services) {
            //         $query->whereIn('id', $services);
            //     });
            // }

            $apartments = $apartments->orderBy('distance')->get();
        } else {
            $apartments = Apartment::with(['address'])->get();
            // $apartments = Apartment::with(['services', 'address'])->get();
        }



        // $services = Service::all();

        return response()->json([
            "success" => true,
            "apartments" => $apartments,

            // 'services' => $services
        ]);
    }



    //     $apartments = Apartment::all();
    //     return response()->json([
    //         'success' => true,
    //         'results' => $apartments
    //     ]);
    // }

    public function show($slug)
    {
        $apartment = Apartment::with(['full_address'])->where('slug', $slug)->first();
        // $apartment = Apartment::with(['services', 'full_address'])->where('slug', $slug)->first();

        if ($apartment) {
            return response()->json([
                'success' => true,
                'apartment' => $apartment
            ]);
        } else {
            return response()->json([
                'success' => false,
                'error' => 'Nessun appartamento trovato'
            ]);
        }
    }
}
