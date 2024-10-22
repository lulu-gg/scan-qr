<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Log;

class TicketController extends Controller
{
    public function store(Request $request)
    {
        Log::info('Ticket store request received', [
            'ticket' => $request->ticket,
            'scanner_id' => $request->scanner_id,
        ]);

        $ticket = Ticket::where('ticket', $request->ticket)->first();

        if (!$ticket) {
            // Buat tiket baru jika tidak ditemukan
            Log::info('Creating new ticket', [
                'ticket' => $request->ticket,
                'scanner_id' => $request->scanner_id,
            ]);

            $ticket = Ticket::create([
                'ticket' => $request->ticket,
                'scanner_id' => $request->scanner_id,
                'scanned' => true,
            ]);

            return response()->json(['status' => 'success', 'message' => 'New ticket created and processed']);
        }

        if ($ticket->scanned) {
            Log::info('Ticket already scanned', ['ticket' => $request->ticket]);

            return response()->json(['status' => 'error', 'message' => 'Ticket already scanned'], 400);
        }

        $ticket->update([
            'scanned' => true,
            'scanner_id' => $request->scanner_id,
        ]);

        Log::info('Ticket processed successfully', [
            'ticket' => $request->ticket,
            'scanner_id' => $request->scanner_id,
        ]);

        return response()->json(['status' => 'success', 'message' => 'Ticket processed successfully']);
    }
}
