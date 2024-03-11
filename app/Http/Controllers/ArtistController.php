<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artist;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $artists = Artist::all();

        return view('artist.index', [
            'artists' => $artists,
            'resource' => 'artistes'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('artist.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'firstname' => 'required|max:60',
            'lastname' => 'required|max:60',
        ]);

        $artist = new Artist();

        $artist->firstname = $validated['firstname'];
        $artist->lastname = $validated['lastname'];

        $artist->save();

        return redirect()->route('artist.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $artist = Artist::find($id);

        return view('artist.show', [
            'artist' => $artist,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $artist = Artist::find($id);

        return view('artist.edit', [
            'artist' => $artist,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'firstname' => 'required|max:60',
            'lastname' => 'required|max:60',
        ]);

        $artist = Artist::find($id);

        $artist->update($validated);

        return view('artist.show', [
            'artist' => $artist,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Artist::destroy($id);

        return redirect()->route('artist.index');
    }
}
