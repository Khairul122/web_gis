<?php
require_once MODEL_PATH . 'SubKriteriaModel.php';

class SubKriteriaController
{
    private $model;

    public function __construct($koneksi)
    {
        $this->model = new SubKriteriaModel($koneksi);
    }

    public function index()
    {
        $data = $this->model->getGroupedByKriteria(); // custom group by function
        include VIEW_PATH . 'subkriteria/index.php';
    }

    public function form()
    {
        $subkriteria = null;
        $kriteria_options = $this->model->getKriteriaOptions();

        if (isset($_GET['id'])) {
            $subkriteria = $this->model->getById($_GET['id']);
        }

        include VIEW_PATH . 'subkriteria/form.php';
    }

    public function simpan()
    {
        if (isset($_POST['id_kriteria'], $_POST['deskripsi'], $_POST['nilai'])) {
            $id_kriteria = $_POST['id_kriteria'];
            $deskripsi = $_POST['deskripsi'];
            $nilai = $_POST['nilai'];

            if (is_array($id_kriteria) && is_array($deskripsi) && is_array($nilai)) {
                for ($i = 0; $i < count($id_kriteria); $i++) {
                    $data = [
                        'id_kriteria' => $id_kriteria[$i],
                        'deskripsi' => $deskripsi[$i],
                        'nilai' => $nilai[$i]
                    ];
                    $this->model->insert($data);
                }
            }
        }

        header("Location: index.php?controller=SubKriteria&action=index");
        exit;
    }

    public function hapus()
    {
        if (isset($_GET['id'])) {
            $this->model->delete($_GET['id']);
        }

        header("Location: index.php?controller=SubKriteria&action=index");
        exit;
    }
}
