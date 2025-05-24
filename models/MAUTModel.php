<?php
class MAUTModel
{
    private $db;

    public function __construct($koneksi)
    {
        $this->db = $koneksi;
    }

    public function getKriteriaData()
    {
        $query = "SELECT * FROM kriteria ORDER BY id_kriteria";
        return $this->db->query($query)->fetch_all(MYSQLI_ASSOC);
    }

    public function getKecamatanData()
    {
        $query = "SELECT * FROM kecamatan ORDER BY nama_kecamatan";
        return $this->db->query($query)->fetch_all(MYSQLI_ASSOC);
    }

    public function getNilaiKriteriaData()
    {
        $query = "SELECT 
                    nk.id_kecamatan,
                    kc.nama_kecamatan,
                    nk.id_kriteria,
                    kr.nama_kriteria,
                    kr.bobot,
                    nk.nilai
                  FROM nilai_kriteria nk
                  JOIN kecamatan kc ON nk.id_kecamatan = kc.id_kecamatan
                  JOIN kriteria kr ON nk.id_kriteria = kr.id_kriteria
                  ORDER BY nk.id_kecamatan, nk.id_kriteria";
        
        return $this->db->query($query)->fetch_all(MYSQLI_ASSOC);
    }

    public function getMatrixData()
    {
        $data = $this->getNilaiKriteriaData();
        $matrix = [];
        
        foreach ($data as $row) {
            $matrix[$row['id_kecamatan']][$row['id_kriteria']] = [
                'nama_kecamatan' => $row['nama_kecamatan'],
                'nama_kriteria' => $row['nama_kriteria'],
                'bobot' => $row['bobot'],
                'nilai' => $row['nilai']
            ];
        }
        
        return $matrix;
    }

    public function calculateMinMaxValues()
    {
        $kriteria = $this->getKriteriaData();
        $minMax = [];
        
        foreach ($kriteria as $k) {
            $query = "SELECT 
                        MIN(nilai) as min_nilai, 
                        MAX(nilai) as max_nilai 
                      FROM nilai_kriteria 
                      WHERE id_kriteria = ?";
            
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("i", $k['id_kriteria']);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc();
            
            $minMax[$k['id_kriteria']] = [
                'min' => $result['min_nilai'],
                'max' => $result['max_nilai'],
                'nama_kriteria' => $k['nama_kriteria'],
                'bobot' => $k['bobot']
            ];
        }
        
        return $minMax;
    }

    public function calculateUtilityValues()
    {
        $matrix = $this->getMatrixData();
        $minMax = $this->calculateMinMaxValues();
        $utility = [];
        
        foreach ($matrix as $id_kecamatan => $kecamatan_data) {
            foreach ($kecamatan_data as $id_kriteria => $kriteria_data) {
                $nilai = $kriteria_data['nilai'];
                $min = $minMax[$id_kriteria]['min'];
                $max = $minMax[$id_kriteria]['max'];
                
                if ($max == $min) {
                    $utilitas = 1;
                } else {
                    $utilitas = ($nilai - $min) / ($max - $min);
                }
                
                $utility[$id_kecamatan][$id_kriteria] = [
                    'nama_kecamatan' => $kriteria_data['nama_kecamatan'],
                    'nama_kriteria' => $kriteria_data['nama_kriteria'],
                    'nilai_asli' => $nilai,
                    'nilai_utilitas' => round($utilitas, 4),
                    'bobot' => $kriteria_data['bobot'],
                    'nilai_terbobot' => round($utilitas * $kriteria_data['bobot'], 4)
                ];
            }
        }
        
        return $utility;
    }

    public function calculateMAUTScore()
    {
        $utility = $this->calculateUtilityValues();
        $scores = [];
        
        foreach ($utility as $id_kecamatan => $kecamatan_data) {
            $total_score = 0;
            $nama_kecamatan = '';
            
            foreach ($kecamatan_data as $kriteria_data) {
                $total_score += $kriteria_data['nilai_terbobot'];
                $nama_kecamatan = $kriteria_data['nama_kecamatan'];
            }
            
            $scores[$id_kecamatan] = [
                'nama_kecamatan' => $nama_kecamatan,
                'total_score' => round($total_score, 4),
                'detail' => $kecamatan_data
            ];
        }
        
        uasort($scores, function($a, $b) {
            return $b['total_score'] <=> $a['total_score'];
        });
        
        return $scores;
    }

    public function getKelasKesesuaian()
    {
        $query = "SELECT * FROM kelas_kesesuaian ORDER BY skor_min DESC";
        return $this->db->query($query)->fetch_all(MYSQLI_ASSOC);
    }

