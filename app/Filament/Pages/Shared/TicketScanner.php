<?php

namespace App\Filament\Pages\Shared;

use Filament\Pages\Page;

class TicketScanner extends Page
{
    protected static string $view = 'filament.pages.shared.ticket-scanner';

    public function processTicket($ticketInfo)
    {
        if ($ticketInfo) {
            session()->flash('success', 'Ticket processed successfully!');
        } else {
            session()->flash('error', 'Failed to process ticket.');
        }
    }

    // Ubah ini menjadi public
    public static function getNavigationLabel(): string
    {
        return 'Ticket Scanner';
    }
}
