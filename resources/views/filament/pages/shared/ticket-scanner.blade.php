<x-filament::page>
    <h2 class="text-center">Ticket Scanner Page</h2>

    <!-- Div untuk menampilkan scanner QR code -->
    <div id="reader"></div>

    <!-- Informasi tentang tiket yang discan -->
    <h3 class="text-center mt-4">Scanned Ticket Info:</h3>
    <p id="ticket-info" class="text-center">No ticket scanned yet</p>

    <!-- Tombol Proceed -->
    <button id="proceed-btn" class="filament-button filament-button-primary" style="display: none; width: 100%;">
        Proceed
    </button>

    <!-- Tambahkan script html5-qrcode yang sudah diunduh -->
    <script src="{{ asset('js/filament/html5-qrcode.min.js') }}"></script>

    <script>
        function onScanSuccess(decodedText, decodedResult) {
            // Tampilkan hasil scan di ticket info
            document.getElementById("ticket-info").innerText = `Scanned: ${decodedText}`;

            // Tampilkan tombol proceed setelah QR code discan
            document.getElementById("proceed-btn").style.display = 'block';
        }

        function onScanFailure(error) {
            // Optional: handle scan failure seperti tidak ada QR code yang ditemukan
            console.warn(`Error: ${error}`);
        }

        // Aktifkan QR code scanner dan akses kamera
        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", { fps: 10, qrbox: { width: 250, height: 250 } }
        );
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>
</x-filament::page>
