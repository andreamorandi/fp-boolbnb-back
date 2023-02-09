<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreApartmentRequest;
use App\Http\Requests\UpdateApartmentRequest;
use App\Models\Apartment;
use Illuminate\Support\Facades\Storage;
use App\Functions\Helpers;
use Illuminate\Support\Facades\Auth;


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
        return view('admin.apartments.create', compact('apartments'));
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
        $form_data['is_visible'] = $request->has('is_visible') ? 1 : 0;
        $form_data['user_id'] = Auth::id();
        $apartment = Apartment::create($form_data);
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
        if ($apartment->user_id === Auth::id()) {
            return view('admin.apartments.edit', compact('apartment'));
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
        $apartment->delete();
        return redirect()->route('admin.apartments.index')->with('message', "$apartment->title è stato rimosso");
    }
}
