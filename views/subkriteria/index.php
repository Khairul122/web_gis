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
            <div class="col-md-6">
              <h4 class="mt-2">Daftar Sub Kriteria</h4>
            </div>
            <div class="col-md-6 text-end">
              <a href="index.php?controller=SubKriteria&action=form" class="btn btn-primary">+ Tambah Sub Kriteria</a>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12">
              <?php if (!empty($data)): ?>
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead class="table-dark">
                      <tr>
                        <th>No</th>
                        <th>Nama Kriteria</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no = 1; foreach ($data as $id_kriteria => $k): ?>
                        <tr>
                          <td><?= $no++ ?></td>
                          <td><?= htmlspecialchars($k['nama_kriteria']) ?></td>
                          <td><?= htmlspecialchars($k['keterangan']) ?></td>
                          <td>
                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modal<?= $id_kriteria ?>">
                              Lihat Sub Kriteria
                            </button>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>

                <?php foreach ($data as $id_kriteria => $k): ?>
                  <div class="modal fade" id="modal<?= $id_kriteria ?>" tabindex="-1" aria-labelledby="modalLabel<?= $id_kriteria ?>" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="modalLabel<?= $id_kriteria ?>">
                            Sub Kriteria: <?= htmlspecialchars($k['nama_kriteria']) ?>
                          </h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <?php if (!empty($k['sub_kriteria'])): ?>
                            <div class="table-responsive">
                              <table class="table table-sm table-bordered">
                                <thead class="table-light">
                                  <tr>
                                    <th>No</th>
                                    <th>Deskripsi</th>
                                    <th>Nilai</th>
                                    <th>Aksi</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php $i = 1; foreach ($k['sub_kriteria'] as $s): ?>
                                    <tr>
                                      <td><?= $i++ ?></td>
                                      <td><?= htmlspecialchars($s['deskripsi']) ?></td>
                                      <td><?= htmlspecialchars($s['nilai']) ?></td>
                                      <td>
                                        <a href="index.php?controller=SubKriteria&action=form&id=<?= $s['id_sub_kriteria'] ?>" class="btn btn-sm btn-warning me-1">
                                          Edit
                                        </a>
                                        <a href="index.php?controller=SubKriteria&action=hapus&id=<?= $s['id_sub_kriteria'] ?>" 
                                           class="btn btn-sm btn-danger" 
                                           onclick="return confirm('Yakin ingin menghapus?')">
                                          Hapus
                                        </a>
                                      </td>
                                    </tr>
                                  <?php endforeach; ?>
                                </tbody>
                              </table>
                            </div>
                          <?php else: ?>
                            <div class="alert alert-info text-center">
                              <i class="fas fa-info-circle me-2"></i>
                              Belum ada sub kriteria untuk kriteria ini.
                            </div>
                          <?php endif; ?>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                          <a href="index.php?controller=SubKriteria&action=form&kriteria_id=<?= $id_kriteria ?>" class="btn btn-primary">
                            Tambah Sub Kriteria
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>

              <?php else: ?>
                <div class="alert alert-warning text-center">
                  <i class="fas fa-exclamation-triangle me-2"></i>
                  Belum ada data kriteria.
                </div>
              <?php endif; ?>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <?php include 'template/script.php'; ?>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var modals = document.querySelectorAll('.modal');
      modals.forEach(function(modal) {
        modal.addEventListener('shown.bs.modal', function() {
          var tableWrapper = modal.querySelector('.table-responsive');
          if (tableWrapper) {
            tableWrapper.style.maxHeight = '400px';
            tableWrapper.style.overflowY = 'auto';
          }
        });
      });
    });
  </script>

</body>
</html>