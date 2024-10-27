<?php

namespace App\Http\Controllers;

use App\Models\WordFrequency;
use App\Models\Compare;
use App\Models\InputText;
use Illuminate\Http\Request;

class CompareController extends Controller
{
    public function index()
    {
        $input_texts = InputText::all();
        return view('compare.index', compact('input_texts'));
    }

    public function show($id)
    {
        $Input_text = InputText::find($id);
        return view('compare.show', compact('Input_text'));
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
