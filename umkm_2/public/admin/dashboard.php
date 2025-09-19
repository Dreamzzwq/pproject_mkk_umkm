<?php require '../config.php'; if(!is_admin()) redirect('../login.php'); ?>
<?php
// create/update produk
if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['save_produk'])){
  $id = (int)($_POST['id'] ?? 0);
  $nama = $_POST['nama']; $harga = (int)$_POST['harga']; $stok=(int)$_POST['stok'];
  $id_kategori = (int)$_POST['id_kategori']; $deskripsi = $_POST['deskripsi'];

  // upload
  $foto = $_POST['foto_old'] ?? null;
  if(isset($_FILES['foto']) && $_FILES['foto']['error']==UPLOAD_ERR_OK){
    $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
    $fn = 'assets/' . time() . '_' . rand(100,999) . '.' . $ext;
    move_uploaded_file($_FILES['foto']['tmp_name'], __DIR__ . '/../' . $fn);
    $foto = $fn;
  }

  if($id){
    $stmt=$conn->prepare("UPDATE tb_produk SET nama=?,harga=?,stok=?,foto=?,deskripsi=?,id_kategori=? WHERE id=?");
    $stmt->bind_param("siissii",$nama,$harga,$stok,$foto,$deskripsi,$id_kategori,$id);
    $stmt->execute();
    flash('ok','Produk diperbarui.');
  }else{
    $stmt=$conn->prepare("INSERT INTO tb_produk(nama,harga,stok,foto,deskripsi,id_kategori) VALUES(?,?,?,?,?,?)");
    $stmt->bind_param("siissi",$nama,$harga,$stok,$foto,$deskripsi,$id_kategori);
    $stmt->execute();
    flash('ok','Produk ditambahkan.');
  }
  redirect('dashboard.php');
}

// delete produk
if(isset($_GET['del'])){
  $id=(int)$_GET['del'];
  $conn->query("DELETE FROM tb_produk WHERE id=".$id);
  flash('ok','Produk dihapus.');
  redirect('dashboard.php');
}

$kategori = $conn->query("SELECT * FROM tb_kategori ORDER BY nama_kategori")->fetch_all(MYSQLI_ASSOC);
$produk = $conn->query("SELECT p.*, k.nama_kategori FROM tb_produk p LEFT JOIN tb_kategori k ON p.id_kategori=k.id_kategori ORDER BY p.id DESC")->fetch_all(MYSQLI_ASSOC);
$pelanggan = $conn->query("SELECT id,nama,email,username,hp FROM tb_user WHERE role='pelanggan' ORDER BY id DESC")->fetch_all(MYSQLI_ASSOC);
$trans = $conn->query("SELECT t.*, u.nama FROM tb_transaksi t JOIN tb_user u ON t.id_pelanggan=u.id ORDER BY t.id_transaksi DESC")->fetch_all(MYSQLI_ASSOC);

// edit data produk
$edit = null;
if(isset($_GET['edit'])){
  $id=(int)$_GET['edit'];
  $s=$conn->prepare("SELECT * FROM tb_produk WHERE id=?"); $s->bind_param("i",$id); $s->execute();
  $edit=$s->get_result()->fetch_assoc();
}
?>
<!doctype html><html lang="id"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Dashboard Admin</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head><body>

