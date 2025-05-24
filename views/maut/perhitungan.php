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
              <a href="index.php?controller=MAUT&action=index" class="btn btn-outline-secondary me-2">
                <i class="mdi mdi-arrow-left"></i> Kembali
              </a>
              <button class="btn btn-primary" onclick="window.print()">
                <i class="mdi mdi-printer"></i> Print
              </button>
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
                  <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                      <thead class="table-dark">
                        <tr>
                          <th rowspan="2" class="align-middle">Kecamatan</th>
                          <th colspan="<?= count($data['kriteria']) ?>" class="text-center">Kriteria</th>
                        </tr>
                        <tr>
                          <?php foreach ($data['kriteria'] as $kriteria): ?>
                            <th class="text-center">
                              <?= htmlspecialchars($kriteria['nama_kriteria']) ?>
                              <br>
                              <small class="text-muted">(<?= round($kriteria['bobot'] * 100, 1) ?>%)</small>
                            </th>
                          <?php endforeach; ?>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($data['matrix'] as $id_kecamatan => $kecamatan_data): ?>
                          <tr>
                            <td class="fw-bold">
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
                                <?= isset($kecamatan_data[$kriteria['id_kriteria']]) ? 
                                    $kecamatan_data[$kriteria['id_kriteria']]['nilai'] : 
                                    '<span class="text-danger">-</span>' ?>
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
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead class="table-light">
                        <tr>
                          <th>Kriteria</th>
                          <th class="text-center">Nilai Minimum</th>
                          <th class="text-center">Nilai Maksimum</th>
                          <th class="text-center">Range</th>
                          <th class="text-center">Bobot</th>
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
                              <span class="badge bg-primary"><?= round($minmax['bobot'] * 100, 1) ?>%</span>
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
                <div class="card-header bg-warning text-white">
                  <h5 class="mb-0">
                    <i class="mdi mdi-numeric-3-circle"></i> Step 3: Normalisasi dengan Fungsi Utilitas
                  </h5>
                </div>
                <div class="card-body">
                  <p class="text-muted mb-3">
                    <strong>Formula:</strong> U(xi) = (xi - min) / (max - min)
                  </p>
                  <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                      <thead class="table-dark">
                        <tr>
                          <th rowspan="2" class="align-middle">Kecamatan</th>
                          <th colspan="<?= count($data['kriteria']) ?>" class="text-center">Nilai Utilitas</th>
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
                            <td class="fw-bold">
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
                                  <span class="badge bg-primary">
                                    <?= $kecamatan_data[$kriteria['id_kriteria']]['nilai_utilitas'] ?>
                                  </span>
                                  <br>
                                  <small class="text-muted">
                                    (<?= $kecamatan_data[$kriteria['id_kriteria']]['nilai_asli'] ?>)
                                  </small>
                                <?php else: ?>
                                  <span class="text-danger">-</span>
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
                  <p class="text-muted mb-3">
                    <strong>Formula:</strong> Nilai Terbobot = Nilai Utilitas × Bobot Kriteria
                  </p>
                  <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                      <thead class="table-dark">
                        <tr>
                          <th rowspan="2" class="align-middle">Kecamatan</th>
                          <th colspan="<?= count($data['kriteria']) ?>" class="text-center">Nilai Terbobot</th>
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
                            <td class="fw-bold">
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
                                  <span class="badge bg-success">
                                    <?= $kecamatan_data[$kriteria['id_kriteria']]['nilai_terbobot'] ?>
                                  </span>
                                  <br>
                                  <small class="text-muted">
                                    <?= $kecamatan_data[$kriteria['id_kriteria']]['nilai_utilitas'] ?> × <?= round($kriteria['bobot'], 3) ?>
                                  </small>
                                <?php else: ?>
                                  <span class="text-danger">-</span>
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
                <div class="card-header bg-dark text-white">
                  <h5 class="mb-0">
                    <i class="mdi mdi-numeric-5-circle"></i> Step 5: Hasil Akhir MAUT Score
                  </h5>
                </div>
                <div class="card-body">
                  <p class="text-muted mb-3">
                    <strong>Formula:</strong> MAUT Score = Σ(Nilai Terbobot)
                  </p>
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead class="table-dark">
                        <tr>
                          <th>Rank</th>
                          <th>Kecamatan</th>
                          <th class="text-center">MAUT Score</th>
                          <th class="text-center">Persentase</th>
                          <th class="text-center">Kategori</th>
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
                            $badge_class = 'bg-warning';
                            $kategori = 'Cukup Sesuai';
                          } else {
                            $badge_class = 'bg-danger';
                            $kategori = 'Kurang Sesuai';
                          }
                        ?>
                          <tr>
                            <td class="text-center">
                              <?php if ($rank <= 3): ?>
                                <span class="badge bg-warning">
                                  <i class="mdi mdi-trophy"></i> <?= $rank ?>
                                </span>
                              <?php else: ?>
                                <span class="badge bg-secondary"><?= $rank ?></span>
                              <?php endif; ?>
                            </td>
                            <td class="fw-bold"><?= htmlspecialchars($score_data['nama_kecamatan']) ?></td>
                            <td class="text-center">
                              <span class="badge bg-primary fs-6"><?= $score_data['total_score'] ?></span>
                            </td>
                            <td class="text-center">
                              <div class="progress" style="height: 25px;">
                                <div class="progress-bar <?= str_replace('bg-', 'bg-', $badge_class) ?>" 
                                     role="progressbar" 
                                     style="width: <?= $persentase ?>%">
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
                    <a href="index.php?controller=MAUT&action=simpanAnalisis" class="btn btn-success btn-lg me-2">
                      <i class="mdi mdi-content-save"></i> Simpan Hasil Analisis
                    </a>
                    <a href="index.php?controller=MAUT&action=ranking" class="btn btn-primary btn-lg">
                      <i class="mdi mdi-trophy"></i> Lihat Ranking Detail
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

  <?php include 'template/script.php'; ?>

  <style>
    @media print {
      .main-panel {
        width: 100% !important;
        margin: 0 !important;
      }
      
      .sidebar, .navbar, .btn {
        display: none !important;
      }
      
      .card {
        break-inside: avoid;
        margin-bottom: 20px;
      }
      
      .table {
        font-size: 12px;
      }
    }
    
    .progress {
      background-color: #e9ecef;
    }
    
    .badge.fs-6 {
      font-size: 0.875rem !important;
    }
    
    .card-header {
      border-bottom: 2px solid rgba(255,255,255,0.2);
    }
  </style>

</body>
</html>