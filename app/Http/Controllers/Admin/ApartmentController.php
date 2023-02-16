<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreApartmentRequest;
use App\Http\Requests\UpdateApartmentRequest;
use App\Models\Apartment;
use Illuminate\Support\Facades\Storage;
use App\Functions\Helpers;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments = Apartment::where('user_id', Auth::id())->get();
        return view('admin.apartments.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $apartments = Apartment::all();
        $services = Service::all();
        return view('admin.apartments.create', compact('apartments', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreApartmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreApartmentRequest $request)
    {
        $form_data = $request->validated();
        $form_data['slug'] = Helpers::generateSlug($form_data['title']);
        if ($request->hasFile('image')) {
            $path = Storage::put('apartment_images', $request->image);
            $form_data['image'] = $path;
        }

        $address = $form_data['full_address'];
        $addressApi = urlencode($address);
        $urlTomTom = "https://api.tomtom.com/search/2/geocode/" . $addressApi . ".json?key=icqraNKAcD0A91G90JmWxaTl0MOJPR3a";
        $response = Http::withOptions(['verify' => false])->get($urlTomTom);
        $data = json_decode($response->body(), true);

        if ($data["summary"]["totalResults"] == 1) {

            $form_data["latitude"] = $data["results"][0]["position"]["lat"];
            $form_data["longitude"] = $data["results"][0]["position"]["lon"];
        } else {
            return back()->withErrors("$address non è un indirizzo valido!")->withInput();
        }

        $form_data['is_visible'] = $request->has('is_visible') ? 1 : 0;
        $form_data['user_id'] = Auth::id();
        $apartment = Apartment::create($form_data);


        if ($request->has('services')) {
            $apartment->services()->attach($form_data['services']);
        }

        return redirect()->route('admin.apartments.index')->with('message', "L'appartamento è stato aggiunto con successo");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        if ($apartment->user_id === Auth::id()) {
            return view('admin.apartments.show', compact('apartment'));
        } else {
            return abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        $services = Service::all();
        if ($apartment->user_id === Auth::id()) {
            return view('admin.apartments.edit', compact('apartment', 'services'));
        } else {
            return abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateApartmentRequest  $request
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateApartmentRequest $request, Apartment $apartment)
    {
        $form_data = $request->validated();
        $form_data['slug'] = Helpers::generateSlug($form_data['title']);
        if ($request->hasFile('image')) {
            if ($apartment->image) {
                Storage::delete($apartment->image);
            }
            $path = Storage::put('apartment_images', $request->image);
            $form_data['image'] = $path;
        }
        $form_data['is_visible'] = $request->has('is_visible') ? 1 : 0;
        $apartment->update($form_data);


        if ($request->has('services')) {
            $apartment->services()->sync($form_data['services']);
        } else {
            $apartment->services()->sync([]);
        }

        return redirect()->route('admin.apartments.index')->with('message', "$apartment->title è stato aggiornato con successo");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        if ($apartment->image) {
            Storage::delete($apartment->image);
        }

        $apartment->services()->detach();

        $apartment->delete();
        return redirect()->route('admin.apartments.index')->with('message', "$apartment->title è stato rimosso");
    }
}
