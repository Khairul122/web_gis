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
              <h4 class="mb-4"><?= isset($kelas) ? 'Edit' : 'Tambah' ?> Kelas Kesesuaian</h4>
              <div class="card">
                <div class="card-body">
                  <form action="index.php?controller=kelas&action=simpan" method="POST">
                    <?php if (isset($kelas)): ?>
                      <input type="hidden" name="id_kelas" value="<?= $kelas['id_kelas'] ?>">
                    <?php endif; ?>
                    <div class="mb-3">
                      <label for="kode" class="form-label">Kode</label>
                      <input type="text" class="form-control" name="kode" id="kode" required value="<?= $kelas['kode'] ?? '' ?>">
                    </div>
                    <div class="mb-3">
                      <label for="nama_kelas" class="form-label">Nama Kelas</label>
                      <input type="text" class="form-control" name="nama_kelas" id="nama_kelas" required value="<?= $kelas['nama_kelas'] ?? '' ?>">
                    </div>
                    <div class="mb-3">
                      <label for="skor_min" class="form-label">Skor Min</label>
                      <input type="number" class="form-control" name="skor_min" id="skor_min" required value="<?= $kelas['skor_min'] ?? '' ?>">
                    </div>
                    <div class="mb-3">
                      <label for="skor_max" class="form-label">Skor Max</label>
                      <input type="number" class="form-control" name="skor_max" id="skor_max" required value="<?= $kelas['skor_max'] ?? '' ?>">
                    </div>
                    <div class="mb-3">
                      <label for="keterangan" class="form-label">Keterangan</label>
                      <textarea class="form-control" name="keterangan" id="keterangan"><?= $kelas['keterangan'] ?? '' ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="index.php?controller=kelas&action=index" class="btn btn-secondary">Kembali</a>
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
</body>
</html>
