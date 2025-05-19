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
            <div class="col-sm-12 text-center">
              <h4 class="fw-bold">Selamat Datang, <?= $_SESSION['nama_lengkap'] ?></h4>
              <p class="lead">
                Anda login sebagai <strong><?= ucfirst($_SESSION['level']) ?></strong>.
              </p>
              <div class="mt-4">
                <p>Silakan akses menu di sebelah kiri untuk mulai menggunakan sistem.</p>
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
