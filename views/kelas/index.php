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
              <h4 class="mb-4">Data Kelas Kesesuaian</h4>
              <a href="index.php?controller=kelas&action=form" class="btn btn-primary mb-3">+ Tambah Kelas</a>
              <div class="card">
                <div class="card-body">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama Kelas</th>
                        <th>Skor Min</th>
                        <th>Skor Max</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no = 1; foreach ($data as $row): ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row['kode'] ?></td>
                        <td><?= $row['nama_kelas'] ?></td>
                        <td><?= $row['skor_min'] ?></td>
                        <td><?= $row['skor_max'] ?></td>
                        <td><?= $row['keterangan'] ?></td>
                        <td>
                          <a href="index.php?controller=kelas&action=form&id=<?= $row['id_kelas'] ?>" class="btn btn-sm btn-warning">Edit</a>
                          <a href="index.php?controller=kelas&action=hapus&id=<?= $row['id_kelas'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data ini?')">Hapus</a>
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
      </div>
    </div>
  </div>
  <?php include 'template/script.php'; ?>
</body>
</html>
