<?php
class SubKriteriaModel
{
    private $db;

    public function __construct($koneksi)
    {
        $this->db = $koneksi;
    }

    public function getAll()
    {
        $query = "SELECT sub_kriteria.*, kriteria.nama_kriteria 
                  FROM sub_kriteria 
                  JOIN kriteria ON sub_kriteria.id_kriteria = kriteria.id_kriteria
                  ORDER BY sub_kriteria.id_kriteria ASC";
        return $this->db->query($query)->fetch_all(MYSQLI_ASSOC);
    }
    public function getGroupedByKriteria()
    {
        $query = "SELECT k.id_kriteria, k.nama_kriteria, k.keterangan,
                     sk.id_sub_kriteria, sk.deskripsi, sk.nilai
              FROM kriteria k
              LEFT JOIN sub_kriteria sk ON k.id_kriteria = sk.id_kriteria
              ORDER BY k.id_kriteria, sk.nilai ASC";

        $result = $this->db->query($query)->fetch_all(MYSQLI_ASSOC);

        $grouped = [];
        foreach ($result as $row) {
            $id = $row['id_kriteria'];
            if (!isset($grouped[$id])) {
                $grouped[$id] = [
                    'nama_kriteria' => $row['nama_kriteria'],
                    'keterangan' => $row['keterangan'],
                    'sub_kriteria' => []
                ];
            }

            if ($row['id_sub_kriteria']) {
                $grouped[$id]['sub_kriteria'][] = [
                    'id_sub_kriteria' => $row['id_sub_kriteria'],
                    'deskripsi' => $row['deskripsi'],
                    'nilai' => $row['nilai']
                ];
            }
        }

        return $grouped;
    }

    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM sub_kriteria WHERE id_sub_kriteria = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function insert($data)
    {
        $stmt = $this->db->prepare("INSERT INTO sub_kriteria (id_kriteria, deskripsi, nilai) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $data['id_kriteria'], $data['deskripsi'], $data['nilai']);
        return $stmt->execute();
    }

    public function update($id, $data)
    {
        $stmt = $this->db->prepare("UPDATE sub_kriteria SET id_kriteria = ?, deskripsi = ?, nilai = ? WHERE id_sub_kriteria = ?");
        $stmt->bind_param("issi", $data['id_kriteria'], $data['deskripsi'], $data['nilai'], $id);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM sub_kriteria WHERE id_sub_kriteria = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function getKriteriaOptions()
    {
        $query = "SELECT * FROM kriteria ORDER BY id_kriteria ASC";
        return $this->db->query($query)->fetch_all(MYSQLI_ASSOC);
    }
}
