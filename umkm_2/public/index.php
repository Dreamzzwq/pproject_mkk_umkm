<?php require 'config.php'; ?>
<?php
// ambil kategori & filter
$kat = $conn->query("SELECT * FROM tb_kategori ORDER BY nama_kategori")->fetch_all(MYSQLI_ASSOC);
$selected = isset($_GET['kat']) ? (int)$_GET['kat'] : 0;

if($selected>0){
  $stmt = $conn->prepare("SELECT p.*, k.nama_kategori FROM tb_produk p LEFT JOIN tb_kategori k ON p.id_kategori=k.id_kategori WHERE p.id_kategori=?");
  $stmt->bind_param("i",$selected);
  $stmt->execute();
  $produk = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
} else {
  $produk = $conn->query("SELECT p.*, k.nama_kategori FROM tb_produk p LEFT JOIN tb_kategori k ON p.id_kategori=k.id_kategori ORDER BY p.id DESC")->fetch_all(MYSQLI_ASSOC);
}
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>index</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include '_navbar.php'; ?>

<header class="container my-4">
  <div id="homeCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner rounded-4 shadow-sm">
      <div class="carousel-item active">
        <img src="assets/slide1.png" class="d-block w-100" alt="Slide 1">
        <div class="carousel-caption d-none d-md-block">
          <h5></h5><p></p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="assets/slide2.jpg" class="d-block w-100" alt="Slide 2">
        <div class="carousel-caption d-none d-md-block">
          <h5></h5><p></p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="assets/slide3.jpg" class="d-block w-100" alt="Slide 3">
        <div class="carousel-caption d-none d-md-block">
          <h5>Test</h5><p>Test</p>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#homeCarousel" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
    <button class="carousel-control-next" type="button" data-bs-target="#homeCarousel" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
  </div>
</header>

<div class="container mb-5">
  <div class="d-flex align-items-center justify-content-between mb-3">
    <h4 class="m-0">Produk</h4>
    <form class="d-flex" method="get">
      <select name="kat" class="form-select me-2" onchange="this.form.submit()">
        <option value="0">Semua Kategori</option>
        <?php foreach($kat as $k): ?>
          <option value="<?=$k['id_kategori']?>" <?= $selected==$k['id_kategori']?'selected':'' ?>><?=e($k['nama_kategori'])?></option>
        <?php endforeach; ?>
      </select>
      <?php if($selected): ?><a class="btn btn-outline-secondary" href="index.php">Reset</a><?php endif; ?>
    </form>
  </div>
  <div class="row g-4">
    <?php foreach($produk as $p): ?>
      <div class="col-6 col-md-4 col-lg-3">
        <div class="card h-100 shadow-sm">
          <img src="<?= e($p['foto'] ?: 'assets/noimage.jpg') ?>" class="card-img-top" alt="">
          <div class="card-body d-flex flex-column">
            <h6 class="card-title"><?= e($p['nama']) ?></h6>
            <small class="text-muted mb-2"><?= e($p['nama_kategori'] ?? 'Tanpa Kategori') ?></small>
            <div class="mt-auto">
              <div class="fw-bold mb-2">Rp <?= number_format($p['harga'],0,',','.') ?></div>
              <form action="add_to_cart.php" method="post" class="d-flex gap-2">
                <input type="hidden" name="id" value="<?=$p['id']?>">
                <input type="number" name="qty" value="1" min="1" class="form-control form-control-sm" style="max-width:90px">
                <button class="btn btn-sm btn-primary">Tambah</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
    <?php if(empty($produk)): ?>
      <div class="col-12"><div class="alert alert-info">Belum ada produk.</div></div>
    <?php endif; ?>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
