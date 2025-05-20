<?php include('template/header.php'); ?>

<body class="with-welcome-text">
  <div class="container-scroller">
    <?php include 'template/navbar.php'; ?>
    <div class="container-fluid page-body-wrapper">
      <?php include 'template/setting_panel.php'; ?>
      <?php include 'template/sidebar.php'; ?>
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-12">

              <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="font-weight-bold">Data Kecamatan</h4>
                <a href="index.php?controller=Kecamatan&action=form" class="btn btn-primary btn-sm">+ Tambah Kecamatan</a>
              </div>

              <div class="card">
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                      <thead class="thead-light">
                        <tr>
                          <th>No</th>
                          <th>Nama Kecamatan</th>
                          <th>Luas (km²)</th>
                          <th>Keterangan</th>
                          <th>GeoJSON</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $no = 1; foreach ($data as $row) : ?>
                          <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($row['nama_kecamatan']) ?></td>
                            <td><?= htmlspecialchars($row['luas']) ?></td>
                            <td><?= htmlspecialchars($row['keterangan']) ?></td>
                            <td>
                              <?php if (!empty($row['data_geojson'])) : ?>
                                <a href="index.php?controller=Geojson&action=preview&file=<?= basename($row['data_geojson']) ?>" target="_blank" class="btn btn-sm btn-info">Lihat</a>
                              <?php else : ?>
                                <span class="text-muted">Tidak Ada</span>
                              <?php endif; ?>
                            </td>
                            <td>
                              <a href="index.php?controller=Kecamatan&action=form&id=<?= $row['id_kecamatan'] ?>" class="btn btn-sm btn-warning">Edit</a>
                              <a href="index.php?controller=Kecamatan&action=delete&id=<?= $row['id_kecamatan'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                        <?php if (empty($data)) : ?>
                          <tr>
                            <td colspan="6" class="text-center">Belum ada data kecamatan.</td>
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
    </div>
  </div>
  <?php include 'template/script.php'; ?>
</body>
</html>
