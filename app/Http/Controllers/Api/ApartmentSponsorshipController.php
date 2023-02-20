<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;

class ApartmentSponsorshipController extends Controller
{
    public function sponsored()
    {
        $apartments = Apartment::whereHas('sponsorships', function ($query) {
            $query->where('end_time', '>=', now());
        })->get();

        return response()->json([
            'success' => true,
            'apartments' => $apartments
        ]);
    }
}
