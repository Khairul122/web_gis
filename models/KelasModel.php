<?php
class KelasModel
{
    private $db;

    public function __construct($koneksi)
    {
        $this->db = $koneksi;
    }

    public function getAll()
    {
        $query = "SELECT * FROM kelas_kesesuaian ORDER BY id_kelas ASC";
        return $this->db->query($query)->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM kelas_kesesuaian WHERE id_kelas = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function insert($data)
    {
        $stmt = $this->db->prepare("INSERT INTO kelas_kesesuaian (kode, nama_kelas, skor_min, skor_max, keterangan) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiis", $data['kode'], $data['nama_kelas'], $data['skor_min'], $data['skor_max'], $data['keterangan']);
        return $stmt->execute();
    }

    public function update($id, $data)
    {
        $stmt = $this->db->prepare("UPDATE kelas_kesesuaian SET kode = ?, nama_kelas = ?, skor_min = ?, skor_max = ?, keterangan = ? WHERE id_kelas = ?");
        $stmt->bind_param("ssii si", $data['kode'], $data['nama_kelas'], $data['skor_min'], $data['skor_max'], $data['keterangan'], $id);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM kelas_kesesuaian WHERE id_kelas = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
