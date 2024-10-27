<?php

namespace App\Http\Controllers;

use App\Models\WordFrequency;
use App\Models\Compare;
use App\Models\InputText;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class CompareController extends Controller
{
    public function index()
    {
        $input_texts = InputText::all();
        return view('compare.index', compact('input_texts'));
    }

    public function show($id)
    {
        $input_text = InputText::find($id);
        $frequency = WordFrequency::all();

        $client = new Client();
        $response = $client->post('http://localhost:5000/tokenize', [
            'json' => ['content' => $input_text->content],
        ]);
        $body = $response->getBody()->getContents();
        $tokenizedWords = json_decode($body, true)['words'] ?? [];

        //dd($tokenizedWords);
        $frequencyMap = [];
        foreach ($frequency as $word_frequency) {
            $frequencyMap[$word_frequency->word] = $word_frequency->frequency;
        }

        /*$wordFrequenciesDict = [];
        foreach ($tokenizedWords as $word) {
            // Assign frequency if the word exists in the frequencyMap, otherwise assign 0
            $wordFrequenciesDict[] = [
                'word' => $word,
                'frequency' => $frequencyMap[$word] ?? 0,
            ];
        }*/

        $maxFrequency = $frequency->max('frequency') ?? 1; // Avoid division by 0, ensure maxFrequency is at least 1
        $wordFrequenciesDict = [];
        foreach ($tokenizedWords as $word) {
            $frequencyValue = $frequencyMap[$word] ?? 0;
            $colorValue = intval(255 * ($frequencyValue / $maxFrequency));
            // (more frequency = more blue, less = red)
            $color = 'rgb(' . (255 - $colorValue) . ', 0, ' . $colorValue . ')';
            $wordFrequenciesDict[] = [
                'word' => $word,
                'frequency' => $frequencyValue,
                'color' => $color,
            ];
        }

        return view('compare.show', compact('input_text', 'frequency', 'wordFrequenciesDict'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|min:10',
        ]);

        $inputText = Compare::create([
            'content' => $request->input('content'),
        ]);

        try {
            return redirect()->route('compare.index')->with('success', 'Text has been saved!');
        } catch (\Exception $e) {
            return redirect()
                ->route('compare.index')
                ->with('error', 'Failed to add text: ' . $e->getMessage());
        }
    }
}
