<?php require 'config.php'; ?>
<?php
if(is_logged_in()) redirect('index.php');

if($_SERVER['REQUEST_METHOD']==='POST'){
  $nama = $_POST['nama'];
  $email = $_POST['email'];
  $username = $_POST['username'];
  $password = $_POST['password']; // tanpa hash
  $hp = $_POST['hp'] ?? null;
  $alamat = $_POST['alamat'] ?? null;

  $stmt = $conn->prepare("INSERT INTO tb_user(nama,email,username,password,hp,alamat,role) VALUES(?,?,?,?,?,?,'pelanggan')");
  $stmt->bind_param("ssssss",$nama,$email,$username,$password,$hp,$alamat);
  if($stmt->execute()){
    flash('ok','Registrasi berhasil, silakan login.');
    redirect('login.php');
  } else {
    flash('err','Registrasi gagal: mungkin email/username sudah terdaftar.');
  }
}
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Register - UMKM</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-7">
      <div class="card shadow-sm">
        <div class="card-body p-4">
          <h3 class="mb-3 text-center">Buat Akun</h3>
          <?php if($m=flash('err')): ?><div class="alert alert-danger"><?=e($m)?></div><?php endif; ?>
          <form method="post">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Nama</label>
                <input name="nama" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Username</label>
                <input name="username" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Email</label>
                <input name="email" type="email" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">HP</label>
                <input name="hp" class="form-control">
              </div>
              <div class="col-12">
                <label class="form-label">Alamat</label>
                <input name="alamat" class="form-control">
              </div>
              <div class="col-md-6">
                <label class="form-label">Password</label>
                <input name="password" type="password" class="form-control" required>
              </div>
            </div>
            <div class="d-grid gap-2 mt-3">
              <button class="btn btn-primary" type="submit">Daftar</button>
              <a class="btn btn-outline-secondary" href="login.php">Sudah punya akun</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
