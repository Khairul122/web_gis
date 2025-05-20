<?php
require_once MODEL_PATH . 'KecamatanModel.php';

class KecamatanController
{
    private $model;

    public function __construct()
    {
        global $koneksi;
        $this->model = new KecamatanModel($koneksi);
    }

    public function index()
    {
        $data = $this->model->getAll();
        include VIEW_PATH . 'kecamatan/index.php';
    }

    public function form()
    {
        $kecamatan = null;
        if (isset($_GET['id'])) {
            $kecamatan = $this->model->getById($_GET['id']);
        }
        include VIEW_PATH . 'kecamatan/form.php';
    }

    public function simpan()
    {
        $data = [
            'nama_kecamatan' => $_POST['nama_kecamatan'],
            'luas' => $_POST['luas'],
            'keterangan' => $_POST['keterangan']
        ];

        $geojsonPath = null;
        if (!empty($_FILES['geojson']['tmp_name'])) {
            $originalName = basename($_FILES['geojson']['name']);
            $targetPath = UPLOAD_GEOJSON_PATH . $originalName;

            if (move_uploaded_file($_FILES['geojson']['tmp_name'], $targetPath)) {
                $geojsonPath =  $originalName;
            } else {
                die("Gagal menyimpan file GeoJSON.");
            }
        }

        if (!empty($_POST['id_kecamatan'])) {
            $this->model->update($_POST['id_kecamatan'], $data, $geojsonPath);
        } else {
            $this->model->insert($data, $geojsonPath);
        }

        header('Location: index.php?controller=Kecamatan&action=index');
        exit;
    }

    public function delete()
    {
        if (isset($_GET['id'])) {
            $this->model->delete($_GET['id']);
        }
        header('Location: index.php?controller=Kecamatan&action=index');
        exit;
    }
}
