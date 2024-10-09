<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\InputText;
use App\Models\WordFrequency;

class InputTextController extends Controller
{
    public function index()
    {
        return view('input_text.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|min:10',
        ]);

        $inputText = InputText::create([
            'content' => $request->input('content'),
        ]);

        $client = new \GuzzleHttp\Client();
        try {
            // Make a POST request to API
            $response = $client->post('http://localhost:5000/analyze', [
                'json' => ['text_id' => $inputText->id],
            ]);

            // Decode the JSON
            $data = json_decode($response->getBody(), true);
            // dd($data);

            foreach ($data['frequencies'] as $word => $frequency) {
                WordFrequency::create([
                    'input_text_id' => $inputText->id,
                    'word' => $word,
                    'frequency' => $frequency,
                ]);
            }

            return redirect()->route('input-text.create')->with('success', 'Text has been saved and analyzed successfully!');
        } catch (\Exception $e) {
            return redirect()
                ->route('input-text.index')
                ->with('error', 'Failed to analyze the text: ' . $e->getMessage());
        }
    }
}
