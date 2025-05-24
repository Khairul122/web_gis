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
              <h4 class="mb-4">Tambah Sub Kriteria</h4>
              <form action="index.php?controller=SubKriteria&action=simpan" method="post" id="multiSubForm">
                <div id="sub-kriteria-container">
                  <div class="sub-kriteria-group border p-3 mb-3 rounded">
                    <div class="form-group">
                      <label for="id_kriteria[]">Kriteria</label>
                      <select class="form-control" name="id_kriteria[]" required>
                        <option value="">-- Pilih Kriteria --</option>
                        <?php foreach ($kriteria_options as $k): ?>
                          <option value="<?= $k['id_kriteria'] ?>"><?= htmlspecialchars($k['nama_kriteria']) ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="deskripsi[]">Deskripsi</label>
                      <input type="text" class="form-control" name="deskripsi[]" required>
                    </div>
                    <div class="form-group">
                      <label for="nilai[]">Nilai</label>
                      <input type="text" class="form-control" name="nilai[]" required>
                    </div>
                    <button type="button" class="btn btn-danger btn-sm mt-2 remove-group">Hapus Baris</button>
                  </div>
                </div>

                <button type="button" class="btn btn-info mb-3" id="addSubKriteria">+ Tambah Baris</button>
                <br>
                <button type="submit" class="btn btn-success">Simpan Semua</button>
                <a href="index.php?controller=SubKriteria&action=index" class="btn btn-secondary">Kembali</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include 'template/script.php'; ?>
  <script>
    document.getElementById('addSubKriteria').addEventListener('click', function () {
      const container = document.getElementById('sub-kriteria-container');
      const newGroup = container.firstElementChild.cloneNode(true);
      newGroup.querySelectorAll('input').forEach(input => input.value = '');
      newGroup.querySelector('select').selectedIndex = 0;
      container.appendChild(newGroup);
    });

    document.addEventListener('click', function (e) {
      if (e.target && e.target.classList.contains('remove-group')) {
        const group = e.target.closest('.sub-kriteria-group');
        const container = document.getElementById('sub-kriteria-container');
        if (container.childElementCount > 1) {
          group.remove();
        }
      }
    });
  </script>
</body>

</html>
