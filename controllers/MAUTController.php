<?php
require_once MODEL_PATH . 'MAUTModel.php';

class MAUTController
{
    private $model;

    public function __construct($koneksi)
    {
        $this->model = new MAUTModel($koneksi);
    }

    public function index()
    {
        $data = [
            'kriteria' => $this->model->getKriteriaData(),
            'kecamatan' => $this->model->getKecamatanData(),
            'matrix' => $this->model->getMatrixData(),
            'ranking' => $this->model->getRanking()
        ];
        
        include VIEW_PATH . 'maut/index.php';
    }

    public function perhitungan()
    {
        $data = [
            'kriteria' => $this->model->getKriteriaData(),
            'matrix' => $this->model->getMatrixData(),
            'minMax' => $this->model->calculateMinMaxValues(),
            'utility' => $this->model->calculateUtilityValues(),
            'scores' => $this->model->calculateMAUTScore()
        ];
        
        include VIEW_PATH . 'maut/perhitungan.php';
    }

    public function matriksPenilaian()
    {
        $data = [
            'kriteria' => $this->model->getKriteriaData(),
            'kecamatan' => $this->model->getKecamatanData(),
            'matrix' => $this->model->getMatrixData()
        ];
        
        include VIEW_PATH . 'maut/matriks_penilaian.php';
    }

    public function normalisasi()
    {
        $data = [
            'kriteria' => $this->model->getKriteriaData(),
            'minMax' => $this->model->calculateMinMaxValues(),
            'utility' => $this->model->calculateUtilityValues()
        ];
        
        include VIEW_PATH . 'maut/normalisasi.php';
    }

    public function ranking()
    {
        $data = [
            'ranking' => $this->model->getRanking(),
            'scores' => $this->model->calculateMAUTScore()
        ];
        
        include VIEW_PATH . 'maut/ranking.php';
    }

    public function simpanAnalisis()
    {
        try {
            $scores = $this->model->calculateMAUTScore();
            $result = $this->model->saveHasilAnalisis($scores);
            
            if ($result) {
                $_SESSION['success_message'] = 'Hasil analisis MAUT berhasil disimpan!';
            } else {
                $_SESSION['error_message'] = 'Gagal menyimpan hasil analisis!';
            }
        } catch (Exception $e) {
            $_SESSION['error_message'] = 'Error: ' . $e->getMessage();
        }
        
        header("Location: index.php?controller=MAUT&action=index");
        exit;
    }

    public function hasilAnalisis()
    {
        $data = [
            'hasil' => $this->model->getHasilAnalisis(),
            'kelas' => $this->model->getKelasKesesuaian()
        ];
        
        include VIEW_PATH . 'maut/hasil_analisis.php';
    }

    public function detailAnalisis()
    {
        if (isset($_GET['id'])) {
            $id_hasil = $_GET['id'];
            $data = [
                'detail' => $this->model->getDetailAnalisis($id_hasil),
                'hasil' => $this->model->getHasilAnalisis()
            ];
            
            $hasil_spesifik = null;
            foreach ($data['hasil'] as $h) {
                if ($h['id_hasil'] == $id_hasil) {
                    $hasil_spesifik = $h;
                    break;
                }
            }
            
            $data['hasil_spesifik'] = $hasil_spesifik;
            
            include VIEW_PATH . 'maut/detail_analisis.php';
        } else {
            header("Location: index.php?controller=MAUT&action=hasilAnalisis");
            exit;
        }
    }

    public function exportCSV()
    {
        $scores = $this->model->calculateMAUTScore();
        $this->model->exportToCSV($scores, 'ranking_maut_' . date('Y-m-d') . '.csv');
    }

    public function hapusAnalisis()
    {
        if (isset($_GET['id'])) {
            try {
                $stmt = $this->model->db->prepare("DELETE FROM hasil_analisis WHERE id_hasil = ?");
                $stmt->bind_param("i", $_GET['id']);
                $result = $stmt->execute();
                
                if ($result) {
                    $_SESSION['success_message'] = 'Hasil analisis berhasil dihapus!';
                } else {
                    $_SESSION['error_message'] = 'Gagal menghapus hasil analisis!';
                }
            } catch (Exception $e) {
                $_SESSION['error_message'] = 'Error: ' . $e->getMessage();
            }
        }
        
        header("Location: index.php?controller=MAUT&action=hasilAnalisis");
        exit;
    }

