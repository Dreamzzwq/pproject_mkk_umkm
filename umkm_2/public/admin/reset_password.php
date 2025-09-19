<?php require '../config.php'; if(!is_admin()) redirect('../login.php');
$id=(int)($_GET['id']??0);
$hash=password_hash('123456', PASSWORD_BCRYPT);
$stmt=$conn->prepare("UPDATE tb_user SET password=? WHERE id=?"); $stmt->bind_param("si",$hash,$id); $stmt->execute();
flash('ok','Password pelanggan direset ke 123456.');
redirect('dashboard.php');
