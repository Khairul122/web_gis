<?php include('template/header.php'); ?>

<body class="with-welcome-text">
  <div class="container-scroller">
    <?php include 'template/navbar.php'; ?>
    <div class="container-fluid page-body-wrapper">
      <?php include 'template/setting_panel.php'; ?>
      <?php include 'template/sidebar.php'; ?>
      <div class="main-panel">
        <div class="content-wrapper">
          
          <div class="row mb-3 no-print">
            <div class="col-md-8">
              <h4 class="mt-2">Laporan Analisis MAUT</h4>
              <p class="text-muted">Laporan lengkap hasil analisis kesesuaian lahan</p>
            </div>
            <div class="col-md-4 text-end">
              <a href="index.php?controller=MAUT&action=index" class="btn btn-outline-secondary me-2">
                <i class="mdi mdi-arrow-left"></i> Kembali
              </a>
              <button class="btn btn-primary" onclick="window.print()">
                <i class="mdi mdi-printer"></i> Print Laporan
              </button>
            </div>
          </div>

          <div class="print-header text-center mb-4">
            <h2>LAPORAN ANALISIS KESESUAIAN LAHAN</h2>
            <h3>METODE MAUT (Multi-Attribute Utility Theory)</h3>
            <p class="text-muted">Tanggal: <?= date('d F Y') ?></p>
            <hr>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header bg-primary text-white">
                  <h5 class="mb-0">
                    <i class="mdi mdi-information"></i> Ringkasan Eksekutif
                  </h5>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-3 text-center">
                      <h3 class="text-primary"><?= count($data['kecamatan']) ?></h3>
                      <small class="text-muted">Total Kecamatan</small>
                    </div>
                    <div class="col-md-3 text-center">
                      <h3 class="text-success"><?= count($data['kriteria']) ?></h3>
                      <small class="text-muted">Kriteria Penilaian</small>
                    </div>
                    <div class="col-md-3 text-center">
                      <?php 
                      $sangat_sesuai = count(array_filter($data['ranking'], function($r) { return $r['persentase'] >= 80; }));
                      ?>
                      <h3 class="text-warning"><?= $sangat_sesuai ?></h3>
                      <small class="text-muted">Sangat Sesuai</small>
                    </div>
                    <div class="col-md-3 text-center">
                      <?php 
                      $terbaik = $data['ranking'][0] ?? null;
                      ?>
                      <h3 class="text-info"><?= $terbaik ? round($terbaik['persentase'], 1) : 0 ?>%</h3>
                      <small class="text-muted">Skor Tertinggi</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row mt-4">
            <div class="col-12">
              <div class="card">
                <div class="card-header bg-success text-white">
                  <h5 class="mb-0">
                    <i class="mdi mdi-scale-balance"></i> Kriteria dan Bobot Penilaian
                  </h5>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead class="table-dark">
                        <tr>
                          <th>No</th>
                          <th>Kode</th>
                          <th>Nama Kriteria</th>
                          <th>Keterangan</th>
                          <th class="text-center">Bobot</th>
                          <th class="text-center">Persentase</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $no = 1;
                        foreach ($data['kriteria'] as $kriteria): 
                        ?>
                          <tr>
                            <td><?= $no++ ?></td>
                            <td class="fw-bold"><?= htmlspecialchars($kriteria['nama_kriteria']) ?></td>
                            <td><?= htmlspecialchars($kriteria['nama_kriteria']) ?></td>
                            <td><?= htmlspecialchars($kriteria['keterangan']) ?></td>
                            <td class="text-center"><?= $kriteria['bobot'] ?></td>
                            <td class="text-center">
                              <span class="badge bg-primary"><?= round($kriteria['bobot'] * 100, 1) ?>%</span>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                      <tfoot class="table-light">
                        <tr>
                          <th colspan="4" class="text-end">Total Bobot:</th>
                          <th class="text-center"><?= array_sum(array_column($data['kriteria'], 'bobot')) ?></th>
                          <th class="text-center">
                            <span class="badge bg-success">100%</span>
                          </th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row mt-4">
            <div class="col-12">
              <div class="card">
                <div class="card-header bg-warning text-white">
                  <h5 class="mb-0">
                    <i class="mdi mdi-chart-line"></i> Nilai Min-Max Kriteria
                  </h5>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead class="table-dark">
                        <tr>
                          <th>Kriteria</th>
                          <th class="text-center">Nilai Minimum</th>
                          <th class="text-center">Nilai Maksimum</th>
                          <th class="text-center">Range</th>
                          <th class="text-center">Rata-rata</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($data['minMax'] as $id_kriteria => $minmax): ?>
                          <tr>
                            <td class="fw-bold"><?= htmlspecialchars($minmax['nama_kriteria']) ?></td>
                            <td class="text-center">
                              <span class="badge bg-danger"><?= $minmax['min'] ?></span>
                            </td>
                            <td class="text-center">
                              <span class="badge bg-success"><?= $minmax['max'] ?></span>
                            </td>
                            <td class="text-center">
                              <span class="badge bg-info"><?= $minmax['max'] - $minmax['min'] ?></span>
                            </td>
                            <td class="text-center">
                              <?php 
                              $total_nilai = 0;
                              $count_nilai = 0;
                              foreach ($data['matrix'] as $kecamatan_data) {
                                if (isset($kecamatan_data[$id_kriteria])) {
                                  $total_nilai += $kecamatan_data[$id_kriteria]['nilai'];
                                  $count_nilai++;
                                }
                              }
                              $avg = $count_nilai > 0 ? round($total_nilai / $count_nilai, 2) : 0;
                              ?>
                              <span class="badge bg-secondary"><?= $avg ?></span>
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
            <div class="col-12">
              <div class="card">
                <div class="card-header bg-info text-white">
                  <h5 class="mb-0">
                    <i class="mdi mdi-trophy-award"></i> Hasil Perangkingan
                  </h5>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                      <thead class="table-dark">
                        <tr>
                          <th class="text-center">Rank</th>
                          <th>Kecamatan</th>
                          <th class="text-center">MAUT Score</th>
                          <th class="text-center">Persentase</th>
                          <th class="text-center">Kategori Kesesuaian</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($data['ranking'] as $rank_data): 
                          $badge_class = '';
                          $kategori = '';
                          
                          if ($rank_data['persentase'] >= 80) {
                            $badge_class = 'bg-success';
                            $kategori = 'Sangat Sesuai';
                          } elseif ($rank_data['persentase'] >= 60) {
                            $badge_class = 'bg-primary';
                            $kategori = 'Sesuai';
                          } elseif ($rank_data['persentase'] >= 40) {
                            $badge_class = 'bg-warning';
                            $kategori = 'Cukup Sesuai';
                          } else {
                            $badge_class = 'bg-danger';
                            $kategori = 'Kurang Sesuai';
                          }
                        ?>
                          <tr>
                            <td class="text-center">
                              <?php if ($rank_data['rank'] <= 3): ?>
                                <span class="badge bg-warning fs-6"><?= $rank_data['rank'] ?></span>
                              <?php else: ?>
                                <span class="badge bg-secondary"><?= $rank_data['rank'] ?></span>
                              <?php endif; ?>
                            </td>
                            <td class="fw-bold"><?= htmlspecialchars($rank_data['nama_kecamatan']) ?></td>
                            <td class="text-center">
                              <span class="badge bg-primary"><?= $rank_data['total_score'] ?></span>
                            </td>
                            <td class="text-center">
                              <span class="badge <?= $badge_class ?>"><?= $rank_data['persentase'] ?>%</span>
                            </td>
                            <td class="text-center">
                              <span class="badge <?= $badge_class ?>"><?= $kategori ?></span>
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
            <div class="col-lg-6">
              <div class="card">
                <div class="card-header bg-secondary text-white">
                  <h5 class="mb-0">
                    <i class="mdi mdi-chart-pie"></i> Distribusi Kategori
                  </h5>
                </div>
                <div class="card-body">
                  <?php 
                  $kategori_stats = [
                    'Sangat Sesuai' => count(array_filter($data['ranking'], function($r) { return $r['persentase'] >= 80; })),
                    'Sesuai' => count(array_filter($data['ranking'], function($r) { return $r['persentase'] >= 60 && $r['persentase'] < 80; })),
                    'Cukup Sesuai' => count(array_filter($data['ranking'], function($r) { return $r['persentase'] >= 40 && $r['persentase'] < 60; })),
                    'Kurang Sesuai' => count(array_filter($data['ranking'], function($r) { return $r['persentase'] < 40; }))
                  ];
                  ?>
                  <?php foreach ($kategori_stats as $kategori => $jumlah): ?>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                      <span class="fw-bold"><?= $kategori ?></span>
                      <div>
                        <span class="badge bg-primary me-2"><?= $jumlah ?></span>
                        <span class="text-muted"><?= round(($jumlah / count($data['ranking'])) * 100, 1) ?>%</span>
                      </div>
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="card">
                <div class="card-header bg-dark text-white">
                  <h5 class="mb-0">
                    <i class="mdi mdi-calculator"></i> Statistik Analisis
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
                  <div class="row text-center">
                    <div class="col-6 mb-3">
                      <h4 class="text-success"><?= round($max_score, 4) ?></h4>
                      <small class="text-muted">Skor Tertinggi</small>
                    </div>
                    <div class="col-6 mb-3">
                      <h4 class="text-danger"><?= round($min_score, 4) ?></h4>
                      <small class="text-muted">Skor Terendah</small>
                    </div>
                    <div class="col-6">
                      <h4 class="text-primary"><?= round($avg_score, 4) ?></h4>
                      <small class="text-muted">Rata-rata</small>
                    </div>
                    <div class="col-6">
                      <h4 class="text-info"><?= round($std_dev, 4) ?></h4>
                      <small class="text-muted">Std. Deviasi</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row mt-4">
            <div class="col-12">
              <div class="card">
                <div class="card-header bg-primary text-white">
                  <h5 class="mb-0">
                    <i class="mdi mdi-file-document-edit"></i> Kesimpulan dan Rekomendasi
                  </h5>
                </div>
                <div class="card-body">
                  <h6 class="fw-bold">Kesimpulan:</h6>
                  <p>Berdasarkan analisis MAUT yang telah dilakukan terhadap <?= count($data['kecamatan']) ?> kecamatan dengan <?= count($data['kriteria']) ?> kriteria penilaian, dapat disimpulkan:</p>
                  <ul>
                    <li>Kecamatan dengan kesesuaian lahan terbaik adalah <strong><?= $data['ranking'][0]['nama_kecamatan'] ?></strong> dengan skor MAUT <?= $data['ranking'][0]['total_score'] ?> (<?= $data['ranking'][0]['persentase'] ?>%).</li>
                    <li>Sebanyak <?= $kategori_stats['Sangat Sesuai'] ?> kecamatan masuk kategori "Sangat Sesuai" untuk pengembangan lahan.</li>
                    <li>Kriteria <?= $data['kriteria'][0]['nama_kriteria'] ?> memiliki bobot tertinggi (<?= round($data['kriteria'][0]['bobot'] * 100, 1) ?>%) dalam penilaian kesesuaian lahan.</li>
                  </ul>
                  
                  <h6 class="fw-bold mt-4">Rekomendasi:</h6>
                  <ul>
                    <li>Prioritaskan pengembangan lahan di kecamatan-kecamatan dengan kategori "Sangat Sesuai" dan "Sesuai".</li>
                    <li>Lakukan perbaikan infrastruktur dan kondisi lahan di kecamatan dengan kategori "Cukup Sesuai" dan "Kurang Sesuai".</li>
                    <li>Perhatikan secara khusus kriteria dengan bobot tinggi dalam perencanaan pengembangan lahan.</li>
                  </ul>
                  
                  <div class="mt-4 text-end">
                    <p class="mb-1">Laporan disusun pada: <?= date('d F Y, H:i') ?> WIB</p>
                    <p class="text-muted">Sistem Analisis MAUT - Kesesuaian Lahan</p>
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
    @media print {
      .main-panel {
        width: 100% !important;
        margin: 0 !important;
      }
      
      .sidebar, .navbar, .no-print {
        display: none !important;
      }
      
      .card {
        break-inside: avoid;
        margin-bottom: 20px;
        border: 1px solid #000 !important;
      }
      
      .card-header {
        background-color: #f8f9fa !important;
        color: #000 !important;
        border-bottom: 1px solid #000 !important;
      }
      
      .table th, .table td {
        border: 1px solid #000 !important;
      }
      
      .badge {
        border: 1px solid #000 !important;
      }
      
      .print-header {
        margin-bottom: 30px;
      }
    }
    
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
    
    .print-header h2, .print-header h3 {
      margin-bottom: 10px;
    }
  </style>

</body>
</html>