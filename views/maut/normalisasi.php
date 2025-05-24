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
              <h4 class="mt-2">Normalisasi dengan Fungsi Utilitas MAUT</h4>
              <p class="text-muted">Proses konversi nilai kriteria menjadi nilai utilitas</p>
            </div>
            <div class="col-md-4 text-end">
              <a href="index.php?controller=MAUT&action=index" class="btn btn-outline-secondary me-2">
                <i class="mdi mdi-arrow-left"></i> Kembali
              </a>
              <a href="index.php?controller=MAUT&action=perhitungan" class="btn btn-primary">
                <i class="mdi mdi-calculator"></i> Perhitungan Lengkap
              </a>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header bg-info text-white">
                  <h5 class="mb-0">
                    <i class="mdi mdi-function"></i> Formula Fungsi Utilitas MAUT
                  </h5>
                </div>
                <div class="card-body">
                  <div class="alert alert-info">
                    <h6 class="alert-heading">Fungsi Utilitas Linear</h6>
                    <div class="row">
                      <div class="col-md-6">
                        <p><strong>Formula:</strong></p>
                        <div class="bg-light p-3 rounded">
                          <code>U(xi) = (xi - min) / (max - min)</code>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <p><strong>Keterangan:</strong></p>
                        <ul>
                          <li><strong>U(xi)</strong> = Nilai utilitas</li>
                          <li><strong>xi</strong> = Nilai asli</li>
                          <li><strong>min</strong> = Nilai minimum</li>
                          <li><strong>max</strong> = Nilai maksimum</li>
                        </ul>
                      </div>
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
                    <i class="mdi mdi-chart-line"></i> Nilai Min-Max Kriteria
                  </h5>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead class="table-dark">
                        <tr>
                          <th>Kriteria</th>
                          <th class="text-center">Min</th>
                          <th class="text-center">Max</th>
                          <th class="text-center">Range</th>
                          <th class="text-center">Bobot</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        foreach ($data['minMax'] as $id_kriteria => $minmax) {
                          echo '<tr>';
                          echo '<td><strong>' . htmlspecialchars($minmax['nama_kriteria']) . '</strong></td>';
                          echo '<td class="text-center"><span class="badge bg-danger">' . $minmax['min'] . '</span></td>';
                          echo '<td class="text-center"><span class="badge bg-success">' . $minmax['max'] . '</span></td>';
                          echo '<td class="text-center"><span class="badge bg-info">' . ($minmax['max'] - $minmax['min']) . '</span></td>';
                          echo '<td class="text-center"><span class="badge bg-primary">' . round($minmax['bobot'] * 100, 1) . '%</span></td>';
                          echo '</tr>';
                        }
                        ?>
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
                    <i class="mdi mdi-calculator-variant"></i> Hasil Normalisasi
                  </h5>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                      <thead class="table-dark">
                        <tr>
                          <th>Kecamatan</th>
                          <?php 
                          foreach ($data['kriteria'] as $kriteria) {
                            echo '<th class="text-center">';
                            echo htmlspecialchars($kriteria['nama_kriteria']);
                            echo '<br><small>(' . round($kriteria['bobot'] * 100, 1) . '%)</small>';
                            echo '</th>';
                          }
                          ?>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        foreach ($data['utility'] as $id_kecamatan => $kecamatan_data) {
                          echo '<tr>';
                          
                          $nama_kecamatan = '';
                          foreach ($kecamatan_data as $kriteria_data) {
                            $nama_kecamatan = $kriteria_data['nama_kecamatan'];
                            break;
                          }
                          echo '<td class="fw-bold bg-light">' . htmlspecialchars($nama_kecamatan) . '</td>';
                          
                          foreach ($data['kriteria'] as $kriteria) {
                            echo '<td class="text-center">';
                            if (isset($kecamatan_data[$kriteria['id_kriteria']])) {
                              $detail = $kecamatan_data[$kriteria['id_kriteria']];
                              $utilitas = $detail['nilai_utilitas'];
                              
                              $badge_class = 'bg-danger';
                              if ($utilitas >= 0.8) {
                                $badge_class = 'bg-success';
                              } elseif ($utilitas >= 0.6) {
                                $badge_class = 'bg-primary';
                              } elseif ($utilitas >= 0.4) {
                                $badge_class = 'bg-warning';
                              }
                              
                              echo '<span class="badge ' . $badge_class . '">' . $detail['nilai_utilitas'] . '</span>';
                              echo '<br><small class="text-muted">Asli: ' . $detail['nilai_asli'] . '</small>';
                            } else {
                              echo '<span class="text-danger">-</span>';
                            }
                            echo '</td>';
                          }
                          echo '</tr>';
                        }
                        ?>
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
                <div class="card-header bg-primary text-white">
                  <h5 class="mb-0">
                    <i class="mdi mdi-chart-bar"></i> Statistik Per Kriteria
                  </h5>
                </div>
                <div class="card-body">
                  <div class="row">
                    <?php 
                    foreach ($data['kriteria'] as $kriteria) {
                      echo '<div class="col-lg-6 col-xl-4 mb-4">';
                      echo '<div class="card h-100">';
                      echo '<div class="card-header bg-light">';
                      echo '<h6 class="mb-0">' . htmlspecialchars($kriteria['nama_kriteria']) . '</h6>';
                      echo '</div>';
                      echo '<div class="card-body">';
                      
                      $nilai_utilitas = array();
                      foreach ($data['utility'] as $kecamatan_data) {
                        if (isset($kecamatan_data[$kriteria['id_kriteria']])) {
                          $nilai_utilitas[] = $kecamatan_data[$kriteria['id_kriteria']]['nilai_utilitas'];
                        }
                      }
                      
                      if (!empty($nilai_utilitas)) {
                        $min_util = min($nilai_utilitas);
                        $max_util = max($nilai_utilitas);
                        $avg_util = round(array_sum($nilai_utilitas) / count($nilai_utilitas), 4);
                        
                        echo '<div class="mb-3">';
                        echo '<div class="d-flex justify-content-between">';
                        echo '<small>Min:</small>';
                        echo '<span class="badge bg-danger">' . $min_util . '</span>';
                        echo '</div>';
                        echo '<div class="d-flex justify-content-between">';
                        echo '<small>Max:</small>';
                        echo '<span class="badge bg-success">' . $max_util . '</span>';
                        echo '</div>';
                        echo '<div class="d-flex justify-content-between">';
                        echo '<small>Avg:</small>';
                        echo '<span class="badge bg-info">' . $avg_util . '</span>';
                        echo '</div>';
                        echo '</div>';
                      } else {
                        echo '<div class="alert alert-warning">';
                        echo '<small>Tidak ada data</small>';
                        echo '</div>';
                      }
                      
                      echo '</div>';
                      echo '</div>';
                      echo '</div>';
                    }
                    ?>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row mt-4">
            <div class="col-12">
              <div class="text-center">
                <a href="index.php?controller=MAUT&action=matriksPenilaian" class="btn btn-outline-secondary me-2">
                  <i class="mdi mdi-arrow-left"></i> Matriks Penilaian
                </a>
                <a href="index.php?controller=MAUT&action=perhitungan" class="btn btn-primary me-2">
                  <i class="mdi mdi-calculator"></i> Perhitungan MAUT
                </a>
                <a href="index.php?controller=MAUT&action=ranking" class="btn btn-success">
                  <i class="mdi mdi-trophy"></i> Lihat Ranking
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
    .badge {
      font-size: 0.875rem;
      padding: 0.375rem 0.75rem;
    }
    
    .card:hover {
      transform: translateY(-1px);
      transition: transform 0.2s ease;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    code {
      font-family: 'Courier New', monospace;
      font-weight: bold;
      color: #495057;
    }
  </style>

</body>
</html>