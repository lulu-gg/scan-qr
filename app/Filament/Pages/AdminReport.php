<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class AdminReport extends Page
{
    // Properti harus nullable (dengan tanda ?)
    protected static ?string $navigationLabel = 'Admin Report';
    protected static ?string $navigationIcon = 'heroicon-o-book-open'; // Gunakan ikon buku

    protected static string $view = 'filament.pages.admin-report';

    public static function shouldRegisterNavigation(): bool
    {
        // Tampilkan navigasi hanya untuk pengguna dengan role "admin"
        return Auth::user()->hasRole('admin');
    }

    // Method untuk mengambil semua tiket yang telah discan
    public function getTickets()
    {
        // Menampilkan semua tiket yang discan oleh seluruh user
        return Ticket::all();
    }
}
