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
              <h4 class="mt-2">Perbandingan Hasil MAUT</h4>
              <p class="text-muted">Analisis perbandingan kesesuaian lahan antar kecamatan</p>
            </div>
            <div class="col-md-4 text-end">
              <a href="index.php?controller=MAUT&action=index" class="btn btn-outline-secondary me-2">
                <i class="mdi mdi-arrow-left"></i> Kembali
              </a>
              <a href="index.php?controller=MAUT&action=grafik" class="btn btn-primary">
                <i class="mdi mdi-chart-bar"></i> Lihat Grafik
              </a>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header bg-primary text-white">
                  <h5 class="mb-0">
                    <i class="mdi mdi-compare"></i> Matriks Perbandingan Nilai Utilitas
                  </h5>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                      <thead class="table-dark">
                        <tr>
                          <th>Kecamatan</th>
                          <?php foreach ($data['kriteria'] as $kriteria): ?>
                            <th class="text-center"><?= htmlspecialchars($kriteria['nama_kriteria']) ?></th>
                          <?php endforeach; ?>
                          <th class="text-center bg-warning">Total MAUT</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $rank = 1;
                        foreach ($data['scores'] as $id_kecamatan => $score_data): 
                        ?>
                          <tr>
                            <td class="fw-bold">
                              <span class="badge bg-secondary me-2"><?= $rank++ ?></span>
                              <?= htmlspecialchars($score_data['nama_kecamatan']) ?>
                            </td>
                            <?php foreach ($data['kriteria'] as $kriteria): ?>
                              <td class="text-center">
                                <?php if (isset($score_data['detail'][$kriteria['id_kriteria']])): 
                                  $detail = $score_data['detail'][$kriteria['id_kriteria']];
                                  $utilitas = $detail['nilai_utilitas'];
                                  $badge_class = '';
                                  
                                  if ($utilitas >= 0.8) {
                                    $badge_class = 'bg-success';
                                  } elseif ($utilitas >= 0.6) {
                                    $badge_class = 'bg-primary';
                                  } elseif ($utilitas >= 0.4) {
                                    $badge_class = 'bg-warning';
                                  } else {
                                    $badge_class = 'bg-danger';
                                  }
                                ?>
                                  <span class="badge <?= $badge_class ?>"><?= $detail['nilai_utilitas'] ?></span>
                                  <br>
                                  <small class="text-muted">(<?= $detail['nilai_asli'] ?>)</small>
                                <?php else: ?>
                                  <span class="text-muted">-</span>
                                <?php endif; ?>
                              </td>
                            <?php endforeach; ?>
                            <td class="text-center bg-light">
                              <span class="badge bg-dark fs-6"><?= $score_data['total_score'] ?></span>
                              <br>
                              <small class="text-success"><?= round($score_data['total_score'] * 100, 2) ?>%</small>
                            </td>
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
                <div class="card-header bg-success text-white">
                  <h5 class="mb-0">
                    <i class="mdi mdi-chart-line"></i> Analisis Performa per Kriteria
                  </h5>
                </div>
                <div class="card-body">
                  <?php foreach ($data['kriteria'] as $kriteria): ?>
                    <div class="mb-4">
                      <h6 class="fw-bold"><?= htmlspecialchars($kriteria['nama_kriteria']) ?> (Bobot: <?= round($kriteria['bobot'] * 100, 1) ?>%)</h6>
                      <div class="row">
                        <?php 
                        $nilai_utilitas = [];
                        $kecamatan_names = [];
                        foreach ($data['utility'] as $id_kecamatan => $kecamatan_data) {
                          if (isset($kecamatan_data[$kriteria['id_kriteria']])) {
                            $nilai_utilitas[] = $kecamatan_data[$kriteria['id_kriteria']]['nilai_utilitas'];
                            $kecamatan_names[] = $kecamatan_data[$kriteria['id_kriteria']]['nama_kecamatan'];
                          }
                        }
                        
                        if (!empty($nilai_utilitas)) {
                          $max_index = array_search(max($nilai_utilitas), $nilai_utilitas);
                          $min_index = array_search(min($nilai_utilitas), $nilai_utilitas);
                          $avg_util = array_sum($nilai_utilitas) / count($nilai_utilitas);
                        ?>
                          <div class="col-md-4">
                            <div class="text-center p-2 border rounded">
                              <small class="text-muted">Terbaik</small>
                              <div class="fw-bold text-success"><?= $kecamatan_names[$max_index] ?></div>
                              <span class="badge bg-success"><?= max($nilai_utilitas) ?></span>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="text-center p-2 border rounded">
                              <small class="text-muted">Rata-rata</small>
                              <div class="fw-bold text-info">Semua Kecamatan</div>
                              <span class="badge bg-info"><?= round($avg_util, 4) ?></span>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="text-center p-2 border rounded">
                              <small class="text-muted">Terendah</small>
                              <div class="fw-bold text-danger"><?= $kecamatan_names[$min_index] ?></div>
                              <span class="badge bg-danger"><?= min($nilai_utilitas) ?></span>
                            </div>
                          </div>
                        <?php } ?>
                      </div>
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="card">
                <div class="card-header bg-warning text-white">
                  <h5 class="mb-0">
                    <i class="mdi mdi-trophy-variant"></i> Top 5 Kecamatan
                  </h5>
                </div>
                <div class="card-body">
                  <?php 
                  $top_5 = array_slice($data['ranking'], 0, 5, true);
                  foreach ($top_5 as $rank_data): 
                    $badge_class = '';
                    if ($rank_data['persentase'] >= 80) {
                      $badge_class = 'bg-success';
                    } elseif ($rank_data['persentase'] >= 60) {
                      $badge_class = 'bg-primary';
                    } elseif ($rank_data['persentase'] >= 40) {
                      $badge_class = 'bg-warning';
                    } else {
                      $badge_class = 'bg-danger';
                    }
                  ?>
                    <div class="d-flex justify-content-between align-items-center mb-3 p-2 border rounded">
                      <div class="d-flex align-items-center">
                        <span class="badge bg-secondary me-2"><?= $rank_data['rank'] ?></span>
                        <div>
                          <div class="fw-bold"><?= htmlspecialchars($rank_data['nama_kecamatan']) ?></div>
                          <small class="text-muted">Score: <?= $rank_data['total_score'] ?></small>
                        </div>
                      </div>
                      <span class="badge <?= $badge_class ?>"><?= $rank_data['persentase'] ?>%</span>
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>

              <div class="card mt-4">
                <div class="card-header bg-info text-white">
                  <h5 class="mb-0">
                    <i class="mdi mdi-chart-pie"></i> Statistik Umum
                  </h5>
                </div>
                <div class="card-body">
                  <?php 
                  $all_scores = array_column($data['ranking'], 'total_score');
                  $avg_score = array_sum($all_scores) / count($all_scores);
                  $max_score = max($all_scores);
                  $min_score = min($all_scores);
                  $std_dev = 0;
                  foreach ($all_scores as $score) {
                    $std_dev += pow($score - $avg_score, 2);
                  }
                  $std_dev = sqrt($std_dev / count($all_scores));
                  ?>
                  <div class="mb-2">
                    <div class="d-flex justify-content-between">
                      <small>Skor Tertinggi:</small>
                      <span class="badge bg-success"><?= round($max_score, 4) ?></span>
                    </div>
                  </div>
                  <div class="mb-2">
                    <div class="d-flex justify-content-between">
                      <small>Skor Terendah:</small>
                      <span class="badge bg-danger"><?= round($min_score, 4) ?></span>
                    </div>
                  </div>
                  <div class="mb-2">
                    <div class="d-flex justify-content-between">
                      <small>Rata-rata:</small>
                      <span class="badge bg-primary"><?= round($avg_score, 4) ?></span>
                    </div>
                  </div>
                  <div class="mb-2">
                    <div class="d-flex justify-content-between">
                      <small>Standar Deviasi:</small>
                      <span class="badge bg-info"><?= round($std_dev, 4) ?></span>
                    </div>
                  </div>
                  <div class="mb-2">
                    <div class="d-flex justify-content-between">
                      <small>Range:</small>
                      <span class="badge bg-secondary"><?= round($max_score - $min_score, 4) ?></span>
                    </div>
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
                    <i class="mdi mdi-swap-horizontal"></i> Perbandingan Detail Top 3
                  </h5>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead class="table-dark">
                        <tr>
                          <th>Aspek</th>
                          <?php 
                          $top_3 = array_slice($data['ranking'], 0, 3, true);
                          foreach ($top_3 as $rank_data): 
                          ?>
                            <th class="text-center"><?= htmlspecialchars($rank_data['nama_kecamatan']) ?></th>
                          <?php endforeach; ?>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="fw-bold">Ranking</td>
                          <?php foreach ($top_3 as $rank_data): ?>
                            <td class="text-center">
                              <span class="badge bg-warning">#<?= $rank_data['rank'] ?></span>
                            </td>
                          <?php endforeach; ?>
                        </tr>
                        <tr>
                          <td class="fw-bold">MAUT Score</td>
                          <?php foreach ($top_3 as $rank_data): ?>
                            <td class="text-center">
                              <span class="badge bg-primary"><?= $rank_data['total_score'] ?></span>
                            </td>
                          <?php endforeach; ?>
                        </tr>
                        <tr>
                          <td class="fw-bold">Persentase</td>
                          <?php foreach ($top_3 as $rank_data): ?>
                            <td class="text-center">
                              <span class="badge bg-success"><?= $rank_data['persentase'] ?>%</span>
                            </td>
                          <?php endforeach; ?>
                        </tr>
                        <?php foreach ($data['kriteria'] as $kriteria): ?>
                          <tr>
                            <td class="fw-bold"><?= htmlspecialchars($kriteria['nama_kriteria']) ?></td>
                            <?php foreach ($top_3 as $rank_data): ?>
                              <td class="text-center">
                                <?php 
                                $score_detail = $data['scores'][$rank_data['id_kecamatan']];
                                if (isset($score_detail['detail'][$kriteria['id_kriteria']])) {
                                  $detail = $score_detail['detail'][$kriteria['id_kriteria']];
                                  echo '<span class="badge bg-info">' . $detail['nilai_utilitas'] . '</span>';
                                  echo '<br><small class="text-muted">(' . $detail['nilai_asli'] . ')</small>';
                                } else {
                                  echo '<span class="text-muted">-</span>';
                                }
                                ?>
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

        </div>
      </div>
    </div>
  </div>

  <?php include 'template/script.php'; ?>

  <style>
    .badge {
      font-size: 0.875rem;
      padding: 0.375rem 0.75rem;
    }
    
    .badge.fs-6 {
      font-size: 0.75rem !important;
    }
    
    .card:hover {
      transform: translateY(-1px);
      transition: transform 0.2s ease;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
  </style>

</body>
</html>