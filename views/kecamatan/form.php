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
              <h4 class="font-weight-bold mb-4"><?= isset($kecamatan) ? 'Edit' : 'Tambah' ?> Kecamatan</h4>
              <div class="card">
                <div class="card-body">
                  <form action="index.php?controller=Kecamatan&action=simpan" method="POST" enctype="multipart/form-data">
                    <?php if (!empty($kecamatan)) : ?>
                      <input type="hidden" name="id_kecamatan" value="<?= $kecamatan['id_kecamatan'] ?>">
                    <?php endif; ?>

                    <div class="form-group">
                      <label>Nama Kecamatan</label>
                      <input type="text" name="nama_kecamatan" class="form-control" required value="<?= $kecamatan['nama_kecamatan'] ?? '' ?>">
                    </div>

                    <div class="form-group">
                      <label>Luas (km²)</label>
                      <input type="number" name="luas" step="0.01" class="form-control" value="<?= $kecamatan['luas'] ?? '' ?>">
                    </div>

                    <div class="form-group">
                      <label>Keterangan</label>
                      <textarea name="keterangan" class="form-control"><?= $kecamatan['keterangan'] ?? '' ?></textarea>
                    </div>

                    <div class="form-group">
                      <label>Upload GeoJSON (Opsional)</label>
                      <input type="file" name="geojson" accept=".json,.geojson" class="form-control-file">
                      <?php if (!empty($kecamatan['data_geojson'])) : ?>
                        <small class="form-text text-muted">Saat ini: <a href="<?= $kecamatan['data_geojson'] ?>" target="_blank">Lihat GeoJSON</a></small>
                      <?php endif; ?>
                    </div>

                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="index.php?controller=Kecamatan&action=index" class="btn btn-secondary">Kembali</a>
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