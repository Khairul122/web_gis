<?php
class PenilaianModel
{
    private $db;

    public function __construct($koneksi)
    {
        $this->db = $koneksi;
    }

    public function getAll()
    {
        $query = "SELECT nk.id_nilai, nk.id_kecamatan, kc.nama_kecamatan, kr.nama_kriteria, nk.nilai, nk.id_kriteria
                  FROM nilai_kriteria nk
                  JOIN kecamatan kc ON nk.id_kecamatan = kc.id_kecamatan
                  JOIN kriteria kr ON nk.id_kriteria = kr.id_kriteria
                  ORDER BY nk.id_kecamatan, nk.id_kriteria";

        return $this->db->query($query)->fetch_all(MYSQLI_ASSOC);
    }

    public function getByKecamatan($id_kecamatan)
    {
        $query = "SELECT nk.id_nilai, nk.id_kecamatan, kc.nama_kecamatan, kr.nama_kriteria, nk.nilai, nk.id_kriteria
                  FROM nilai_kriteria nk
                  JOIN kecamatan kc ON nk.id_kecamatan = kc.id_kecamatan
                  JOIN kriteria kr ON nk.id_kriteria = kr.id_kriteria
                  WHERE nk.id_kecamatan = ?
                  ORDER BY nk.id_kriteria";
        
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id_kecamatan);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getKecamatanOptions()
    {
        $query = "SELECT * FROM kecamatan ORDER BY nama_kecamatan ASC";
        return $this->db->query($query)->fetch_all(MYSQLI_ASSOC);
    }

