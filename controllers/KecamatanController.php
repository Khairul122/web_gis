<?php
require_once MODEL_PATH . 'KecamatanModel.php';

class KecamatanController
{
    private $model;

    public function __construct($koneksi)
    {
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
            'latitude' => $_POST['latitude'],
            'longitude' => $_POST['longitude'],
            'luas' => $_POST['luas'],
            'keterangan' => $_POST['keterangan']
        ];

        if (!empty($_POST['id_kecamatan'])) {
            $this->model->update($_POST['id_kecamatan'], $data);
        } else {
            $this->model->insert($data);
        }

        header("Location: index.php?controller=kecamatan&action=index");
        exit;
    }

    public function hapus()
    {
        if (isset($_GET['id'])) {
            $this->model->delete($_GET['id']);
        }

        header("Location: index.php?controller=kecamatan&action=index");
        exit;
    }
}
