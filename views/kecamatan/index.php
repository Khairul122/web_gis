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
            <div class="col-sm-12 d-flex justify-content-between align-items-center">
              <h4 class="fw-bold">Data Kecamatan</h4>
              <a href="index.php?controller=kecamatan&action=form" class="btn btn-primary btn-sm">+ Tambah Kecamatan</a>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12">
              <div class="table-responsive">
                <table class="table table-bordered table-striped">
                  <thead class="table-light">
                    <tr>
                      <th>No</th>
                      <th>Nama Kecamatan</th>
                      <th>Latitude</th>
                      <th>Longitude</th>
                      <th>Luas (km²)</th>
                      <th>Keterangan</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (!empty($data)) : ?>
                      <?php $no = 1; foreach ($data as $row) : ?>
                        <tr>
                          <td><?= $no++ ?></td>
                          <td><?= $row['nama_kecamatan'] ?></td>
                          <td><?= $row['latitude'] ?></td>
                          <td><?= $row['longitude'] ?></td>
                          <td><?= $row['luas'] ?></td>
                          <td><?= $row['keterangan'] ?></td>
                          <td>
                            <a href="index.php?controller=kecamatan&action=form&id=<?= $row['id_kecamatan'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="index.php?controller=kecamatan&action=hapus&id=<?= $row['id_kecamatan'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    <?php else : ?>
                      <tr>
                        <td colspan="7" class="text-center">Belum ada data kecamatan.</td>
                      </tr>
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
