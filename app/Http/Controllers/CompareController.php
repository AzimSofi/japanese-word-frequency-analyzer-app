<?php

namespace App\Http\Controllers;

use App\Models\WordFrequency;
use App\Models\Compare;
use Illuminate\Http\Request;

class CompareController extends Controller
{
    public function index()
    {

        return view('compare.index');
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
