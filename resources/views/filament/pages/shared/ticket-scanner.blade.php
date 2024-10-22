<x-filament::page>
    <h2 class="text-center">Ticket Scanner Page</h2>

    <!-- Menampilkan counter untuk tiket yang sudah discan oleh user -->
    <div class="text-center mt-4">
        <strong>Tickets Scanned: <span id="scanned-count">{{ $this->getScannedTicketCount() }}</span></strong>
    </div>

    <!-- Div untuk menampilkan scanner QR code -->
    <div id="reader" class="scanner-container"></div>

    <!-- Informasi tentang tiket yang discan -->
    <h3 class="text-center mt-4">Scanned Ticket Info:</h3>
    <p id="ticket-info" class="text-center">No ticket scanned yet</p>

    <!-- Tombol Proceed dengan icon -->
    <button id="proceed-btn" class="filament-button filament-button-primary proceed-btn" style="display: none;">
        <i class="fas fa-check-circle"></i> Proceed
    </button>

    <!-- Tambahkan script html5-qrcode yang sudah diunduh -->
    <script src="{{ asset('js/filament/html5-qrcode.min.js') }}"></script>

    <script>
        let scannedTicket = null; // Variabel untuk menyimpan tiket yang discan

        function onScanSuccess(decodedText, decodedResult) {
            // Tampilkan hasil scan di ticket info
            scannedTicket = decodedText;
            document.getElementById("ticket-info").innerText = `Scanned: ${decodedText}`;
            // Tampilkan tombol proceed setelah QR code discan
            document.getElementById("proceed-btn").style.display = 'block';
        }

        function onScanFailure(error) {
            console.warn(`Error: ${error}`);
        }

        // Aktifkan QR code scanner dan akses kamera
        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", { fps: 10, qrbox: { width: 250, height: 250 } }
        );
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);

        // Event handler untuk tombol proceed
        document.getElementById('proceed-btn').addEventListener('click', function () {
            if (scannedTicket) {
                console.log('Ticket:', scannedTicket); // Debugging: Lihat data yang akan dikirim
                // Simpan data tiket dan scanner_id ke database
                fetch('/tickets/store', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({
                        ticket: scannedTicket,
                        scanner_id: {{ auth()->user()->id }}, // ID user yang sedang login
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Response:', data); // Debugging: Lihat respons dari server
                    if (data.status === 'error') {
                        document.getElementById("ticket-info").innerText = 'Ticket already scanned';
                    } else {
                        alert(data.message);
                        // Sembunyikan tombol proceed setelah berhasil
                        document.getElementById("proceed-btn").style.display = 'none';
                        document.getElementById("ticket-info").innerText = 'No ticket scanned yet';

                        // Refresh halaman setelah 1 detik
                        setTimeout(function() {
                            window.location.reload(); // Refresh halaman
                        }, 1000); // Menunggu 1 detik sebelum refresh
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        });
    </script>

    <!-- Custom CSS untuk Mobile-First -->
    <style>
        .scanner-container {
            width: 100%;
            max-width: 300px;
            margin: 0 auto;
        }

        .proceed-btn {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            padding: 10px;
            font-size: 1.2rem;
        }

        .proceed-btn i {
            margin-right: 8px;
        }

        @media (min-width: 768px) {
            .scanner-container {
                max-width: 500px;
            }

            .proceed-btn {
                font-size: 1.5rem;
                padding: 12px;
            }
        }
    </style>

    <!-- Tambahkan Font Awesome CDN untuk icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</x-filament::page>
