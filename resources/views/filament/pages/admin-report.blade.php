<x-filament::page>
    <h2 class="text-center">Scanner Report</h2>

    <div class="table-container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ticket</th>
                    <th>Scanner ID</th>
                    <th>Scanned</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($this->getTickets() as $ticket)
                    <tr>
                        <td>{{ $ticket->id }}</td>
                        <td>{{ $ticket->ticket }}</td>
                        <td>{{ $ticket->scanner_id }}</td>
                        <td>{{ $ticket->scanned ? 'Yes' : 'No' }}</td>
                        <td>{{ $ticket->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Custom CSS -->
    <style>
        /* Styling untuk tabel responsif */
        .table-container {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        /* Mobile styling */
        @media (max-width: 768px) {
            th, td {
                font-size: 14px;
                padding: 6px;
            }

            th, td:nth-child(3), td:nth-child(4) {
                display: none; /* Sembunyikan kolom Scanner ID dan Scanned di mobile */
            }
        }
    </style>
</x-filament::page>
