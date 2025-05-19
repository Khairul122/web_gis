<?php
require_once MODEL_PATH . 'KriteriaModel.php';

class KriteriaController
{
    private $model;

    public function __construct($koneksi)
    {
        $this->model = new KriteriaModel($koneksi);
    }

    public function index()
    {
        $data = $this->model->getAll();
        include VIEW_PATH . 'kriteria/index.php';
    }

    public function form()
    {
        $kriteria = null;
        if (isset($_GET['id'])) {
            $kriteria = $this->model->getById($_GET['id']);
        }
        include VIEW_PATH . 'kriteria/form.php';
    }

    public function simpan()
    {
        $data = [
            'nama_kriteria' => $_POST['nama_kriteria'],
            'bobot' => $_POST['bobot'],
            'keterangan' => $_POST['keterangan']
        ];
        if (!empty($_POST['id_kriteria'])) {
            $this->model->update($_POST['id_kriteria'], $data);
        } else {
            $this->model->insert($data);
        }
        header("Location: index.php?controller=kriteria&action=index");
        exit;
    }

    public function hapus()
    {
        if (isset($_GET['id'])) {
            $this->model->delete($_GET['id']);
        }
        header("Location: index.php?controller=kriteria&action=index");
        exit;
    }
}
