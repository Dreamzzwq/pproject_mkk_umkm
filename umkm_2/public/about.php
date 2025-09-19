<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kopi Kenangan</title>
  <style>
    
    body {margin:0; font-family: Arial, sans-serif; line-height:1.6; color:#333;}
    header {display:flex; justify-content:space-between; align-items:center; padding:15px 40px; background:#fff; position:sticky; top:0; border-bottom:1px solid #eee;}
    header img {height:40px;}
    nav ul {display:flex; list-style:none; margin:0; padding:0;}
    nav ul li {margin-left:20px;}
    nav ul li a {text-decoration:none; color:#333; font-weight:500;}
    .hero {width:100%; height:350px; background:url('https://picsum.photos/1600/500') center/cover no-repeat;}
    .section {padding:60px 20px; max-width:1000px; margin:auto; text-align:center;}
    .section h2 {margin-bottom:20px;}
    .about img {width:200px; border-radius:10px;}
    .news {display:flex; justify-content:space-around; flex-wrap:wrap;}
    .news-item {width:250px; margin:20px;}
    .app img {height:50px; margin:10px;}
    .promo img {max-width:400px; width:100%; border-radius:10px;}
    .products {margin:30px 0;}
    .products button {margin:10px; padding:12px 20px; border:none; border-radius:20px; background:#000; color:#fff; cursor:pointer;}
    .gallery {display:grid; grid-template-columns:repeat(auto-fit, minmax(200px, 1fr)); gap:15px;}
    .gallery img {width:100%; border-radius:10px;}
    footer {background:#111; color:#fff; padding:40px 20px; text-align:center;}
    footer small {display:block; margin-top:10px; color:#bbb;}
  </style>
</head>
<body>

<?php include '_navbar.php'; ?>

  <div class="hero"></div>

  <section class="section">
    <h2>Kopi Kenangan Stands For Coffee Memories.</h2>
  </section>

  <section class="section about">
    <img src="https://picsum.photos/200" alt="Founder">
    <p><i>"At Kopi Kenangan, our dream is to serve high quality coffee, made with the freshest local ingredients to customers across Indonesia – and the rest of the world."</i></p>
    <p><b>— Edward Tirtanata, CEO and Founder</b></p>
  </section>

  <section class="section">
    <h2>News</h2>
    <div class="news">
      <div class="news-item">
        <h3>Halal Certification</h3>
        <p>Komitmen kami untuk menyajikan kopi berkualitas terbaik sudah diakui dengan sertifikat halal.</p>
      </div>
      <div class="news-item">
        <h3>World’s Best Brand</h3>
        <p>Kopi Kenangan berhasil meraih penghargaan dari World Branding Awards.</p>
      </div>
      <div class="news-item">
        <h3>Coffee Journey</h3>
        <p>Perjalanan kopi kami dimulai dari petani terbaik untuk memberikan kualitas terbaik.</p>
      </div>
    </div>
  </section>

  <section class="section app">
    <h2>Kopi Kenangan App</h2>
    <p>Order kopi favoritmu dengan mudah lewat aplikasi resmi kami.</p>
    <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg" alt="Google Play">
    <img src="https://upload.wikimedia.org/wikipedia/commons/9/96/Download_on_the_App_Store_Badge.svg" alt="App Store">
  </section>

  <section class="section promo">
    <h2>Promo Of The Month</h2>
    <img src="https://via.placeholder.com/400x200.png?text=Promo+Kopi+Kenangan" alt="Promo">
  </section>

  <section class="section products">
    <h2>Beli Di Sini</h2>
    <button>Outlet Terdekat</button>
    <button>Aplikasi Kopi Kenangan</button>
  </section>

  <section class="section gallery">
    <img src="https://picsum.photos/300/200?1">
    <img src="https://picsum.photos/300/200?2">
    <img src="https://picsum.photos/300/200?3">
    <img src="https://picsum.photos/300/200?4">
    <img src="https://picsum.photos/300/200?5">
    <img src="https://picsum.photos/300/200?6">
  </section>
</body>
</html>
