<?php
class GISModel
{
    private $db;

    public function __construct($koneksi)
    {
        $this->db = $koneksi;
    }

    public function getAllGeoJSONForMap()
    {
        $query = "SELECT k.id_kecamatan, k.nama_kecamatan, k.luas, 
                         g.data_geojson, ha.total_skor, 
                         kk.nama_kelas
                  FROM kecamatan k 
                  LEFT JOIN geojson_kecamatan g ON k.id_kecamatan = g.id_kecamatan
                  LEFT JOIN hasil_analisis ha ON k.id_kecamatan = ha.id_kecamatan
                  LEFT JOIN kelas_kesesuaian kk ON ha.id_kelas = kk.id_kelas
                  WHERE g.data_geojson IS NOT NULL
                  ORDER BY k.nama_kecamatan";
        return $this->db->query($query)->fetch_all(MYSQLI_ASSOC);
    }

    public function getKecamatanWithMAUT()
    {
        $query = "SELECT k.*, ha.total_skor, kk.nama_kelas
                  FROM kecamatan k 
                  LEFT JOIN hasil_analisis ha ON k.id_kecamatan = ha.id_kecamatan
                  LEFT JOIN kelas_kesesuaian kk ON ha.id_kelas = kk.id_kelas
                  ORDER BY ha.total_skor DESC";
        return $this->db->query($query)->fetch_all(MYSQLI_ASSOC);
    }

    public function getGeoJSONAPI()
    {
        $data = $this->getAllGeoJSONForMap();
        $features = [];
        
        foreach ($data as $kecamatan) {
            if ($kecamatan['data_geojson']) {
                $geojsonFile = UPLOAD_GEOJSON_PATH . $kecamatan['data_geojson'];
                
                if (file_exists($geojsonFile)) {
                    $geojsonContent = file_get_contents($geojsonFile);
                    $geojson = json_decode($geojsonContent, true);
                    
                    if ($geojson && isset($geojson['features'])) {
                        foreach ($geojson['features'] as $feature) {
                            $feature['properties']['kecamatan_id'] = $kecamatan['id_kecamatan'];
                            $feature['properties']['kecamatan_name'] = $kecamatan['nama_kecamatan'];
                            $feature['properties']['luas'] = $kecamatan['luas'];
                            $feature['properties']['maut_score'] = $kecamatan['total_skor'];
                            $feature['properties']['nama_kelas'] = $kecamatan['nama_kelas'];
                            $features[] = $feature;
                        }
                    }
                } else {
                    $geojsonString = $kecamatan['data_geojson'];
                    $geojson = json_decode($geojsonString, true);
                    
                    if ($geojson && isset($geojson['features'])) {
                        foreach ($geojson['features'] as $feature) {
                            $feature['properties']['kecamatan_id'] = $kecamatan['id_kecamatan'];
                            $feature['properties']['kecamatan_name'] = $kecamatan['nama_kecamatan'];
                            $feature['properties']['luas'] = $kecamatan['luas'];
                            $feature['properties']['maut_score'] = $kecamatan['total_skor'];
                            $feature['properties']['nama_kelas'] = $kecamatan['nama_kelas'];
                            $features[] = $feature;
                        }
                    }
                }
            }
        }
        
        return [
            'type' => 'FeatureCollection',
            'features' => $features
        ];
    }
}