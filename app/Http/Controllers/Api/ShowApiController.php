<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Show;
use App\Http\Resources\ShowResource;
use Illuminate\Http\Request;

class ShowApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $paginate = $request->input('paginate', true);

        $query = Show::with([
            'location',
            'location.locality',
            'representations',
            'artists',
            'representations.representationReservations',
        ])->orderBy('id', 'desc');

        if ($paginate) {
            $shows = $query->paginate($perPage);
        } else {
            $shows = $query->get();
        }

        return ShowResource::collection($shows);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $show = Show::findOrFail($id)->load([
            'location',
            'location.locality',
            'representations',
            'artists',
            'representations.representationReservations',
        ]);

        return new ShowResource($show);
    }
    /**
     * Search for a specified resource.
     */

    //  http://127.0.0.1:8000/api/show/search?q=Ayiti
    public function search(Request $request)
    {
        return ShowResource::collection(Show::search($request->input('q'))->get());
    }

    public function destroy($id)
    {
        $show = Show::findOrFail($id);
        $show->delete();

        return response()->json(null, 204);
    }
}

