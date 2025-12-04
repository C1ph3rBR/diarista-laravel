<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiaristaController;

Route::get('/', function () {
    return redirect()->route('diarista.index');
});

Route::get('/diarista', [DiaristaController::class, 'index'])->name('diarista.index');
Route::post('/diarista/orcamento', [DiaristaController::class, 'storeQuote'])->name('diarista.orcamento');
?>