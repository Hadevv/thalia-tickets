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

class ShowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // dd(session('locale'));

        $search = $request->input('search');
        $lieux = Locality::pluck('locality')->toArray();

        if ($search) {
            $shows = $this->search($request);
        } else {
            $shows = Show::paginate(3);
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
            ->paginate(3);

        return $shows;
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('show.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Show $show)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:60'],
            'description' => ['required', 'string', 'max:2000'],
            'poster_url' => ['nullable', 'url:http,https', 'max:255'],
            'duration' => ['required', 'numeric'],
        ]);

        // Génération automatique du slug à partir du titre
        $slug = Str::slug($validated['title']);

        $show = new Show();

        // Affectation des valeurs validées aux propriétés du modèle Show
        $show->title = $validated['title'];
        $show->slug = $slug;
        $show->description = $validated['description'];
        $show->poster_url = $validated['poster_url'];
        $show->duration = $validated['duration'];
        $show->created_in = now()->year;

        $show->bookable = true;

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
            $show = Show::where('id', $id)->where('slug', $slug)->firstOrFail();

            $show->load('representations');

            foreach ($show->representations as $representation) {
                if (is_string($representation->schedule)) {
                    $representation->schedule = \Carbon\Carbon::parse($representation->schedule);
                }
            }

            return view('show.show', [
                'show' => $show,
            ]);

        } catch (\Exception $e) {
            // Log de l'exception
            Log::error("Error fetching show with ID {$id} and slug {$slug}: {$e->getMessage()}");

            // Redirection avec un message d'erreur
            return redirect()->route('show.index')->with('error', 'Erreur lors de la récupération du spectacle.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit($id)
    {
        $show = Show::findOrFail($id);

        return view('show.edit', compact('show'));
    }

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
        ]);

        // Génération auto du slug APD title
        $show = Show::find($id);

        $show->slug = Str::slug($validated['title']);

        $show->update($validated);

        return view('show.show', [
            'show' => $show
        ]);
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
