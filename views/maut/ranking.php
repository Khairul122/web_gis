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
              <h4 class="mt-2">Ranking Kesesuaian Lahan</h4>
              <p class="text-muted">Peringkat kecamatan berdasarkan hasil analisis MAUT</p>
            </div>
            <div class="col-md-4 text-end">
              <a href="index.php?controller=MAUT&action=index" class="btn btn-outline-secondary me-2">
                <i class="mdi mdi-arrow-left"></i> Kembali
              </a>
              <div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                  <i class="mdi mdi-download"></i> Export
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="index.php?controller=MAUT&action=exportCSV">
                    <i class="mdi mdi-file-excel"></i> Export CSV
                  </a></li>
                  <li><a class="dropdown-item" href="index.php?controller=MAUT&action=downloadLaporan">
                    <i class="mdi mdi-file-pdf"></i> Export PDF
                  </a></li>
                </ul>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-8">
              <div class="card">
                <div class="card-header bg-gradient-primary text-white">
                  <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                      <i class="mdi mdi-trophy-award"></i> Ranking Lengkap
                    </h5>
                    <span class="badge bg-light text-dark">
                      Total: <?= count($data['ranking']) ?> Kecamatan
                    </span>
                  </div>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive">
                    <table class="table table-hover mb-0">
                      <thead class="table-dark">
                        <tr>
                          <th class="text-center" style="width: 80px;">Rank</th>
                          <th>Kecamatan</th>
                          <th class="text-center">MAUT Score</th>
                          <th class="text-center" style="width: 200px;">Persentase</th>
                          <th class="text-center">Kategori</th>
                          <th class="text-center">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($data['ranking'] as $rank_data): 
                          $badge_class = '';
                          $kategori = '';
                          $icon = '';
                          
                          if ($rank_data['persentase'] >= 80) {
                            $badge_class = 'bg-success';
                            $kategori = 'Sangat Sesuai';
                            $icon = 'mdi-star';
                          } elseif ($rank_data['persentase'] >= 60) {
                            $badge_class = 'bg-primary';
                            $kategori = 'Sesuai';
                            $icon = 'mdi-thumb-up';
                          } elseif ($rank_data['persentase'] >= 40) {
                            $badge_class = 'bg-warning';
                            $kategori = 'Cukup Sesuai';
                            $icon = 'mdi-minus-circle';
                          } else {
                            $badge_class = 'bg-danger';
                            $kategori = 'Kurang Sesuai';
                            $icon = 'mdi-close-circle';
                          }
                        ?>
                          <tr>
                            <td class="text-center">
                              <?php if ($rank_data['rank'] == 1): ?>
                                <span class="badge bg-warning fs-5">
                                  <i class="mdi mdi-trophy"></i> 1
                                </span>
                              <?php elseif ($rank_data['rank'] == 2): ?>
                                <span class="badge bg-secondary fs-5">
                                  <i class="mdi mdi-medal"></i> 2
                                </span>
                              <?php elseif ($rank_data['rank'] == 3): ?>
                                <span class="badge bg-orange fs-5">
                                  <i class="mdi mdi-medal"></i> 3
                                </span>
                              <?php else: ?>
                                <span class="badge bg-light text-dark fs-5"><?= $rank_data['rank'] ?></span>
                              <?php endif; ?>
                            </td>
                            <td>
                              <div class="d-flex align-items-center">
                                <div class="ms-2">
                                  <h6 class="mb-0"><?= htmlspecialchars($rank_data['nama_kecamatan']) ?></h6>
                                  <small class="text-muted">ID: <?= $rank_data['id_kecamatan'] ?></small>
                                </div>
                              </div>
                            </td>
                            <td class="text-center">
                              <span class="badge bg-info fs-6"><?= $rank_data['total_score'] ?></span>
                            </td>
                            <td>
                              <div class="progress mb-1" style="height: 20px;">
                                <div class="progress-bar <?= str_replace('bg-', 'bg-', $badge_class) ?>" 
                                     role="progressbar" 
                                     style="width: <?= $rank_data['persentase'] ?>%">
                                  <?= $rank_data['persentase'] ?>%
                                </div>
                              </div>
                            </td>
                            <td class="text-center">
                              <span class="badge <?= $badge_class ?>">
                                <i class="mdi <?= $icon ?>"></i> <?= $kategori ?>
                              </span>
                            </td>
                            <td class="text-center">
                              <button class="btn btn-sm btn-outline-primary" 
                                      data-bs-toggle="modal" 
                                      data-bs-target="#detailModal<?= $rank_data['id_kecamatan'] ?>">
                                <i class="mdi mdi-eye"></i> Detail
                              </button>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="card">
                <div class="card-header bg-light">
                  <h5 class="mb-0">
                    <i class="mdi mdi-chart-pie"></i> Distribusi Kategori
                  </h5>
                </div>
                <div class="card-body">
                  <?php 
                  $kategori_count = [
                    'Sangat Sesuai' => 0,
                    'Sesuai' => 0,
                    'Cukup Sesuai' => 0,
                    'Kurang Sesuai' => 0
                  ];
                  
                  foreach ($data['ranking'] as $rank_data) {
                    if ($rank_data['persentase'] >= 80) {
                      $kategori_count['Sangat Sesuai']++;
                    } elseif ($rank_data['persentase'] >= 60) {
                      $kategori_count['Sesuai']++;
                    } elseif ($rank_data['persentase'] >= 40) {
                      $kategori_count['Cukup Sesuai']++;
                    } else {
                      $kategori_count['Kurang Sesuai']++;
                    }
                  }
                  
                  $total = count($data['ranking']);
                  ?>
                  
                  <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                      <span class="text-success">Sangat Sesuai</span>
                      <span class="badge bg-success"><?= $kategori_count['Sangat Sesuai'] ?></span>
                    </div>
                    <div class="progress mb-1" style="height: 8px;">
                      <div class="progress-bar bg-success" 
                           style="width: <?= $total > 0 ? ($kategori_count['Sangat Sesuai']/$total)*100 : 0 ?>%"></div>
                    </div>
                  </div>
                  
                  <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                      <span class="text-primary">Sesuai</span>
                      <span class="badge bg-primary"><?= $kategori_count['Sesuai'] ?></span>
                    </div>
                    <div class="progress mb-1" style="height: 8px;">
                      <div class="progress-bar bg-primary" 
                           style="width: <?= $total > 0 ? ($kategori_count['Sesuai']/$total)*100 : 0 ?>%"></div>
                    </div>
                  </div>
                  
                  <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                      <span class="text-warning">Cukup Sesuai</span>
                      <span class="badge bg-warning"><?= $kategori_count['Cukup Sesuai'] ?></span>
                    </div>
                    <div class="progress mb-1" style="height: 8px;">
                      <div class="progress-bar bg-warning" 
                           style="width: <?= $total > 0 ? ($kategori_count['Cukup Sesuai']/$total)*100 : 0 ?>%"></div>
                    </div>
                  </div>
                  
                  <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                      <span class="text-danger">Kurang Sesuai</span>
                      <span class="badge bg-danger"><?= $kategori_count['Kurang Sesuai'] ?></span>
                    </div>
                    <div class="progress mb-1" style="height: 8px;">
                      <div class="progress-bar bg-danger" 
                           style="width: <?= $total > 0 ? ($kategori_count['Kurang Sesuai']/$total)*100 : 0 ?>%"></div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card mt-4">
                <div class="card-header bg-light">
                  <h5 class="mb-0">
                    <i class="mdi mdi-trophy-variant"></i> Top 3 Kecamatan
                  </h5>
                </div>
                <div class="card-body">
                  <?php for ($i = 0; $i < min(3, count($data['ranking'])); $i++): 
                    $top = $data['ranking'][$i];
                    $medal_class = ['bg-warning', 'bg-secondary', 'bg-orange'][$i];
                    $medal_icon = ['mdi-trophy', 'mdi-medal', 'mdi-medal'][$i];
                  ?>
                    <div class="d-flex align-items-center mb-3 p-2 border rounded">
                      <span class="badge <?= $medal_class ?> me-3">
                        <i class="mdi <?= $medal_icon ?>"></i> <?= $i + 1 ?>
                      </span>
                      <div class="flex-grow-1">
                        <h6 class="mb-1"><?= htmlspecialchars($top['nama_kecamatan']) ?></h6>
                        <div class="d-flex justify-content-between">
                          <small class="text-muted">Score: <?= $top['total_score'] ?></small>
                          <small class="text-success fw-bold"><?= $top['persentase'] ?>%</small>
                        </div>
                      </div>
                    </div>
                  <?php endfor; ?>
                </div>
              </div>
            </div>
          </div>

          <?php foreach ($data['scores'] as $id_kecamatan => $score_data): ?>
            <div class="modal fade" id="detailModal<?= $id_kecamatan ?>" tabindex="-1">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">
                      Detail Perhitungan - <?= htmlspecialchars($score_data['nama_kecamatan']) ?>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>
                  <div class="modal-body">
                    <div class="table-responsive">
                      <table class="table table-bordered table-sm">
                        <thead class="table-light">
                          <tr>
                            <th>Kriteria</th>
                            <th class="text-center">Nilai Asli</th>
                            <th class="text-center">Nilai Utilitas</th>
                            <th class="text-center">Bobot</th>
                            <th class="text-center">Nilai Terbobot</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($score_data['detail'] as $id_kriteria => $detail): ?>
                            <tr>
                              <td><?= htmlspecialchars($detail['nama_kriteria']) ?></td>
                              <td class="text-center">
                                <span class="badge bg-secondary"><?= $detail['nilai_asli'] ?></span>
                              </td>
                              <td class="text-center">
                                <span class="badge bg-primary"><?= $detail['nilai_utilitas'] ?></span>
                              </td>
                              <td class="text-center">
                                <span class="badge bg-info"><?= round($detail['bobot'] * 100, 1) ?>%</span>
                              </td>
                              <td class="text-center">
                                <span class="badge bg-success"><?= $detail['nilai_terbobot'] ?></span>
                              </td>
                            </tr>
                          <?php endforeach; ?>
                        </tbody>
                        <tfoot class="table-dark">
                          <tr>
                            <th colspan="4" class="text-end">Total MAUT Score:</th>
                            <th class="text-center">
                              <span class="badge bg-warning fs-6"><?= $score_data['total_score'] ?></span>
                            </th>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>

        </div>
      </div>
    </div>
  </div>

  <?php include 'template/script.php'; ?>

  <style>
    .bg-orange {
      background-color: #fd7e14 !important;
    }
    
    .progress {
      background-color: #e9ecef;
    }
    
    .card:hover {
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      transition: box-shadow 0.3s ease;
    }
    
    .badge.fs-5 {
      font-size: 1rem !important;
      padding: 0.5rem 0.75rem;
    }
    
    .badge.fs-6 {
      font-size: 0.875rem !important;
    }
  </style>

</body>
</html>