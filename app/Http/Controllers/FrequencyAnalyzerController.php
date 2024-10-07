<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class FrequencyAnalyzerController extends Controller
{
    public function analyzeText(Request $request)
    {
        // Initialize the Guzzle HTTP client
        $client = new Client();

        // Make a GET request to the FastAPI endpoint
        $response = $client->get('http://localhost:5000'); // Adjust the port if necessary

        // Decode the JSON response
        $data = json_decode($response->getBody(), true);

        // Return the data as a response or render a view
        return response()->json($data);
    }
}
