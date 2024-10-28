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

        $inputText = InputText::create(
            attributes: [
                'content' => $request->input('content'),
            ],
        );

        $client = new Client();
        try {
            $response = $client->post('http://localhost:5000/analyze', [
                'json' => ['content' => $inputText->content],
            ]);

            $data = json_decode($response->getBody(), true);
            // dd($data);

            foreach ($data['frequencies'] as $word => $frequency) {
                // Check if the word already exists for the current word
                $existingWord = WordFrequency::where('word', $word)->first();

                // dd(vars: $existingWord);
                if ($existingWord) {
                    $existingWord->update([
                        'frequency' => $existingWord->frequency + $frequency,
                    ]);
                } else {
                    WordFrequency::create([
                        'input_text_id' => $inputText->id,
                        'word' => $word,
                        'frequency' => $frequency,
                    ]);
                }
            }
            return redirect()->route('input-text.index')->with('success', 'Text has been saved and analyzed successfully!');
        } catch (\Exception $e) {
            return redirect()
                ->route('input-text.index')
                ->with('error', 'Failed to analyze the text: ' . $e->getMessage());
        }
    }
}
