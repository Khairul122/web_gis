<?php include('template/header.php'); ?>

<body class="with-welcome-text">
  <div class="container-scroller">
    <?php include 'template/navbar.php'; ?>
    <div class="container-fluid page-body-wrapper">
      <?php include 'template/setting_panel.php'; ?>
      <?php include 'template/sidebar.php'; ?>
      <div class="main-panel">
        <div class="content-wrapper">
          
          <div class="row mb-4">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-md-8">
                      <h3 class="fw-bold text-primary mb-2">
                        <i class="mdi mdi-account-circle me-2"></i>
                        Selamat Datang, <?= $_SESSION['nama_lengkap'] ?>!
                      </h3>
                      <p class="text-muted mb-2">
                        Anda login sebagai <span class="badge bg-primary"><?= ucfirst($_SESSION['level']) ?></span>
                      </p>
                      <small class="text-muted">
                        <i class="mdi mdi-clock-outline me-1"></i>
                        Login terakhir: <?= date('d F Y, H:i') ?> WIB
                      </small>
                    </div>
                    <div class="col-md-4 text-end">
                      <div class="welcome-avatar">
                        <i class="mdi mdi-account-circle text-primary" style="font-size: 80px;"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-8">
              <div class="card">
                <div class="card-header bg-gradient-primary text-white">
                  <h5 class="mb-0">
                    <i class="mdi mdi-information"></i> Tentang Sistem
                  </h5>
                </div>
                <div class="card-body">
                  <h6 class="fw-bold text-primary mb-3">Sistem Informasi Geografis (GIS) Kesesuaian Lahan Kelapa Sawit</h6>
                  
                  <div class="row">
                    <div class="col-md-6">
                      <div class="info-item mb-3">
                        <h6 class="fw-bold">
                          <i class="mdi mdi-target text-success me-2"></i>
                          Tujuan Sistem
                        </h6>
                        <p class="text-muted small">
                          Menentukan kesesuaian lahan untuk tanaman kelapa sawit di Kabupaten Mandailing Natal 
                          menggunakan metode MAUT (Multi-Attribute Utility Theory).
                        </p>
                      </div>
                      
                      <div class="info-item mb-3">
                        <h6 class="fw-bold">
                          <i class="mdi mdi-map-marker text-warning me-2"></i>
                          Lokasi Studi
                        </h6>
                        <p class="text-muted small">
                          Kabupaten Mandailing Natal, Sumatera Utara dengan 23 kecamatan yang dianalisis.
                        </p>
                      </div>
                    </div>
                    
                    <div class="col-md-6">
                      <div class="info-item mb-3">
                        <h6 class="fw-bold">
                          <i class="mdi mdi-calculator text-info me-2"></i>
                          Metode Analisis
                        </h6>
                        <p class="text-muted small">
                          MAUT (Multi-Attribute Utility Theory) dengan 6 kriteria penilaian: 
                          Tekstur Tanah, Curah Hujan, Drainase, Kemiringan, Suhu, dan pH Tanah.
                        </p>
                      </div>
                      
                      <div class="info-item mb-3">
                        <h6 class="fw-bold">
                          <i class="mdi mdi-chart-line text-danger me-2"></i>
                          Output Sistem
                        </h6>
                        <p class="text-muted small">
                          Peta tematik kesesuaian lahan, ranking kecamatan, dan rekomendasi 
                          pengembangan lahan kelapa sawit.
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card mt-4">
                <div class="card-header bg-gradient-success text-white">
                  <h5 class="mb-0">
                    <i class="mdi mdi-menu"></i> Menu Utama Sistem
                  </h5>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <div class="menu-card">
                        <div class="d-flex align-items-center p-3 border rounded">
                          <div class="icon-circle bg-primary text-white me-3">
                            <i class="mdi mdi-calculator"></i>
                          </div>
                          <div>
                            <h6 class="mb-1">Analisis MAUT</h6>
                            <small class="text-muted">Perhitungan kesesuaian lahan</small>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                      <div class="menu-card">
                        <div class="d-flex align-items-center p-3 border rounded">
                          <div class="icon-circle bg-success text-white me-3">
                            <i class="mdi mdi-earth"></i>
                          </div>
                          <div>
                            <h6 class="mb-1">Peta GIS</h6>
                            <small class="text-muted">Visualisasi peta wilayah</small>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                      <div class="menu-card">
                        <div class="d-flex align-items-center p-3 border rounded">
                          <div class="icon-circle bg-warning text-white me-3">
                            <i class="mdi mdi-database"></i>
                          </div>
                          <div>
                            <h6 class="mb-1">Data Penilaian</h6>
                            <small class="text-muted">Input data kriteria</small>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                      <div class="menu-card">
                        <div class="d-flex align-items-center p-3 border rounded">
                          <div class="icon-circle bg-info text-white me-3">
                            <i class="mdi mdi-chart-bar"></i>
                          </div>
                          <div>
                            <h6 class="mb-1">Laporan</h6>
                            <small class="text-muted">Hasil analisis dan ranking</small>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="card">
                <div class="card-header bg-gradient-warning text-white">
                  <h5 class="mb-0">
                    <i class="mdi mdi-chart-pie"></i> Statistik Sistem
                  </h5>
                </div>
                <div class="card-body">
                  <div class="stat-item mb-3">
                    <div class="d-flex justify-content-between align-items-center">
                      <div>
                        <h6 class="mb-1">Total Kecamatan</h6>
                        <small class="text-muted">Wilayah analisis</small>
                      </div>
                      <span class="badge bg-primary fs-6">23</span>
                    </div>
                  </div>
                  
                  <div class="stat-item mb-3">
                    <div class="d-flex justify-content-between align-items-center">
                      <div>
                        <h6 class="mb-1">Kriteria Penilaian</h6>
                        <small class="text-muted">Parameter analisis</small>
                      </div>
                      <span class="badge bg-success fs-6">6</span>
                    </div>
                  </div>
                  
                  <div class="stat-item mb-3">
                    <div class="d-flex justify-content-between align-items-center">
                      <div>
                        <h6 class="mb-1">Sub Kriteria</h6>
                        <small class="text-muted">Detail penilaian</small>
                      </div>
                      <span class="badge bg-warning fs-6">25+</span>
                    </div>
                  </div>
                  
                  <div class="stat-item">
                    <div class="d-flex justify-content-between align-items-center">
                      <div>
                        <h6 class="mb-1">Status Analisis</h6>
                        <small class="text-muted">Data terkini</small>
                      </div>
                      <span class="badge bg-info fs-6">Ready</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card mt-4">
                <div class="card-header bg-gradient-secondary text-white">
                  <h5 class="mb-0">
                    <i class="mdi mdi-clock-outline"></i> Aktivitas Terakhir
                  </h5>
                </div>
                <div class="card-body">
                  <div class="activity-log">
                    <div class="activity-item d-flex align-items-center mb-2">
                      <i class="mdi mdi-login text-success me-2"></i>
                      <div>
                        <small class="text-muted">Login sistem</small>
                        <br>
                        <small class="text-muted"><?= date('d M Y, H:i') ?></small>
                      </div>
                    </div>
                    
                    <div class="activity-item d-flex align-items-center mb-2">
                      <i class="mdi mdi-eye text-primary me-2"></i>
                      <div>
                        <small class="text-muted">Mengakses dashboard</small>
                        <br>
                        <small class="text-muted"><?= date('d M Y, H:i') ?></small>
                      </div>
                    </div>
                  </div>
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
      width: 50px;
      height: 50px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 20px;
    }
    
    .menu-card:hover {
      transform: translateY(-2px);
      transition: transform 0.2s ease;
    }
    
    .menu-card .border:hover {
      border-color: #007bff !important;
      box-shadow: 0 2px 8px rgba(0,123,255,0.2);
    }
    
    .step-item .badge {
      width: 25px;
      height: 25px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    
    .activity-item i {
      font-size: 18px;
    }
    
    .card {
      border: none;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      transition: box-shadow 0.3s ease;
    }
    
    .card:hover {
      box-shadow: 0 4px 20px rgba(0,0,0,0.15);
    }
    
    .bg-gradient-primary {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .bg-gradient-success {
      background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    }
    
    .bg-gradient-warning {
      background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }
    
    .bg-gradient-info {
      background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }
    
    .bg-gradient-secondary {
      background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
    }
    
    .bg-gradient-dark {
      background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
    }
  </style>

</body>

</html>