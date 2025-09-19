<?php require 'config.php';
$id = (int)($_GET['id'] ?? 0);
$stmt = $conn->prepare("SELECT t.*, u.nama, u.email, u.hp, u.alamat FROM tb_transaksi t JOIN tb_user u ON t.id_pelanggan=u.id WHERE t.id_transaksi=?");
$stmt->bind_param("i",$id);
$stmt->execute();
$trx = $stmt->get_result()->fetch_assoc();
if(!$trx){ die('Transaksi tidak ditemukan.'); }

$det = $conn->prepare("SELECT d.*, p.nama FROM tb_detail d JOIN tb_produk p ON d.id_produk=p.id WHERE d.id_transaksi=?");
$det->bind_param("i",$id);
$det->execute();
$items = $det->get_result()->fetch_all(MYSQLI_ASSOC);
?>
<!doctype html><html lang="id"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Invoice #<?=$id?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-white">
  <?php include '_navbar.php'; ?>
<div class="container my-4">
  <div class="d-flex justify-content-between align-items-center">
    <h3>Invoice #<?=$id?></h3>
    <button class="btn btn-outline-secondary" onclick="window.print()">Cetak</button>
  </div>
  <hr>
  <div class="row">
    <div class="col-md-6">
      <h6>Untuk:</h6>
      <div><?=e($trx['nama'])?><br><?=e($trx['email'])?><br><?=e($trx['hp'])?><br><?=e($trx['alamat_kirim'] ?: $trx['alamat'])?></div>
    </div>
    <div class="col-md-6 text-md-end">
      <div>Tanggal: <?= e($trx['tanggal']) ?></div>
      <div>Pembayaran: <?= e($trx['metode_bayar']) ?></div>
      <div>Pengiriman: <?= e($trx['metode_kirim']) ?></div>
      <div>Status: <?= e($trx['status']) ?></div>
    </div>
  </div>
  <div class="table-responsive my-3">
    <table class="table table-bordered">
      <thead><tr><th>Produk</th><th>Qty</th><th>Harga</th><th>Subtotal</th></tr></thead>
      <tbody>
        <?php foreach($items as $it): ?>
          <tr>
            <td><?=e($it['nama'])?></td>
            <td><?=$it['jumlah']?></td>
            <td>Rp <?=number_format($it['harga_satuan'],0,',','.')?></td>
            <td>Rp <?=number_format($it['subtotal'],0,',','.')?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
      <tfoot>
        <tr><th colspan="3" class="text-end">Total</th><th>Rp <?=number_format($trx['total_harga'],0,',','.')?></th></tr>
      </tfoot>
    </table>
  </div>
</div>
</body>
</html>