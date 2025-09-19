<?php
session_start();

$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASS = 'rizkynolimit';
$DB_NAME = 'db_toko';

$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if ($conn->connect_error) { die("Koneksi gagal: " . $conn->connect_error); }

function is_logged_in() { return isset($_SESSION['user']); }
function is_admin() { return is_logged_in() && $_SESSION['user']['role'] === 'admin'; }
function is_customer() { return is_logged_in() && $_SESSION['user']['role'] === 'pelanggan'; }

function redirect($to) {
  header("Location: " . $to);
  exit;
}

function e($str){ return htmlspecialchars($str, ENT_QUOTES, 'UTF-8'); }

function flash($key, $msg=null){
  if($msg!==null){ $_SESSION['flash'][$key]=$msg; return; }
  if(isset($_SESSION['flash'][$key])){ $m=$_SESSION['flash'][$key]; unset($_SESSION['flash'][$key]); return $m; }
  return null;
}
?>
