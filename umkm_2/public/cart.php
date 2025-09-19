<?php require 'config.php'; ?>
<?php
$cart = $_SESSION['cart'] ?? [];
if(isset($_POST['action'])){
  if($_POST['action']==='update'){
    foreach($_POST['qty'] as $id=>$q){
      $q = max(1,(int)$q);
      if(isset($cart[$id])) $cart[$id]['qty']=$q;
    }
    $_SESSION['cart']=$cart;
  } elseif($_POST['action']==='remove'){
    $id=(int)$_POST['id']; unset($_SESSION['cart'][$id]);
  }
  header("Location: cart.php"); exit;
}

$total = 0;
foreach($cart as $it){ $total += $it['harga'] * $it['qty']; }
?>
<!doctype html>
<html lang="id"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Keranjang</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head><body>
<?php include '_navbar.php'; ?>
<div class="container my-4">
  <h4>Keranjang</h4>
  <form method="post">
    <input type="hidden" name="action" value="update">
    <div class="table-responsive">
      <table class="table align-middle">
        <thead><tr><th>Produk</th><th>Harga</th><th>Qty</th><th>Subtotal</th><th></th></tr></thead>
        <tbody>
          <?php foreach($cart as $id=>$it): $sub=$it['harga']*$it['qty']; ?>
          <tr>
            <td class="d-flex align-items-center gap-2">
              <img src="<?=e($it['foto']?:'assets/noimage.jpg')?>" width="60">
              <div><?=e($it['nama'])?></div>
            </td>
            <td>Rp <?=number_format($it['harga'],0,',','.')?></td>
            <td style="max-width:110px"><input type="number" class="form-control" name="qty[<?=$id?>]" value="<?=$it['qty']?>" min="1"></td>
            <td>Rp <?=number_format($sub,0,',','.')?></td>
            <td>
              <form method="post" class="d-inline">
                <input type="hidden" name="action" value="remove">
                <input type="hidden" name="id" value="<?=$id?>">
                <button class="btn btn-sm btn-outline-danger">Hapus</button>
              </form>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <div class="d-flex justify-content-between">
      <a class="btn btn-outline-secondary" href="index.php">Tambah Produk</a>
      <div class="d-flex gap-2">
        <button class="btn btn-outline-primary">Reset</button>
      </div>
    </div>
  </form>

  <hr>
  <div class="row">
    <div class="col-md-6">
      <form action="checkout.php" method="post" class="card p-3 shadow-sm">
        <h5>Checkout</h5>
        <?php if(!is_logged_in()): ?>
          <div class="alert alert-warning">Anda harus <a href="login.php">login</a> untuk melakukan transaksi.</div>
        <?php endif; ?>
        <div class="mb-2">
          <label class="form-label">Metode Pembayaran</label>
          <select name="metode_bayar" class="form-select">
            <option>Qris</option>
            <option>Bank</option>
            <option>Bri</option>
            <option>Bca</option>
             <select name="metode_bayar" class="form-select">
        <div class="mb-2">
          <label class="form-label">Metode Pengiriman</label>
          <select name="metode_kirim" class="form-select">
            <option>Grab Express</option>
            <option>Silintar Delivery</option>
            <option>Ambil Di toko</option>
          </select>
        </div>
        <div class="mb-2">
          <label class="form-label">Alamat Pengiriman</label>
          <input name="alamat_kirim" class="form-control" value="<?= e($_SESSION['user']['alamat'] ?? '') ?>" required>
        </div>
        <div class="d-flex justify-content-between mt-2">
          <div class="fw-bold fs-5">Total: Rp <?=number_format($total,0,',','.')?></div>
          <button class="btn btn-success" <?= empty($cart)||!is_logged_in()?'disabled':''; ?>>Beli</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body></html>
