<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Representation;
use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Show;
use App\Http\Requests\StoreRepresentationRequest;
use App\Http\Requests\UpdateRepresentationRequest;

class AdminRepresentationController extends Controller
{
    public function index()
    {
        $representations = Representation::with('location', 'show')->get();

        return view('admin.representation.index', [
            'representations' => $representations,
        ]);
    }

    public function create()
    {
        $locations = Location::all();
        $shows = Show::all();

        return view('admin.representation.create', [
            'locations' => $locations,
            'shows' => $shows,
        ]);
    }

    public function store(StoreRepresentationRequest $request)
    {
        $validated = $request->validated();

        $representation = new Representation();
        $representation->schedule = \Carbon\Carbon::parse($validated['schedule']);
        $representation->location_id = $validated['location_id'];
        $representation->show_id = $validated['show_id'];
        $representation->save();

        return redirect()->route('admin.representation.index')->with('notification', 'La représentation a bien été créée !');
    }


    public function show($id)
    {
        $representation = Representation::with('location', 'show')->findOrFail($id);

        return view('admin.representation.show', [
            'representation' => $representation,
        ]);
    }

    public function edit($id)
    {
        $representation = Representation::with('location', 'show')->findOrFail($id);
        $locations = Location::all();
        $shows = Show::all();

        return view('admin.representation.edit', [
            'representation' => $representation,
            'locations' => $locations,
            'shows' => $shows,
        ]);
    }

    public function update(UpdateRepresentationRequest $request, $id)
    {
        $validated = $request->validated();

        $representation = Representation::findOrFail($id);
        $representation->schedule = $validated['schedule'];
        $representation->location_id = $validated['location_id'];
        $representation->show_id = $validated['show_id'];
        $representation->save();

        return redirect()->route('admin.representation.index')->with('notification', 'La représentation a bien été mise à jour !');
    }

    public function destroy($id)
    {
        $representation = Representation::findOrFail($id);

        $representation->reservations()->delete();

        $representation->delete();

        return redirect()->route('admin.representation.index')->with('notification', 'La représentation a bien été supprimée !');
    }
}

