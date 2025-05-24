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
              <h4 class="mt-2">Peta Wilayah Kecamatan</h4>
              <p class="text-muted">Visualisasi batas wilayah administratif kecamatan</p>
            </div>
            <div class="col-md-4 text-end">
              <a href="index.php?controller=GIS&action=index" class="btn btn-outline-secondary me-2">
                <i class="mdi mdi-arrow-left"></i> Kembali
              </a>
              <a href="index.php?controller=GIS&action=petaMAUT" class="btn btn-success">
                <i class="mdi mdi-chart-areaspline"></i> Peta MAUT
              </a>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header bg-primary text-white">
                  <h5 class="mb-0">
                    <i class="mdi mdi-earth"></i> Peta Interaktif
                  </h5>
                </div>
                <div class="card-body p-0">
                  <div id="map" style="height: 70vh; width: 100%;"></div>
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
                return {
                  fillColor: '#3498db',
                  weight: 2,
                  opacity: 1,
                  color: '#2c3e50',
                  fillOpacity: 0.6
                };
              },
              onEachFeature: function(feature, layer) {
                const props = feature.properties || {};
                const kecamatanName = props.kecamatan_name || props.name || 'Unknown';
                const luas = props.luas || 'N/A';
                
                const popupContent = `
                  <div class="popup-content">
                    <h6 class="mb-2">${kecamatanName}</h6>
                    <table class="table table-sm">
                      <tr><td>Nama:</td><td>${kecamatanName}</td></tr>
                      <tr><td>Luas:</td><td>${luas !== 'N/A' ? luas + ' km²' : 'N/A'}</td></tr>
                    </table>
                  </div>
                `;
                
                layer.bindPopup(popupContent);
                
                layer.on('mouseover', function(e) {
                  layer.setStyle({
                    weight: 3,
                    fillOpacity: 0.8
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