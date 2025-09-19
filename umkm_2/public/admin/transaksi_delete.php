<?php require '../config.php'; if(!is_admin()) redirect('../login.php');
$id=(int)($_GET['id']??0);
$conn->query("DELETE FROM tb_transaksi WHERE id_transaksi=".$id);
flash('ok','Transaksi dihapus.');
redirect('dashboard.php');
