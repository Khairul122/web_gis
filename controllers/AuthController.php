<?php
require_once MODEL_PATH . 'AuthModel.php';

class AuthController
{
    private $model;

    public function __construct()
    {
        global $koneksi;
        $this->model = new AuthModel($koneksi);
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $this->model->login($username, $password);
            if ($user) {
                $_SESSION['login'] = true;
                $_SESSION['id_user'] = $user['id_user'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
                $_SESSION['level'] = $user['level'];

                if ($user['level'] === 'admin') {
                    header('Location: index.php?controller=Dashboard&action=index');
                } else {
                    header('Location: index.php?controller=User&action=index');
                }
                exit;
            } else {
                header('Location: index.php?controller=Auth&action=login&status=failed');
                exit;
            }
        } else {
            include VIEW_PATH . 'auth/login.php';
        }
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $nama_lengkap = $_POST['nama_lengkap'];

            $success = $this->model->register($username, $password, $nama_lengkap);
            if ($success) {
                header('Location: index.php?controller=Auth&action=login&status=registered');
            } else {
                header('Location: index.php?controller=Auth&action=register&status=failed');
            }
            exit;
        } else {
            include VIEW_PATH . 'auth/register.php';
        }
    }

    public function logout()
    {
        session_destroy();
        header('Location: index.php?controller=Auth&action=login&status=logout');
        exit;
    }
}
