<?php require 'config.php'; ?>
<?php
if(is_logged_in()) redirect('index.php');

if($_SERVER['REQUEST_METHOD']==='POST'){
  $identity = $_POST['identity'] ?? '';
  $password = $_POST['password'] ?? '';

  $stmt = $conn->prepare("SELECT * FROM tb_user WHERE email=? OR username=? LIMIT 1");
  $stmt->bind_param("ss",$identity,$identity);
  $stmt->execute();
  $res = $stmt->get_result();
  $user = $res->fetch_assoc();
  
  // Cek password langsung (tanpa hash)
  if($user && $password === $user['password']){
    $_SESSION['user'] = $user;
    flash('ok','Login berhasil.');
    redirect('index.php');
  } else {
    flash('err','Email/Username atau password salah.');
  }
}
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login - UMKM</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card shadow-sm">
        <div class="card-body p-4">
          <h3 class="mb-3 text-center">Login</h3>
          <?php if($m=flash('err')): ?><div class="alert alert-danger"><?=e($m)?></div><?php endif; ?>
          <?php if($m=flash('ok')): ?><div class="alert alert-success"><?=e($m)?></div><?php endif; ?>
          <form method="post">
            <div class="mb-3">
              <label class="form-label">Email / Username</label>
              <input type="text" name="identity" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Password</label>
              <input type="password" name="password" class="form-control" required>
            </div>
            <div class="d-grid gap-2">
              <button class="btn btn-primary" type="submit">Masuk</button>
              <a class="btn btn-outline-secondary" href="register.php">Buat Akun</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
