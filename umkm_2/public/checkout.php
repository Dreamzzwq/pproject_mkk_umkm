<?php require 'config.php';
if(!is_logged_in()) redirect('login.php');
$cart = $_SESSION['cart'] ?? [];
if(!$cart){ flash('err','Keranjang kosong.'); redirect('cart.php'); }

$metode_bayar = $_POST['metode_bayar'] ?? 'Transfer Bank';
$metode_kirim = $_POST['metode_kirim'] ?? 'JNE';
$alamat_kirim = $_POST['alamat_kirim'] ?? '';

$total = 0; foreach($cart as $it){ $total += $it['harga']*$it['qty']; }

$conn->begin_transaction();
try{
  $stmt = $conn->prepare("INSERT INTO tb_transaksi (id_pelanggan,total_harga,metode_bayar,metode_kirim,alamat_kirim,status) VALUES (?,?,?,?,?,'baru')");
  $stmt->bind_param("iisss", $_SESSION['user']['id'],$total,$metode_bayar,$metode_kirim,$alamat_kirim);
  $stmt->execute();
  $id_transaksi = $stmt->insert_id;

  $stmtDet = $conn->prepare("INSERT INTO tb_detail (id_transaksi,id_produk,jumlah,harga_satuan,subtotal) VALUES (?,?,?,?,?)");
  foreach($cart as $it){
    $sub = $it['harga']*$it['qty'];
    $stmtDet->bind_param("iiiis",$id_transaksi,$it['id'],$it['qty'],$it['harga'],$sub);
    $stmtDet->execute();
   
    $up = $conn->prepare("UPDATE tb_produk SET stok = GREATEST(stok-?,0) WHERE id=?");
    $up->bind_param("ii",$it['qty'],$it['id']);
    $up->execute();
  }
  $conn->commit();
  unset($_SESSION['cart']);
  redirect('invoice.php?id=' . $id_transaksi);
}catch(Exception $e){
  $conn->rollback();
  flash('err','Gagal checkout: '.$e->getMessage());
  redirect('cart.php');
}
