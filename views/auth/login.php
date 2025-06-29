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
    
    .action-buttons {
      display: flex;
      gap: 20px;
      justify-content: center;
      flex-wrap: wrap;
      margin-top: 30px;
    }
    
    .action-btn {
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
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      min-width: 200px;
      justify-content: center;
    }
    
    .action-btn:hover {
      background: rgba(255,255,255,0.3);
      transform: translateY(-2px);
      box-shadow: 0 12px 35px rgba(0,0,0,0.3);
      color: white;
      text-decoration: none;
    }
    
    .btn-login {
      background: rgba(255,255,255,0.25);
      border-color: rgba(255,255,255,0.4);
    }
    
    .btn-guest {
      background: rgba(76, 175, 80, 0.3);
      border-color: rgba(76, 175, 80, 0.5);
    }
    
    .btn-guest:hover {
      background: rgba(76, 175, 80, 0.4);
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
    
    .btn-login-modal {
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
    
    .btn-login-modal:hover {
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
    
    .guest-info {
      background: rgba(255,255,255,0.1);
      border-radius: 15px;
      padding: 20px;
      margin-top: 30px;
      backdrop-filter: blur(10px);
    }
    
    .guest-info h5 {
      margin-bottom: 15px;
      color: #fff3e0;
    }
    
    .guest-info ul {
      list-style: none;
      padding: 0;
    }
    
    .guest-info li {
      margin-bottom: 8px;
      padding-left: 20px;
      position: relative;
    }
    
    .guest-info li::before {
      content: '✓';
      position: absolute;
      left: 0;
      color: #4caf50;
      font-weight: bold;
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
      
      .action-buttons {
        flex-direction: column;
        align-items: center;
      }
      
      .action-btn {
        padding: 12px 30px;
        font-size: 1rem;
        min-width: 250px;
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
      
      <div class="action-buttons">
        <button type="button" class="action-btn btn-login" data-bs-toggle="modal" data-bs-target="#loginModal">
          <i class="bi bi-shield-lock me-2"></i>
          LOGIN ADMINISTRATOR
        </button>
        
        <a href="index.php?controller=GIS&action=petaUser" class="action-btn btn-guest">
          <i class="bi bi-map me-2"></i>
          LIHAT PETA UMUM
        </a>
      </div>
    
    </div>
  </div>

  <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="loginModalLabel">
            <i class="bi bi-shield-lock me-2"></i>
            Login Administrator
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
                     placeholder="Masukkan username administrator">
            </div>
            
            <div class="mb-4">
              <label for="password" class="form-label">
                <i class="bi bi-lock me-1"></i>
                Password
              </label>
              <input type="password" class="form-control" id="password" name="password" required 
                     placeholder="Masukkan password administrator">
            </div>
            
            <button type="submit" class="btn btn-login-modal">
              <i class="bi bi-box-arrow-in-right me-2"></i>
              MASUK SISTEM
            </button>
          </form>
          
          <div class="register-link">
            <p class="mb-0">Belum memiliki akun administrator? 
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
            Registrasi Administrator
          </h5>