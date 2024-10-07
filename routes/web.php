<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/Analyze', [App\Http\Controllers\FrequencyAnalyzerController::class, 'analyzeText'])->name('analyzer');
