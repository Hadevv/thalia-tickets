<?php

namespace App\Http\Controllers;

use App\Models\Show;
use App\Models\Artist;
use App\Models\Locality;
use App\Http\Requests\StoreShowRequest;
use App\Http\Requests\UpdateShowRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Tag;
use Illuminate\Support\Facades\Log;

class ShowController extends Controller
{
    /**
     * Fonction pour afficher la liste des spectacles et les filtres de recherche associés
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     * @throws \Exception
     * @throws \Throwable
     */
    public function index(Request $request)
    {
        try {
            $search = $request->input('search');
            // Récupération des paramètres de recherche keyword
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
                    })
                    ->orWhereHas('tags', function ($query) use ($search) {
                        $query->where('tag', 'like', '%' . $search . '%');
                    });
            }

            if ($dateFrom && $dateTo) {
                $query->whereHas('representations', function ($query) use ($dateFrom, $dateTo) {
                    $query->whereBetween('schedule', [$dateFrom, $dateTo]);
                });
            }

            if ($location) {
                $query->whereHas('location.locality', function ($query) use ($location) {
                    $query->where('id', $location + 1);
                    // Zone de test pour vérifier si la localité est bien récupérée
                    // Attention comme pas tres propre, à supprimer
                    Log::info("Location: {$location}");
                });
            }

            // Pagination des spectacles
            $shows = $query->paginate(3);

            return view('show.index', [
                'shows' => $shows,
                'resource' => 'shows',
                'lieux' => $lieux,
                'search' => $search,
            ]);
        } catch (\Exception $e) {
            Log::error("Erreur dans la récupération des spectacles: {$e->getMessage()}");
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

    // Fonction pour ajouter un tag à un spectacle
    public function addTag(Request $request, Show $show)
    {

        $request->validate([
            'tag' => 'required|string|max:255',
        ]);

        $tagName = $request->input('tag');
        $tag = Tag::firstOrCreate(['tag' => $tagName]);
        $show->tags()->attach($tag->id);

        return response()->json(['success' => true, 'tag' => $tagName]);
    }

    public function removeTag(Request $request, Show $show)
    {

        $request->validate([
            'tag' => 'required|string|max:255',
        ]);

        $tagName = $request->input('tag');
        $tag = Tag::where('tag', $tagName)->first();

        if ($tag) {
            $show->tags()->detach($tag->id);
        }

        return redirect()->route('show.show', ['id' => $show->id, 'slug' => $show->slug]);
    }

    // Fonction pour stocker un spectacle
    public function store(StoreShowRequest $request, Show $show)
    {
        $validated = $request->validated();

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
    public function update(UpdateShowRequest $request, $id)
    {
        $validated = $request->validated();

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
            Log::error("Erreur lors de la suppression du spectacle avec l'ID spécifié {$id}: {$e->getMessage()}");

            // Redirection avec un message d'erreur
            return redirect()->route('admin.index')->with('error', 'Erreur lors de la suppression du spectacle.');
        }
    }
}
