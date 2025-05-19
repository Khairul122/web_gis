<?php
class KecamatanModel
{
    private $db;

    public function __construct($koneksi)
    {
        $this->db = $koneksi;
    }

    public function getAll()
    {
        $query = "SELECT * FROM kecamatan ORDER BY id_kecamatan ASC";
        return $this->db->query($query)->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM kecamatan WHERE id_kecamatan = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function insert($data)
    {
        $stmt = $this->db->prepare("INSERT INTO kecamatan (nama_kecamatan, latitude, longitude, luas, keterangan) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sddds", $data['nama_kecamatan'], $data['latitude'], $data['longitude'], $data['luas'], $data['keterangan']);
        return $stmt->execute();
    }

    public function update($id, $data)
    {
        $stmt = $this->db->prepare("UPDATE kecamatan SET nama_kecamatan = ?, latitude = ?, longitude = ?, luas = ?, keterangan = ? WHERE id_kecamatan = ?");
        $stmt->bind_param("sdddsi", $data['nama_kecamatan'], $data['latitude'], $data['longitude'], $data['luas'], $data['keterangan'], $id);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM kecamatan WHERE id_kecamatan = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
