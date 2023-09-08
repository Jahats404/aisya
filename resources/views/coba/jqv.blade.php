<!DOCTYPE html>
<html>
<head>
    <title>Contoh Peta Interaktif dengan Leaflet.js</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
</head>
<body>
    <div id="map" style="width: 600px; height: 400px;"></div>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
</body>
<script>
    // Inisialisasi peta dengan koordinat pusat dan level zoom awal
    var map = L.map('map').setView([-6.1753924, 106.8271528], 13);

    // Tambahkan peta dasar dari OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Tambahkan marker atau layer lainnya sesuai kebutuhan
    // Contoh:
    // L.marker([-6.1753924, 106.8271528]).addTo(map);
</script>

</html>
