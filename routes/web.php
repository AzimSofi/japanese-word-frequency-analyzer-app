<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('input_text.index');
});

Route::get('/analyze', [App\Http\Controllers\FrequencyAnalyzerController::class, 'analyze'])->name('analyzer');
Route::get('/test', [App\Http\Controllers\FrequencyAnalyzerController::class, 'test'])->name('test');

Route::get('/input-text/index', [App\Http\Controllers\InputTextController::class, 'index'])->name('input-text.index');
Route::get('/frequencies/showAll', [App\Http\Controllers\FrequencyController::class, 'showAll'])->name('frequencies.showAll');
Route::post('/input-text/store', [App\Http\Controllers\InputTextController::class, 'store'])->name('input-text.store');
Route::get('/frequencies', [App\Http\Controllers\FrequencyController::class, 'index'])->name('frequencies.index');
Route::get('/frequencies/{text_id}', [App\Http\Controllers\FrequencyController::class, 'show'])->name('frequencies.show');

Route::get('/compare/index', [App\Http\Controllers\CompareController::class, 'index'])->name('compare.index');
Route::get('/compare/show/{id}', [App\Http\Controllers\CompareController::class, 'show'])->name('compare.show');
Route::post('/compare/store', [App\Http\Controllers\CompareController::class, 'store'])->name('compare.store');
