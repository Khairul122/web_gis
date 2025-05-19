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
            <div class="col-sm-12">
              <h4 class="fw-bold"><?= isset($kecamatan) ? 'Edit' : 'Tambah' ?> Kecamatan</h4>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <form action="index.php?controller=kecamatan&action=simpan" method="post">
                <?php if (isset($kecamatan)) : ?>
                  <input type="hidden" name="id_kecamatan" value="<?= $kecamatan['id_kecamatan'] ?>">
                <?php endif; ?>

                <div class="mb-3">
                  <label class="form-label">Nama Kecamatan</label>
                  <input type="text" name="nama_kecamatan" class="form-control" required value="<?= $kecamatan['nama_kecamatan'] ?? '' ?>">
                </div>

                <div class="mb-3">
                  <label class="form-label">Latitude</label>
                  <input type="text" name="latitude" class="form-control" required value="<?= $kecamatan['latitude'] ?? '' ?>">
                </div>

                <div class="mb-3">
                  <label class="form-label">Longitude</label>
                  <input type="text" name="longitude" class="form-control" required value="<?= $kecamatan['longitude'] ?? '' ?>">
                </div>

                <div class="mb-3">
                  <label class="form-label">Luas (km²)</label>
                  <input type="number" step="0.01" name="luas" class="form-control" value="<?= $kecamatan['luas'] ?? '' ?>">
                </div>

                <div class="mb-3">
                  <label class="form-label">Keterangan</label>
                  <textarea name="keterangan" class="form-control" rows="3"><?= $kecamatan['keterangan'] ?? '' ?></textarea>
                </div>

                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="index.php?controller=kecamatan&action=index" class="btn btn-secondary">Kembali</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include 'template/script.php'; ?>
</body>
</html>
