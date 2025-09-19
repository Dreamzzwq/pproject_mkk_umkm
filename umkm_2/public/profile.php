<?php require 'config.php'; if(!is_logged_in()) redirect('login.php'); ?>
<?php
// update profile
if($_SERVER['REQUEST_METHOD']==='POST'){
  $nama=$_POST['nama']; $username=$_POST['username']; $hp=$_POST['hp']; $alamat=$_POST['alamat'];
  $sql = "UPDATE tb_user SET nama=?, username=?, hp=?, alamat=? WHERE id=?";
  $stmt=$conn->prepare($sql); $stmt->bind_param("ssssi",$nama,$username,$hp,$alamat,$_SESSION['user']['id']);
  $stmt->execute();
  if(!empty($_POST['password'])){
    $pass=password_hash($_POST['password'], PASSWORD_BCRYPT);
    $up=$conn->prepare("UPDATE tb_user SET password=? WHERE id=?"); $up->bind_param("si",$pass,$_SESSION['user']['id']); $up->execute();
  }
  // refresh session
  $s=$conn->prepare("SELECT * FROM tb_user WHERE id=?"); $s->bind_param("i",$_SESSION['user']['id']); $s->execute();
  $_SESSION['user']=$s->get_result()->fetch_assoc();
  flash('ok','Profil diperbarui.');
  redirect('profile.php');
}
$u = $_SESSION['user'];
$trx = $conn->query("SELECT * FROM tb_transaksi WHERE id_pelanggan=".$u['id']." ORDER BY id_transaksi DESC")->fetch_all(MYSQLI_ASSOC);
?>
<!doctype html><html lang="id"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Profil</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head><body>
<?php include '_navbar.php'; ?>
<div class="container my-4">
  <div class="row g-4">
    <div class="col-md-5">
      <div class="card shadow-sm">
        <div class="card-body">
          <h5 class="mb-3">Edit Profil</h5>
          <?php if($m=flash('ok')): ?><div class="alert alert-success"><?=e($m)?></div><?php endif; ?>
          <form method="post">
            <div class="mb-2"><label class="form-label">Nama</label><input name="nama" class="form-control" value="<?=e($u['nama'])?>"></div>
            <div class="mb-2"><label class="form-label">Username</label><input name="username" class="form-control" value="<?=e($u['username'])?>"></div>
            <div class="mb-2"><label class="form-label">HP</label><input name="hp" class="form-control" value="<?=e($u['hp'])?>"></div>
            <div class="mb-2"><label class="form-label">Alamat</label><input name="alamat" class="form-control" value="<?=e($u['alamat'])?>"></div>
            <div class="mb-2"><label class="form-label">Password Baru (opsional)</label><input name="password" type="password" class="form-control"></div>
            <button class="btn btn-primary mt-2">Simpan</button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-7">
      <div class="card shadow-sm">
        <div class="card-body">
          <h5>Riwayat Transaksi</h5>
          <div class="table-responsive mt-2">
            <table class="table table-sm">
              <thead><tr><th>ID</th><th>Tanggal</th><th>Total</th><th>Status</th><th></th></tr></thead>
              <tbody>
                <?php foreach($trx as $t): ?>
                  <tr>
                    <td>#<?=$t['id_transaksi']?></td>
                    <td><?=$t['tanggal']?></td>
                    <td>Rp <?=number_format($t['total_harga'],0,',','.')?></td>
                    <td><?=e($t['status'])?></td>
                    <td><a class="btn btn-sm btn-outline-secondary" href="invoice.php?id=<?=$t['id_transaksi']?>">Invoice</a></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body></html>
