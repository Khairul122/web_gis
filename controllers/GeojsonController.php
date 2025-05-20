<?php
class GeojsonController
{
    public function preview()
    {
        if (!isset($_GET['file'])) {
            echo 'File tidak ditentukan.';
            exit;
        }

        $filename = basename($_GET['file']);
        $filepath = UPLOAD_GEOJSON_PATH . $filename;

        if (!file_exists($filepath)) {
            echo 'File tidak ditemukan.';
            exit;
        }

        $geojsonUrl = "index.php?controller=Geojson&action=view&file=" . $filename;
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Preview Peta GeoJSON</title>
            <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
            <style>
                html, body { margin: 0; padding: 0; height: 100%; }
                #map { height: 100%; width: 100%; }
            </style>
        </head>
        <body>
            <div id="map"></div>

            <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
            <script>
                var map = L.map('map').setView([0.5897, 99.6447], 10);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors'
                }).addTo(map);

                fetch('<?= $geojsonUrl ?>')
                    .then(res => res.json())
                    .then(data => {
                        var layer = L.geoJSON(data).addTo(map);
                        map.fitBounds(layer.getBounds());
                    })
                    .catch(err => {
                        alert('Gagal memuat GeoJSON.');
                        console.error(err);
                    });
            </script>
        </body>
        </html>
        <?php
    }

    public function view()
    {
        if (!isset($_GET['file'])) {
            header('HTTP/1.1 400 Bad Request');
            echo 'Parameter file tidak ditemukan.';
            exit;
        }

        $filename = basename($_GET['file']);
        $filepath = UPLOAD_GEOJSON_PATH . $filename;

        if (!file_exists($filepath)) {
            header('HTTP/1.1 404 Not Found');
            echo 'File tidak ditemukan.';
            exit;
        }

        header('Content-Type: application/json');
        readfile($filepath);
        exit;
    }
}
