<?php

use Illuminate\Support\Facades\Route;
use Filament\Facades\Filament;
use Illuminate\Http\Request;
use App\Http\Controllers\TicketController;
use Filament\Http\Livewire\Auth\Login;
use App\Filament\Pages\ScannerReport;
use App\Filament\Pages\AdminReport;

// Route untuk memeriksa navigasi Filament (hanya contoh)
Route::get('/check-filament', function () {
    return Filament::getNavigation();
});

// Route untuk memproses tiket (contoh)
Route::post('/process-ticket', function (Request $request) {
    $ticket = $request->input('ticket');

    // Proses tiket (misalnya, simpan ke database atau validasi tiket)
    if ($ticket) {
        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false]);
})->name('process-ticket');

// Route untuk menyimpan tiket melalui TicketController
Route::post('/tickets/store', [TicketController::class, 'store']);
Route::middleware(['auth', 'role:scanner officer'])->group(function () {
    //Filament::registerPage(ScannerReport::class);
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    //Filament::registerPage(AdminReport::class);
});
Route::get('/', Login::class)->name('login');
// try
