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
              <h4 class="mt-2">Sistem Informasi Geografis (GIS)</h4>
              <p class="text-muted">Pemetaan dan visualisasi wilayah kecamatan</p>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-6 mb-4">
              <div class="card h-100">
                <div class="card-body text-center">
                  <div class="icon-circle bg-primary text-white mb-3 mx-auto">
                    <i class="mdi mdi-earth"></i>
                  </div>
                  <h5 class="card-title">Peta Wilayah</h5>
                  <p class="card-text text-muted">Visualisasi peta wilayah kecamatan dengan batas administratif</p>
                  <a href="index.php?controller=GIS&action=peta" class="btn btn-primary">
                    <i class="mdi mdi-map"></i> Buka Peta
                  </a>
                </div>
              </div>
            </div>

            <div class="col-lg-6 mb-4">
              <div class="card h-100">
                <div class="card-body text-center">
                  <div class="icon-circle bg-success text-white mb-3 mx-auto">
                    <i class="mdi mdi-map-marker-multiple"></i>
                  </div>
                  <h5 class="card-title">Peta Kesesuaian Lahan</h5>
                  <p class="card-text text-muted">Peta tematik hasil analisis MAUT dengan pewarnaan sesuai kategori</p>
                  <a href="index.php?controller=GIS&action=petaMAUT" class="btn btn-success">
                    <i class="mdi mdi-chart-areaspline"></i> Peta MAUT
                  </a>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <?php include 'template/script.php'; ?>

  <style>
    .icon-circle {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 32px;
    }
    
    .card:hover {
      transform: translateY(-5px);
      transition: transform 0.3s ease;
      box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
  </style>

</body>
</html>