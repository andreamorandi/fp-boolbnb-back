<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\View;
use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Validator;

class ViewController extends Controller
{
    public function index($apartment_id)
    {
        $views = View::where('apartment_id', $apartment_id)->get();
        // return response()->json($views);

        if ($views) {
            return response()->json([
                'success' => true,
                'views' => $views
            ]);
        } else {
            return response()->json([
                'success' => false,
                'error' => 'Nessuna view'
            ]);
        }
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['guest_ip'] = FacadesRequest::ip();
        $validator = Validator::make($data, [
            'date' => ['required'],
            'guest_ip' => ['max:40'],
            'apartment_id' => ['required']
        ]);


        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        $add_view = new View();
        $add_view->fill($data);
        // dd($add_view);
        $add_view->save();

        return response()->json([
            'success' => true
        ]);
    }
}
