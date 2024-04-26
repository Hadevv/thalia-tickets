<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class HttpShowController extends Controller
{
    public function getShows($objectId)
    {
        $start = '0';
        $end = '5';
        $apiKey = env('CLE_API_CRIS');
        $entryPoint = 'https://www.theatre-contemporain.net';

        $apiRequest = "/api/spectacles/{$objectId}/schedules";

        $client = new Client();

        try {
            $response = $client->request('GET', $entryPoint . $apiRequest, [
                'query' => [
                    'k' => $apiKey,
                    'offset_start' => $start,
                    'offset_end' => $end,
                ],
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
            ]);

            $result = json_decode($response->getBody(), true);

            return response()->json($result);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la récupération des spectacles.'], 500);
        }
    }
}

