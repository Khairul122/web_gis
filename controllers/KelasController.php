<?php
require_once MODEL_PATH . 'KelasModel.php';

class KelasController
{
    private $model;

    public function __construct($koneksi)
    {
        $this->model = new KelasModel($koneksi);
    }

    public function index()
    {
        $data = $this->model->getAll();
        include VIEW_PATH . 'kelas/index.php';
    }

    public function form()
    {
        $kelas = null;
        if (isset($_GET['id'])) {
            $kelas = $this->model->getById($_GET['id']);
        }
        include VIEW_PATH . 'kelas/form.php';
    }

    public function simpan()
    {
        $data = [
            'kode' => $_POST['kode'],
            'nama_kelas' => $_POST['nama_kelas'],
            'skor_min' => $_POST['skor_min'],
            'skor_max' => $_POST['skor_max'],
            'keterangan' => $_POST['keterangan']
        ];

        if (!empty($_POST['id_kelas'])) {
            $this->model->update($_POST['id_kelas'], $data);
        } else {
            $this->model->insert($data);
        }

        header("Location: index.php?controller=kelas&action=index");
        exit;
    }

    public function hapus()
    {
        if (isset($_GET['id'])) {
            $this->model->delete($_GET['id']);
        }
        header("Location: index.php?controller=kelas&action=index");
        exit;
    }
}
