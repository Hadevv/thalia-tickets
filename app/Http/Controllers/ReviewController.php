<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Http\Requests\UpdatereviewsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{

    /**
     * Fonction pour enregistrer un avis sur un spectacle donné
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'review' => 'required|string',
                'stars' => 'required|integer',
                'show_id' => 'required|exists:shows,id',
            ]);

            $review = new Review();

            $review->review = $validatedData['review'];
            $review->stars = $validatedData['stars'];
            $review->show_id = $validatedData['show_id'];

            // Récupérer l'id de l'utilisateur connecté
            $user_id = Auth::id();

            // Utilisateur est-il bien connecté avant d'enregistrer l'avis
            if ($user_id) {
                $review->user_id = $user_id;
            } else {
                // Redirection avec un message d'erreur
                return redirect()->route('home')->with('error', 'Vous devez être connecté pour laisser un avis.');
            }

            $review->save();

            // Redirection avec un message de succès
            return redirect()->route('home')->with('success', 'Votre avis a bien été enregistré.');
        } catch (\Exception $e) {
            // En cas d'erreur, enregistrez le message d'erreur dans les logs
            Log::error('Erreur lors de l\'enregistrement de l\'avis : ' . $e->getMessage());

            // Redirection avec un message d'erreur
            return redirect()->route('home')->with('error', 'Une erreur est survenue lors de l\'enregistrement de votre avis.');
        }
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    /**
     * Display the specified resource.
     */
    public function show(Review $reviews)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $reviews)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatereviewsRequest $request, Review $reviews)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $reviews)
    {
        //
    }
}
