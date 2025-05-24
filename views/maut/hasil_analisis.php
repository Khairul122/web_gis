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
              <h4 class="mt-2">Hasil Analisis MAUT</h4>
              <p class="text-muted">Riwayat dan hasil analisis kesesuaian lahan yang tersimpan</p>
            </div>
            <div class="col-md-4 text-end">
              <a href="index.php?controller=MAUT&action=index" class="btn btn-outline-secondary me-2">
                <i class="mdi mdi-arrow-left"></i> Kembali
              </a>
              <div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                  <i class="mdi mdi-cogs"></i> Aksi
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="index.php?controller=MAUT&action=simpanAnalisis">
                    <i class="mdi mdi-plus"></i> Analisis Baru
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
            <div class="col-12">
              <div class="card">
                <div class="card-header bg-gradient-primary text-white">
                  <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                      <i class="mdi mdi-database"></i> Data Hasil Analisis
                    </h5>
                    <span class="badge bg-light text-dark">
                      <?= !empty($data['hasil']) ? count($data['hasil']) : 0 ?> Analisis Tersimpan
                    </span>
                  </div>
                </div>
                <div class="card-body">
                  <?php if (!empty($data['hasil'])): ?>
                    <div class="table-responsive">
                      <table class="table table-hover align-middle">
                        <thead class="table-dark">
                          <tr>
                            <th style="width: 50px;">No</th>
                            <th>Kecamatan</th>
                            <th class="text-center">Skor MAUT</th>
                            <th class="text-center">Persentase</th>
                            <th class="text-center">Kategori</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center" style="width: 120px;">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                          $no = 1;
                          foreach ($data['hasil'] as $hasil): 
                            $persentase = round($hasil['total_skor'] * 100, 2);
                            $badge_class = '';
                            $kategori = '';
                            
                            if ($persentase >= 80) {
                              $badge_class = 'bg-success';
                              $kategori = 'Sangat Sesuai';
                            } elseif ($persentase >= 60) {
                              $badge_class = 'bg-primary';
                              $kategori = 'Sesuai';
                            } elseif ($persentase >= 40) {
                              $badge_class = 'bg-warning';
                              $kategori = 'Cukup Sesuai';
                            } else {
                              $badge_class = 'bg-danger';
                              $kategori = 'Kurang Sesuai';
                            }
                          ?>
                            <tr>
                              <td>
                                <span class="badge bg-secondary"><?= $no++ ?></span>
                              </td>
                              <td>
                                <div class="d-flex align-items-center">
                                  <div class="avatar-sm bg-light rounded-circle d-flex align-items-center justify-content-center me-3">
                                    <i class="mdi mdi-map-marker text-primary"></i>
                                  </div>
                                  <div>
                                    <h6 class="mb-0"><?= htmlspecialchars($hasil['nama_kecamatan']) ?></h6>
                                    <small class="text-muted">ID: <?= $hasil['id_kecamatan'] ?></small>
                                  </div>
                                </div>
                              </td>
                              <td class="text-center">
                                <span class="badge bg-info fs-6"><?= round($hasil['total_skor'], 4) ?></span>
                              </td>
                              <td class="text-center">
                                <div class="progress mb-1" style="height: 20px;">
                                  <div class="progress-bar <?= str_replace('bg-', 'bg-', $badge_class) ?>" 
                                       role="progressbar" 
                                       style="width: <?= $persentase ?>%">
                                    <?= $persentase ?>%
                                  </div>
                                </div>
                              </td>
                              <td class="text-center">
                                <span class="badge <?= $badge_class ?>"><?= $kategori ?></span>
                                <?php if ($hasil['kode_kelas']): ?>
                                  <br><small class="text-muted">(<?= htmlspecialchars($hasil['kode_kelas']) ?>)</small>
                                <?php endif; ?>
                              </td>
                              <td class="text-center">
                                <span class="badge bg-secondary"><?= date('d/m/Y', strtotime($hasil['tanggal_analisis'])) ?></span>
                                <br><small class="text-muted"><?= date('H:i', strtotime($hasil['tanggal_analisis'])) ?></small>
                              </td>
                              <td class="text-center">
                                <div class="btn-group-vertical btn-group-sm">
                                  <a href="index.php?controller=MAUT&action=detailAnalisis&id=<?= $hasil['id_hasil'] ?>" 
                                     class="btn btn-outline-primary btn-sm">
                                    <i class="mdi mdi-eye"></i> Detail
                                  </a>
                                  <a href="index.php?controller=MAUT&action=hapusAnalisis&id=<?= $hasil['id_hasil'] ?>" 
                                     class="btn btn-outline-danger btn-sm"
                                     onclick="return confirm('Yakin ingin menghapus hasil analisis untuk <?= htmlspecialchars($hasil['nama_kecamatan']) ?>?')">
                                    <i class="mdi mdi-delete"></i> Hapus
                                  </a>
                                </div>
                              </td>
                            </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  <?php else: ?>
                    <div class="text-center py-5">
                      <div class="mb-4">
                        <i class="mdi mdi-file-document-outline display-1 text-muted"></i>
                      </div>
                      <h5 class="text-muted mb-3">Belum Ada Hasil Analisis</h5>
                      <p class="text-muted mb-4">Silakan lakukan analisis MAUT terlebih dahulu untuk melihat hasil</p>
                      <div class="d-flex justify-content-center gap-2">
                        <a href="index.php?controller=MAUT&action=simpanAnalisis" class="btn btn-primary">
                          <i class="mdi mdi-plus"></i> Buat Analisis Baru
                        </a>
                        <a href="index.php?controller=MAUT&action=perhitungan" class="btn btn-outline-primary">
                          <i class="mdi mdi-calculator"></i> Lihat Perhitungan
                        </a>
                      </div>
                    </div>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>

          <?php if (!empty($data['hasil'])): ?>
            <div class="row mt-4">
              <div class="col-lg-3 col-md-6 mb-4">
                <div class="card text-center h-100">
                  <div class="card-body">
                    <div class="icon-circle bg-success text-white mb-3 mx-auto">
                      <i class="mdi mdi-trophy"></i>
                    </div>
                    <?php 
                    $sangat_sesuai = 0;
                    foreach ($data['hasil'] as $hasil) {
                      if (($hasil['total_skor'] * 100) >= 80) $sangat_sesuai++;
                    }
                    ?>
                    <h3 class="text-success"><?= $sangat_sesuai ?></h3>
                    <h6 class="text-muted">Sangat Sesuai</h6>
                    <small class="text-muted">Skor ≥ 80%</small>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 col-md-6 mb-4">
                <div class="card text-center h-100">
                  <div class="card-body">
                    <div class="icon-circle bg-primary text-white mb-3 mx-auto">
                      <i class="mdi mdi-thumb-up"></i>
                    </div>
                    <?php 
                    $sesuai = 0;
                    foreach ($data['hasil'] as $hasil) {
                      $persen = $hasil['total_skor'] * 100;
                      if ($persen >= 60 && $persen < 80) $sesuai++;
                    }
                    ?>
                    <h3 class="text-primary"><?= $sesuai ?></h3>
                    <h6 class="text-muted">Sesuai</h6>
                    <small class="text-muted">Skor 60-79%</small>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 col-md-6 mb-4">
                <div class="card text-center h-100">
                  <div class="card-body">
                    <div class="icon-circle bg-warning text-white mb-3 mx-auto">
                      <i class="mdi mdi-minus-circle"></i>
                    </div>
                    <?php 
                    $cukup_sesuai = 0;
                    foreach ($data['hasil'] as $hasil) {
                      $persen = $hasil['total_skor'] * 100;
                      if ($persen >= 40 && $persen < 60) $cukup_sesuai++;
                    }
                    ?>
                    <h3 class="text-warning"><?= $cukup_sesuai ?></h3>
                    <h6 class="text-muted">Cukup Sesuai</h6>
                    <small class="text-muted">Skor 40-59%</small>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 col-md-6 mb-4">
                <div class="card text-center h-100">
                  <div class="card-body">
                    <div class="icon-circle bg-danger text-white mb-3 mx-auto">
                      <i class="mdi mdi-close-circle"></i>
                    </div>
                    <?php 
                    $kurang_sesuai = 0;
                    foreach ($data['hasil'] as $hasil) {
                      if (($hasil['total_skor'] * 100) < 40) $kurang_sesuai++;
                    }
                    ?>
                    <h3 class="text-danger"><?= $kurang_sesuai ?></h3>
                    <h6 class="text-muted">Kurang Sesuai</h6>
                    <small class="text-muted">Skor < 40%</small>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-6">
                <div class="card">
                  <div class="card-header bg-success text-white">
                    <h5 class="mb-0">
                      <i class="mdi mdi-podium-gold"></i> Top 5 Performers
                    </h5>
                  </div>
                  <div class="card-body">
                    <?php 
                    $sorted_hasil = $data['hasil'];
                    usort($sorted_hasil, function($a, $b) {
                      return $b['total_skor'] <=> $a['total_skor'];
                    });
                    $top_5 = array_slice($sorted_hasil, 0, 5);
                    ?>
                    <?php 
                    $rank = 1;
                    foreach ($top_5 as $top): 
                      $persen = round($top['total_skor'] * 100, 2);
                      $medal_class = '';
                      $medal_icon = '';
                      
                      if ($rank == 1) {
                        $medal_class = 'bg-warning';
                        $medal_icon = 'mdi-trophy';
                      } elseif ($rank == 2) {
                        $medal_class = 'bg-secondary';
                        $medal_icon = 'mdi-medal';
                      } elseif ($rank == 3) {
                        $medal_class = 'bg-orange';
                        $medal_icon = 'mdi-medal';
                      } else {
                        $medal_class = 'bg-light text-dark';
                        $medal_icon = 'mdi-numeric-' . $rank . '-circle';
                      }
                    ?>
                      <div class="d-flex justify-content-between align-items-center mb-3 p-3 border rounded">
                        <div class="d-flex align-items-center">
                          <span class="badge <?= $medal_class ?> me-3">
                            <i class="mdi <?= $medal_icon ?>"></i> <?= $rank ?>
                          </span>
                          <div>
                            <h6 class="mb-1 fw-bold"><?= htmlspecialchars($top['nama_kecamatan']) ?></h6>
                            <small class="text-muted">Skor: <?= round($top['total_skor'], 4) ?></small>
                          </div>
                        </div>
                        <div class="text-end">
                          <span class="badge bg-success fs-6"><?= $persen ?>%</span>
                          <br>
                          <small class="text-muted"><?= date('d/m/Y', strtotime($top['tanggal_analisis'])) ?></small>
                        </div>
                      </div>
                    <?php 
                      $rank++;
                    endforeach; 
                    ?>
                  </div>
                </div>
              </div>

              <div class="col-lg-6">
                <div class="card">
                  <div class="card-header bg-info text-white">
                    <h5 class="mb-0">
                      <i class="mdi mdi-chart-line"></i> Statistik Analisis
                    </h5>
                  </div>
                  <div class="card-body">
                    <?php 
                    $scores = array_column($data['hasil'], 'total_skor');
                    $avg_score = array_sum($scores) / count($scores);
                    $max_score = max($scores);
                    $min_score = min($scores);
                    $range = $max_score - $min_score;
                    
                    $std_dev = 0;
                    foreach ($scores as $score) {
                      $std_dev += pow($score - $avg_score, 2);
                    }
                    $std_dev = sqrt($std_dev / count($scores));
                    ?>
                    <div class="row text-center">
                      <div class="col-6 mb-3">
                        <div class="border-end">
                          <h4 class="text-success mb-1"><?= round($max_score, 4) ?></h4>
                          <small class="text-muted">Skor Tertinggi</small>
                        </div>
                      </div>
                      <div class="col-6 mb-3">
                        <h4 class="text-danger mb-1"><?= round($min_score, 4) ?></h4>
                        <small class="text-muted">Skor Terendah</small>
                      </div>
                      <div class="col-6 mb-3">
                        <div class="border-end">
                          <h4 class="text-primary mb-1"><?= round($avg_score, 4) ?></h4>
                          <small class="text-muted">Rata-rata</small>
                        </div>
                      </div>
                      <div class="col-6 mb-3">
                        <h4 class="text-warning mb-1"><?= round($range, 4) ?></h4>
                        <small class="text-muted">Range</small>
                      </div>
                      <div class="col-12">
                        <h4 class="text-info mb-1"><?= round($std_dev, 4) ?></h4>
                        <small class="text-muted">Standar Deviasi</small>
                      </div>
                    </div>
                    
                    <hr>
                    
                    <div class="text-center">
                      <h6 class="mb-2">Distribusi Skor</h6>
                      <div class="progress mb-2" style="height: 25px;">
                        <?php 
                        $excellent_pct = round(($sangat_sesuai / count($data['hasil'])) * 100, 1);
                        $good_pct = round(($sesuai / count($data['hasil'])) * 100, 1);
                        $fair_pct = round(($cukup_sesuai / count($data['hasil'])) * 100, 1);
                        $poor_pct = round(($kurang_sesuai / count($data['hasil'])) * 100, 1);
                        ?>
                        <div class="progress-bar bg-success" style="width: <?= $excellent_pct ?>%" title="Sangat Sesuai: <?= $excellent_pct ?>%"></div>
                        <div class="progress-bar bg-primary" style="width: <?= $good_pct ?>%" title="Sesuai: <?= $good_pct ?>%"></div>
                        <div class="progress-bar bg-warning" style="width: <?= $fair_pct ?>%" title="Cukup Sesuai: <?= $fair_pct ?>%"></div>
                        <div class="progress-bar bg-danger" style="width: <?= $poor_pct ?>%" title="Kurang Sesuai: <?= $poor_pct ?>%"></div>
                      </div>
                      <small class="text-muted">
                        <span class="text-success">■</span> Sangat Sesuai 
                        <span class="text-primary">■</span> Sesuai 
                        <span class="text-warning">■</span> Cukup 
                        <span class="text-danger">■</span> Kurang
                      </small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php endif; ?>

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
    
    .avatar-sm {
      width: 40px;
      height: 40px;
    }
    
    .bg-orange {
      background-color: #fd7e14 !important;
    }
    
    .badge.fs-6 {
      font-size: 0.875rem !important;
      padding: 0.375rem 0.75rem;
    }
    
    .progress {
      background-color: #e9ecef;
    }
    
    .card:hover {
      transform: translateY(-2px);
      transition: transform 0.2s ease;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    
    .btn-group-vertical .btn {
      border-radius: 0.375rem;
      margin-bottom: 2px;
    }
    
    .btn-group-vertical .btn:last-child {
      margin-bottom: 0;
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

      const tooltips = document.querySelectorAll('[title]');
      tooltips.forEach(function(tooltip) {
        if (typeof bootstrap !== 'undefined') {
          new bootstrap.Tooltip(tooltip);
        }
      });
    });
  </script>

</body>
</html>