<div class="container-fluid my-3">
  <?php if($m=flash('ok')): ?><div class="alert alert-success container"><?=e($m)?></div><?php endif; ?>
  <div class="row g-3">
    <div class="col-lg-4">
      <div class="card shadow-sm">
        <div class="card-body">
          <h5><?= $edit?'Edit':'Tambah' ?> Produk</h5>
          <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $edit['id'] ?? 0 ?>">
            <input type="hidden" name="foto_old" value="<?= $edit['foto'] ?? '' ?>">
            <div class="mb-2"><label class="form-label">Nama</label><input name="nama" class="form-control" value="<?= e($edit['nama'] ?? '') ?>" required></div>
            <div class="mb-2"><label class="form-label">Harga</label><input type="number" name="harga" class="form-control" value="<?= e($edit['harga'] ?? 0) ?>" required></div>
            <div class="mb-2"><label class="form-label">Stok</label><input type="number" name="stok" class="form-control" value="<?= e($edit['stok'] ?? 0) ?>" required></div>
            <div class="mb-2">
              <label class="form-label">Kategori</label>
              <select name="id_kategori" class="form-select" required>
                <option value="">-- Pilih Kategori --</option>
                <?php foreach($kategori as $k): ?>
                  <option value="<?=$k['id_kategori']?>" <?= isset($edit['id_kategori']) && $edit['id_kategori']==$k['id_kategori'] ? 'selected':'' ?>>
                    <?= e($k['nama_kategori']) ?>
                  </option>
                <?php endforeach; ?>
              </select>
              <div class="form-text">Nama kategori ditampilkan, value yang dikirim adalah <b>id_kategori</b>.</div>
            </div>
            <div class="mb-2"><label class="form-label">Foto</label><input type="file" name="foto" class="form-control"></div>
            <div class="mb-2"><label class="form-label">Deskripsi</label><textarea name="deskripsi" class="form-control" rows="3"><?= e($edit['deskripsi'] ?? '') ?></textarea></div>
            <button class="btn btn-primary mt-2" name="save_produk">Simpan</button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-lg-8">
      <div class="card shadow-sm mb-3">
        <div class="card-body">
          <h5>Data Produk</h5>
          <div class="table-responsive">
            <table class="table table-sm align-middle">
              <thead><tr><th>ID</th><th>Nama</th><th>Harga</th><th>Stok</th><th>Kategori</th><th></th></tr></thead>
              <tbody>
                <?php foreach($produk as $p): ?>
                  <tr>
                    <td><?=$p['id']?></td>
                    <td><?=e($p['nama'])?></td>
                    <td>Rp <?=number_format($p['harga'],0,',','.')?></td>
                    <td><?=$p['stok']?></td>
                    <td><?=e($p['nama_kategori'] ?? '-')?></td>
                    <td>x 
                      <a class="btn btn-sm btn-outline-primary" href="?edit=<?=$p['id']?>">Edit</a>
                      <a class="btn btn-sm btn-outline-danger" href="?del=<?=$p['id']?>" onclick="return confirm('Hapus produk ini?')">Hapus</a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="row g-3">
        <div class="col-lg-6">
          <div class="card shadow-sm h-100">
            <div class="card-body">
              <h5>Data Transaksi</h5>
              <div class="table-responsive" style="max-height:300px">
                <table class="table table-sm">
                  <thead><tr><th>ID</th><th>Pelanggan</th><th>Total</th><th>Tgl</th><th></th></tr></thead>
                  <tbody>
                    <?php foreach($trans as $t): ?>
                      <tr>
                        <td>#<?=$t['id_transaksi']?></td>
                        <td><?=e($t['nama'])?></td>
                        <td>Rp <?=number_format($t['total_harga'],0,',','.')?></td>
                        <td><?=$t['tanggal']?></td>
                        <td>
                          <a class="btn btn-sm btn-outline-secondary" href="transaksi_detail.php?id=<?=$t['id_transaksi']?>">Detail</a>
                          <a class="btn btn-sm btn-outline-danger" href="transaksi_delete.php?id=<?=$t['id_transaksi']?>" onclick="return confirm('Hapus transaksi?')">Hapus</a>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card shadow-sm h-100">
            <div class="card-body">
              <h5>Data Pelanggan</h5>
              <div class="table-responsive" style="max-height:300px">
                <table class="table table-sm">
                  <thead><tr><th>Nama</th><th>Email</th><th>HP</th><th></th></tr></thead>
                  <tbody>
                    <?php foreach($pelanggan as $pl): ?>
                      <tr>
                        <td><?=e($pl['nama'])?></td><td><?=e($pl['email'])?></td><td><?=e($pl['hp'])?></td>
                        <td><a class="btn btn-sm btn-outline-warning" href="reset_password.php?id=<?=$pl['id']?>" onclick="return confirm('Reset password ke 123456?')">Reset Password</a></td>
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
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body></html>
