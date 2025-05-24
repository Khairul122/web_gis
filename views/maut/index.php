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
              <h4 class="mt-2">Analisis MAUT (Multi-Attribute Utility Theory)</h4>
              <p class="text-muted">Sistem analisis kesesuaian lahan menggunakan metode MAUT</p>
            </div>
            <div class="col-md-4 text-end">
              <div class="btn-group" role="group">
                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                  <i class="mdi mdi-cogs"></i> Menu Analisis
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="index.php?controller=MAUT&action=validasiData">
                    <i class="mdi mdi-check-circle"></i> Validasi Data
                  </a></li>
                  <li><a class="dropdown-item" href="index.php?controller=MAUT&action=analisisUlang">
                    <i class="mdi mdi-refresh"></i> Analisis Ulang
                  </a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="index.php?controller=MAUT&action=exportCSV">
                    <i class="mdi mdi-download"></i> Export CSV
                  </a></li>
                </ul>
              </div>
            </div>
          </div>

          <?php if (isset($_SESSION['success_message'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <i class="mdi mdi-check-circle me-2"></i>
              <?= $_SESSION['success_message'] ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['success_message']); ?>
          <?php endif; ?>

          <?php if (isset($_SESSION['error_message'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <i class="mdi mdi-alert-circle me-2"></i>
              <?= $_SESSION['error_message'] ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['error_message']); ?>
          <?php endif; ?>

          <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body text-center">
                  <div class="icon-circle bg-primary text-white mb-3 mx-auto">
                    <i class="mdi mdi-table-large"></i>
                  </div>
                  <h5 class="card-title">Matriks Penilaian</h5>
                  <p class="card-text text-muted">Data penilaian alternatif berdasarkan kriteria yang telah ditentukan</p>
                  <a href="index.php?controller=MAUT&action=matriksPenilaian" class="btn btn-outline-primary">
                    <i class="mdi mdi-eye"></i> Lihat Detail
                  </a>
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body text-center">
                  <div class="icon-circle bg-success text-white mb-3 mx-auto">
                    <i class="mdi mdi-calculator"></i>
                  </div>
                  <h5 class="card-title">Proses Normalisasi</h5>
                  <p class="card-text text-muted">Normalisasi nilai menggunakan fungsi utilitas MAUT</p>
                  <a href="index.php?controller=MAUT&action=normalisasi" class="btn btn-outline-success">
                    <i class="mdi mdi-calculator-variant"></i> Hitung
                  </a>
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body text-center">
                  <div class="icon-circle bg-warning text-white mb-3 mx-auto">
                    <i class="mdi mdi-chart-line"></i>
                  </div>
                  <h5 class="card-title">Perhitungan MAUT</h5>
                  <p class="card-text text-muted">Proses perhitungan lengkap metode MAUT</p>
                  <a href="index.php?controller=MAUT&action=perhitungan" class="btn btn-outline-warning">
                    <i class="mdi mdi-trending-up"></i> Analisis
                  </a>
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body text-center">
                  <div class="icon-circle bg-info text-white mb-3 mx-auto">
                    <i class="mdi mdi-trophy"></i>
                  </div>
                  <h5 class="card-title">Ranking Hasil</h5>
                  <p class="card-text text-muted">Peringkat kesesuaian lahan berdasarkan skor MAUT</p>
                  <a href="index.php?controller=MAUT&action=ranking" class="btn btn-outline-info">
                    <i class="mdi mdi-medal"></i> Lihat Ranking
                  </a>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-8">
              <div class="card">
                <div class="card-header bg-light">
                  <h5 class="mb-0">
                    <i class="mdi mdi-trophy-award"></i> Top 10 Ranking Kesesuaian Lahan
                  </h5>
                </div>
                <div class="card-body">
                  <?php if (!empty($data['ranking'])): ?>
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead class="table-dark">
                          <tr>
                            <th>Rank</th>
                            <th>Kecamatan</th>
                            <th>Skor MAUT</th>
                            <th>Persentase</th>
                            <th>Kategori</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                          $displayed = 0;
                          foreach ($data['ranking'] as $rank): 
                            if ($displayed >= 10) break;
                            $badge_class = '';
                            $kategori = '';
                            
                            if ($rank['persentase'] >= 80) {
                              $badge_class = 'bg-success';
                              $kategori = 'Sangat Sesuai';
                            } elseif ($rank['persentase'] >= 60) {
                              $badge_class = 'bg-primary';
                              $kategori = 'Sesuai';
                            } elseif ($rank['persentase'] >= 40) {
                              $badge_class = 'bg-warning';
                              $kategori = 'Cukup Sesuai';
                            } else {
                              $badge_class = 'bg-danger';
                              $kategori = 'Kurang Sesuai';
                            }
                          ?>
                            <tr>
                              <td>
                                <?php if ($rank['rank'] <= 3): ?>
                                  <span class="badge bg-warning">
                                    <i class="mdi mdi-trophy"></i> <?= $rank['rank'] ?>
                                  </span>
                                <?php else: ?>
                                  <span class="badge bg-secondary"><?= $rank['rank'] ?></span>
                                <?php endif; ?>
                              </td>
                              <td>
                                <strong><?= htmlspecialchars($rank['nama_kecamatan']) ?></strong>
                              </td>
                              <td>
                                <span class="badge bg-primary"><?= $rank['total_score'] ?></span>
                              </td>
                              <td>
                                <div class="progress" style="height: 20px;">
                                  <div class="progress-bar <?= str_replace('bg-', 'bg-', $badge_class) ?>" 
                                       role="progressbar" 
                                       style="width: <?= $rank['persentase'] ?>%">
                                    <?= $rank['persentase'] ?>%
                                  </div>
                                </div>
                              </td>
                              <td>
                                <span class="badge <?= $badge_class ?>"><?= $kategori ?></span>
                              </td>
                            </tr>
                          <?php 
                            $displayed++;
                          endforeach; 
                          ?>
                        </tbody>
                      </table>
                    </div>
                    
                    <div class="text-center mt-3">
                      <a href="index.php?controller=MAUT&action=ranking" class="btn btn-primary">
                        <i class="mdi mdi-view-list"></i> Lihat Semua Ranking
                      </a>
                    </div>
                  <?php else: ?>
                    <div class="alert alert-warning text-center">
                      <i class="mdi mdi-alert-triangle me-2"></i>
                      Belum ada data ranking. Silakan lakukan analisis terlebih dahulu.
                    </div>
                  <?php endif; ?>
                </div>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="card">
                <div class="card-header bg-light">
                  <h5 class="mb-0">
                    <i class="mdi mdi-information"></i> Informasi Kriteria
                  </h5>
                </div>
                <div class="card-body">
                  <?php if (!empty($data['kriteria'])): ?>
                    <div class="list-group list-group-flush">
                      <?php foreach ($data['kriteria'] as $kriteria): ?>
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                          <div>
                            <strong><?= htmlspecialchars($kriteria['nama_kriteria']) ?></strong>
                            <br>
                            <small class="text-muted"><?= htmlspecialchars($kriteria['keterangan']) ?></small>
                          </div>
                          <span class="badge bg-info">
                            <?= round($kriteria['bobot'] * 100, 1) ?>%
                          </span>
                        </div>
                      <?php endforeach; ?>
                    </div>
                    
                    <div class="mt-3 pt-3 border-top">
                      <div class="d-flex justify-content-between">
                        <strong>Total Bobot:</strong>
                        <span class="badge bg-success">
                          <?= round(array_sum(array_column($data['kriteria'], 'bobot')) * 100, 1) ?>%
                        </span>
                      </div>
                    </div>
                  <?php else: ?>
                    <div class="alert alert-warning">
                      <i class="mdi mdi-alert-triangle me-2"></i>
                      Belum ada data kriteria.
                    </div>
                  <?php endif; ?>
                </div>
              </div>

              <div class="card mt-4">
                <div class="card-header bg-light">
                  <h5 class="mb-0">
                    <i class="mdi mdi-chart-pie"></i> Statistik
                  </h5>
                </div>
                <div class="card-body">
                  <?php 
                  $total_kecamatan = count($data['kecamatan']);
                  $total_kriteria = count($data['kriteria']);
                  $total_penilaian = 0;
                  
                  foreach ($data['matrix'] as $kecamatan_data) {
                    $total_penilaian += count($kecamatan_data);
                  }
                  
                  $max_penilaian = $total_kecamatan * $total_kriteria;
                  $kelengkapan = $max_penilaian > 0 ? round(($total_penilaian / $max_penilaian) * 100, 1) : 0;
                  ?>
                  
                  <div class="row text-center">
                    <div class="col-6">
                      <div class="border-end">
                        <h3 class="text-primary"><?= $total_kecamatan ?></h3>
                        <small class="text-muted">Kecamatan</small>
                      </div>
                    </div>
                    <div class="col-6">
                      <h3 class="text-success"><?= $total_kriteria ?></h3>
                      <small class="text-muted">Kriteria</small>
                    </div>
                  </div>
                  
                  <hr>
                  
                  <div class="text-center">
                    <h4 class="text-info"><?= $kelengkapan ?>%</h4>
                    <small class="text-muted">Kelengkapan Data</small>
                    <div class="progress mt-2">
                      <div class="progress-bar bg-info" 
                           role="progressbar" 
                           style="width: <?= $kelengkapan ?>%"></div>
                    </div>
                  </div>
                  
                  <div class="mt-3">
                    <small class="text-muted">
                      <?= $total_penilaian ?> dari <?= $max_penilaian ?> penilaian telah dilengkapi
                    </small>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row mt-4">
            <div class="col-12">
              <div class="card">
                <div class="card-header bg-light">
                  <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                      <i class="mdi mdi-cogs"></i> Menu Lanjutan
                    </h5>
                    <button class="btn btn-primary" onclick="location.href='index.php?controller=MAUT&action=simpanAnalisis'">
                      <i class="mdi mdi-content-save"></i> Simpan Hasil Analisis
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-3 col-md-6 mb-3">
                      <a href="index.php?controller=MAUT&action=perbandingan" class="card text-decoration-none">
                        <div class="card-body text-center">
                          <i class="mdi mdi-compare h2 text-primary"></i>
                          <h6 class="mt-2">Perbandingan</h6>
                          <small class="text-muted">Bandingkan hasil antar kecamatan</small>
                        </div>
                      </a>
                    </div>
                    
                    <div class="col-lg-3 col-md-6 mb-3">
                      <a href="index.php?controller=MAUT&action=grafik" class="card text-decoration-none">
                        <div class="card-body text-center">
                          <i class="mdi mdi-chart-bar h2 text-success"></i>
                          <h6 class="mt-2">Grafik & Chart</h6>
                          <small class="text-muted">Visualisasi data dalam grafik</small>
                        </div>
                      </a>
                    </div>
                    
                    <div class="col-lg-3 col-md-6 mb-3">
                      <a href="index.php?controller=MAUT&action=hasilAnalisis" class="card text-decoration-none">
                        <div class="card-body text-center">
                          <i class="mdi mdi-file-document h2 text-warning"></i>
                          <h6 class="mt-2">Hasil Analisis</h6>
                          <small class="text-muted">Riwayat analisis yang tersimpan</small>
                        </div>
                      </a>
                    </div>
                    
                    <div class="col-lg-3 col-md-6 mb-3">
                      <a href="index.php?controller=MAUT&action=laporan" class="card text-decoration-none">
                        <div class="card-body text-center">
                          <i class="mdi mdi-printer h2 text-info"></i>
                          <h6 class="mt-2">Laporan</h6>
                          <small class="text-muted">Generate laporan lengkap</small>
                        </div>
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
      width: 60px;
      height: 60px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 24px;
    }
    
    .card:hover {
      transform: translateY(-2px);
      transition: transform 0.2s ease-in-out;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    .progress {
      background-color: #e9ecef;
    }
    
    .list-group-item {
      border: none;
      padding: 0.75rem 0;
    }
    
    .list-group-item:not(:last-child) {
      border-bottom: 1px solid #dee2e6;
    }
  </style>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const alerts = document.querySelectorAll('.alert');
      alerts.forEach(function(alert) {
        setTimeout(function() {
          if (alert && alert.parentNode) {
            alert.classList.remove('show');
            setTimeout(function() {
              if (alert && alert.parentNode) {
                alert.parentNode.removeChild(alert);
              }
            }, 150);
          }
        }, 5000);
      });

      const confirmButtons = document.querySelectorAll('[onclick*="analisisUlang"]');
      confirmButtons.forEach(function(button) {
        button.addEventListener('click', function(e) {
          if (!confirm('Apakah Anda yakin ingin melakukan analisis ulang? Data analisis sebelumnya akan dihapus.')) {
            e.preventDefault();
          }
        });
      });
    });
  </script>

</body>
</html>