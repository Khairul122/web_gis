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
              <h4 class="mt-2">Matriks Penilaian MAUT</h4>
              <p class="text-muted">Data penilaian kecamatan berdasarkan kriteria yang telah ditetapkan</p>
            </div>
            <div class="col-md-4 text-end">
              <a href="index.php?controller=MAUT&action=index" class="btn btn-outline-secondary me-2">
                <i class="mdi mdi-arrow-left"></i> Kembali
              </a>
              <a href="index.php?controller=MAUT&action=normalisasi" class="btn btn-primary">
                <i class="mdi mdi-arrow-right"></i> Lanjut ke Normalisasi
              </a>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header bg-primary text-white">
                  <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                      <i class="mdi mdi-table-large"></i> Matriks Keputusan
                    </h5>
                    <span class="badge bg-light text-dark">
                      <?= count($data['kecamatan']) ?> Kecamatan × <?= count($data['kriteria']) ?> Kriteria
                    </span>
                  </div>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive">
                    <table class="table table-bordered table-hover mb-0">
                      <thead class="table-dark">
                        <tr>
                          <th rowspan="2" class="align-middle sticky-left bg-dark text-white" style="min-width: 200px;">
                            Kecamatan
                          </th>
                          <th colspan="<?= count($data['kriteria']) ?>" class="text-center">
                            Kriteria Penilaian
                          </th>
                        </tr>
                        <tr>
                          <?php foreach ($data['kriteria'] as $kriteria): ?>
                            <th class="text-center" style="min-width: 120px;">
                              <div>
                                <strong><?= htmlspecialchars($kriteria['nama_kriteria']) ?></strong>
                                <br>
                                <small class="text-muted">
                                  <?= htmlspecialchars($kriteria['keterangan']) ?>
                                </small>
                                <br>
                                <span class="badge bg-info">
                                  Bobot: <?= round($kriteria['bobot'] * 100, 1) ?>%
                                </span>
                              </div>
                            </th>
                          <?php endforeach; ?>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $row_count = 0;
                        foreach ($data['kecamatan'] as $kecamatan): 
                          $row_count++;
                          $row_class = ($row_count % 2 == 0) ? 'table-light' : '';
                        ?>
                          <tr class="<?= $row_class ?>">
                            <td class="fw-bold sticky-left bg-light">
                              <div class="d-flex align-items-center">
                                <span class="badge bg-secondary me-2"><?= $row_count ?></span>
                                <div>
                                  <div><?= htmlspecialchars($kecamatan['nama_kecamatan']) ?></div>
                                  <small class="text-muted">ID: <?= $kecamatan['id_kecamatan'] ?></small>
                                </div>
                              </div>
                            </td>
                            <?php foreach ($data['kriteria'] as $kriteria): ?>
                              <td class="text-center">
                                <?php if (isset($data['matrix'][$kecamatan['id_kecamatan']][$kriteria['id_kriteria']])): 
                                  $nilai = $data['matrix'][$kecamatan['id_kecamatan']][$kriteria['id_kriteria']]['nilai'];
                                  $badge_class = '';
                                  
                                  if ($nilai >= 4) {
                                    $badge_class = 'bg-success';
                                  } elseif ($nilai >= 3) {
                                    $badge_class = 'bg-primary';
                                  } elseif ($nilai >= 2) {
                                    $badge_class = 'bg-warning';
                                  } else {
                                    $badge_class = 'bg-danger';
                                  }
                                ?>
                                  <span class="badge <?= $badge_class ?> fs-6"><?= $nilai ?></span>
                                <?php else: ?>
                                  <span class="text-danger">
                                    <i class="mdi mdi-close-circle"></i>
                                    <small>Tidak ada data</small>
                                  </span>
                                <?php endif; ?>
                              </td>
                            <?php endforeach; ?>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row mt-4">
            <div class="col-lg-8">
              <div class="card">
                <div class="card-header bg-info text-white">
                  <h5 class="mb-0">
                    <i class="mdi mdi-chart-bar"></i> Statistik Penilaian
                  </h5>
                </div>
                <div class="card-body">
                  <?php 
                  $total_kecamatan = count($data['kecamatan']);
                  $total_kriteria = count($data['kriteria']);
                  $max_penilaian = $total_kecamatan * $total_kriteria;
                  
                  $penilaian_lengkap = 0;
                  $total_penilaian = 0;
                  
                  foreach ($data['kecamatan'] as $kecamatan) {
                    $count_kriteria = 0;
                    foreach ($data['kriteria'] as $kriteria) {
                      if (isset($data['matrix'][$kecamatan['id_kecamatan']][$kriteria['id_kriteria']])) {
                        $count_kriteria++;
                        $total_penilaian++;
                      }
                    }
                    if ($count_kriteria == $total_kriteria) {
                      $penilaian_lengkap++;
                    }
                  }
                  
                  $persentase_lengkap = $total_kecamatan > 0 ? round(($penilaian_lengkap / $total_kecamatan) * 100, 1) : 0;
                  $persentase_data = $max_penilaian > 0 ? round(($total_penilaian / $max_penilaian) * 100, 1) : 0;
                  ?>
                  
                  <div class="row">
                    <div class="col-md-3 text-center mb-3">
                      <h3 class="text-primary"><?= $total_kecamatan ?></h3>
                      <small class="text-muted">Total Kecamatan</small>
                    </div>
                    <div class="col-md-3 text-center mb-3">
                      <h3 class="text-success"><?= $total_kriteria ?></h3>
                      <small class="text-muted">Total Kriteria</small>
                    </div>
                    <div class="col-md-3 text-center mb-3">
                      <h3 class="text-warning"><?= $penilaian_lengkap ?></h3>
                      <small class="text-muted">Penilaian Lengkap</small>
                    </div>
                    <div class="col-md-3 text-center mb-3">
                      <h3 class="text-info"><?= $total_penilaian ?></h3>
                      <small class="text-muted">Total Data</small>
                    </div>
                  </div>
                  
                  <hr>
                  
                  <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                      <span>Kelengkapan Penilaian per Kecamatan</span>
                      <span class="badge bg-primary"><?= $persentase_lengkap ?>%</span>
                    </div>
                    <div class="progress mb-2" style="height: 10px;">
                      <div class="progress-bar bg-primary" 
                           role="progressbar" 
                           style="width: <?= $persentase_lengkap ?>%"></div>
                    </div>
                    <small class="text-muted">
                      <?= $penilaian_lengkap ?> dari <?= $total_kecamatan ?> kecamatan memiliki penilaian lengkap
                    </small>
                  </div>
                  
                  <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                      <span>Kelengkapan Data Keseluruhan</span>
                      <span class="badge bg-success"><?= $persentase_data ?>%</span>
                    </div>
                    <div class="progress mb-2" style="height: 10px;">
                      <div class="progress-bar bg-success" 
                           role="progressbar" 
                           style="width: <?= $persentase_data ?>%"></div>
                    </div>
                    <small class="text-muted">
                      <?= $total_penilaian ?> dari <?= $max_penilaian ?> data penilaian telah diisi
                    </small>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="card">
                <div class="card-header bg-success text-white">
                  <h5 class="mb-0">
                    <i class="mdi mdi-scale-balance"></i> Bobot Kriteria
                  </h5>
                </div>
                <div class="card-body">
                  <?php foreach ($data['kriteria'] as $kriteria): ?>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                      <div>
                        <strong><?= htmlspecialchars($kriteria['nama_kriteria']) ?></strong>
                        <br>
                        <small class="text-muted"><?= htmlspecialchars($kriteria['keterangan']) ?></small>
                      </div>
                      <div class="text-end">
                        <span class="badge bg-primary fs-6">
                          <?= round($kriteria['bobot'] * 100, 1) ?>%
                        </span>
                        <br>
                        <small class="text-muted"><?= $kriteria['bobot'] ?></small>
                      </div>
                    </div>
                  <?php endforeach; ?>
                  
                  <hr>
                  
                  <div class="d-flex justify-content-between align-items-center">
                    <strong>Total Bobot:</strong>
                    <span class="badge bg-success fs-6">
                      <?= round(array_sum(array_column($data['kriteria'], 'bobot')) * 100, 1) ?>%
                    </span>
                  </div>
                </div>
              </div>

              <div class="card mt-4">
                <div class="card-header bg-warning text-white">
                  <h5 class="mb-0">
                    <i class="mdi mdi-information"></i> Keterangan Nilai
                  </h5>
                </div>
                <div class="card-body">
                  <div class="mb-2">
                    <span class="badge bg-success me-2">5</span>
                    <small>Sangat Baik</small>
                  </div>
                  <div class="mb-2">
                    <span class="badge bg-primary me-2">4</span>
                    <small>Baik</small>
                  </div>
                  <div class="mb-2">
                    <span class="badge bg-warning me-2">3</span>
                    <small>Cukup</small>
                  </div>
                  <div class="mb-2">
                    <span class="badge bg-orange me-2">2</span>
                    <small>Kurang</small>
                  </div>
                  <div class="mb-2">
                    <span class="badge bg-danger me-2">1</span>
                    <small>Sangat Kurang</small>
                  </div>
                  
                  <hr>
                  
                  <div class="alert alert-info py-2">
                    <small>
                      <i class="mdi mdi-lightbulb"></i>
                      Nilai yang lebih tinggi menunjukkan kesesuaian yang lebih baik untuk kriteria tersebut.
                    </small>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row mt-4">
            <div class="col-12">
              <div class="card">
                <div class="card-header bg-secondary text-white">
                  <h5 class="mb-0">
                    <i class="mdi mdi-alert-circle"></i> Kecamatan dengan Data Tidak Lengkap
                  </h5>
                </div>
                <div class="card-body">
                  <?php 
                  $kecamatan_tidak_lengkap = [];
                  foreach ($data['kecamatan'] as $kecamatan) {
                    $missing_criteria = [];
                    foreach ($data['kriteria'] as $kriteria) {
                      if (!isset($data['matrix'][$kecamatan['id_kecamatan']][$kriteria['id_kriteria']])) {
                        $missing_criteria[] = $kriteria['nama_kriteria'];
                      }
                    }
                    if (!empty($missing_criteria)) {
                      $kecamatan_tidak_lengkap[] = [
                        'kecamatan' => $kecamatan,
                        'missing' => $missing_criteria
                      ];
                    }
                  }
                  ?>
                  
                  <?php if (!empty($kecamatan_tidak_lengkap)): ?>
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>Kecamatan</th>
                            <th>Kriteria yang Belum Dinilai</th>
                            <th class="text-center">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($kecamatan_tidak_lengkap as $item): ?>
                            <tr>
                              <td>
                                <strong><?= htmlspecialchars($item['kecamatan']['nama_kecamatan']) ?></strong>
                                <br>
                                <small class="text-muted">ID: <?= $item['kecamatan']['id_kecamatan'] ?></small>
                              </td>
                              <td>
                                <?php foreach ($item['missing'] as $missing): ?>
                                  <span class="badge bg-danger me-1 mb-1"><?= htmlspecialchars($missing) ?></span>
                                <?php endforeach; ?>
                              </td>
                              <td class="text-center">
                                <a href="index.php?controller=Penilaian&action=form&kecamatan=<?= $item['kecamatan']['id_kecamatan'] ?>" 
                                   class="btn btn-sm btn-warning">
                                  <i class="mdi mdi-pencil"></i> Lengkapi Data
                                </a>
                              </td>
                            </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  <?php else: ?>
                    <div class="alert alert-success text-center">
                      <i class="mdi mdi-check-circle-outline me-2"></i>
                      Semua kecamatan memiliki data penilaian yang lengkap!
                    </div>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>

          <div class="row mt-4">
            <div class="col-12">
              <div class="text-center">
                <a href="index.php?controller=Penilaian&action=index" class="btn btn-outline-info me-2">
                  <i class="mdi mdi-database"></i> Kelola Data Penilaian
                </a>
                <a href="index.php?controller=MAUT&action=normalisasi" class="btn btn-primary me-2">
                  <i class="mdi mdi-arrow-right"></i> Lanjut ke Normalisasi
                </a>
                <a href="index.php?controller=MAUT&action=perhitungan" class="btn btn-success">
                  <i class="mdi mdi-calculator"></i> Lihat Perhitungan Lengkap
                </a>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <?php include 'template/script.php'; ?>

  <style>
    .sticky-left {
      position: sticky;
      left: 0;
      z-index: 10;
    }
    
    .badge.fs-6 {
      font-size: 0.875rem !important;
      padding: 0.375rem 0.75rem;
    }
    
    .bg-orange {
      background-color: #fd7e14 !important;
    }
    
    .progress {
      background-color: #e9ecef;
    }
    
    .table-hover tbody tr:hover {
      background-color: rgba(0,0,0,0.075);
    }
    
    .card:hover {
      transform: translateY(-1px);
      transition: transform 0.2s ease;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    .table th {
      border-top: none;
    }
    
    .alert-info {
      border-left: 4px solid #0dcaf0;
    }
  </style>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Tooltip untuk badge nilai
      const badges = document.querySelectorAll('.badge');
      badges.forEach(function(badge) {
        badge.setAttribute('data-bs-toggle', 'tooltip');
        badge.setAttribute('data-bs-placement', 'top');
      });
      
      // Initialize tooltips
      if (typeof bootstrap !== 'undefined') {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
          return new bootstrap.Tooltip(tooltipTriggerEl);
        });
      }
    });
  </script>

</body>
</html>