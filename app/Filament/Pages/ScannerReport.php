<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;

class ScannerReport extends Page
{
    // Properti view dan label
    protected static string $view = 'filament.pages.scanner-report';
    protected static ?string $navigationLabel = 'Scanner Report'; // Buat nullable
    protected static ?string $navigationIcon = 'heroicon-o-book-open'; // Gunakan ikon buku dan buat nullable

    // Fungsi untuk menentukan apakah navigasi harus ditampilkan
    public static function shouldRegisterNavigation(): bool
    {
        // Tampilkan navigasi hanya untuk pengguna dengan role "scanner officer"
        return Auth::check() && Auth::user()->hasRole('scanner officer');
    }

    // Fungsi untuk mengambil tiket yang discan oleh user yang sedang login
    public function getTickets()
    {
        return Ticket::where('scanner_id', Auth::id())->get();
    }
}
