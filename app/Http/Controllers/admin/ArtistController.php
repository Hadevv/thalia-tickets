<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ArtistsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArtistRequest;
use App\Imports\ArtistsImport;
use App\Models\Artist;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\ArtistType;

class ArtistController extends Controller
{
    /**
     * Affiche la liste des artistes pour l'admin avec crud
     */
    public function index()
    {
        $artists = Artist::all();

        return view('admin.artist.index', [
            'artists' => $artists,
            'resource' => 'artistes'
        ]);
    }
    /**
     * Fonction pour créer un artiste
     */
    public function create()
    {
        $roles = Type::all();

        return view('admin.artist.create', [
            'roles' => $roles,
        ]);
    }
    /**
     * Fonction pour créer un artiste avec ses rôles associés
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'firstname' => 'required|max:60',
            'lastname' => 'required|max:60',
            'roles' => 'required|array|min:1',
        ]);

        $artist = new Artist();
        $artist->firstname = $validated['firstname'];
        $artist->lastname = $validated['lastname'];
        $artist->save();

        $artist->types()->attach($validated['roles']);

        return redirect()->route('artist.index');
    }

    /**
     * Affiche un artiste
     */
    public function show(string $id)
    {
        $artist = Artist::find($id);

        return view('artist.show', [
            'artist' => $artist,
        ]);
    }

    /**
     * Function pour éditer un artiste
     */
    public function edit(string $id)
    {
        $artist = Artist::find($id);
        $roles = Type::all();

        return view('admin.artist.edit', [
            'artist' => $artist,
            'roles' => $roles,
        ]);
    }

    /**
     * Mettre à jour un artiste
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'firstname' => 'required|max:60',
            'lastname' => 'required|max:60',
            'roles' => 'required|array|min:1',
        ]);

        try {
            $artist = Artist::findOrFail($id);

            // Mettre à jour les attributs de l'artiste
            $artist->firstname = $validated['firstname'];
            $artist->lastname = $validated['lastname'];
            $artist->save();

            // Mettre à jour les rôles de l'artiste
            $artist->types()->sync($validated['roles']);

            $artist->refresh();

            return view('admin.artist.show', [
                'artist' => $artist,
            ]);

        } catch (\Exception $e) {
            // Log de l'erreur
            Log::error("Erreur lors de la mise à jour d\'un artiste avec l\'ID spécifié {$id}: {$e->getMessage()}");

            // Redirection avec un message d'erreur
            return redirect()->route('admin.artist.index')->with('error', 'Erreur lors de la mise à jour de l\'artiste.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ArtistType::where('artist_id', $id)->delete();

        Artist::destroy($id);

        return redirect()->route('admin.artist.index');
    }

    /**
     * ADMIN cela serais plus malin de le mettre dans adminController
     */

    public function export()
    {
        return Excel::download(new ArtistsExport, 'artists.xlsx');
    }

    public function import(ArtistRequest $request)
    {
        try{

            Excel::import(new ArtistsImport, $request->file('file'));
            return response()->json(['data'=>'Users imported successfully.',201]);
        }catch(\Exception $ex){
            Log::info($ex);
            return response()->json(['data'=>'Some error has occur.',400]);

        }
    }
}
