<?php require '../config.php'; if(!is_admin()) redirect('../login.php');
$id = (int)($_GET['id'] ?? 0);
$trx = $conn->query("SELECT t.*, u.nama FROM tb_transaksi t JOIN tb_user u ON t.id_pelanggan=u.id WHERE t.id_transaksi=$id")->fetch_assoc();
$items = $conn->query("SELECT d.*, p.nama FROM tb_detail d JOIN tb_produk p ON d.id_produk=p.id WHERE d.id_transaksi=$id")->fetch_all(MYSQLI_ASSOC);
?>
<!doctype html><html lang="id"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Detail Transaksi</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head><body>
<?php include '../_navbar.php'; ?>
<div class="container my-4">
  <h4>Transaksi #<?=$id?></h4>
  <div class="mb-2">Pelanggan: <?=e($trx['nama'])?> | Tanggal: <?=$trx['tanggal']?> | Total: Rp <?=number_format($trx['total_harga'],0,',','.')?></div>
  <a class="btn btn-sm btn-outline-secondary" href="../invoice.php?id=<?=$id?>">Cetak Invoice</a>
  <div class="table-responsive mt-3">
    <table class="table table-bordered">
      <thead><tr><th>Produk</th><th>Qty</th><th>Harga</th><th>Subtotal</th></tr></thead>
      <tbody>
        <?php foreach($items as $it): ?>
          <tr><td><?=e($it['nama'])?></td><td><?=$it['jumlah']?></td><td><?=$it['harga_satuan']?></td><td><?=$it['subtotal']?></td></tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
</body></html>
