<?php
date_default_timezone_set('Asia/Jakarta');
$hour = date('H');
if ($hour >= 5 && $hour < 12) {
    $greeting = "Good Morning";
} elseif ($hour >= 12 && $hour < 15) {
    $greeting = "Good Afternoon";
} elseif ($hour >= 15 && $hour < 18) {
    $greeting = "Good Evening";
} else {
    $greeting = "Good Night";
}
?>

<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
    <div class="me-3">
      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
        <span class="icon-menu"></span>
      </button>
    </div>
    <div>
      <a class="navbar-brand brand-logo" href="index.php">
        <img src="logo.png" alt="logo" />
      </a>
      <a class="navbar-brand brand-logo-mini" href="index.php">
        <img src="logo.png" alt="logo" />
      </a>
    </div>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-top">
    <ul class="navbar-nav">
      <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
        <h1 class="welcome-text">
          <?= $greeting ?>, <span class="text-black fw-bold"><?= $_SESSION['nama_lengkap'] ?? 'Guest' ?></span>
        </h1>
      </li>
    </ul>
    <ul class="navbar-nav ms-auto">
      <li class="nav-item dropdown d-none d-lg-block user-dropdown">
        <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
          <img class="img-xs rounded-circle" src="logo.png" alt="Profile image" />
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
          <div class="dropdown-header text-center">
            <img class="img-xs rounded-circle" src="logo.png" alt="Profile image" style="width: 50%; height: auto;" />
            <p class="mb-1 mt-3 font-weight-semibold"><?= $_SESSION['nama_lengkap'] ?? 'Nama Lengkap' ?></p>
            <p class="fw-light text-muted mb-0"><?= $_SESSION['username'] ?? 'username' ?></p>
          </div>
          <a class="dropdown-item" href="index.php?controller=Auth&action=logout">
            <i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out
          </a>
        </div>
      </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
      <span class="mdi mdi-menu"></span>
    </button>
  </div>
</nav>
