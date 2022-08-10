<?php
session_start();
include 'config/db.php';
include 'config/config.php';
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
    <title>Reconn</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">



    <!-- Bootstrap core CSS -->
    <link href="        https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">

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

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse" style="min-height: calc(100vh - 50px);">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">
              <span data-feather="scans"></span>
              Scans
            </a>
          </li>


        </ul>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Scans</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
        <button class="btn btn-sm btn-dark m-1" disabled><i class="fa-solid fa-user"></i> <?= htmlspecialchars($_SESSION['username']); ?></button>

        <a href="home.php"><button type="button" class="btn btn-sm btn-outline-success m-1"><i class="fa-solid fa-house"></i> Home</button></a>

        </div>
      </div>

      <!-- Main Section -->
      <?php
if (isset($_GET['message']) && $_GET['message'] == 'http_error_1' )
{
     echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
     Invalid URL value!
   </div>';
}

if (isset($_GET['message']) && $_GET['message'] == 'http_error_2' )
{
     echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
     Cannot use http:// on testssl scan. Use https:// instead.
   </div>';
}

if (isset($_GET['message']) && $_GET['message'] == 'http_error_3' )
{
     echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
     Choose a wordlist on feroxbuster scan!
   </div>';
}
?>

      <form method="post" action="functions/add_scan.php">
        <label for="basic-url" class="form-label">Project Name</label>
        <div class="input-group mb-3">
        <input type="text" class="form-control" name="project_name" placeholder="Project Name" aria-label="project-name" aria-describedby="basic-addon1" required>
        </div>
        <label for="basic-url" class="form-label">URL</label>
        <div class="input-group mb-3">
        <input type="text" class="form-control" name="url" placeholder="e.g https://example.com" aria-label="Recipient's username" aria-describedby="basic-addon2" required>
        </div>

        <label for="basic-url" class="form-label">Select Tools:</label>

        <div class="form-check form-switch">
        <label class="form-check-label" for="flexSwitchCheckDefault">Nikto
        <input class="form-check-input" name="nikto_check" type="checkbox" role="switch" id="flexSwitchCheckDefault"></input>
        </label>
        </div>

        <!-- whatweb form -->
        <div class="form-check form-switch">
        <label class="form-check-label" for="flexSwitchCheckDefault">Whatweb</label>
        <input class="form-check-input" name="whatweb_check" type="checkbox" role="switch" id="whatweb_chk"></input>
        </div>

        <div class="form-check form-switch">
        <input class="form-check-input" name="wafw00f_check" type="checkbox" role="switch" id=""></input>
        <label class="form-check-label" for="flexSwitchCheckChecked">Wafw00f</label>
        </div>

        <div class="form-check form-switch">
        <input class="form-check-input" name="testssl_check" type="checkbox" role="switch" id=""></input>
        <label class="form-check-label" for="flexSwitchCheckChecked">Testssl</label>
        </div>

        <div class="form-check form-switch">
        <input class="form-check-input" name="feroxbuster_check" type="checkbox" role="switch" id="feroxbuster_chk"></input>
        <label class="form-check-label" for="flexSwitchCheckChecked">Feroxbuster</label>
        </div>

        <div id="feroxbuster_params" style="display: none;" class="m-2">
          <span class="fw-semibold">Wordlist: <span class="fst-italic text-muted">(required)</span></span>

        <div class="form-check">
          <input class="form-check-input" type="radio" id="flexRadioDefault1" value="common.txt" name="feroxbuster_wordlist">
          <label class="form-check-label" for="flexRadioDefault1">
            common.txt <a href="https://github.com/danielmiessler/SecLists/blob/master/Discovery/Web-Content/common.txt" class="text-decoration-none">[Source]</a>
          </label>
        </div>

        <div class="form-check">
          <input class="form-check-input" type="radio" id="flexRadioDefault1" value="big.txt" name="feroxbuster_wordlist">
          <label class="form-check-label" for="flexRadioDefault1">
            big.txt <a href="https://github.com/danielmiessler/SecLists/blob/master/Discovery/Web-Content/big.txt" class="text-decoration-none">[Source]</a>
          </label>
        </div>

        <div class="form-check">
          <input class="form-check-input" type="radio" id="flexRadioDefault1" value="directory-list-2.3-medium.txt" name="feroxbuster_wordlist">
          <label class="form-check-label" for="flexRadioDefault1">
            directory-list-2.3-medium.txt <a href="https://github.com/danielmiessler/SecLists/blob/master/Discovery/Web-Content/directory-list-2.3-medium.txt" class="text-decoration-none">[Source]</a>
          </label>
        </div>
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-outline-primary btn-sm align-items-end m-1" data-bs-toggle="modal" data-bs-target="#exampleModal">Save</button>
          </div>
        </form>
      <!-- Main Section End -->



    </main>
  </div>
</div>

<script>
let inputSubmit = document.getElementsByClassName('form-check-input')
for (let i = 0; i < inputSubmit.length; i++) {
  inputSubmit[i].addEventListener('click', () => {
    if (inputSubmit[i].getAttribute("value") == null) {
      inputSubmit[i].setAttribute("value", '1');
    } else if (inputSubmit[i].getAttribute("value") == '1') {
      inputSubmit[i].removeAttribute("value");
    }
  })
}


// let removeCheck = document.getElementsByClassName('form-check-input')
// for (let i = 0; i < inputSubmit.length; i++) {
//   inputSubmit[i].addEventListener('click', () => {
//     inputSubmit[i].removeAttribute('value');
//   })
// }
</script>

    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
    $(document).ready(function() {
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
            });
        }, 1500);
    });

    $(function () {
        $("#whatweb_chk").click(function () {
            if ($(this).is(":checked")) {
                $("#whatweb_params").show();
            } else {
                $("#whatweb_params").hide();
            }
        });
    });

    $(function () {
        $("#feroxbuster_chk").click(function () {
            if ($(this).is(":checked")) {
                $("#feroxbuster_params").show();
            } else {
                $("#feroxbuster_params").hide();
            }
        });
    });

      </script>
      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
    </body>
</html>
