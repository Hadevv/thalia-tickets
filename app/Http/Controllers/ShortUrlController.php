<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Show;
use AshAllenDesign\ShortURL\Facades\ShortURL;
use Illuminate\Support\Facades\Log;

class ShortUrlController extends Controller
{
    public function generateShortUrl(Show $show)
    {
        try {
            // on lui passe à la fois l'id et le slug
            $url = route('show.show', ['id' => $show->id, 'slug' => $show->slug]);
            Log::info('Generating short URL for: ' . $url);

            $shortUrl = ShortURL::destinationUrl($url)->make();

            Log::info('Short URL generated: ' . $shortUrl->default_short_url);

            return response()->json(['shortUrl' => $shortUrl->default_short_url]);
        } catch (\Exception $e) {
            Log::error('Error generating short URL: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to generate short URL'], 500);
        }
    }
}
