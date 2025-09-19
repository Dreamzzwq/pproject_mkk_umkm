<?php require 'config.php';
$id = (int)($_POST['id'] ?? 0);
$qty = max(1, (int)($_POST['qty'] ?? 1));
$stmt = $conn->prepare("SELECT id,nama,harga,foto FROM tb_produk WHERE id=? LIMIT 1");
$stmt->bind_param("i",$id);
$stmt->execute();
$p = $stmt->get_result()->fetch_assoc();
if(!$p){ flash('err','Produk tidak ditemukan.'); redirect('index.php'); }

$_SESSION['cart'] = $_SESSION['cart'] ?? [];
if(isset($_SESSION['cart'][$id])){
  $_SESSION['cart'][$id]['qty'] += $qty;
} else {
  $_SESSION['cart'][$id] = ['id'=>$p['id'],'nama'=>$p['nama'],'harga'=>$p['harga'],'foto'=>$p['foto'],'qty'=>$qty];
}
flash('ok','Produk masuk keranjang.');
redirect('cart.php');
