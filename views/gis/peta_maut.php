<?php include('template/header.php'); ?>

<body class="with-welcome-text">
  <div class="container-scroller">
    <?php include 'template/navbar.php'; ?>
    <div class="container-fluid page-body-wrapper">
      <?php include 'template/setting_panel.php'; ?>
      <?php include 'template/sidebar.php'; ?>
      <div class="main-panel">
        <div class="content-wrapper">
          
          <div class="row mb-3">
            <div class="col-md-8">
              <h4 class="mt-2">Peta Kesesuaian Lahan (MAUT)</h4>
              <p class="text-muted">Visualisasi hasil analisis kesesuaian lahan menggunakan metode MAUT</p>
            </div>
            <div class="col-md-4 text-end">
              <a href="index.php?controller=GIS&action=peta" class="btn btn-outline-secondary me-2">
                <i class="mdi mdi-earth"></i> Peta Wilayah
              </a>
              <a href="index.php?controller=GIS&action=index" class="btn btn-outline-primary">
                <i class="mdi mdi-arrow-left"></i> Kembali
              </a>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-9">
              <div class="card">
                <div class="card-header bg-success text-white">
                  <h5 class="mb-0">
                    <i class="mdi mdi-map-marker-multiple"></i> Peta Kesesuaian Lahan
                  </h5>
                </div>
                <div class="card-body p-0">
                  <div id="map" style="height: 70vh; width: 100%;"></div>
                </div>
              </div>
            </div>

            <div class="col-lg-3">
              <div class="card">
                <div class="card-header bg-warning text-white">
                  <h5 class="mb-0">
                    <i class="mdi mdi-palette"></i> Legenda
                  </h5>
                </div>
                <div class="card-body">
                  <div class="d-flex align-items-center mb-2">
                    <div style="width: 20px; height: 20px; background-color: #27ae60; border: 1px solid #000; margin-right: 10px;"></div>
                    <span>Sangat Sesuai (≥80%)</span>
                  </div>
                  <div class="d-flex align-items-center mb-2">
                    <div style="width: 20px; height: 20px; background-color: #3498db; border: 1px solid #000; margin-right: 10px;"></div>
                    <span>Sesuai (60-79%)</span>
                  </div>
                  <div class="d-flex align-items-center mb-2">
                    <div style="width: 20px; height: 20px; background-color: #f39c12; border: 1px solid #000; margin-right: 10px;"></div>
                    <span>Cukup Sesuai (40-59%)</span>
                  </div>
                  <div class="d-flex align-items-center mb-2">
                    <div style="width: 20px; height: 20px; background-color: #e74c3c; border: 1px solid #000; margin-right: 10px;"></div>
                    <span>Kurang Sesuai (<40%)</span>
                  </div>
                  <div class="d-flex align-items-center">
                    <div style="width: 20px; height: 20px; background-color: #95a5a6; border: 1px solid #000; margin-right: 10px;"></div>
                    <span>Belum Analisis</span>
                  </div>
                </div>
              </div>

              <div class="card mt-3">
                <div class="card-header bg-info text-white">
                  <h5 class="mb-0">
                    <i class="mdi mdi-trophy"></i> Ranking
                  </h5>
                </div>
                <div class="card-body">
                  <?php 
                  $rank = 1;
                  foreach (array_slice($data['kecamatan_maut'], 0, 5) as $kecamatan): 
                    if ($kecamatan['total_skor']):
                      $persentase = round($kecamatan['total_skor'] * 100, 2);
                      $badge_class = '';
                      
                      if ($persentase >= 80) {
                        $badge_class = 'bg-success';
                      } elseif ($persentase >= 60) {
                        $badge_class = 'bg-primary';
                      } elseif ($persentase >= 40) {
                        $badge_class = 'bg-warning';
                      } else {
                        $badge_class = 'bg-danger';
                      }
                  ?>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                      <div>
                        <span class="badge bg-secondary me-2"><?= $rank++ ?></span>
                        <small><?= htmlspecialchars($kecamatan['nama_kecamatan']) ?></small>
                      </div>
                      <span class="badge <?= $badge_class ?>"><?= $persentase ?>%</span>
                    </div>
                  <?php 
                    endif;
                  endforeach; 
                  ?>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <?php include 'template/script.php'; ?>
  
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

  <script>
    let map;
    let geojsonLayer;
    
    document.addEventListener('DOMContentLoaded', function() {
      initMap();
      loadGeoJSONData();
    });

    function initMap() {
      map = L.map('map').setView([1.5, 99.5], 10);
      
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
      }).addTo(map);
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

    function loadGeoJSONData() {
      fetch('index.php?controller=GIS&action=getGeoJSONAPI')
        .then(response => {
          if (!response.ok) {
            throw new Error('Network response was not ok');
          }
          return response.json();
        })
        .then(data => {
          console.log('GeoJSON Data loaded:', data);
          
          if (data && data.features && Array.isArray(data.features) && data.features.length > 0) {
            geojsonLayer = L.geoJSON(data, {
              style: function(feature) {
                const props = feature.properties || {};
                const score = props.maut_score;
                
                return {
                  fillColor: getMAUTColor(score),
                  weight: 2,
                  opacity: 1,
                  color: '#2c3e50',
                  fillOpacity: 0.8
                };
              },
              onEachFeature: function(feature, layer) {
                const props = feature.properties || {};
                const score = props.maut_score;
                const percentage = score ? (parseFloat(score) * 100).toFixed(2) : 'N/A';
                const category = getMAUTCategory(score);
                const kecamatanName = props.kecamatan_name || props.name || 'Unknown';
                const luas = props.luas || 'N/A';
                
                const popupContent = `
                  <div class="popup-content">
                    <h6 class="mb-2">${kecamatanName}</h6>
                    <table class="table table-sm">
                      <tr><td>Nama:</td><td>${kecamatanName}</td></tr>
                      <tr><td>Luas:</td><td>${luas !== 'N/A' ? luas + ' km²' : 'N/A'}</td></tr>
                      <tr><td>MAUT Score:</td><td>${score ? parseFloat(score).toFixed(4) : 'Belum Ada'}</td></tr>
                      <tr><td>Persentase:</td><td>${percentage}${percentage !== 'N/A' ? '%' : ''}</td></tr>
                      <tr><td>Kategori:</td><td><span class="badge" style="background-color: ${getMAUTColor(score)}; color: white;">${category}</span></td></tr>
                    </table>
                  </div>
                `;
                
                layer.bindPopup(popupContent);
                
                layer.on('mouseover', function(e) {
                  layer.setStyle({
                    weight: 4,
                    fillOpacity: 1
                  });
                });
                
                layer.on('mouseout', function(e) {
                  if (geojsonLayer) {
                    geojsonLayer.resetStyle(e.target);
                  }
                });
              }
            });
            
            if (geojsonLayer) {
              geojsonLayer.addTo(map);
              
              try {
                const bounds = geojsonLayer.getBounds();
                if (bounds && bounds.isValid()) {
                  map.fitBounds(bounds);
                }
              } catch (e) {
                console.warn('Could not fit bounds:', e);
              }
            }
          } else {
            console.warn('No valid GeoJSON features found');
            
            const noDataDiv = document.createElement('div');
            noDataDiv.className = 'alert alert-warning position-absolute';
            noDataDiv.style.cssText = 'top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1000;';
            noDataDiv.innerHTML = '<i class="mdi mdi-alert-triangle"></i> Tidak ada data GeoJSON yang ditemukan';
            document.getElementById('map').appendChild(noDataDiv);
          }
        })
        .catch(error => {
          console.error('Error loading GeoJSON:', error);
          
          const errorDiv = document.createElement('div');
          errorDiv.className = 'alert alert-danger position-absolute';
          errorDiv.style.cssText = 'top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1000;';
          errorDiv.innerHTML = '<i class="mdi mdi-alert-circle"></i> Error loading map data: ' + error.message;
          document.getElementById('map').appendChild(errorDiv);
        });
    }
  </script>

</body>
</html>