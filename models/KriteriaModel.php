<?php
class KriteriaModel
{
    private $db;

    public function __construct($koneksi)
    {
        $this->db = $koneksi;
    }

    public function getAll()
    {
        $query = "SELECT * FROM kriteria ORDER BY id_kriteria ASC";
        return $this->db->query($query)->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM kriteria WHERE id_kriteria = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function insert($data)
    {
        $stmt = $this->db->prepare("INSERT INTO kriteria (nama_kriteria, bobot, keterangan) VALUES (?, ?, ?)");
        $stmt->bind_param("sds", $data['nama_kriteria'], $data['bobot'], $data['keterangan']);
        return $stmt->execute();
    }

    public function update($id, $data)
    {
        $stmt = $this->db->prepare("UPDATE kriteria SET nama_kriteria = ?, bobot = ?, keterangan = ? WHERE id_kriteria = ?");
        $stmt->bind_param("sdsi", $data['nama_kriteria'], $data['bobot'], $data['keterangan'], $id);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM kriteria WHERE id_kriteria = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
    
}
