<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Show;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggleLike(Request $request, Show $show)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthenticated'], 401);
            redirect()->route('login');
        }

        $user = $request->user();
        if ($user->likedShows()->where('show_id', $show->id)->exists()) {
            $user->likedShows()->detach($show);
            return response()->json(['status' => 'unliked']);
        } else {
            $user->likedShows()->attach($show);
            return response()->json(['status' => 'liked']);
        }
    }
}