    public function analisisUlang()
    {
        try {
            $this->model->db->query("DELETE FROM detail_analisis");
            $this->model->db->query("DELETE FROM hasil_analisis");
            
            $scores = $this->model->calculateMAUTScore();
            $result = $this->model->saveHasilAnalisis($scores);
            
            if ($result) {
                $_SESSION['success_message'] = 'Analisis ulang berhasil dilakukan!';
            } else {
                $_SESSION['error_message'] = 'Gagal melakukan analisis ulang!';
            }
        } catch (Exception $e) {
            $_SESSION['error_message'] = 'Error: ' . $e->getMessage();
        }
        
        header("Location: index.php?controller=MAUT&action=index");
        exit;
    }

    public function perbandingan()
    {
        $data = [
            'kriteria' => $this->model->getKriteriaData(),
            'matrix' => $this->model->getMatrixData(),
            'utility' => $this->model->calculateUtilityValues(),
            'scores' => $this->model->calculateMAUTScore(),
            'ranking' => $this->model->getRanking()
        ];
        
        include VIEW_PATH . 'maut/perbandingan.php';
    }

    public function grafik()
    {
        $data = [
            'ranking' => $this->model->getRanking(),
            'scores' => $this->model->calculateMAUTScore(),
            'kriteria' => $this->model->getKriteriaData()
        ];
        
        include VIEW_PATH . 'maut/grafik.php';
    }

    public function laporan()
    {
        $data = [
            'kriteria' => $this->model->getKriteriaData(),
            'kecamatan' => $this->model->getKecamatanData(),
            'matrix' => $this->model->getMatrixData(),
            'minMax' => $this->model->calculateMinMaxValues(),
            'utility' => $this->model->calculateUtilityValues(),
            'scores' => $this->model->calculateMAUTScore(),
            'ranking' => $this->model->getRanking(),
            'hasil_analisis' => $this->model->getHasilAnalisis()
        ];
        
        include VIEW_PATH . 'maut/laporan.php';
    }

    public function downloadLaporan()
    {
        $data = [
            'kriteria' => $this->model->getKriteriaData(),
            'kecamatan' => $this->model->getKecamatanData(),
            'matrix' => $this->model->getMatrixData(),
            'minMax' => $this->model->calculateMinMaxValues(),
            'utility' => $this->model->calculateUtilityValues(),
            'scores' => $this->model->calculateMAUTScore(),
            'ranking' => $this->model->getRanking()
        ];
        
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="Laporan_MAUT_' . date('Y-m-d') . '.pdf"');
        
        include VIEW_PATH . 'maut/laporan_pdf.php';
        exit;
    }

    public function validasiData()
    {
        $errors = [];
        $kriteria = $this->model->getKriteriaData();
        $kecamatan = $this->model->getKecamatanData();
        $matrix = $this->model->getMatrixData();
        
        foreach ($kecamatan as $kec) {
            $data_count = isset($matrix[$kec['id_kecamatan']]) ? count($matrix[$kec['id_kecamatan']]) : 0;
            $kriteria_count = count($kriteria);
            
            if ($data_count < $kriteria_count) {
                $errors[] = "Kecamatan {$kec['nama_kecamatan']} belum memiliki penilaian lengkap ({$data_count}/{$kriteria_count} kriteria)";
            }
        }
        
        $total_bobot = array_sum(array_column($kriteria, 'bobot'));
        if (abs($total_bobot - 1.0) > 0.001) {
            $errors[] = "Total bobot kriteria tidak sama dengan 1.0 (saat ini: {$total_bobot})";
        }
        
        if (empty($errors)) {
            $_SESSION['success_message'] = 'Data valid dan siap untuk dianalisis!';
        } else {
            $_SESSION['error_message'] = 'Ditemukan masalah: ' . implode('; ', $errors);
        }
        
        header("Location: index.php?controller=MAUT&action=index");
        exit;
    }
}