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
        $query = "SELECT kecamatan.*, geojson_kecamatan.data_geojson 
                  FROM kecamatan
                  LEFT JOIN geojson_kecamatan ON kecamatan.id_kecamatan = geojson_kecamatan.id_kecamatan";
        return $this->db->query($query);
    }

    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT kecamatan.*, geojson_kecamatan.data_geojson 
            FROM kecamatan 
            LEFT JOIN geojson_kecamatan ON kecamatan.id_kecamatan = geojson_kecamatan.id_kecamatan
            WHERE kecamatan.id_kecamatan = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function insert($data, $geojsonPath)
    {
        $stmt = $this->db->prepare("INSERT INTO kecamatan (nama_kecamatan, luas, keterangan) VALUES (?, ?, ?)");
        $stmt->bind_param('sds', $data['nama_kecamatan'], $data['luas'], $data['keterangan']);
        $stmt->execute();
        $id_kecamatan = $stmt->insert_id;

        if (!empty($geojsonPath)) {
            $stmt2 = $this->db->prepare("INSERT INTO geojson_kecamatan (id_kecamatan, data_geojson) VALUES (?, ?)");
            $stmt2->bind_param('is', $id_kecamatan, $geojsonPath);
            $stmt2->execute();
        }
    }

    public function update($id, $data, $geojsonPath)
    {
        $stmt = $this->db->prepare("UPDATE kecamatan SET nama_kecamatan = ?, luas = ?, keterangan = ? WHERE id_kecamatan = ?");
        $stmt->bind_param('sdsi', $data['nama_kecamatan'], $data['luas'], $data['keterangan'], $id);
        $stmt->execute();

        if (!empty($geojsonPath)) {
            $stmt2 = $this->db->prepare("SELECT id_geojson FROM geojson_kecamatan WHERE id_kecamatan = ?");
            $stmt2->bind_param('i', $id);
            $stmt2->execute();
            $result = $stmt2->get_result();

            if ($result->num_rows > 0) {
                $stmt3 = $this->db->prepare("UPDATE geojson_kecamatan SET data_geojson = ? WHERE id_kecamatan = ?");
                $stmt3->bind_param('si', $geojsonPath, $id);
                $stmt3->execute();
            } else {
                $stmt4 = $this->db->prepare("INSERT INTO geojson_kecamatan (id_kecamatan, data_geojson) VALUES (?, ?)");
                $stmt4->bind_param('is', $id, $geojsonPath);
                $stmt4->execute();
            }
        }
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM kecamatan WHERE id_kecamatan = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
    }
}
