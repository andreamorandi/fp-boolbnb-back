<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
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
                ->where('is_visible', true)
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
                $apartments = $apartments->where(function ($query) use ($services) {
                    $query->whereHas('services', function ($subquery) use ($services) {
                        $subquery->whereIn('id', $services);
                    }, '>=', count($services));
                });
            }

            $filteredApartments = clone $apartments;

            $sponsoredApartments = $apartments->whereHas('sponsorships', function ($query) {
                $query->where('end_time', '>=', now());
            })->get();

            $notSponsoredApartments = $filteredApartments->whereDoesntHave('sponsorships')
                ->orWhereHas('sponsorships', function ($query) {
                    $query->where('end_time', '<', now());
                })
                ->orderBy('distance')
                ->get();

            $mergedApartments = $sponsoredApartments->merge($notSponsoredApartments);

            $apartments = new LengthAwarePaginator(
                $mergedApartments->forPage(request()->page, 5),
                $mergedApartments->count(),
                5,
                request()->page,
                ['path' => url()->current()]
            );
        } else {
            $apartments = Apartment::query()
                ->where('is_visible', true);
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
                $apartments = $apartments->where(function ($query) use ($services) {
                    $query->whereHas('services', function ($subquery) use ($services) {
                        $subquery->whereIn('id', $services);
                    }, '>=', count($services));
                });
            }

            $filteredApartments = clone $apartments;

            $sponsoredApartments = $apartments->whereHas('sponsorships', function ($query) {
                $query->where('end_time', '>=', now());
            })->get();

            $notSponsoredApartments = $filteredApartments->whereDoesntHave('sponsorships')
                ->orWhereHas('sponsorships', function ($query) {
                    $query->where('end_time', '<', now());
                })
                ->get();

            $mergedApartments = $sponsoredApartments->merge($notSponsoredApartments);

            $apartments = new LengthAwarePaginator(
                $mergedApartments->forPage(request()->page, 5),
                $mergedApartments->count(),
                5,
                request()->page,
                ['path' => url()->current()]
            );
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