    public function getKriteriaOptions()
    {
        $query = "SELECT * FROM kriteria ORDER BY id_kriteria ASC";
        return $this->db->query($query)->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM nilai_kriteria WHERE id_nilai = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function insert($data)
    {
        $stmt = $this->db->prepare("INSERT INTO nilai_kriteria (id_kecamatan, id_kriteria, nilai) VALUES (?, ?, ?)");
        $stmt->bind_param("iid", $data['id_kecamatan'], $data['id_kriteria'], $data['nilai']);
        return $stmt->execute();
    }

    public function update($id, $data)
    {
        $stmt = $this->db->prepare("UPDATE nilai_kriteria SET id_kecamatan = ?, id_kriteria = ?, nilai = ? WHERE id_nilai = ?");
        $stmt->bind_param("iidi", $data['id_kecamatan'], $data['id_kriteria'], $data['nilai'], $id);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM nilai_kriteria WHERE id_nilai = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function getSubKriteriaByKriteria($id_kriteria)
    {
        $stmt = $this->db->prepare("SELECT * FROM sub_kriteria WHERE id_kriteria = ? ORDER BY nilai ASC");
        $stmt->bind_param("i", $id_kriteria);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getSubKriteriaDesc($id_kriteria, $nilai)
    {
        $stmt = $this->db->prepare("SELECT deskripsi FROM sub_kriteria WHERE id_kriteria = ? AND nilai = ?");
        $stmt->bind_param("id", $id_kriteria, $nilai);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result ? $result['deskripsi'] : 'Tidak ditemukan';
    }

    public function getAllWithDetails()
    {
        $data = [];
        
        $query = "SELECT k.*, 
                         sk.id_sub_kriteria,
                         sk.deskripsi,
                         sk.nilai
                  FROM kriteria k
                  LEFT JOIN sub_kriteria sk ON k.id_kriteria = sk.id_kriteria
                  ORDER BY k.id_kriteria, sk.nilai DESC";
        
        $result = $this->db->query($query);
        
        while ($row = $result->fetch_assoc()) {
            $id_kriteria = $row['id_kriteria'];
            
            if (!isset($data[$id_kriteria])) {
                $data[$id_kriteria] = [
                    'id_kriteria' => $row['id_kriteria'],
                    'nama_kriteria' => $row['nama_kriteria'],
                    'keterangan' => $row['keterangan'],
                    'bobot' => $row['bobot'] ?? 0,
                    'sub_kriteria' => []
                ];
            }
            
            if ($row['id_sub_kriteria']) {
                $data[$id_kriteria]['sub_kriteria'][] = [
                    'id_sub_kriteria' => $row['id_sub_kriteria'],
                    'deskripsi' => $row['deskripsi'],
                    'nilai' => $row['nilai']
                ];
            }
        }
        
        return $data;
    }

    public function getPenilaianWithDetails()
    {
        $query = "SELECT 
                    nk.id_nilai, 
                    nk.id_kecamatan, 
                    kc.nama_kecamatan, 
                    kr.nama_kriteria, 
                    nk.nilai, 
                    nk.id_kriteria,
                    sk.deskripsi as sub_kriteria_desc
                  FROM nilai_kriteria nk
                  JOIN kecamatan kc ON nk.id_kecamatan = kc.id_kecamatan
                  JOIN kriteria kr ON nk.id_kriteria = kr.id_kriteria
                  LEFT JOIN sub_kriteria sk ON nk.id_kriteria = sk.id_kriteria AND nk.nilai = sk.nilai
                  ORDER BY nk.id_kecamatan, nk.id_kriteria";

        return $this->db->query($query)->fetch_all(MYSQLI_ASSOC);
    }

    public function checkExisting($id_kecamatan, $id_kriteria)
    {
        $stmt = $this->db->prepare("SELECT id_nilai FROM nilai_kriteria WHERE id_kecamatan = ? AND id_kriteria = ?");
        $stmt->bind_param("ii", $id_kecamatan, $id_kriteria);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function upsert($data)
    {
        $existing = $this->checkExisting($data['id_kecamatan'], $data['id_kriteria']);
        
        if ($existing) {
            return $this->update($existing['id_nilai'], $data);
        } else {
            return $this->insert($data);
        }
    }

    public function getKriteriaWithSubKriteria()
    {
        $query = "SELECT k.id_kriteria, k.nama_kriteria, k.keterangan, k.bobot,
                         sk.id_sub_kriteria, sk.deskripsi, sk.nilai
                  FROM kriteria k
                  LEFT JOIN sub_kriteria sk ON k.id_kriteria = sk.id_kriteria
                  ORDER BY k.id_kriteria, sk.nilai DESC";
        
        $result = $this->db->query($query);
        $data = [];
        
        while ($row = $result->fetch_assoc()) {
            $id_kriteria = $row['id_kriteria'];
            
            if (!isset($data[$id_kriteria])) {
                $data[$id_kriteria] = [
                    'id_kriteria' => $row['id_kriteria'],
                    'nama_kriteria' => $row['nama_kriteria'],
                    'keterangan' => $row['keterangan'],
                    'bobot' => $row['bobot'],
                    'sub_kriteria' => []
                ];
            }
            
            if ($row['id_sub_kriteria']) {
                $data[$id_kriteria]['sub_kriteria'][] = [
                    'id_sub_kriteria' => $row['id_sub_kriteria'],
                    'deskripsi' => $row['deskripsi'],
                    'nilai' => $row['nilai']
                ];
            }
        }
        
        return $data;
    }

    public function getNilaiByKecamatanKriteria($id_kecamatan, $id_kriteria)
    {
        $stmt = $this->db->prepare("SELECT nilai FROM nilai_kriteria WHERE id_kecamatan = ? AND id_kriteria = ?");
        $stmt->bind_param("ii", $id_kecamatan, $id_kriteria);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result ? $result['nilai'] : null;
    }

    public function getMatrixData()
    {
        $query = "SELECT 
                    kc.id_kecamatan,
                    kc.nama_kecamatan,
                    kr.id_kriteria,
                    kr.nama_kriteria,
                    COALESCE(nk.nilai, 0) as nilai
                  FROM kecamatan kc
                  CROSS JOIN kriteria kr
                  LEFT JOIN nilai_kriteria nk ON kc.id_kecamatan = nk.id_kecamatan AND kr.id_kriteria = nk.id_kriteria
                  ORDER BY kc.id_kecamatan, kr.id_kriteria";
        
        return $this->db->query($query)->fetch_all(MYSQLI_ASSOC);
    }
}