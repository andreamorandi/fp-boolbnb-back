<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;

class ApartmentSponsorshipController extends Controller
{
    public function index()
    {
        $apartments = Apartment::with('sponsorships')->get();
        return response()->json([
            'success' => true,
            'apartments' => $apartments
        ]);
    }
}
