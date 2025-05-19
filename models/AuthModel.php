<?php
class AuthModel
{
    private $db;

    public function __construct($koneksi)
    {
        $this->db = $koneksi;
    }

    public function login($username, $password)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && $password === $user['password']) {
            return $user;
        }

        return false;
    }

    public function register($username, $password, $nama_lengkap, $level = 'user')
    {
        $stmt = $this->db->prepare("INSERT INTO users (username, password, nama_lengkap, level) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('ssss', $username, $password, $nama_lengkap, $level);
        return $stmt->execute();
    }
}
