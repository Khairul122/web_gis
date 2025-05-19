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
              <h4 class="mb-4"><?= isset($kriteria) ? 'Edit' : 'Tambah' ?> Kriteria</h4>
              <form action="index.php?controller=kriteria&action=simpan" method="post">
                <?php if (isset($kriteria)): ?>
                  <input type="hidden" name="id_kriteria" value="<?= $kriteria['id_kriteria'] ?>">
                <?php endif; ?>
                <div class="form-group">
                  <label for="nama_kriteria">Nama Kriteria</label>
                  <input type="text" class="form-control" name="nama_kriteria" required value="<?= $kriteria['nama_kriteria'] ?? '' ?>">
                </div>
                <div class="form-group">
                  <label for="bobot">Bobot</label>
                  <input type="number" step="0.01" class="form-control" name="bobot" required value="<?= $kriteria['bobot'] ?? '' ?>">
                </div>
                <div class="form-group">
                  <label for="keterangan">Keterangan</label>
                  <textarea class="form-control" name="keterangan"><?= $kriteria['keterangan'] ?? '' ?></textarea>
                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="index.php?controller=kriteria&action=index" class="btn btn-secondary">Kembali</a>
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
