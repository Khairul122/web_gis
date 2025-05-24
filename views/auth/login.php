<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SIG Kesesuaian Lahan Kelapa Sawit - Mandailing Natal</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      overflow-x: hidden;
    }
    
    .hero-section {
      height: 100vh;
      background: linear-gradient(135deg, #4fc3f7 0%, #29b6f6 50%, #0288d1 100%);
      position: relative;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    
    .hero-content {
      text-align: center;
      color: white;
      z-index: 2;
      max-width: 900px;
      padding: 0 20px;
    }
    
    .logo {
      width: 120px;
      height: 120px;
      background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="45" fill="%23fff" stroke="%23333" stroke-width="2"/><path d="M30 40 Q50 20 70 40 Q50 60 30 40" fill="%23228B22"/><circle cx="50" cy="45" r="8" fill="%23FFD700"/></svg>') center/contain no-repeat;
      margin: 0 auto 30px;
      border-radius: 50%;
      box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }
    
    .hero-title {
      font-size: 2.5rem;
      font-weight: 700;
      margin-bottom: 20px;
      text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
      line-height: 1.2;
    }
    
    .hero-subtitle {
      font-size: 1.8rem;
      font-weight: 600;
      margin-bottom: 15px;
      color: #e3f2fd;
    }
    
    .hero-method {
      font-size: 2rem;
      font-weight: 700;
      margin: 20px 0;
      color: #fff3e0;
      text-shadow: 2px 2px 4px rgba(0,0,0,0.4);
    }
    
    .hero-location {
      font-size: 1.5rem;
      font-weight: 600;
      margin-bottom: 40px;
      color: #e1f5fe;
    }
    
    .login-btn {
      background: rgba(255,255,255,0.2);
      backdrop-filter: blur(10px);
      border: 2px solid rgba(255,255,255,0.3);
      color: white;
      padding: 15px 40px;
      font-size: 1.2rem;
      font-weight: 600;
      border-radius: 50px;
      transition: all 0.3s ease;
      box-shadow: 0 8px 25px rgba(0,0,0,0.2);
    }
    
    .login-btn:hover {
      background: rgba(255,255,255,0.3);
      transform: translateY(-2px);
      box-shadow: 0 12px 35px rgba(0,0,0,0.3);
      color: white;
    }
    
    .modal-content {
      border-radius: 20px;
      border: none;
      box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    }
    
    .modal-header {
      background: linear-gradient(135deg, #4fc3f7, #29b6f6);
      color: white;
      border-radius: 20px 20px 0 0;
      border-bottom: none;
      padding: 25px 30px;
    }
    
    .modal-title {
      font-weight: 600;
      font-size: 1.3rem;
    }
    
    .btn-close {
      background: none;
      filter: invert(1);
    }
    
    .modal-body {
      padding: 40px 30px 30px;
      background: white;
    }
    
    .form-control {
      border-radius: 25px;
      padding: 12px 20px;
      border: 2px solid #e0e0e0;
      font-size: 1rem;
      transition: all 0.3s ease;
    }
    
    .form-control:focus {
      border-color: #29b6f6;
      box-shadow: 0 0 0 0.2rem rgba(41, 182, 246, 0.25);
    }
    
    .btn-login {
      background: linear-gradient(135deg, #4fc3f7, #29b6f6);
      border: none;
      border-radius: 25px;
      padding: 12px 30px;
      font-weight: 600;
      color: white;
      width: 100%;
      font-size: 1.1rem;
      transition: all 0.3s ease;
    }
    
    .btn-login:hover {
      background: linear-gradient(135deg, #29b6f6, #0288d1);
      transform: translateY(-1px);
      box-shadow: 0 8px 25px rgba(41, 182, 246, 0.4);
      color: white;
    }
    
    .floating-shapes {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      overflow: hidden;
      z-index: 1;
    }
    
    .shape {
      position: absolute;
      background: rgba(255,255,255,0.1);
      border-radius: 50%;
      animation: float 6s ease-in-out infinite;
    }
    
    .shape:nth-child(1) {
      width: 80px;
      height: 80px;
      top: 20%;
      left: 10%;
      animation-delay: 0s;
    }
    
    .shape:nth-child(2) {
      width: 120px;
      height: 120px;
      top: 60%;
      right: 10%;
      animation-delay: 2s;
    }
    
    .shape:nth-child(3) {
      width: 60px;
      height: 60px;
      top: 80%;
      left: 70%;
      animation-delay: 4s;
    }
    
    .shape:nth-child(4) {
      width: 100px;
      height: 100px;
      top: 10%;
      right: 25%;
      animation-delay: 1s;
    }
    
    @keyframes float {
      0%, 100% {
        transform: translateY(0px) rotate(0deg);
      }
      50% {
        transform: translateY(-20px) rotate(180deg);
      }
    }
    
    .form-label {
      font-weight: 600;
      color: #333;
      margin-bottom: 8px;
    }
    
    .alert-custom {
      border-radius: 15px;
      border: none;
      padding: 15px 20px;
      margin-bottom: 20px;
    }
    
    .register-link {
      text-align: center;
      margin-top: 20px;
      padding-top: 20px;
      border-top: 1px solid #e0e0e0;
    }
    
    .register-link a {
      color: #29b6f6;
      text-decoration: none;
      font-weight: 600;
    }
    
    .register-link a:hover {
      color: #0288d1;
      text-decoration: underline;
    }
    
    @media (max-width: 768px) {
      .hero-title {
        font-size: 1.8rem;
      }
      
      .hero-subtitle {
        font-size: 1.3rem;
      }
      
      .hero-method {
        font-size: 1.5rem;
      }
      
      .hero-location {
        font-size: 1.2rem;
      }
      
      .login-btn {
        padding: 12px 30px;
        font-size: 1rem;
      }
    }
  </style>
</head>

<body>
  <div class="hero-section">
    <div class="floating-shapes">
      <div class="shape"></div>
      <div class="shape"></div>
      <div class="shape"></div>
      <div class="shape"></div>
    </div>
    
    <div class="hero-content">
      <div class="logo"></div>
      
      <h1 class="hero-title">
        SISTEM INFORMASI GEOGRAFIS (GIS)<br>
        MENENTUKAN KESESUAIAN LAHAN TANAMAN KELAPA SAWIT
      </h1>
      
      <h2 class="hero-subtitle">
        UNTUK MENINGKATKAN PRODUKSI SAWIT
      </h2>
      
      <h3 class="hero-method">
        DENGAN MENGGUNAKAN METODE<br>
        <em>MULTI-ATTRIBUTE UTILITY THEORY</em><br>
        <strong>(MAUT)</strong>
      </h3>
      
      <h4 class="hero-location">
        STUDI KASUS: KABUPATEN MANDAILING NATAL
      </h4>
      
      <button type="button" class="btn login-btn" data-bs-toggle="modal" data-bs-target="#loginModal">
        <i class="bi bi-box-arrow-in-right me-2"></i>
        MASUK SISTEM
      </button>
    </div>
  </div>

  <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="loginModalLabel">
            <i class="bi bi-person-circle me-2"></i>
            Login Sistem
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div id="alert-container"></div>
          
          <form id="loginForm" method="POST" action="index.php?controller=Auth&action=login">
            <div class="mb-3">
              <label for="username" class="form-label">
                <i class="bi bi-person me-1"></i>
                Username
              </label>
              <input type="text" class="form-control" id="username" name="username" required 
                     placeholder="Masukkan username Anda">
            </div>
            
            <div class="mb-4">
              <label for="password" class="form-label">
                <i class="bi bi-lock me-1"></i>
                Password
              </label>
              <input type="password" class="form-control" id="password" name="password" required 
                     placeholder="Masukkan password Anda">
            </div>
            
            <button type="submit" class="btn btn-login">
              <i class="bi bi-box-arrow-in-right me-2"></i>
              MASUK
            </button>
          </form>
          
          <div class="register-link">
            <p class="mb-0">Belum memiliki akun? 
              <a href="#" data-bs-toggle="modal" data-bs-target="#registerModal" data-bs-dismiss="modal">
                Daftar di sini
              </a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="registerModalLabel">
            <i class="bi bi-person-plus me-2"></i>
            Registrasi Akun Baru
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div id="register-alert-container"></div>
          
          <form id="registerForm" method="POST" action="index.php?controller=Auth&action=register">
            <div class="mb-3">
              <label for="reg_username" class="form-label">
                <i class="bi bi-person me-1"></i>
                Username
              </label>
              <input type="text" class="form-control" id="reg_username" name="username" required 
                     placeholder="Pilih username unik">
            </div>
            
            <div class="mb-3">
              <label for="reg_nama_lengkap" class="form-label">
                <i class="bi bi-card-text me-1"></i>
                Nama Lengkap
              </label>
              <input type="text" class="form-control" id="reg_nama_lengkap" name="nama_lengkap" required 
                     placeholder="Masukkan nama lengkap">
            </div>
            
            <div class="mb-3">
              <label for="reg_password" class="form-label">
                <i class="bi bi-lock me-1"></i>
                Password
              </label>
              <input type="password" class="form-control" id="reg_password" name="password" required 
                     placeholder="Buat password yang kuat">
            </div>
            
            <div class="mb-4">
              <label for="reg_confirm_password" class="form-label">
                <i class="bi bi-lock-fill me-1"></i>
                Konfirmasi Password
              </label>
              <input type="password" class="form-control" id="reg_confirm_password" name="confirm_password" required 
                     placeholder="Ulangi password">
            </div>
            
            <button type="submit" class="btn btn-login">
              <i class="bi bi-person-plus me-2"></i>
              DAFTAR
            </button>
          </form>
          
          <div class="register-link">
            <p class="mb-0">Sudah memiliki akun? 
              <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">
                Login di sini
              </a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const urlParams = new URLSearchParams(window.location.search);
      const status = urlParams.get('status');
      
      function showAlert(container, type, message) {
        const alertHtml = `
          <div class="alert alert-${type} alert-custom alert-dismissible fade show" role="alert">
            <i class="bi bi-${type === 'success' ? 'check-circle' : type === 'danger' ? 'exclamation-triangle' : 'info-circle'} me-2"></i>
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
        `;
        document.getElementById(container).innerHTML = alertHtml;
      }
      
      if (status === 'failed') {
        const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
        loginModal.show();
        showAlert('alert-container', 'danger', 'Login gagal! Username atau password salah.');
      } else if (status === 'registered') {
        const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
        loginModal.show();
        showAlert('alert-container', 'success', 'Registrasi berhasil! Silakan login dengan akun baru Anda.');
      } else if (status === 'logout') {
        showAlert('alert-container', 'info', 'Anda berhasil logout. Terima kasih telah menggunakan sistem.');
      } else if (status === 'register_failed') {
        const registerModal = new bootstrap.Modal(document.getElementById('registerModal'));
        registerModal.show();
        showAlert('register-alert-container', 'danger', 'Registrasi gagal! Username mungkin sudah digunakan.');
      }
      
      document.getElementById('registerForm').addEventListener('submit', function(e) {
        const password = document.getElementById('reg_password').value;
        const confirmPassword = document.getElementById('reg_confirm_password').value;
        
        if (password !== confirmPassword) {
          e.preventDefault();
          showAlert('register-alert-container', 'danger', 'Password dan konfirmasi password tidak cocok!');
        }
      });
      
      document.getElementById('loginForm').addEventListener('submit', function(e) {
        const username = document.getElementById('username').value.trim();
        const password = document.getElementById('password').value.trim();
        
        if (!username || !password) {
          e.preventDefault();
          showAlert('alert-container', 'danger', 'Username dan password harus diisi!');
        }
      });
    });
  </script>
</body>
</html>