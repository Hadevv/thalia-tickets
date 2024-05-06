<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Show;
use App\Http\Resources\ShowResource;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;

class ShowApiController extends Controller
{
    use ApiResponseTrait;

    /**
     * Afficher une liste de ressources
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

        return $this->successResponse(ShowResource::collection($shows));
    }

    /**
     * Afficher la ressource spécifiée
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

        if (!$show) {
            return $this->errorResponse('Spectacle introuvable', 404);
        }

        return $this->successResponse(new ShowResource($show));
    }

    /**
     * Rechercher une ressource spécifiée
     *
     * http://127.0.0.1:8000/api/show/search?q=Ayiti
     */
    public function search(Request $request)
    {
        $query = $request->input('q');

        if (!$query) {
            return $this->errorResponse('Le paramètre de requête est requis', 400);
        }

        $shows = Show::search($query)->get();

        return $this->successResponse(ShowResource::collection($shows));
    }

    public function destroy($id)
    {
        $show = Show::findOrFail($id);

        if (!$show->delete()) {
            return $this->errorResponse('Impossible de supprimer le spectacle', 500);
        }

        return $this->successResponse(null, 'Spectacle supprimé avec succès', 204);
    }

    // @todo terminer les méthodes suivantes

    /**
     * Mettre à jour la ressource spécifiée dans le stockage.
     */
    public function update(Request $request, $id)
    {
        $show = Show::findOrFail($id);

        if (!$show->update($request->all())) {
            return $this->errorResponse('Impossible de mettre à jour le spectacle', 500);
        }

        return $this->successResponse(new ShowResource($show), 'Spectacle mis à jour avec succès');
    }

    /**
     * Stocker une nouvelle ressource dans le stockage.
     */
    public function store(Request $request)
    {
        $show = Show::create($request->all());

        if (!$show) {
            return $this->errorResponse('Impossible de créer le spectacle', 500);
        }

        return $this->successResponse(new ShowResource($show), 'Spectacle créé avec succès', 201);
    }

}

