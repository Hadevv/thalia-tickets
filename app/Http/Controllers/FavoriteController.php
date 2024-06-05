<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Show;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function toggleFavorite(Request $request, Show $show)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthenticated'], 401);
            redirect()->route('login');
        }

        $user = $request->user();
        if ($user->favoriteShows()->where('show_id', $show->id)->exists()) {
            $user->favoriteShows()->detach($show);
            return response()->json(['status' => 'unfavorited']);
        } else {
            $user->favoriteShows()->attach($show);
            return response()->json(['status' => 'favorited']);
        }
    }
}
