<?php
require_once MODEL_PATH . 'GISModel.php';

class GISController
{
    private $model;

    public function __construct($koneksi)
    {
        $this->model = new GISModel($koneksi);
    }

    public function index()
    {
        include VIEW_PATH . 'gis/index.php';
    }

    public function peta()
    {
        include VIEW_PATH . 'gis/peta.php';
    }

    public function petaMAUT()
    {
        $data = [
            'kecamatan_maut' => $this->model->getKecamatanWithMAUT()
        ];
        include VIEW_PATH . 'gis/peta_maut.php';
    }

    public function getGeoJSONAPI()
    {
        header('Content-Type: application/json');
        echo json_encode($this->model->getGeoJSONAPI());
        exit;
    }

    public function petaUser()
    {
        $data = [
            'kecamatan_maut' => $this->model->getKecamatanWithMAUT()
        ];
        include VIEW_PATH . 'peta/index.php';
    }
}