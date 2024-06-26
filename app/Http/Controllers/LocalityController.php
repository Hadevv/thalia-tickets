<?php

namespace App\Http\Controllers;

use App\Models\Locality;
use App\Http\Requests\StoreLocalityRequest;
use App\Http\Requests\UpdateLocalityRequest;

class LocalityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $localities = Locality::all();

        return view('locality.index', [
            'localities' => $localities,
            'resource' => 'localities',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLocalityRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $locality = Locality::find($id);

        return view('locality.show', [
            'locality' => $locality,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Locality $locality)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLocalityRequest $request, Locality $locality)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Locality $locality)
    {
        //
    }
}
