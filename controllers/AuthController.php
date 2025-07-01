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
            try {
                ob_clean();
                header('Content-Type: application/json; charset=utf-8');
                
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                
                $username = trim($_POST['username'] ?? '');
                $password = trim($_POST['password'] ?? '');

                error_log("Login attempt - Username: " . $username);

                if (empty($username) || empty($password)) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Username dan password harus diisi!'
                    ], JSON_UNESCAPED_UNICODE);
                    exit;
                }

                if (strlen($username) < 3) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Username minimal 3 karakter!'
                    ], JSON_UNESCAPED_UNICODE);
                    exit;
                }

                $user = $this->model->login($username, $password);
                
                error_log("Login result: " . ($user ? "Success" : "Failed"));
                
                if ($user) {
                    $_SESSION['login'] = true;
                    $_SESSION['id_user'] = $user['id_user'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
                    $_SESSION['level'] = $user['level'];

                    echo json_encode([
                        'success' => true,
                        'message' => 'Login berhasil! Mengalihkan ke dashboard...',
                        'redirect' => 'index.php?controller=Dashboard&action=index',
                        'user' => [
                            'username' => $user['username'],
                            'nama' => $user['nama_lengkap'],
                            'level' => $user['level']
                        ]
                    ], JSON_UNESCAPED_UNICODE);
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Username atau password salah!'
                    ], JSON_UNESCAPED_UNICODE);
                }
                exit;
                
            } catch (Exception $e) {
                error_log("Login error: " . $e->getMessage());
                echo json_encode([
                    'success' => false,
                    'message' => 'Terjadi kesalahan server: ' . $e->getMessage()
                ], JSON_UNESCAPED_UNICODE);
                exit;
            }
        } else {
            include VIEW_PATH . 'auth/login.php';
        }
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                ob_clean();
                header('Content-Type: application/json; charset=utf-8');
                
                $username = trim($_POST['username'] ?? '');
                $password = trim($_POST['password'] ?? '');
                $nama = trim($_POST['nama'] ?? '');
                $email = trim($_POST['email'] ?? '');
                $confirm_password = trim($_POST['confirm_password'] ?? '');

                error_log("Register attempt - Username: " . $username . ", Email: " . $email);

                if (empty($username) || empty($password) || empty($nama) || empty($email)) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Semua field harus diisi!'
                    ], JSON_UNESCAPED_UNICODE);
                    exit;
                }

                if (strlen($nama) < 3) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Nama minimal 3 karakter!'
                    ], JSON_UNESCAPED_UNICODE);
                    exit;
                }

                if (strlen($username) < 3) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Username minimal 3 karakter!'
                    ], JSON_UNESCAPED_UNICODE);
                    exit;
                }

                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Format email tidak valid!'
                    ], JSON_UNESCAPED_UNICODE);
                    exit;
                }

                if ($password !== $confirm_password) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Konfirmasi password tidak cocok!'
                    ], JSON_UNESCAPED_UNICODE);
                    exit;
                }

                $checkUser = $this->model->checkExistingUser($username, $email);
                if ($checkUser) {
                    if (strtolower($checkUser['username']) === strtolower($username)) {
                        echo json_encode([
                            'success' => false,
                            'message' => 'Username sudah digunakan! Silakan pilih username lain.'
                        ], JSON_UNESCAPED_UNICODE);
                    } else {
                        echo json_encode([
                            'success' => false,
                            'message' => 'Email sudah terdaftar! Silakan gunakan email lain.'
                        ], JSON_UNESCAPED_UNICODE);
                    }
                    exit;
                }

                $success = $this->model->register($username, $password, $nama, $email);
                
                error_log("Register result: " . ($success ? "Success" : "Failed"));
                
                if ($success) {
                    echo json_encode([
                        'success' => true,
                        'message' => 'Registrasi berhasil! Silakan login dengan akun Anda.'
                    ], JSON_UNESCAPED_UNICODE);
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Registrasi gagal! Terjadi kesalahan database.'
                    ], JSON_UNESCAPED_UNICODE);
                }
                exit;
                
            } catch (Exception $e) {
                error_log("Register error: " . $e->getMessage());
                echo json_encode([
                    'success' => false,
                    'message' => 'Terjadi kesalahan server: ' . $e->getMessage()
                ], JSON_UNESCAPED_UNICODE);
                exit;
            }
        } else {
            include VIEW_PATH . 'auth/register.php';
        }
    }

    public function logout()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
        header('Location: index.php?controller=Auth&action=login&status=logout');
        exit;
    }

    public function index()
    {
        include VIEW_PATH . 'auth/login.php';
    }
}