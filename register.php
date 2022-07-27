<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Basic Web Reconnaissance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
  <body>

  <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Basic Web Reconnaissance</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <a class="nav-link px-3" href="#">Sign out</a>
    </div>
  </div>
</header>
    <br><br>



    <!-- Form -->
  <div class="card mx-auto" style="width: 400px">
  <div class="card-body">
    <h5 class="card-title text-center">Welcome!</h5>
    <h6 class="card-subtitle mb-2 text-muted text-center">Basic Web Reconnaissance</h6>
    <form method="post" action="functions/register.php">
          <!-- Alert if registration Failed-->
<?php
    if (isset($_GET['message']) && $_GET['message'] == 'failed' )
{
     echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
     Password was not the same with the password confirmation!
     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
   </div>';
}
?>
  <div class="mb-3">
    <label for="exampleUsername" class="form-label">Username</label>
    <input type="text" name="username" class="form-control" id="exampleUsername" aria-describedby="Username">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword2" class="form-label">Password Confirmation</label>
    <input type="password" name="password_conf" class="form-control" id="exampleInputPassword2">
  </div>
  <div class="d-grid gap-2">
  <button type="submit" class="btn btn-primary">Register</button>
  </div>
</form>

<br>
<p class="card-text text-end text-muted">Already Registered?</p>
    <p class="text-end"><a href="index.php" class="card-link">Log In Here!</a></p>
  </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </body>
</html>