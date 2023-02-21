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
            $address = $request->full_address;
            $urlTomTom = "https://api.tomtom.com/search/2/geocode/" . $address . ".json?key=icqraNKAcD0A91G90JmWxaTl0MOJPR3a";
            $response = Http::withOptions(['verify' => false])->get($urlTomTom);
            $data = json_decode($response->body(), true);

            $latitude = $data["results"][0]["position"]["lat"];
            $longitude = $data["results"][0]["position"]["lon"];

            if ($request->has("range")) {
                $range = $request->range;
            } else {
                $range = 20;
            }

            $apartments = Apartment::selectRaw('apartments.*, 6371 * 2 * ASIN(SQRT(POWER(SIN((' . $latitude . ' - abs(apartments.latitude)) * pi()/180 / 2), 2) + COS(' . $latitude . ' * pi()/180 ) * COS( abs(apartments.latitude) * pi()/180) * POWER(SIN((' . $longitude . ' - apartments.longitude) * pi()/180 / 2), 2) )) as distance')
                ->having('distance', '<', $range);

            if ($request->has('room_number')) {
                $room_number = $request->room_number;
                $apartments = $apartments->where('room_number', '>=', $room_number);
            }

            if ($request->has('bed_number')) {
                $bed_number = $request->bed_number;
                $apartments = $apartments->where('bed_number', '>=', $bed_number);
            }

            if ($request->has('services')) {
                $services = $request->services;
                $apartments = $apartments->whereHas('services', function ($query) use ($services) {
                    foreach ($services as $service) {
                        $query->where('id', $service);
                    }
                }, '=', count($services));
            }

            $apartments = $apartments->orderBy('distance')->paginate(5);
        } else {
            $apartments = Apartment::query();
            if ($request->has('room_number')) {
                $room_number = $request->room_number;
                $apartments = $apartments->where('room_number', '>=', $room_number);
            }

            if ($request->has('bed_number')) {
                $bed_number = $request->bed_number;
                $apartments = $apartments->where('bed_number', '>=', $bed_number);
            }

            if ($request->has('services')) {
                $services = $request->services;
                $apartments = $apartments->whereHas('services', function ($query) use ($services) {
                    foreach ($services as $service) {
                        $query->where('id', $service);
                    }
                }, '=', count($services));
            }
            $apartments = $apartments->paginate(5);
        }

        return response()->json([
            "success" => true,
            "apartments" => $apartments,
        ]);
    }

    public function show($slug)
    {
        $apartment = Apartment::with('services')->where('slug', $slug)->first();

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
