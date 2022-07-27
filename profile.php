<?php
session_start();
include 'config/config.php';
include 'config/db.php';
$conn = OpenCon();
if (!isset($_SESSION['username'])) {
  header('Location: ' . $base_url . '/index.php');
  die();
}
  ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Basic Web Reconnaissance</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">

    

    <!-- Bootstrap core CSS -->
<link href=" 	https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="assets/css/dashboard.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/6c966798cf.js" crossorigin="anonymous"></script>
  </head>
  <body>
    
  <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Basic Web Reconnaissance</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
    <a class="nav-link p-2" href="functions/logout.php">Log Out <i class="fa-solid fa-power-off p-1"></i></a>
    </div>
  </div>
</header>

    <main class="col-md-9 ms-sm-auto col-lg-12 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 fw-semibold"><i class="fa-solid fa-id-badge"></i> My Profile</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          
            <a href="home.php"><button type="button" class="btn btn-sm btn-outline-success m-1"><i class="fa-solid fa-house"></i> Home</button></a>
          
        </div>
      </div>

      <!-- Main Section -->
    <div class="card mx-auto" style="width: 500px;">
    <div class="card-body">
    <form method="post" action="functions/profile.php">
    <h5 class="card-title fw-semibold">Details</h5>
    <hr>
        <label for="basic-url" class="form-label">Username</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" value="<?= htmlspecialchars($_SESSION['username']); ?>" disabled readonly> 
            </div>
            <br>
            <h5 class="card-title fw-semibold">Change Password</h5>
            <hr>

        <label for="basic-url" class="form-label">Current Password</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" placeholder="●●●●●●●●●"> 
            </div>
        <label for="basic-url" class="form-label">New Password</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" placeholder="●●●●●●●●●"> 
            </div>
        <label for="basic-url" class="form-label">Confirm Password</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" placeholder="●●●●●●●●●"> 
            </div>
        <a href="#" class="btn btn-outline-primary">Change Password</a>
    </form>
    </div>
    </div>
    <br>
    </main>
      <!-- Main Section End -->
    


  </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
  </body>
</html>
