<?php

namespace App\Http\Controllers;

use App\Models\Show;
use App\Models\Artist;
use App\Models\Locality;
use App\Http\Requests\StoreShowRequest;
use App\Http\Requests\UpdateShowRequest;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $search = $request->input('search');
    $lieux = Locality::pluck('locality')->toArray();

    if ($search) {
        $shows = $this->search($request);
    } else {
        $shows = Show::all();
    }

    return view('show.index', [
        'shows' => $shows,
        'resource' => 'shows',
        'lieux' => $lieux,
        'search' => $search,
    ]);
}
public function search(Request $request)
{
    $search = $request->input('search');

    $shows = Show::where(function ($query) use ($search) {
        // search in shows
        $query->where('title', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%');
    })
    // search in artists
    ->orWhereHas('artistTypes.artist', function ($query) use ($search) {
        $query->where('firstname', 'like', '%' . $search . '%')
            ->orWhere('lastname', 'like', '%' . $search . '%');
    })
    // search in localities
    ->orWhereHas('location.locality', function ($query) use ($search) {
        $query->where('locality', 'like', '%' . $search . '%');
    })
    // search in types
    ->orWhereHas('artistTypes.type', function ($query) use ($search) {
        $query->where('type', 'like', '%' . $search . '%');
    })
    ->get();

    return $shows;
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

        $show->load('representations');

        foreach ($show->representations as $representation) {
            if (is_string($representation->schedule)) {
                $representation->schedule = \Carbon\Carbon::parse($representation->schedule);
            }
        }
        
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
