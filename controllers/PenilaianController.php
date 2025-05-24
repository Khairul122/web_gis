<?php
require_once MODEL_PATH . 'PenilaianModel.php';

class PenilaianController
{
    private $model;

    public function __construct($koneksi)
    {
        $this->model = new PenilaianModel($koneksi);
    }

    public function index()
    {
        $data = $this->model->getPenilaianWithDetails();
        include VIEW_PATH . 'penilaian/index.php';
    }

    public function form()
    {
        $kecamatan_options = $this->model->getKecamatanOptions();
        $kriteria_options = $this->model->getKriteriaOptions();

        $sub_kriteria = [];
        foreach ($kriteria_options as $k) {
            $sub_kriteria[$k['id_kriteria']] = $this->model->getSubKriteriaByKriteria($k['id_kriteria']);
        }

        $existing_data = [];
        if (isset($_GET['kecamatan'])) {
            $existing_data = $this->model->getByKecamatan($_GET['kecamatan']);
            $existing_values = [];
            foreach ($existing_data as $data) {
                $existing_values[$data['id_kriteria']] = $data;
            }
            $existing_data = $existing_values;
        }

        include VIEW_PATH . 'penilaian/form.php';
    }

    public function simpanSub()
    {
        if (isset($_POST['id_kecamatan'], $_POST['id_kriteria'], $_POST['nilai'])) {
            $id_kecamatan = $_POST['id_kecamatan'];
            $id_kriteria = $_POST['id_kriteria'];
            $nilai = $_POST['nilai'];

            if (is_array($id_kriteria) && is_array($nilai)) {
                $success_count = 0;
                $update_count = 0;
                $insert_count = 0;
                
                for ($i = 0; $i < count($id_kriteria); $i++) {
                    $data = [
                        'id_kecamatan' => $id_kecamatan,
                        'id_kriteria' => $id_kriteria[$i],
                        'nilai' => $nilai[$i]
                    ];
                    
                    $existing = $this->model->checkExisting($id_kecamatan, $id_kriteria[$i]);
                    
                    if ($existing) {
                        if ($this->model->update($existing['id_nilai'], $data)) {
                            $success_count++;
                            $update_count++;
                        }
                    } else {
                        if ($this->model->insert($data)) {
                            $success_count++;
                            $insert_count++;
                        }
                    }
                }
                
                if ($success_count > 0) {
                    $message = "Penilaian berhasil diproses! ";
                    if ($update_count > 0 && $insert_count > 0) {
                        $message .= "($update_count data diperbarui, $insert_count data baru ditambah)";
                    } elseif ($update_count > 0) {
                        $message .= "($update_count data berhasil diperbarui)";
                    } else {
                        $message .= "($insert_count data baru berhasil ditambah)";
                    }
                    $_SESSION['success_message'] = $message;
                } else {
                    $_SESSION['error_message'] = 'Gagal menyimpan data penilaian!';
                }
            } else {
                $_SESSION['error_message'] = 'Data tidak valid!';
            }
        } else {
            $_SESSION['error_message'] = 'Data tidak lengkap!';
        }

        header("Location: index.php?controller=Penilaian&action=index");
        exit;
    }

    public function hapus()
    {
        if (isset($_GET['id'])) {
            $result = $this->model->delete($_GET['id']);
            
            if ($result) {
                $_SESSION['success_message'] = 'Data berhasil dihapus!';
            } else {
                $_SESSION['error_message'] = 'Gagal menghapus data!';
            }
        } else {
            $_SESSION['error_message'] = 'ID tidak ditemukan!';
        }

        header("Location: index.php?controller=Penilaian&action=index");
        exit;
    }

    public function getSubKriteriaDesc($id_kriteria, $nilai)
    {
        return $this->model->getSubKriteriaDesc($id_kriteria, $nilai);
    }

    public function edit()
    {
        if (isset($_GET['id'])) {
            $data = $this->model->getById($_GET['id']);
            $kecamatan_options = $this->model->getKecamatanOptions();
            $kriteria_options = $this->model->getKriteriaOptions();
            
            $sub_kriteria = [];
            foreach ($kriteria_options as $k) {
                $sub_kriteria[$k['id_kriteria']] = $this->model->getSubKriteriaByKriteria($k['id_kriteria']);
            }

            include VIEW_PATH . 'penilaian/edit.php';
        } else {
            header("Location: index.php?controller=Penilaian&action=index");
            exit;
        }
    }

    public function update()
    {
        if (isset($_POST['id_nilai'], $_POST['id_kecamatan'], $_POST['id_kriteria'], $_POST['nilai'])) {
            $data = [
                'id_kecamatan' => $_POST['id_kecamatan'],
                'id_kriteria' => $_POST['id_kriteria'],
                'nilai' => $_POST['nilai']
            ];
            
            $result = $this->model->update($_POST['id_nilai'], $data);
            
            if ($result) {
                $_SESSION['success_message'] = 'Data berhasil diupdate!';
            } else {
                $_SESSION['error_message'] = 'Gagal mengupdate data!';
            }
        } else {
            $_SESSION['error_message'] = 'Data tidak lengkap!';
        }

        header("Location: index.php?controller=Penilaian&action=index");
        exit;
    }

    public function getSubKriteriaAjax()
    {
        if (isset($_GET['id_kriteria'])) {
            $sub_kriteria = $this->model->getSubKriteriaByKriteria($_GET['id_kriteria']);
            header('Content-Type: application/json');
            echo json_encode($sub_kriteria);
            exit;
        }
    }

    public function matrix()
    {
        $data = $this->model->getMatrixData();
        $kecamatan_list = $this->model->getKecamatanOptions();
        $kriteria_list = $this->model->getKriteriaOptions();
        
        include VIEW_PATH . 'penilaian/matrix.php';
    }
}