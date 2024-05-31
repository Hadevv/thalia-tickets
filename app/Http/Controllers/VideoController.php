<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Show;
use App\Models\Video;
use App\Models\Artist;

class VideoController extends Controller
{
    public function showVideos($showId)
    {
        $show = Show::with('videos')->findOrFail($showId);
        return view('shows.videos', compact('show'));
    }

    public function store(Request $request, $showId)
    {
        $request->validate([
            'title' => 'required|max:255',
            'video_url' => 'required|url|unique:videos,video_url',
        ]);

        $show = Show::findOrFail($showId);

        if ($show->representations->isEmpty()) {
            return redirect()->back()->withErrors(['error' => 'pas de representation pour ce show']);
        }

        $video = new Video($request->all());
        $video->show_id = $showId;
        $video->save();

        return redirect()->route('show.videos', $showId);
    }
    public function showArtistVideos($name)
    {
        $artist = Artist::where('name', $name)->firstOrFail();
        $shows = $artist->shows()->with('videos')->get();

        return view('artists.videos', compact('artist', 'shows'));
    }
}
