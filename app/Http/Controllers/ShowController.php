<?php

namespace App\Http\Controllers;

use App\Models\Show;
use App\Models\Artist;
use App\Models\Locality;
use App\Http\Requests\StoreShowRequest;
use App\Http\Requests\UpdateShowRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class ShowController extends Controller
{
    public function index(Request $request)
    {
        try {
            $search = $request->input('search');
            $dateFrom = $request->input('date_from');
            $dateTo = $request->input('date_to');
            $location = $request->input('location');
            $lieux = Locality::pluck('locality')->toArray();

            $query = Show::query();

            if ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%');
                })
                    ->orWhereHas('artistTypes.artist', function ($query) use ($search) {
                        $query->where('firstname', 'like', '%' . $search . '%')
                            ->orWhere('lastname', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('location.locality', function ($query) use ($search) {
                        $query->where('locality', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('artistTypes.type', function ($query) use ($search) {
                        $query->where('type', 'like', '%' . $search . '%');
                    });
            }

            if ($dateFrom && $dateTo) {
                $query->whereHas('representations', function ($query) use ($dateFrom, $dateTo) {
                    $query->whereBetween('schedule', [$dateFrom, $dateTo]);
                });
            }

            if ($location) {
                $query->whereHas('location.locality', function ($query) use ($location) {
                    $query->where('locality', $location);
                });
            }

            $shows = $query->paginate(3);

            return view('show.index', [
                'shows' => $shows,
                'resource' => 'shows',
                'lieux' => $lieux,
                'search' => $search,
            ]);

        } catch (\Exception $e) {
            Log::error("Error in ShowController@index: {$e->getMessage()}");
            return redirect()->route('show.index')->with('error', 'Une erreur est survenue lors de la récupération des spectacles.');
        }
    }
    // Fonction pour reset les filtres et la recherche
    public function clear(Request $request)
    {
        $request->session()->forget('search');
        $request->session()->forget('date_from');
        $request->session()->forget('date_to');
        $request->session()->forget('location');

        return redirect()->route('show.index');
    }
    // Fonction pour créer un spectacle
    public function create()
    {
        return view('show.create', [
            'artists' => Artist::all(),
        ]);
    }

    // Fonction pour stocker un spectacle
    public function store(Request $request, Show $show)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:60'],
            'description' => ['required', 'string', 'max:2000'],
            'poster_url' => ['nullable', 'url:http,https', 'max:255'],
            'duration' => ['required', 'numeric'],
            'poster' => ['nullable', 'image', 'max:2048'],
        ]);

        // Génération automatique du slug à partir du titre
        $slug = Str::slug($validated['title']);

        $show = new Show();

        $show->title = $validated['title'];
        $show->slug = $slug;
        $show->description = $validated['description'];
        $show->poster_url = $validated['poster_url'];
        $show->duration = $validated['duration'];
        $show->created_in = now()->year;

        $show->bookable = true;

        // Upload de l'image
        if ($request->hasFile('poster')) {
            $image = $request->file('poster');
            $imageName = $slug . '.' . $image->getClientOriginalExtension();

            // Stockage de l'image dans le répertoire public/posters
            $image->move(public_path('posters'), $imageName);

            // Stockage de l'image dans le répertoire public/images
            $image->move(public_path('images'), $imageName);

            $show->poster_url = $imageName;
        }
        $show->save();
        return redirect()->route('show.index');
    }

    /**
     * Afficher le spectacle et ses représentations associées
     *  -------------ADMIN-------------
     * @param string $id
     * @return \Illuminate\Contracts\View\View
     * @throws \Exception
     * @throws \Throwable
     */

    public function show(string $id, string $slug)
    {
        try {
            $show = Show::with('artists')->where('id', $id)->where('slug', $slug)->firstOrFail();

            $show->load('representations');

            foreach ($show->representations as $representation) {
                if (is_string($representation->schedule)) {
                    $representation->schedule = \Carbon\Carbon::parse($representation->schedule);
                }
            }

            $created_in = \Carbon\Carbon::parse($show->created_in);

            return view('show.show', compact('show', 'created_in'));

        } catch (\Exception $e) {
            Log::error("Error fetching show with ID {$id} and slug {$slug}: {$e->getMessage()}");
            return redirect()->route('show.index')->with('error', 'Erreur lors de la récupération du spectacle.');
        }
    }

    // Fonction pour éditer un spectacle
    public function edit($id)
    {
        $show = Show::findOrFail($id);

        $shows = Show::all();

        $artists = Artist::all();
        return view('show.edit', [
            'show' => $show,
            'artists' => $artists,
            'shows' => $shows,
        ]);
    }

    // Fonction pour mettre à jour un spectacle
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:60'],
            'description' => ['required', 'string', 'max:2000'],
            'poster_url' => [
                'nullable',
                'string',
                'max:255',
                Rule::requiredIf(function () use ($request) {
                    return preg_match('/^https?:\/\//', $request->poster_url);
                }),
                Rule::requiredIf(function () use ($request) {
                    return File::exists(public_path('images/' . basename($request->poster_url)));
                }),
            ],
            'duration' => ['required', 'numeric'],
            'artists' => ['nullable', 'array'],
            'artists.*' => ['exists:artists,id'],
        ]);

        $show = Show::findOrFail($id);

        // Mise à jour des données du spectacle
        $show->slug = Str::slug($validated['title']);
        $show->update($validated);

        // Mise à jour des artistes associés
        if (isset($validated['artists'])) {
            $show->artists()->sync($validated['artists']); // Cette méthode synchronise les artistes associés
        } else {
            $show->artists()->detach(); // Détache tous les artistes du spectacle
        }
        $show->refresh();

        return redirect()->route('show.show', ['id' => $show->id, 'slug' => $show->slug])->with('notification', 'Le spectacle a bien été mis à jour !');
    }

    /**
     * Supprimer le spectacle et ses représentations associées
     * -------------ADMIN-------------
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(string $id)
    {
        try {
            // Trouver le spectacle par son ID
            $show = Show::findOrFail($id);

            // Supprimer toutes les représentations liées au spectacle
            $show->representations()->delete();

            // Supprimer toutes les avis liés au spectacle
            $show->reviews()->delete();

            // Supprimer le spectacle
            $show->delete();

            session()->flash('notification', 'Le spectacle a bien été supprimé !');

            return redirect()->route('admin.index');

        } catch (\Exception $e) {
            // Log de l'exception
            Log::error("Error deleting show with ID {$id}: {$e->getMessage()}");

            // Redirection avec un message d'erreur
            return redirect()->route('admin.index')->with('error', 'Erreur lors de la suppression du spectacle.');
        }
    }
}
