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
              <h4 class="mt-2">Data Kriteria</h4>
            </div>
            <div class="col-md-6 text-end">
              <a href="index.php?controller=kriteria&action=form" class="btn btn-primary">+ Tambah Kriteria</a>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="table-responsive">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Kriteria</th>
                      <th>Bobot</th>
                      <th>Keterangan</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1; foreach ($data as $row): ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($row['nama_kriteria']) ?></td>
                        <td><?= $row['bobot'] ?></td>
                        <td><?= htmlspecialchars($row['keterangan']) ?></td>
                        <td>
                          <a href="index.php?controller=kriteria&action=form&id=<?= $row['id_kriteria'] ?>" class="btn btn-sm btn-warning">Edit</a>
                          <a href="index.php?controller=kriteria&action=hapus&id=<?= $row['id_kriteria'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                    <?php if (empty($data)): ?>
                      <tr><td colspan="5" class="text-center">Data belum tersedia</td></tr>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include 'template/script.php'; ?>
</body>

</html>
