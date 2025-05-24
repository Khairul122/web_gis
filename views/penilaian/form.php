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
              <h4 class="mt-2">Input Penilaian Berdasarkan Sub Kriteria</h4>
              <p class="text-muted">Pilih kecamatan dan berikan penilaian untuk setiap kriteria berdasarkan sub kriteria yang tersedia</p>
            </div>
            <div class="col-md-4 text-end">
              <a href="index.php?controller=Penilaian&action=index" class="btn btn-outline-secondary">
                <i class="mdi mdi-arrow-left"></i> Kembali
              </a>
            </div>
          </div>

          <?php if (isset($_SESSION['error_message'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <i class="mdi mdi-alert-circle me-2"></i>
              <?= $_SESSION['error_message'] ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['error_message']); ?>
          <?php endif; ?>

          <div class="row">
            <div class="col-sm-12">
              <div class="card">
                <div class="card-body">
                  <form action="index.php?controller=Penilaian&action=simpanSub" method="post" id="formPenilaian">
                    
                    <div class="row mb-4">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="id_kecamatan" class="form-label">
                            <strong>Pilih Kecamatan</strong> <span class="text-danger">*</span>
                          </label>
                          <select name="id_kecamatan" id="id_kecamatan" class="form-select" required>
                            <option value="">-- Pilih Kecamatan --</option>
                            <?php foreach ($kecamatan_options as $k): ?>
                              <option value="<?= $k['id_kecamatan'] ?>" 
                                      <?= (isset($_GET['kecamatan']) && $_GET['kecamatan'] == $k['id_kecamatan']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($k['nama_kecamatan']) ?>
                              </option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="border-top pt-4">
                      <h5 class="mb-3">
                        <i class="mdi mdi-clipboard-list-outline me-2"></i>
                        Pilih Nilai Berdasarkan Sub Kriteria
                      </h5>

                      <?php 
                      $kriteria_count = 1;
                      foreach ($kriteria_options as $k): 
                        $current_value = '';
                        $is_edit_mode = false;
                        if (isset($existing_data[$k['id_kriteria']])) {
                          $current_value = $existing_data[$k['id_kriteria']]['nilai'];
                          $is_edit_mode = true;
                        }
                      ?>
                        <div class="card mb-3 kriteria-card">
                          <div class="card-header bg-light">
                            <div class="d-flex justify-content-between align-items-center">
                              <h6 class="mb-0">
                                <span class="badge bg-primary me-2"><?= $kriteria_count++ ?></span>
                                <strong><?= htmlspecialchars($k['nama_kriteria']) ?></strong>
                                <?php if ($is_edit_mode): ?>
                                  <span class="badge bg-success ms-2">
                                    <i class="mdi mdi-check"></i> Sudah Dinilai
                                  </span>
                                <?php else: ?>
                                  <span class="badge bg-warning ms-2">
                                    <i class="mdi mdi-clock"></i> Belum Dinilai
                                  </span>
                                <?php endif; ?>
                              </h6>
                              <small class="text-muted"><?= htmlspecialchars($k['keterangan']) ?></small>
                            </div>
                          </div>
                          <div class="card-body">
                            <input type="hidden" name="id_kriteria[]" value="<?= $k['id_kriteria'] ?>">
                            
                            <div class="form-group">
                              <label class="form-label">Pilih Sub Kriteria <span class="text-danger">*</span></label>
                              <select name="nilai[]" class="form-select kriteria-select" required data-kriteria="<?= $k['id_kriteria'] ?>">
                                <option value="">-- Pilih Sub Kriteria --</option>
                                <?php if (isset($sub_kriteria[$k['id_kriteria']])): ?>
                                  <?php foreach ($sub_kriteria[$k['id_kriteria']] as $sub): ?>
                                    <option value="<?= $sub['nilai'] ?>" 
                                            <?= ($current_value == $sub['nilai']) ? 'selected' : '' ?>
                                            data-deskripsi="<?= htmlspecialchars($sub['deskripsi']) ?>">
                                      <?= htmlspecialchars($sub['deskripsi']) ?> 
                                      <span class="fw-bold">(Nilai: <?= $sub['nilai'] ?>)</span>
                                    </option>
                                  <?php endforeach; ?>
                                <?php else: ?>
                                  <option value="" disabled>Sub kriteria belum tersedia</option>
                                <?php endif; ?>
                              </select>
                            </div>

                            <div class="selected-info mt-2" style="display: none;">
                              <div class="alert alert-info py-2 mb-0">
                                <small>
                                  <strong>Terpilih:</strong> <span class="selected-desc"></span> 
                                  <strong>| Nilai:</strong> <span class="selected-nilai badge bg-success"></span>
                                </small>
                              </div>
                            </div>
                          </div>
                        </div>
                      <?php endforeach; ?>
                    </div>

                    <div class="border-top pt-4">
                      <div class="d-flex justify-content-between align-items-center">
                        <div>
                          <button type="submit" class="btn btn-success btn-lg me-2">
                            <i class="mdi mdi-content-save"></i> 
                            <?= isset($_GET['kecamatan']) ? 'Update Penilaian' : 'Simpan Penilaian' ?>
                          </button>
                          <button type="reset" class="btn btn-outline-warning">
                            <i class="mdi mdi-refresh"></i> Reset Form
                          </button>
                        </div>
                        <div class="text-end">
                          <?php if (isset($_GET['kecamatan'])): ?>
                            <div class="alert alert-info py-2 mb-2">
                              <small>
                                <i class="mdi mdi-information"></i>
                                Mode Edit: Data akan diperbarui
                              </small>
                            </div>
                          <?php endif; ?>
                          <small class="text-muted">
                            <span class="text-danger">*</span> Field wajib diisi
                          </small>
                        </div>
                      </div>
                    </div>

                  </form>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <?php include 'template/script.php'; ?>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const selects = document.querySelectorAll('.kriteria-select');
      const form = document.getElementById('formPenilaian');

      selects.forEach(function(select) {
        select.addEventListener('change', function() {
          const selectedOption = this.options[this.selectedIndex];
          const infoDiv = this.closest('.card-body').querySelector('.selected-info');
          const descSpan = infoDiv.querySelector('.selected-desc');
          const nilaiSpan = infoDiv.querySelector('.selected-nilai');

          if (this.value) {
            const deskripsi = selectedOption.getAttribute('data-deskripsi');
            descSpan.textContent = deskripsi;
            nilaiSpan.textContent = this.value;
            infoDiv.style.display = 'block';
            
            this.closest('.kriteria-card').classList.add('border-success');
          } else {
            infoDiv.style.display = 'none';
            this.closest('.kriteria-card').classList.remove('border-success');
          }
        });

        if (select.value) {
          select.dispatchEvent(new Event('change'));
        }
      });

      form.addEventListener('submit', function(e) {
        const kecamatan = document.getElementById('id_kecamatan').value;
        const nilaiSelects = document.querySelectorAll('select[name="nilai[]"]');
        let allFilled = true;

        if (!kecamatan) {
          alert('Silakan pilih kecamatan terlebih dahulu!');
          e.preventDefault();
          return;
        }

        nilaiSelects.forEach(function(select) {
          if (!select.value) {
            allFilled = false;
            select.closest('.kriteria-card').classList.add('border-danger');
          } else {
            select.closest('.kriteria-card').classList.remove('border-danger');
          }
        });

        if (!allFilled) {
          alert('Silakan lengkapi semua penilaian kriteria!');
          e.preventDefault();
          return;
        }

        if (!confirm(kecamatan ? 'Apakah Anda yakin ingin memperbarui penilaian ini?' : 'Apakah Anda yakin ingin menyimpan penilaian ini?')) {
          e.preventDefault();
        }
      });

      document.querySelector('button[type="reset"]').addEventListener('click', function() {
        setTimeout(function() {
          document.querySelectorAll('.selected-info').forEach(function(info) {
            info.style.display = 'none';
          });
          document.querySelectorAll('.kriteria-card').forEach(function(card) {
            card.classList.remove('border-success', 'border-danger');
          });
        }, 10);
      });

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
    });
  </script>

  <style>
    .kriteria-card {
      transition: all 0.3s ease;
    }
    
    .kriteria-card:hover {
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    .kriteria-card.border-success {
      border-color: #198754 !important;
      border-width: 2px !important;
    }
    
    .kriteria-card.border-danger {
      border-color: #dc3545 !important;
      border-width: 2px !important;
      animation: shake 0.5s ease-in-out;
    }
    
    @keyframes shake {
      0%, 100% { transform: translateX(0); }
      25% { transform: translateX(-5px); }
      75% { transform: translateX(5px); }
    }
    
    .selected-info {
      animation: fadeIn 0.3s ease-in-out;
    }
    
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-10px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>

</body>
</html>