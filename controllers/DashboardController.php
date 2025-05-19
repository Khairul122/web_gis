<?php
class DashboardController
{
    public function index()
    {
        if (!isset($_SESSION['login'])) {
            header('Location: index.php?controller=Auth&action=login&status=failed');
            exit;
        }

        $level = $_SESSION['level'];

        if ($level === 'admin') {
            include VIEW_PATH . 'dashboard/admin.php';
        } elseif ($level === 'user') {
            include VIEW_PATH . 'dashboard/user.php';
        } else {
            echo "Akses tidak diizinkan.";
        }
    }
}
