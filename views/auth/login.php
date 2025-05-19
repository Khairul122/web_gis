<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background-color: #f8f9fa; }
    .login-container {
      max-width: 400px;
      margin: 60px auto;
      padding: 30px;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body>

<div class="login-container">
  <h4 class="text-center mb-4">Login Pengguna</h4>
  <form method="POST" action="index.php?controller=Auth&action=login">
    <div class="mb-3">
      <label class="form-label">Username</label>
      <input type="text" name="username" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Password</label>
      <input type="password" name="password" class="form-control" required>
    </div>
    <div class="d-grid mb-3">
      <button type="submit" class="btn btn-primary">Login</button>
    </div>
    <p class="text-center">
      Belum punya akun? <a href="index.php?controller=Auth&action=register">Daftar di sini</a>
    </p>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  const urlParams = new URLSearchParams(window.location.search);
  const status = urlParams.get('status');
  if (status === 'failed') {
    alert('Login gagal! Username atau password salah.');
  } else if (status === 'registered') {
    alert('Registrasi berhasil! Silakan login.');
  } else if (status === 'logout') {
    alert('Anda berhasil logout.');
  }
</script>
</body>
</html>
