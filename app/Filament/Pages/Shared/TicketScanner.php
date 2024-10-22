<?php

namespace App\Filament\Pages\Shared;

use App\Models\Ticket;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class TicketScanner extends Page
{
    protected static string $view = 'filament.pages.shared.ticket-scanner';

    // Fungsi untuk memproses tiket
    public function processTicket($ticketInfo)
    {
        // Cek apakah tiket ada di database
        $ticket = Ticket::where('ticket', $ticketInfo)->first();

        if ($ticket) {
            // Cek apakah tiket sudah discan
            if ($ticket->scanned) {
                session()->flash('error', 'Ticket has already been scanned!');
            } else {
                // Tandai tiket sebagai discan dan simpan scanner_id
                $ticket->update([
                    'scanned' => true,
                    'scanner_id' => Auth::id(),
                ]);
                session()->flash('success', 'Ticket processed successfully!');
            }
        } else {
            session()->flash('error', 'Ticket not found.');
        }
    }

    // Hitung berapa tiket yang sudah discan oleh user tersebut
    public function getScannedTicketCount(): int
    {
        return Ticket::where('scanner_id', Auth::id())->count();
    }

    public static function getNavigationLabel(): string
    {
        return 'Ticket Scanner';
    }

    public static function getNavigationIcon(): string
    {
        return 'heroicon-o-ticket'; // Menggunakan icon "ticket" dari Heroicons
    }
}
