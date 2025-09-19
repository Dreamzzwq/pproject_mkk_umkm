<?php require_once __DIR__.'/config.php'; ?>
<nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom sticky-top">
  <div class="container">

  
    <a class="navbar-brand fw-bold" href="index.php">
      <img src="assets/logo.png" alt="Logo" height="50">
    </a>
   
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="nav">
      <ul class="navbar-nav mb-2 mb-lg-0">
     
        <li class="nav-item"><a class="nav-link" href="index.php">Beranda</a></li>
        <li class="nav-item"><a class="nav-link" href="about.php">About Me</a></li>
        <li class="nav-item"><a class="nav-link" href="cart.php">Keranjang</a></li>

       
        <?php if(is_admin()): ?>
          <li class="nav-item"><a class="nav-link" href="admin/dashboard.php">Dashboard</a></li>
        <?php endif; ?>

      
        <?php if(is_logged_in()): ?>
          <li class="nav-item"><a class="nav-link" href="profile.php">Hai, <?=e($_SESSION['user']['nama'])?></a></li>
          <li class="nav-item">
            <a class="nav-link text-danger fw-bold" href="logout.php">Logout</a>
          </li>
        <?php else: ?>
      
          <li class="nav-item">
            <a class="btn btn-sm btn-primary" href="login.php">Login / Register</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
