<?php

namespace App\Http\Controllers;

use App\Models\Representation;
use App\Models\Price;
use App\Http\Requests\StoreRepresentationRequest;
use App\Http\Requests\UpdateRepresentationRequest;

class RepresentationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $representations = Representation::all();

        return view('representation.index', [
            'representations' => $representations,
            'resource' => 'representations',
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
    public function store(StoreRepresentationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $representation = Representation::find($id);

        return view('representation.show', [
            'representation' => $representation,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Representation $representation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRepresentationRequest $request, Representation $representation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Representation $representation)
    {
        //
    }

    public function booking(string $id){

        $representation = Representation::find($id);

        if (is_string($representation->schedule)) {
            $representation->schedule = \Carbon\Carbon::parse($representation->schedule);
        }

        $currentPrices = Price::where('end_date', '=', null)->get();

        return view('representation.booking', [
            'representation' => $representation,
            'currentPrices' => $currentPrices,
        ]);
    }
}