    public function determineKesesuaianClass($score)
    {
        $kelas = $this->getKelasKesesuaian();
        
        foreach ($kelas as $k) {
            if ($score >= $k['skor_min'] && $score <= $k['skor_max']) {
                return $k;
            }
        }
        
        return [
            'kode' => 'N/A',
            'nama_kelas' => 'Tidak Terdefinisi',
            'keterangan' => 'Skor tidak masuk dalam kategori yang ada'
        ];
    }

    public function saveHasilAnalisis($data)
    {
        $this->db->query("DELETE FROM detail_analisis");
        $this->db->query("DELETE FROM hasil_analisis");
        
        foreach ($data as $id_kecamatan => $hasil) {
            $kelas = $this->determineKesesuaianClass($hasil['total_score'] * 100);
            
            $stmt = $this->db->prepare("INSERT INTO hasil_analisis 
                                       (id_kecamatan, total_skor, id_kelas, tanggal_analisis, keterangan) 
                                       VALUES (?, ?, ?, CURDATE(), ?)");
            
            $total_skor = $hasil['total_score'];
            $id_kelas = $kelas['id_kelas'] ?? 0;
            $keterangan = "Analisis MAUT - " . $kelas['nama_kelas'];
            
            $stmt->bind_param("idis", $id_kecamatan, $total_skor, $id_kelas, $keterangan);
            $stmt->execute();
            $id_hasil = $this->db->insert_id;
            
            foreach ($hasil['detail'] as $id_kriteria => $detail) {
                $stmt_detail = $this->db->prepare("INSERT INTO detail_analisis 
                                                  (id_hasil, id_kriteria, nilai_asli, skor, nilai_utilitas, nilai_terbobot) 
                                                  VALUES (?, ?, ?, ?, ?, ?)");
                
                $nilai_asli = $detail['nilai_asli'];
                $skor = round($detail['nilai_asli']);
                $nilai_utilitas = $detail['nilai_utilitas'];
                $nilai_terbobot = $detail['nilai_terbobot'];
                
                $stmt_detail->bind_param("iididd", $id_hasil, $id_kriteria, $nilai_asli, $skor, $nilai_utilitas, $nilai_terbobot);
                $stmt_detail->execute();
            }
        }
        
        return true;
    }

    public function getHasilAnalisis()
    {
        $query = "SELECT 
                    ha.id_hasil,
                    ha.id_kecamatan,
                    kc.nama_kecamatan,
                    ha.total_skor,
                    ha.tanggal_analisis,
                    ha.keterangan,
                    kk.kode as kode_kelas,
                    kk.nama_kelas,
                    kk.keterangan as kelas_keterangan
                  FROM hasil_analisis ha
                  JOIN kecamatan kc ON ha.id_kecamatan = kc.id_kecamatan
                  LEFT JOIN kelas_kesesuaian kk ON ha.id_kelas = kk.id_kelas
                  ORDER BY ha.total_skor DESC";
        
        return $this->db->query($query)->fetch_all(MYSQLI_ASSOC);
    }

    public function getDetailAnalisis($id_hasil)
    {
        $query = "SELECT 
                    da.*,
                    kr.nama_kriteria,
                    kr.bobot
                  FROM detail_analisis da
                  JOIN kriteria kr ON da.id_kriteria = kr.id_kriteria
                  WHERE da.id_hasil = ?
                  ORDER BY da.id_kriteria";
        
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id_hasil);
        $stmt->execute();
        
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getRanking()
    {
        $scores = $this->calculateMAUTScore();
        $ranking = [];
        $rank = 1;
        
        foreach ($scores as $id_kecamatan => $data) {
            $ranking[] = [
                'rank' => $rank++,
                'id_kecamatan' => $id_kecamatan,
                'nama_kecamatan' => $data['nama_kecamatan'],
                'total_score' => $data['total_score'],
                'persentase' => round($data['total_score'] * 100, 2)
            ];
        }
        
        return $ranking;
    }

    public function exportToCSV($data, $filename = 'hasil_maut.csv')
    {
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=' . $filename);
        
        $output = fopen('php://output', 'w');
        
        fputcsv($output, ['Ranking', 'Kecamatan', 'Total Score', 'Persentase (%)']);
        
        $rank = 1;
        foreach ($data as $id_kecamatan => $hasil) {
            fputcsv($output, [
                $rank++,
                $hasil['nama_kecamatan'],
                $hasil['total_score'],
                round($hasil['total_score'] * 100, 2) . '%'
            ]);
        }
        
        fclose($output);
        exit;
    }
}