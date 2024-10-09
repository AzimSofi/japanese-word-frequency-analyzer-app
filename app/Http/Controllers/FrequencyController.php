<?php

namespace App\Http\Controllers;

use App\Models\WordFrequency;
use App\Models\InputText;

class FrequencyController extends Controller
{
    public function show($text_id)
{
    $inputText = InputText::findOrFail($text_id);
    $wordFrequencies = WordFrequency::where('input_text_id', $text_id)
                                    ->orderBy('frequency', 'desc')
                                    ->get();

    return view('frequencies.show', compact('inputText', 'wordFrequencies'));
}

    // Show all texts
    public function index()
    {
        $texts = InputText::all();

        return view('frequencies.index', compact('texts'));
    }
}
