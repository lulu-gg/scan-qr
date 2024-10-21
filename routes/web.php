<?php

use Illuminate\Support\Facades\Route;
use Filament\Facades\Filament;
use Illuminate\Http\Request;

Route::get('/check-filament', function () {
    return Filament::getNavigation();
});
Route::post('/process-ticket', function (Request $request) {
    $ticket = $request->input('ticket');

    // Proses tiket (misalnya, simpan ke database atau validasi tiket)
    if ($ticket) {
        // Contoh: simpan ke database atau validasi tiket
        // Ticket::create(['info' => $ticket]);

        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false]);
})->name('process-ticket');
