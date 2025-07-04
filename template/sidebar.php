<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <?php if ($_SESSION['level'] === 'admin'): ?>
      <li class="nav-item">
        <a class="nav-link" href="index.php?controller=Dashboard&action=index">
          <i class="mdi mdi-view-dashboard-outline menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?controller=Kriteria&action=index">
          <i class="mdi mdi-format-list-bulleted menu-icon"></i>
          <span class="menu-title">Data Kriteria</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?controller=Kecamatan&action=index">
          <i class="mdi mdi-map-marker menu-icon"></i>
          <span class="menu-title">Data Kecamatan</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?controller=SubKriteria&action=index">
          <i class="mdi mdi-playlist-edit menu-icon"></i>
          <span class="menu-title">Data Sub Kriteria</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?controller=Penilaian&action=index">
          <i class="mdi mdi-checkbox-marked menu-icon"></i>
          <span class="menu-title">Data Penilaian</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?controller=Kelas&action=index">
          <i class="mdi mdi-domain menu-icon"></i>
          <span class="menu-title">Data Kelas</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?controller=MAUT&action=index">
          <i class="mdi mdi-calculator-variant menu-icon"></i>
          <span class="menu-title">Perhitungan MAUT</span>
        </a>
      </li>
    <?php endif; ?>
    <li class="nav-item">
      <a class="nav-link" href="index.php?controller=GIS&action=index">
        <i class="mdi mdi-map-outline menu-icon"></i>
        <span class="menu-title">Pemetaan GIS</span>
      </a>
    </li>
  </ul>
</nav>