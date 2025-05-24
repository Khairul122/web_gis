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
                        <div class="col-md-6">
                            <h4 class="mt-2">Data Penilaian Kecamatan</h4>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="index.php?controller=Penilaian&action=form" class="btn btn-primary">+ Tambah Penilaian</a>
                        </div>
                    </div>

                    <?php if (isset($_SESSION['success_message'])): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="mdi mdi-check-circle me-2"></i>
                            <?= $_SESSION['success_message'] ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        <?php unset($_SESSION['success_message']); ?>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['error_message'])): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="mdi mdi-alert-circle me-2"></i>
                            <?= $_SESSION['error_message'] ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        <?php unset($_SESSION['error_message']); ?>
                    <?php endif; ?>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Kecamatan</th>
                                            <th>Status Penilaian</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $penilaian_data = [];
                                        if (!empty($data) && is_array($data)) {
                                            foreach ($data as $row) {
                                                if (isset($row['id_kecamatan']) && isset($row['nama_kecamatan'])) {
                                                    $id_kecamatan = $row['id_kecamatan'];
                                                    if (!isset($penilaian_data[$id_kecamatan])) {
                                                        $penilaian_data[$id_kecamatan] = [
                                                            'nama_kecamatan' => $row['nama_kecamatan'],
                                                            'kriteria' => [],
                                                            'count' => 0
                                                        ];
                                                    }
                                                    $penilaian_data[$id_kecamatan]['kriteria'][] = $row;
                                                    $penilaian_data[$id_kecamatan]['count']++;
                                                }
                                            }
                                        }

                                        $no = 1;
                                        if (!empty($penilaian_data)):
                                            foreach ($penilaian_data as $id_kecamatan => $kecamatan_data):
                                                $total_kriteria = 6;
                                                $dinilai = $kecamatan_data['count'];
                                                $status = ($dinilai >= $total_kriteria) ? 'Lengkap' : 'Belum Lengkap';
                                                $status_class = ($dinilai >= $total_kriteria) ? 'success' : 'warning';
                                        ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= htmlspecialchars($kecamatan_data['nama_kecamatan']) ?></td>
                                                <td>
                                                    <span class="badge bg-<?= $status_class ?>">
                                                        <?= $status ?> (<?= $dinilai ?>/<?= $total_kriteria ?>)
                                                    </span>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-info me-1" data-bs-toggle="modal" data-bs-target="#modalDetail<?= $id_kecamatan ?>">
                                                        <i class="mdi mdi-eye"></i> Detail
                                                    </button>
                                                    <a href="index.php?controller=Penilaian&action=form&kecamatan=<?= $id_kecamatan ?>" class="btn btn-sm btn-warning">
                                                        <i class="mdi mdi-pencil"></i> Edit
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php 
                                            endforeach;
                                        else:
                                        ?>
                                            <tr>
                                                <td colspan="4" class="text-center">
                                                    <div class="alert alert-info mb-0">
                                                        <i class="mdi mdi-information me-2"></i>
                                                        Belum ada data penilaian
                                                    </div>
                                                </td>
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

    <?php if (!empty($penilaian_data)): ?>
        <?php foreach ($penilaian_data as $id_kecamatan => $kecamatan_data): ?>
            <div class="modal fade" id="modalDetail<?= $id_kecamatan ?>" tabindex="-1" aria-labelledby="modalDetailLabel<?= $id_kecamatan ?>" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalDetailLabel<?= $id_kecamatan ?>">
                                Detail Penilaian - <?= htmlspecialchars($kecamatan_data['nama_kecamatan']) ?>
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm">
                                    <thead class="table-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Kriteria</th>
                                            <th>Deskripsi/Sub Kriteria</th>
                                            <th>Nilai</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no_detail = 1;
                                        $all_kriteria = [
                                            1 => 'Tekstur Tanah',
                                            2 => 'Curah Hujan',
                                            3 => 'Drainase Tanah',
                                            4 => 'Kemiringan Lahan',
                                            5 => 'Suhu',
                                            6 => 'pH Tanah'
                                        ];

                                        $nilai_existing = [];
                                        foreach ($kecamatan_data['kriteria'] as $kriteria) {
                                            if (isset($kriteria['id_kriteria'])) {
                                                $nilai_existing[$kriteria['id_kriteria']] = $kriteria;
                                            }
                                        }

                                        foreach ($all_kriteria as $id_kriteria => $nama_kriteria):
                                            if (isset($nilai_existing[$id_kriteria])):
                                                $kriteria_data = $nilai_existing[$id_kriteria];
                                                $deskripsi = isset($kriteria_data['sub_kriteria_desc']) && !empty($kriteria_data['sub_kriteria_desc']) 
                                                           ? $kriteria_data['sub_kriteria_desc'] 
                                                           : 'Deskripsi tidak tersedia';
                                        ?>
                                            <tr>
                                                <td><?= $no_detail++ ?></td>
                                                <td><?= htmlspecialchars($kriteria_data['nama_kriteria'] ?? $nama_kriteria) ?></td>
                                                <td><?= htmlspecialchars($deskripsi) ?></td>
                                                <td>
                                                    <span class="badge bg-primary"><?= $kriteria_data['nilai'] ?></span>
                                                </td>
                                                <td>
                                                    <?php if (isset($kriteria_data['id_nilai'])): ?>
                                                        <a href="index.php?controller=Penilaian&action=hapus&id=<?= $kriteria_data['id_nilai'] ?>"
                                                            class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Yakin ingin menghapus?')">
                                                            <i class="mdi mdi-delete"></i>
                                                        </a>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php else: ?>
                                            <tr class="table-warning">
                                                <td><?= $no_detail++ ?></td>
                                                <td><?= htmlspecialchars($nama_kriteria) ?></td>
                                                <td><em>Belum dinilai</em></td>
                                                <td>
                                                    <span class="badge bg-secondary">-</span>
                                                </td>
                                                <td>-</td>
                                            </tr>
                                        <?php endif; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <a href="index.php?controller=Penilaian&action=form&kecamatan=<?= $id_kecamatan ?>" class="btn btn-primary">
                                <i class="mdi mdi-pencil"></i> Edit Penilaian
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php include 'template/script.php'; ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    if (alert && alert.parentNode) {
                        alert.classList.remove('show');
                        setTimeout(function() {
                            if (alert && alert.parentNode) {
                                alert.parentNode.removeChild(alert);
                            }
                        }, 150);
                    }
                }, 5000);
            });
        });

        function confirmDelete(url) {
            if (confirm('Yakin ingin menghapus data ini?')) {
                window.location.href = url;
            }
        }
    </script>

</body>

</html>