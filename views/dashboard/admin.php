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
                      <h3 class="fw-bold text-danger mb-2">
                        <i class="mdi mdi-shield-account me-2"></i>
                        Selamat Datang, <?= $_SESSION['nama_lengkap'] ?>!
                      </h3>
                      <p class="text-muted mb-2">
                        Anda login sebagai <span class="badge bg-danger"><?= ucfirst($_SESSION['level']) ?></span>
                        <span class="badge bg-warning ms-2">Full Access</span>
                      </p>
                      <small class="text-muted">
                        <i class="mdi mdi-clock-outline me-1"></i>
                        Login terakhir: <?= date('d F Y, H:i') ?> WIB
                      </small>
                    </div>
                    <div class="col-md-4 text-end">
                      <div class="admin-avatar">
                        <i class="mdi mdi-shield-account text-danger" style="font-size: 80px;"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
              <div class="card stats-card bg-gradient-primary text-white">
                <div class="card-body">
                  <div class="row">
                    <div class="col-8">
                      <div class="numbers">
                        <p class="text-white-50 mb-0">Total Kecamatan</p>
                        <h4 class="fw-bold">23</h4>
                        <p class="text-white-50 mb-0">
                          <span class="text-success">
                            <i class="mdi mdi-check me-1"></i>100%
                          </span>
                          Coverage
                        </p>
                      </div>
                    </div>
                    <div class="col-4 text-end">
                      <div class="icon">
                        <i class="mdi mdi-map-marker-multiple" style="font-size: 50px;"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
              <div class="card stats-card bg-gradient-success text-white">
                <div class="card-body">
                  <div class="row">
                    <div class="col-8">
                      <div class="numbers">
                        <p class="text-white-50 mb-0">Data Penilaian</p>
                        <h4 class="fw-bold">138</h4>
                        <p class="text-white-50 mb-0">
                          <span class="text-warning">
                            <i class="mdi mdi-trending-up me-1"></i>Complete
                          </span>
                        </p>
                      </div>
                    </div>
                    <div class="col-4 text-end">
                      <div class="icon">
                        <i class="mdi mdi-database" style="font-size: 50px;"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
              <div class="card stats-card bg-gradient-warning text-white">
                <div class="card-body">
                  <div class="row">
                    <div class="col-8">
                      <div class="numbers">
                        <p class="text-white-50 mb-0">Analisis MAUT</p>
                        <h4 class="fw-bold">1</h4>
                        <p class="text-white-50 mb-0">
                          <span class="text-success">
                            <i class="mdi mdi-check-circle me-1"></i>Active
                          </span>
                        </p>
                      </div>
                    </div>
                    <div class="col-4 text-end">
                      <div class="icon">
                        <i class="mdi mdi-calculator" style="font-size: 50px;"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
              <div class="card stats-card bg-gradient-info text-white">
                <div class="card-body">
                  <div class="row">
                    <div class="col-8">
                      <div class="numbers">
                        <p class="text-white-50 mb-0">Users</p>
                        <h4 class="fw-bold">5</h4>
                        <p class="text-white-50 mb-0">
                          <span class="text-warning">
                            <i class="mdi mdi-account-multiple me-1"></i>Online
                          </span>
                        </p>
                      </div>
                    </div>
                    <div class="col-4 text-end">
                      <div class="icon">
                        <i class="mdi mdi-account-group" style="font-size: 50px;"></i>
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
                <div class="card-header bg-gradient-dark text-white">
                  <h5 class="mb-0">
                    <i class="mdi mdi-cog me-2"></i>
                    Panel Administrasi Sistem
                  </h5>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <div class="admin-menu-card">
                        <div class="d-flex align-items-center p-3 border rounded hover-card">
                          <div class="icon-circle bg-primary text-white me-3">
                            <i class="mdi mdi-database-settings"></i>
                          </div>
                          <div class="flex-grow-1">
                            <h6 class="mb-1">Kelola Data Master</h6>
                            <small class="text-muted">Kriteria, Sub Kriteria, Kecamatan</small>
                          </div>
                          <a href="index.php?controller=Kriteria&action=index" class="btn btn-sm btn-outline-primary">
                            <i class="mdi mdi-arrow-right"></i>
                          </a>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6 mb-3">
                      <div class="admin-menu-card">
                        <div class="d-flex align-items-center p-3 border rounded hover-card">
                          <div class="icon-circle bg-success text-white me-3">
                            <i class="mdi mdi-account-multiple-plus"></i>
                          </div>
                          <div class="flex-grow-1">
                            <h6 class="mb-1">Manajemen User</h6>
                            <small class="text-muted">Tambah, Edit, Hapus Pengguna</small>
                          </div>
                          <a href="index.php?controller=User&action=index" class="btn btn-sm btn-outline-success">
                            <i class="mdi mdi-arrow-right"></i>
                          </a>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6 mb-3">
                      <div class="admin-menu-card">
                        <div class="d-flex align-items-center p-3 border rounded hover-card">
                          <div class="icon-circle bg-warning text-white me-3">
                            <i class="mdi mdi-chart-line"></i>
                          </div>
                          <div class="flex-grow-1">
                            <h6 class="mb-1">Monitor Analisis</h6>
                            <small class="text-muted">Status dan Hasil MAUT</small>
                          </div>
                          <a href="index.php?controller=MAUT&action=hasilAnalisis" class="btn btn-sm btn-outline-warning">
                            <i class="mdi mdi-arrow-right"></i>
                          </a>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6 mb-3">
                      <div class="admin-menu-card">
                        <div class="d-flex align-items-center p-3 border rounded hover-card">
                          <div class="icon-circle bg-info text-white me-3">
                            <i class="mdi mdi-cloud-upload"></i>
                          </div>
                          <div class="flex-grow-1">
                            <h6 class="mb-1">Upload GeoJSON</h6>
                            <small class="text-muted">Kelola Data Peta GIS</small>
                          </div>
                          <a href="index.php?controller=GIS&action=kelola" class="btn btn-sm btn-outline-info">
                            <i class="mdi mdi-arrow-right"></i>
                          </a>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6 mb-3">
                      <div class="admin-menu-card">
                        <div class="d-flex align-items-center p-3 border rounded hover-card">
                          <div class="icon-circle bg-danger text-white me-3">
                            <i class="mdi mdi-backup-restore"></i>
                          </div>
                          <div class="flex-grow-1">
                            <h6 class="mb-1">Backup & Restore</h6>
                            <small class="text-muted">Cadangkan Data Sistem</small>
                          </div>
                          <a href="#" class="btn btn-sm btn-outline-danger" onclick="backupSystem()">
                            <i class="mdi mdi-arrow-right"></i>
                          </a>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6 mb-3">
                      <div class="admin-menu-card">
                        <div class="d-flex align-items-center p-3 border rounded hover-card">
                          <div class="icon-circle bg-secondary text-white me-3">
                            <i class="mdi mdi-file-document-multiple"></i>
                          </div>
                          <div class="flex-grow-1">
                            <h6 class="mb-1">Generate Reports</h6>
                            <small class="text-muted">Laporan Sistem Lengkap</small>
                          </div>
                          <a href="index.php?controller=MAUT&action=laporan" class="btn btn-sm btn-outline-secondary">
                            <i class="mdi mdi-arrow-right"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card mt-4">
                <div class="card-header bg-gradient-info text-white">
                  <h5 class="mb-0">
                    <i class="mdi mdi-chart-pie me-2"></i>
                    Status Kesesuaian Lahan Terkini
                  </h5>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-3 text-center mb-3">
                      <div class="status-item">
                        <div class="status-circle bg-success text-white mx-auto mb-2">
                          <span class="fw-bold">8</span>
                        </div>
                        <h6 class="fw-bold text-success">Sangat Sesuai</h6>
                        <small class="text-muted">34.8% dari total</small>
                      </div>
                    </div>
                    <div class="col-md-3 text-center mb-3">
                      <div class="status-item">
                        <div class="status-circle bg-primary text-white mx-auto mb-2">
                          <span class="fw-bold">7</span>
                        </div>
                        <h6 class="fw-bold text-primary">Sesuai</h6>
                        <small class="text-muted">30.4% dari total</small>
                      </div>
                    </div>
                    <div class="col-md-3 text-center mb-3">
                      <div class="status-item">
                        <div class="status-circle bg-warning text-white mx-auto mb-2">
                          <span class="fw-bold">6</span>
                        </div>
                        <h6 class="fw-bold text-warning">Cukup Sesuai</h6>
                        <small class="text-muted">26.1% dari total</small>
                      </div>
                    </div>
                    <div class="col-md-3 text-center mb-3">
                      <div class="status-item">
                        <div class="status-circle bg-danger text-white mx-auto mb-2">
                          <span class="fw-bold">2</span>
                        </div>
                        <h6 class="fw-bold text-danger">Kurang Sesuai</h6>
                        <small class="text-muted">8.7% dari total</small>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="card">
                <div class="card-header bg-gradient-success text-white">
                  <h5 class="mb-0">
                    <i class="mdi mdi-trophy me-2"></i>
                    Top 5 Kesesuaian Terbaik
                  </h5>
                </div>
                <div class="card-body">
                  <div class="ranking-list">
                    <div class="ranking-item d-flex align-items-center mb-3">
                      <span class="rank-badge bg-warning text-white me-3">1</span>
                      <div class="flex-grow-1">
                        <h6 class="mb-0">Panyabungan Utara</h6>
                        <small class="text-muted">Score: 0.8517</small>
                      </div>
                      <span class="badge bg-success">85.17%</span>
                    </div>
                    
                    <div class="ranking-item d-flex align-items-center mb-3">
                      <span class="rank-badge bg-secondary text-white me-3">2</span>
                      <div class="flex-grow-1">
                        <h6 class="mb-0">Panyabungan Selatan</h6>
                        <small class="text-muted">Score: 0.8417</small>
                      </div>
                      <span class="badge bg-success">84.17%</span>
                    </div>
                    
                    <div class="ranking-item d-flex align-items-center mb-3">
                      <span class="rank-badge bg-orange text-white me-3">3</span>
                      <div class="flex-grow-1">
                        <h6 class="mb-0">Panyabungan Timur</h6>
                        <small class="text-muted">Score: 0.8317</small>
                      </div>
                      <span class="badge bg-success">83.17%</span>
                    </div>
                    
                    <div class="ranking-item d-flex align-items-center mb-3">
                      <span class="rank-badge bg-info text-white me-3">4</span>
                      <div class="flex-grow-1">
                        <h6 class="mb-0">Bukit Malintang</h6>
                        <small class="text-muted">Score: 0.7956</small>
                      </div>
                      <span class="badge bg-primary">79.56%</span>
                    </div>
                    
                    <div class="ranking-item d-flex align-items-center">
                      <span class="rank-badge bg-info text-white me-3">5</span>
                      <div class="flex-grow-1">
                        <h6 class="mb-0">Siabu</h6>
                        <small class="text-muted">Score: 0.7845</small>
                      </div>
                      <span class="badge bg-primary">78.45%</span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card mt-4">
                <div class="card-header bg-gradient-warning text-white">
                  <h5 class="mb-0">
                    <i class="mdi mdi-alert-circle me-2"></i>
                    System Alerts
                  </h5>
                </div>
                <div class="card-body">
                  <div class="alert-item d-flex align-items-start mb-3">
                    <i class="mdi mdi-check-circle text-success me-2 mt-1"></i>
                    <div>
                      <h6 class="mb-1">Data Sync Complete</h6>
                      <small class="text-muted">Semua data kecamatan telah tersinkronisasi</small>
                      <br>
                      <small class="text-success">2 menit yang lalu</small>
                    </div>
                  </div>
                  
                  <div class="alert-item d-flex align-items-start mb-3">
                    <i class="mdi mdi-information text-info me-2 mt-1"></i>
                    <div>
                      <h6 class="mb-1">Backup Scheduled</h6>
                      <small class="text-muted">Backup otomatis dijadwalkan malam ini</small>
                      <br>
                      <small class="text-info">5 menit yang lalu</small>
                    </div>
                  </div>
                  
                  <div class="alert-item d-flex align-items-start">
                    <i class="mdi mdi-account-plus text-primary me-2 mt-1"></i>
                    <div>
                      <h6 class="mb-1">New User Registration</h6>
                      <small class="text-muted">1 pengguna baru mendaftar</small>
                      <br>
                      <small class="text-primary">10 menit yang lalu</small>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card mt-4">
                <div class="card-header bg-gradient-secondary text-white">
                  <h5 class="mb-0">
                    <i class="mdi mdi-chart-line me-2"></i>
                    System Performance
                  </h5>
                </div>
                <div class="card-body">
                  <div class="performance-item mb-3">
                    <div class="d-flex justify-content-between mb-1">
                      <span class="text-muted">Database</span>
                      <span class="badge bg-success">98%</span>
                    </div>
                    <div class="progress" style="height: 8px;">
                      <div class="progress-bar bg-success" style="width: 98%"></div>
                    </div>
                  </div>
                  
                  <div class="performance-item mb-3">
                    <div class="d-flex justify-content-between mb-1">
                      <span class="text-muted">Server Load</span>
                      <span class="badge bg-warning">65%</span>
                    </div>
                    <div class="progress" style="height: 8px;">
                      <div class="progress-bar bg-warning" style="width: 65%"></div>
                    </div>
                  </div>
                  
                  <div class="performance-item">
                    <div class="d-flex justify-content-between mb-1">
                      <span class="text-muted">Storage</span>
                      <span class="badge bg-info">45%</span>
                    </div>
                    <div class="progress" style="height: 8px;">
                      <div class="progress-bar bg-info" style="width: 45%"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row mt-4">
            <div class="col-12">
              <div class="card">
                <div class="card-header bg-gradient-primary text-white">
                  <h5 class="mb-0">
                    <i class="mdi mdi-rocket me-2"></i>
                    Quick Actions
                  </h5>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-2 mb-2">
                      <a href="index.php?controller=Penilaian&action=form" class="btn btn-outline-primary w-100">
                        <i class="mdi mdi-plus me-2"></i>
                        Add Data
                      </a>
                    </div>
                    <div class="col-md-2 mb-2">
                      <a href="index.php?controller=MAUT&action=simpanAnalisis" class="btn btn-outline-success w-100">
                        <i class="mdi mdi-calculator me-2"></i>
                        Run MAUT
                      </a>
                    </div>
                    <div class="col-md-2 mb-2">
                      <a href="index.php?controller=GIS&action=peta" class="btn btn-outline-info w-100">
                        <i class="mdi mdi-earth me-2"></i>
                        View Map
                      </a>
                    </div>
                    <div class="col-md-2 mb-2">
                      <a href="index.php?controller=MAUT&action=exportCSV" class="btn btn-outline-warning w-100">
                        <i class="mdi mdi-download me-2"></i>
                        Export
                      </a>
                    </div>
                    <div class="col-md-2 mb-2">
                      <button class="btn btn-outline-danger w-100" onclick="clearCache()">
                        <i class="mdi mdi-cached me-2"></i>
                        Clear Cache
                      </button>
                    </div>
                    <div class="col-md-2 mb-2">
                      <a href="index.php?controller=MAUT&action=validasiData" class="btn btn-outline-secondary w-100">
                        <i class="mdi mdi-check-all me-2"></i>
                        Validate
                      </a>
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
    
    .hover-card:hover {
      transform: translateY(-2px);
      transition: transform 0.2s ease;
      border-color: #007bff !important;
      box-shadow: 0 4px 15px rgba(0,123,255,0.2);
    }
    
    .stats-card {
      transition: transform 0.3s ease;
    }
    
    .stats-card:hover {
      transform: translateY(-5px);
    }
    
    .status-circle {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 18px;
    }
    
    .rank-badge {
      width: 30px;
      height: 30px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
    }
    
    .bg-orange {
      background-color: #fd7e14 !important;
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
    
    .bg-gradient-danger {
      background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);
    }
    
    .card {
      border: none;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      transition: box-shadow 0.3s ease;
    }
    
    .card:hover {
      box-shadow: 0 4px 20px rgba(0,0,0,0.15);
    }
  </style>

  <script>
    function backupSystem() {
      if (confirm('Apakah Anda yakin ingin melakukan backup sistem?')) {
        alert('Backup sistem sedang diproses...');
      }
    }
    
    function clearCache() {
      if (confirm('Apakah Anda yakin ingin menghapus cache sistem?')) {
        alert('Cache sistem berhasil dihapus!');
      }
    }
  </script>

</body>

</html>