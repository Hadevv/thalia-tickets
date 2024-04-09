<?php

namespace App\Http\Controllers;

use App\Models\Show;
use App\Models\Artist;
use App\Http\Requests\StoreShowRequest;
use App\Http\Requests\UpdateShowRequest;

class ShowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shows = Show::all();

        return view('show.index', [
            'shows' => $shows,
            'resource' => 'shows',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // créer des artistes pour les associer à un spectacle
        $artists = Artist::all();

        return view('show.create', [
            'artists' => $artists,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreShowRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $show = Show::find($id);

        return view('show.show', [
            'show' => $show,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Show $show)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShowRequest $request, Show $show)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Show $show)
    {
        //
    }
}
