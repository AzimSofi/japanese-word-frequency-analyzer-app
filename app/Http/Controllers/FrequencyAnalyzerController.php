<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class FrequencyAnalyzerController extends Controller
{
    public function test(Request $request)
    {
        $client = new Client();
        $response = $client->get('http://localhost:5000');

        // Decode the JSON response
        $data = json_decode($response->getBody(), true);
        return response()->json($data);
    }

    public function analyze($text_id)
    {
        $client = new Client();

        try {
            $response = $client->post('http://localhost:5000/analyze', [
                'json' => ['text_id' => $text_id]
            ]);

            // Decode JSON response
            $data = json_decode($response->getBody(), true);

            if (isset($data['error'])) {
                return response()->json(['error' => $data['error']], 404);
            }

            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to connect to FastAPI service'], 500);
        }
    }

}
