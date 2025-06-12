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
              <h4 class="mt-2">Perhitungan MAUT (Multi-Attribute Utility Theory)</h4>
              <p class="text-muted">Proses perhitungan lengkap metode MAUT untuk analisis kesesuaian lahan</p>
            </div>
            <div class="col-md-4 text-end">
              <div class="btn-group" role="group">
                <a href="index.php?controller=MAUT&action=index" class="btn btn-outline-secondary">
                  <i class="mdi mdi-arrow-left"></i> Kembali
                </a>
                <button class="btn btn-info" onclick="window.print()">
                  <i class="mdi mdi-printer"></i> Print
                </button>
                <a href="index.php?controller=MAUT&action=exportCSV" class="btn btn-success">
                  <i class="mdi mdi-file-excel"></i> Export CSV
                </a>
                <a href="index.php?controller=MAUT&action=exportPDF" class="btn btn-danger">
                  <i class="mdi mdi-file-pdf"></i> Export PDF
                </a>
              </div>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-12">
              <div class="alert alert-info d-flex align-items-center">
                <i class="mdi mdi-information-outline me-2"></i>
                <div>
                  <strong>Informasi:</strong> Halaman ini menampilkan proses perhitungan MAUT secara step-by-step untuk transparansi analisis.
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header bg-primary text-white">
                  <h5 class="mb-0">
                    <i class="mdi mdi-numeric-1-circle"></i> Step 1: Matriks Keputusan Awal
                  </h5>
                </div>
                <div class="card-body">
                  <p class="text-muted mb-3">Data penilaian awal untuk setiap kecamatan berdasarkan kriteria yang telah ditentukan.</p>
                  <div class="table-responsive">
                    <table class="table table-bordered table-sm table-hover">
                      <thead class="table-dark">
                        <tr>
                          <th rowspan="2" class="align-middle text-center">Kecamatan</th>
                          <th colspan="<?= count($data['kriteria']) ?>" class="text-center">Kriteria Penilaian</th>
                        </tr>
                        <tr>
                          <?php foreach ($data['kriteria'] as $kriteria): ?>
                            <th class="text-center">
                              <?= htmlspecialchars($kriteria['nama_kriteria']) ?>
                              <br>
                              <small class="text-warning">(Bobot: <?= round($kriteria['bobot'] * 100, 1) ?>%)</small>
                            </th>
                          <?php endforeach; ?>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($data['matrix'] as $id_kecamatan => $kecamatan_data): ?>
                          <tr>
                            <td class="fw-bold bg-light">
                              <?php 
                              $nama_kecamatan = '';
                              foreach ($kecamatan_data as $kriteria_data) {
                                $nama_kecamatan = $kriteria_data['nama_kecamatan'];
                                break;
                              }
                              echo htmlspecialchars($nama_kecamatan);
                              ?>
                            </td>
                            <?php foreach ($data['kriteria'] as $kriteria): ?>
                              <td class="text-center">
                                <?php if (isset($kecamatan_data[$kriteria['id_kriteria']])): ?>
                                  <span class="badge bg-secondary fs-6">
                                    <?= $kecamatan_data[$kriteria['id_kriteria']]['nilai'] ?>
                                  </span>
                                <?php else: ?>
                                  <span class="text-danger fw-bold">N/A</span>
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
            <div class="col-12">
              <div class="card">
                <div class="card-header bg-success text-white">
                  <h5 class="mb-0">
                    <i class="mdi mdi-numeric-2-circle"></i> Step 2: Identifikasi Nilai Min-Max
                  </h5>
                </div>
                <div class="card-body">
                  <p class="text-muted mb-3">Identifikasi nilai minimum dan maksimum untuk setiap kriteria sebagai dasar normalisasi.</p>
                  <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                      <thead class="table-light">
                        <tr>
                          <th class="fw-bold">Kriteria</th>
                          <th class="text-center">Nilai Minimum</th>
                          <th class="text-center">Nilai Maksimum</th>
                          <th class="text-center">Range (Max-Min)</th>
                          <th class="text-center">Bobot Kriteria</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($data['minMax'] as $id_kriteria => $minmax): ?>
                          <tr>
                            <td class="fw-bold"><?= htmlspecialchars($minmax['nama_kriteria']) ?></td>
                            <td class="text-center">
                              <span class="badge bg-danger fs-6"><?= $minmax['min'] ?></span>
                            </td>
                            <td class="text-center">
                              <span class="badge bg-success fs-6"><?= $minmax['max'] ?></span>
                            </td>
                            <td class="text-center">
                              <span class="badge bg-info fs-6"><?= $minmax['max'] - $minmax['min'] ?></span>
                            </td>
                            <td class="text-center">
                              <span class="badge bg-primary fs-6"><?= round($minmax['bobot'] * 100, 1) ?>%</span>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                        <tr class="table-warning">
                          <td class="fw-bold">Total Bobot</td>
                          <td colspan="3" class="text-center">-</td>
                          <td class="text-center">
                            <span class="badge bg-warning text-dark fs-6">
                              <?= round(array_sum(array_column($data['kriteria'], 'bobot')) * 100, 1) ?>%
                            </span>
                          </td>
                        </tr>
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
                <div class="card-header bg-warning text-white">
                  <h5 class="mb-0">
                    <i class="mdi mdi-numeric-3-circle"></i> Step 3: Normalisasi dengan Fungsi Utilitas
                  </h5>
                </div>
                <div class="card-body">
                  <div class="alert alert-light border-start border-warning border-4">
                    <h6 class="fw-bold mb-2">Formula Normalisasi:</h6>
                    <code>U(xi) = (xi - min) / (max - min)</code>
                    <p class="mb-0 mt-2 small text-muted">
                      Dimana: xi = nilai kriteria, min = nilai minimum, max = nilai maksimum
                    </p>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-bordered table-sm table-hover">
                      <thead class="table-dark">
                        <tr>
                          <th rowspan="2" class="align-middle text-center">Kecamatan</th>
                          <th colspan="<?= count($data['kriteria']) ?>" class="text-center">Nilai Utilitas (Normalisasi)</th>
                        </tr>
                        <tr>
                          <?php foreach ($data['kriteria'] as $kriteria): ?>
                            <th class="text-center"><?= htmlspecialchars($kriteria['nama_kriteria']) ?></th>
                          <?php endforeach; ?>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($data['utility'] as $id_kecamatan => $kecamatan_data): ?>
                          <tr>
                            <td class="fw-bold bg-light">
                              <?php 
                              foreach ($kecamatan_data as $kriteria_data) {
                                echo htmlspecialchars($kriteria_data['nama_kecamatan']);
                                break;
                              }
                              ?>
                            </td>
                            <?php foreach ($data['kriteria'] as $kriteria): ?>
                              <td class="text-center">
                                <?php if (isset($kecamatan_data[$kriteria['id_kriteria']])): ?>
                                  <span class="badge bg-primary fs-6">
                                    <?= $kecamatan_data[$kriteria['id_kriteria']]['nilai_utilitas'] ?>
                                  </span>
                                  <br>
                                  <small class="text-muted">
                                    (Asli: <?= $kecamatan_data[$kriteria['id_kriteria']]['nilai_asli'] ?>)
                                  </small>
                                <?php else: ?>
                                  <span class="text-danger fw-bold">N/A</span>
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
            <div class="col-12">
              <div class="card">
                <div class="card-header bg-info text-white">
                  <h5 class="mb-0">
                    <i class="mdi mdi-numeric-4-circle"></i> Step 4: Perhitungan Nilai Terbobot
                  </h5>
                </div>
                <div class="card-body">
                  <div class="alert alert-light border-start border-info border-4">
                    <h6 class="fw-bold mb-2">Formula Pembobotan:</h6>
                    <code>Nilai Terbobot = Nilai Utilitas × Bobot Kriteria</code>
                    <p class="mb-0 mt-2 small text-muted">
                      Setiap nilai utilitas dikalikan dengan bobot masing-masing kriteria.
                    </p>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-bordered table-sm table-hover">
                      <thead class="table-dark">
                        <tr>
                          <th rowspan="2" class="align-middle text-center">Kecamatan</th>
                          <th colspan="<?= count($data['kriteria']) ?>" class="text-center">Nilai Terbobot</th>
                          <th rowspan="2" class="align-middle text-center">Total</th>
                        </tr>
                        <tr>
                          <?php foreach ($data['kriteria'] as $kriteria): ?>
                            <th class="text-center"><?= htmlspecialchars($kriteria['nama_kriteria']) ?></th>
                          <?php endforeach; ?>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($data['utility'] as $id_kecamatan => $kecamatan_data): ?>
                          <tr>
                            <td class="fw-bold bg-light">
                              <?php 
                              foreach ($kecamatan_data as $kriteria_data) {
                                echo htmlspecialchars($kriteria_data['nama_kecamatan']);
                                break;
                              }
                              ?>
                            </td>
                            <?php 
                            $total_terbobot = 0;
                            foreach ($data['kriteria'] as $kriteria): 
                            ?>
                              <td class="text-center">
                                <?php if (isset($kecamatan_data[$kriteria['id_kriteria']])): ?>
                                  <?php $total_terbobot += $kecamatan_data[$kriteria['id_kriteria']]['nilai_terbobot']; ?>
                                  <span class="badge bg-success fs-6">
                                    <?= $kecamatan_data[$kriteria['id_kriteria']]['nilai_terbobot'] ?>
                                  </span>
                                  <br>
                                  <small class="text-muted">
                                    <?= $kecamatan_data[$kriteria['id_kriteria']]['nilai_utilitas'] ?> × <?= round($kriteria['bobot'], 3) ?>
                                  </small>
                                <?php else: ?>
                                  <span class="text-danger fw-bold">N/A</span>
                                <?php endif; ?>
                              </td>
                            <?php endforeach; ?>
                            <td class="text-center bg-warning">
                              <span class="badge bg-dark fs-6 fw-bold">
                                <?= round($total_terbobot, 4) ?>
                              </span>
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
                <div class="card-header bg-dark text-white">
                  <h5 class="mb-0">
                    <i class="mdi mdi-trophy"></i> Step 5: Hasil Akhir MAUT Score & Ranking
                  </h5>
                </div>
                <div class="card-body">
                  <div class="alert alert-light border-start border-dark border-4">
                    <h6 class="fw-bold mb-2">Formula MAUT Score:</h6>
                    <code>MAUT Score = Σ(Nilai Terbobot) = Σ(Utilitas × Bobot)</code>
                    <p class="mb-0 mt-2 small text-muted">
                      Skor akhir merupakan penjumlahan semua nilai terbobot untuk setiap alternatif.
                    </p>
                  </div>
                  
                  <div class="row mb-4">
                    <div class="col-md-6">
                      <div class="card bg-primary text-white">
                        <div class="card-body text-center">
                          <h6 class="card-title">Total Alternatif</h6>
                          <h2 class="mb-0"><?= count($data['scores']) ?></h2>
                          <small>Kecamatan yang dianalisis</small>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="card bg-success text-white">
                        <div class="card-body text-center">
                          <h6 class="card-title">Skor Tertinggi</h6>
                          <h2 class="mb-0"><?= round(max(array_column($data['scores'], 'total_score')), 4) ?></h2>
                          <small>Nilai maksimum yang dicapai</small>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                      <thead class="table-dark">
                        <tr>
                          <th class="text-center">Ranking</th>
                          <th>Kecamatan</th>
                          <th class="text-center">MAUT Score</th>
                          <th class="text-center">Persentase</th>
                          <th class="text-center">Visualisasi</th>
                          <th class="text-center">Kategori Kesesuaian</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $rank = 1;
                        foreach ($data['scores'] as $id_kecamatan => $score_data): 
                          $persentase = round($score_data['total_score'] * 100, 2);
                          $badge_class = '';
                          $kategori = '';
                          
                          if ($persentase >= 80) {
                            $badge_class = 'bg-success';
                            $kategori = 'Sangat Sesuai';
                          } elseif ($persentase >= 60) {
                            $badge_class = 'bg-primary';
                            $kategori = 'Sesuai';
                          } elseif ($persentase >= 40) {
                            $badge_class = 'bg-warning text-dark';
                            $kategori = 'Cukup Sesuai';
                          } else {
                            $badge_class = 'bg-danger';
                            $kategori = 'Kurang Sesuai';
                          }
                        ?>
                          <tr class="<?= $rank <= 3 ? 'table-warning' : '' ?>">
                            <td class="text-center">
                              <?php if ($rank <= 3): ?>
                                <span class="badge bg-warning text-dark fs-6">
                                  <i class="mdi mdi-trophy"></i> <?= $rank ?>
                                </span>
                              <?php else: ?>
                                <span class="badge bg-secondary fs-6"><?= $rank ?></span>
                              <?php endif; ?>
                            </td>
                            <td class="fw-bold"><?= htmlspecialchars($score_data['nama_kecamatan']) ?></td>
                            <td class="text-center">
                              <span class="badge bg-primary fs-6"><?= $score_data['total_score'] ?></span>
                            </td>
                            <td class="text-center">
                              <span class="badge bg-info fs-6"><?= $persentase ?>%</span>
                            </td>
                            <td>
                              <div class="progress" style="height: 25px;">
                                <div class="progress-bar <?= str_replace('bg-', '', $badge_class) ?>" 
                                     role="progressbar" 
                                     style="width: <?= $persentase ?>%"
                                     aria-valuenow="<?= $persentase ?>" 
                                     aria-valuemin="0" 
                                     aria-valuemax="100">
                                  <?= $persentase ?>%
                                </div>
                              </div>
                            </td>
                            <td class="text-center">
                              <span class="badge <?= $badge_class ?> fs-6"><?= $kategori ?></span>
                            </td>
                          </tr>
                        <?php 
                          $rank++;
                        endforeach; 
                        ?>
                      </tbody>
                    </table>
                  </div>
                  
                  <div class="text-center mt-4">
                    <div class="btn-group" role="group">
                      <a href="index.php?controller=MAUT&action=simpanAnalisis" class="btn btn-success btn-lg">
                        <i class="mdi mdi-content-save"></i> Simpan Hasil Analisis
                      </a>
                      <a href="index.php?controller=MAUT&action=ranking" class="btn btn-primary btn-lg">
                        <i class="mdi mdi-trophy"></i> Lihat Ranking Detail
                      </a>
                      <a href="index.php?controller=MAUT&action=grafik" class="btn btn-info btn-lg">
                        <i class="mdi mdi-chart-bar"></i> Lihat Grafik
                      </a>
                    </div>
                  </div>

                  <div class="mt-4">
                    <div class="alert alert-info">
                      <h6 class="fw-bold">Interpretasi Hasil:</h6>
                      <ul class="mb-0">
                        <li><strong>Sangat Sesuai (≥80%):</strong> Kecamatan dengan tingkat kesesuaian sangat tinggi</li>
                        <li><strong>Sesuai (60-79%):</strong> Kecamatan dengan tingkat kesesuaian tinggi</li>
                        <li><strong>Cukup Sesuai (40-59%):</strong> Kecamatan dengan tingkat kesesuaian sedang</li>
                        <li><strong>Kurang Sesuai (<40%):</strong> Kecamatan dengan tingkat kesesuaian rendah</li>
                      </ul>
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
    @media print {
      .main-panel {
        width: 100% !important;
        margin: 0 !important;
      }
      
      .sidebar, .navbar, .btn, .footer {
        display: none !important;
      }
      
      .card {
        break-inside: avoid;
        margin-bottom: 20px;
        box-shadow: none;
        border: 1px solid #dee2e6;
      }
      
      .table {
        font-size: 11px;
      }
      
      .badge {
        background-color: #6c757d !important;
        color: white !important;
      }
      
      .progress-bar {
        background-color: #007bff !important;
      }
    }
    
    .progress {
      background-color: #e9ecef;
      border-radius: 0.375rem;
    }
    
    .badge.fs-6 {
      font-size: 0.875rem !important;
      padding: 0.5em 0.75em;
    }
    
    .card-header {
      border-bottom: 2px solid rgba(255,255,255,0.2);
      font-weight: 600;
    }
    
    .table-hover tbody tr:hover {
      background-color: rgba(0,0,0,.075);
    }
    
    .border-4 {
      border-width: 4px !important;
    }
    
    .alert code {
      background-color: rgba(0,0,0,.1);
      padding: 2px 6px;
      border-radius: 3px;
      font-family: 'Courier New', Courier, monospace;
    }
  </style>

</body>
</html>