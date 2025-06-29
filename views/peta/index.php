<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peta Kesesuaian Lahan (MAUT) - GIS System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.2.96/css/materialdesignicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar-brand {
            font-weight: bold;
        }

        .card {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            border: 1px solid rgba(0, 0, 0, 0.125);
        }

        .card-header {
            border-bottom: 1px solid rgba(0, 0, 0, 0.125);
        }

        #map {
            border-radius: 0.375rem;
        }

        .popup-content {
            min-width: 280px;
        }

        .popup-content table {
            margin-bottom: 0;
        }

        .popup-content .table td {
            padding: 0.25rem 0.5rem;
            border: none;
        }

        .btn-floating {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
            border-radius: 50%;
            width: 56px;
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .loading-spinner {
            display: inline-block;
            width: 1rem;
            height: 1rem;
            border: 0.125rem solid currentColor;
            border-right-color: transparent;
            border-radius: 50%;
            animation: spin 0.75s linear infinite;
        }

        @keyframes spin {
            100% {
                transform: rotate(360deg);
            }
        }

        .legend-item {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
        }

        .legend-color {
            width: 20px;
            height: 20px;
            border: 1px solid #000;
            margin-right: 10px;
            border-radius: 3px;
        }

        .ranking-item {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 8px;
            padding: 8px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .ranking-item:hover {
            background-color: #f8f9fa;
        }

        .ranking-number {
            background: #6c757d;
            color: white;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-weight: bold;
            margin-right: 10px;
        }

        .ranking-name {
            flex-grow: 1;
            font-size: 0.9rem;
        }

        .ranking-score {
            font-weight: bold;
            font-size: 0.85rem;
            padding: 2px 8px;
            border-radius: 12px;
            color: white;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <i class="mdi mdi-chart-line"></i> MAUT Analysis System
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=Auth&action=login">
                            <i class="mdi mdi-home"></i> Beranda
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid py-4">
        <div class="row mb-4">
            <div class="col-md-8">
                <h2 class="mb-1">Peta Kesesuaian Lahan (MAUT)</h2>
                <p class="text-muted mb-0">Visualisasi hasil analisis kesesuaian lahan menggunakan metode Multi-Attribute Utility Theory</p>
            </div>
            <div class="col-md-4 text-end">
                <a href="index.php?controller=Auth&action=login" class="btn btn-outline-primary">
                    <i class="mdi mdi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-9 mb-4">
                <div class="card h-100">
                    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="mdi mdi-map-marker-multiple"></i> Peta Kesesuaian Lahan
                        </h5>
                        <div class="btn-group btn-group-sm" role="group">
                            <button type="button" class="btn btn-light btn-sm" onclick="resetMapView()">
                                <i class="mdi mdi-home-map-marker"></i> Reset
                            </button>
                            <button type="button" class="btn btn-light btn-sm" onclick="toggleFullscreen()">
                                <i class="mdi mdi-fullscreen"></i> Fullscreen
                            </button>
                            <button type="button" class="btn btn-light btn-sm" onclick="exportMap()">
                                <i class="mdi mdi-download"></i> Export
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div id="map" style="height: 70vh; width: 100%;"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="card mb-3">
                    <div class="card-header bg-warning text-white">
                        <h6 class="mb-0">
                            <i class="mdi mdi-palette"></i> Legenda Kesesuaian
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="legend-item">
                            <div class="legend-color" style="background-color: #27ae60;"></div>
                            <span class="small">Sangat Sesuai (≥80%)</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color" style="background-color: #3498db;"></div>
                            <span class="small">Sesuai (60-79%)</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color" style="background-color: #f39c12;"></div>
                            <span class="small">Cukup Sesuai (40-59%)</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color" style="background-color: #e74c3c;"></div>
                            <span class="small">Kurang Sesuai (<40%)< /span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color" style="background-color: #95a5a6;"></div>
                            <span class="small">Belum Analisis</span>
                        </div>
                        <hr class="my-2">
                        <div class="text-muted small">
                            <i class="mdi mdi-cursor-pointer text-primary"></i> Klik wilayah untuk detail<br>
                            <i class="mdi mdi-mouse text-warning"></i> Hover untuk highlight
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">
                            <i class="mdi mdi-trophy"></i> Ranking Kecamatan
                        </h6>
                        <span class="badge bg-light text-dark" id="rankingCount">0</span>
                    </div>
                    <div class="card-body p-0" style="max-height: 300px; overflow-y: auto;">
                        <div id="rankingList">
                            <div class="text-center text-muted p-3">
                                <div class="loading-spinner"></div>
                                <div class="mt-2">Memuat ranking...</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h6 class="mb-0">
                            <i class="mdi mdi-information"></i> Statistik MAUT
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-6 mb-2">
                                <div class="text-muted small">Total Kecamatan</div>
                                <h5 class="text-primary mb-0" id="totalKecamatan">
                                    <div class="loading-spinner"></div>
                                </h5>
                            </div>
                            <div class="col-6 mb-2">
                                <div class="text-muted small">Sudah Analisis</div>
                                <h5 class="text-success mb-0" id="totalAnalyzed">
                                    <div class="loading-spinner"></div>
                                </h5>
                            </div>
                        </div>
                        <div class="row text-center">
                            <div class="col-6 mb-2">
                                <div class="text-muted small">Rata-rata Skor</div>
                                <h6 class="text-info mb-0" id="averageScore">
                                    <div class="loading-spinner"></div>
                                </h6>
                            </div>
                            <div class="col-6 mb-2">
                                <div class="text-muted small">Skor Tertinggi</div>
                                <h6 class="text-warning mb-0" id="maxScore">
                                    <div class="loading-spinner"></div>
                                </h6>
                            </div>
                        </div>
                        <div class="text-center mt-2">
                            <div class="text-muted small">Status Peta</div>
                            <div id="mapStatus" class="badge bg-warning mt-1">
                                <div class="loading-spinner"></div> Loading...
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <button class="btn btn-success btn-floating" onclick="scrollToTop()" title="Kembali ke atas">
        <i class="mdi mdi-arrow-up"></i>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        let map;
        let geojsonLayer;
        let kecamatanData = [];
        let originalBounds;

        document.addEventListener('DOMContentLoaded', function() {
            initMap();
            loadGeoJSONData();
        });

        function initMap() {
            map = L.map('map').setView([1.5, 99.5], 10);

            const osmLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors',
                maxZoom: 18
            });

            const satelliteLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                attribution: '© Esri',
                maxZoom: 18
            });

            const terrainLayer = L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenTopoMap contributors',
                maxZoom: 17
            });

            osmLayer.addTo(map);

            const baseMaps = {
                "Peta Jalan": osmLayer,
                "Satelit": satelliteLayer,
                "Topografi": terrainLayer
            };

            L.control.layers(baseMaps).addTo(map);

            const scaleControl = L.control.scale({
                position: 'bottomleft',
                metric: true,
                imperial: false
            });
            scaleControl.addTo(map);
        }

        function getMAUTColor(score) {
            if (!score || score === null || score === undefined) return '#95a5a6';

            const percentage = parseFloat(score) * 100;

            if (percentage >= 80) return '#27ae60';
            if (percentage >= 60) return '#3498db';
            if (percentage >= 40) return '#f39c12';
            return '#e74c3c';
        }

        function getMAUTCategory(score) {
            if (!score || score === null || score === undefined) return 'Belum Analisis';

            const percentage = parseFloat(score) * 100;

            if (percentage >= 80) return 'Sangat Sesuai';
            if (percentage >= 60) return 'Sesuai';
            if (percentage >= 40) return 'Cukup Sesuai';
            return 'Kurang Sesuai';
        }

        function getMAUTStyle(feature) {
            const props = feature.properties || {};
            const score = props.maut_score;

            return {
                fillColor: getMAUTColor(score),
                weight: 2,
                opacity: 1,
                color: '#2c3e50',
                fillOpacity: 0.8
            };
        }

        function highlightFeature(e) {
            const layer = e.target;

            layer.setStyle({
                weight: 4,
                color: '#e74c3c',
                fillOpacity: 1
            });

            if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
                layer.bringToFront();
            }
        }

        function resetHighlight(e) {
            if (geojsonLayer) {
                geojsonLayer.resetStyle(e.target);
            }
        }

        function zoomToFeature(e) {
            map.fitBounds(e.target.getBounds());
            e.target.openPopup();
        }

        function onEachFeature(feature, layer) {
            const props = feature.properties || {};
            const score = props.maut_score;
            const percentage = score ? (parseFloat(score) * 100).toFixed(2) : 'N/A';
            const category = getMAUTCategory(score);
            const kecamatanName = props.kecamatan_name || props.name || 'Unknown';
            const luas = props.luas || 'N/A';

            const popupContent = `
        <div class="popup-content">
          <div class="text-center mb-2">
            <h6 class="text-success mb-1">${kecamatanName}</h6>
          </div>
          <table class="table table-sm">
            <tr>
              <td><i class="mdi mdi-map-marker text-primary"></i> Nama</td>
              <td><strong>${kecamatanName}</strong></td>
            </tr>
            <tr>
              <td><i class="mdi mdi-ruler-square text-info"></i> Luas</td>
              <td>${luas !== 'N/A' ? luas + ' km²' : 'Tidak tersedia'}</td>
            </tr>
            <tr>
              <td><i class="mdi mdi-chart-line text-warning"></i> MAUT Score</td>
              <td><strong>${score ? parseFloat(score).toFixed(4) : 'Belum Ada'}</strong></td>
            </tr>
            <tr>
              <td><i class="mdi mdi-percent text-success"></i> Persentase</td>
              <td><strong>${percentage}${percentage !== 'N/A' ? '%' : ''}</strong></td>
            </tr>
            <tr>
              <td><i class="mdi mdi-trophy text-warning"></i> Kategori</td>
              <td>
                <span class="badge text-white" style="background-color: ${getMAUTColor(score)};">
                  ${category}
                </span>
              </td>
            </tr>
          </table>
          <div class="text-center mt-2">
            <button class="btn btn-sm btn-success me-1" onclick="showDetailAnalysis('${kecamatanName}')">
              <i class="mdi mdi-chart-box"></i> Detail Analisis
            </button>
            <button class="btn btn-sm btn-primary" onclick="centerToFeature('${kecamatanName}')">
              <i class="mdi mdi-crosshairs-gps"></i> Tengah
            </button>
          </div>
        </div>
      `;

            layer.bindPopup(popupContent, {
                maxWidth: 320,
                className: 'custom-popup'
            });

            layer.on({
                mouseover: highlightFeature,
                mouseout: resetHighlight,
                click: zoomToFeature
            });
        }

        function loadGeoJSONData() {
            updateMapStatus('loading', 'Memuat data...');

            fetch('index.php?controller=GIS&action=getGeoJSONAPI')
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data && data.features && Array.isArray(data.features) && data.features.length > 0) {
                        kecamatanData = data.features;

                        geojsonLayer = L.geoJSON(data, {
                            style: getMAUTStyle,
                            onEachFeature: onEachFeature
                        });

                        if (geojsonLayer) {
                            geojsonLayer.addTo(map);

                            try {
                                originalBounds = geojsonLayer.getBounds();
                                if (originalBounds && originalBounds.isValid()) {
                                    map.fitBounds(originalBounds, {
                                        padding: [10, 10]
                                    });
                                }
                            } catch (e) {
                                console.warn('Could not fit bounds:', e);
                            }
                        }

                        updateStatistics(data.features);
                        updateRankingList(data.features);
                        updateMapStatus('success', 'Data dimuat');

                    } else {
                        throw new Error('Data GeoJSON tidak valid atau kosong');
                    }
                })
                .catch(error => {
                    console.error('Error loading GeoJSON:', error);
                    updateMapStatus('error', 'Gagal memuat');
                    showError('Error memuat data peta: ' + error.message);
                });
        }

        function updateMapStatus(type, message) {
            const statusElement = document.getElementById('mapStatus');
            const icons = {
                loading: '<div class="loading-spinner"></div>',
                success: '<i class="mdi mdi-check-circle"></i>',
                error: '<i class="mdi mdi-alert-circle"></i>'
            };
            const classes = {
                loading: 'badge bg-warning',
                success: 'badge bg-success',
                error: 'badge bg-danger'
            };

            statusElement.innerHTML = `${icons[type]} ${message}`;
            statusElement.className = classes[type];
        }

        function updateStatistics(features) {
            const totalKecamatan = features.length;
            let totalAnalyzed = 0;
            let totalScore = 0;
            let maxScore = 0;

            features.forEach(feature => {
                const score = parseFloat(feature.properties.maut_score) || 0;
                if (score > 0) {
                    totalAnalyzed++;
                    totalScore += score;
                    if (score > maxScore) {
                        maxScore = score;
                    }
                }
            });

            const averageScore = totalAnalyzed > 0 ? totalScore / totalAnalyzed : 0;

            document.getElementById('totalKecamatan').textContent = totalKecamatan.toLocaleString('id-ID');
            document.getElementById('totalAnalyzed').textContent = totalAnalyzed.toLocaleString('id-ID');
            document.getElementById('averageScore').textContent = (averageScore * 100).toFixed(1) + '%';
            document.getElementById('maxScore').textContent = (maxScore * 100).toFixed(1) + '%';
        }

        function updateRankingList(features) {
            const rankingContainer = document.getElementById('rankingList');
            rankingContainer.innerHTML = '';

            const validFeatures = features.filter(feature => {
                const score = parseFloat(feature.properties.maut_score) || 0;
                return score > 0;
            });

            validFeatures.sort((a, b) => {
                const scoreA = parseFloat(a.properties.maut_score) || 0;
                const scoreB = parseFloat(b.properties.maut_score) || 0;
                return scoreB - scoreA;
            });

            const topFeatures = validFeatures.slice(0, 10);

            if (topFeatures.length === 0) {
                rankingContainer.innerHTML = `
          <div class="text-center text-muted p-3">
            <i class="mdi mdi-alert-circle"></i>
            <div class="mt-2">Belum ada data analisis MAUT</div>
          </div>
        `;
                document.getElementById('rankingCount').textContent = '0';
                return;
            }

            topFeatures.forEach((feature, index) => {
                const props = feature.properties || {};
                const score = parseFloat(props.maut_score) || 0;
                const percentage = (score * 100).toFixed(2);
                const kecamatanName = props.kecamatan_name || props.name || 'Unknown';

                let badgeClass = 'bg-danger';
                if (percentage >= 80) {
                    badgeClass = 'bg-success';
                } else if (percentage >= 60) {
                    badgeClass = 'bg-primary';
                } else if (percentage >= 40) {
                    badgeClass = 'bg-warning';
                }

                const rankingItem = document.createElement('div');
                rankingItem.className = 'ranking-item';
                rankingItem.style.cursor = 'pointer';
                rankingItem.innerHTML = `
          <div class="ranking-number">${index + 1}</div>
          <div class="ranking-name">${kecamatanName}</div>
          <div class="ranking-score ${badgeClass}">${percentage}%</div>
        `;

                rankingItem.addEventListener('click', function() {
                    const layer = geojsonLayer.getLayers().find(l => {
                        const layerProps = l.feature.properties || {};
                        const layerName = layerProps.kecamatan_name || layerProps.name || 'Unknown';
                        return layerName === kecamatanName;
                    });

                    if (layer) {
                        map.fitBounds(layer.getBounds(), {
                            padding: [20, 20]
                        });
                        setTimeout(() => {
                            layer.openPopup();
                        }, 500);
                    }
                });

                rankingContainer.appendChild(rankingItem);
            });

            document.getElementById('rankingCount').textContent = topFeatures.length;
        }

        function showDetailAnalysis(kecamatanName) {
            const feature = kecamatanData.find(f => {
                const props = f.properties || {};
                const name = props.kecamatan_name || props.name || 'Unknown';
                return name === kecamatanName;
            });

            if (feature) {
                const props = feature.properties;
                const score = parseFloat(props.maut_score) || 0;
                const percentage = (score * 100).toFixed(2);
                const category = getMAUTCategory(score);

                const details = `
ANALISIS MAUT - ${kecamatanName}

Nama Kecamatan: ${kecamatanName}
Luas Area: ${props.luas ? props.luas + ' km²' : 'Tidak tersedia'}

HASIL ANALISIS:
MAUT Score: ${score.toFixed(4)}
Persentase: ${percentage}%
Kategori: ${category}

Status: ${score > 0 ? 'Sudah Dianalisis' : 'Belum Dianalisis'}

Fitur detail analisis kriteria dapat dikembangkan lebih lanjut untuk menampilkan breakdown skor per kriteria MAUT.
        `;
                alert(details);
            }
        }

        function centerToFeature(kecamatanName) {
            const layer = geojsonLayer.getLayers().find(l => {
                const layerProps = l.feature.properties || {};
                const layerName = layerProps.kecamatan_name || layerProps.name || 'Unknown';
                return layerName === kecamatanName;
            });

            if (layer) {
                const bounds = layer.getBounds();
                const center = bounds.getCenter();
                map.setView(center, Math.max(map.getZoom(), 12));
            }
        }

        function resetMapView() {
            if (originalBounds && originalBounds.isValid()) {
                map.fitBounds(originalBounds, {
                    padding: [10, 10]
                });
            } else {
                map.setView([1.5, 99.5], 10);
            }
        }

        function toggleFullscreen() {
            const mapContainer = document.getElementById('map');
            if (!document.fullscreenElement) {
                mapContainer.requestFullscreen().then(() => {
                    setTimeout(() => {
                        map.invalidateSize();
                    }, 100);
                });
            } else {
                document.exitFullscreen().then(() => {
                    setTimeout(() => {
                        map.invalidateSize();
                    }, 100);
                });
            }
        }

        function exportMap() {
            const timestamp = new Date().toISOString().slice(0, 19).replace(/:/g, '-');
            const filename = `peta_maut_${timestamp}.png`;

            html2canvas(document.getElementById('map')).then(canvas => {
                const link = document.createElement('a');
                link.download = filename;
                link.href = canvas.toDataURL();
                link.click();
            }).catch(error => {
                console.error('Export failed:', error);
                alert('Export gagal. Fitur ini memerlukan library html2canvas untuk screenshot peta.');
            });
        }

        function showError(message) {
            const mapContainer = document.getElementById('map');
            const errorDiv = document.createElement('div');
            errorDiv.className = 'alert alert-danger position-absolute';
            errorDiv.style.cssText = 'top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1000; min-width: 300px;';
            errorDiv.innerHTML = `
        <div class="text-center">
          <i class="mdi mdi-alert-circle-outline mb-2" style="font-size: 2rem;"></i>
          <div><strong>Terjadi Kesalahan</strong></div>
          <div class="small mt-1">${message}</div>
          <button class="btn btn-sm btn-outline-danger mt-2" onclick="location.reload()">
            <i class="mdi mdi-refresh"></i> Muat Ulang
          </button>
        </div>
      `;
            mapContainer.appendChild(errorDiv);
        }

        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        window.addEventListener('resize', function() {
            if (map) {
                setTimeout(() => {
                    map.invalidateSize();
                }, 100);
            }
        });
    </script>
</body>

</html>