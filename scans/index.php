<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: ../index.php");
  die();
}

    include '../config/db.php';
    $conn = OpenCon();
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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">

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
    <link href="../assets/css/dashboard.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/6c966798cf.js" crossorigin="anonymous"></script>
  </head>
  <body>
    
  <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="../home.php">Horangi Recon</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
    <a class="nav-link p-2" href="../functions/logout.php">Log Out <i class="fa-solid fa-power-off p-1"></i></a>
    </div>
  </div>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse" style="min-height: calc(100vh - 50px);">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../index.php">
              <span data-feather="scans"></span>
              Scans
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">
              <span data-feather="reports"></span>
              Reports
            </a>
          </li>
        </ul>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">
        <?php
              $id = $_GET['id'];
              $project_id = $_SESSION['project_id'];
              $sql = "SELECT id, project_owner_id, urls, project_name, nikto, whatweb, wafw00f, testssl, dirsearch FROM projects WHERE id = '$id' AND project_owner_id ='$project_id'";
              $result = $conn->query($sql);
              $value = $result->fetch_assoc();
              ?> 
        <p class="h1"><?= htmlspecialchars($value['project_name']); ?></p>
        <hr>
        <p class="h5 text-muted"><em><?= htmlspecialchars($value['urls']); ?></em></p>
        </h1>
        <div class="btn-toolbar mb-2 mb-md-0">
        <a href="../functions/export.php"><button type="button" class="btn btn-sm btn-outline-primary m-1"><i class="fa-solid fa-file-export"></i></button></a>
        <a href="../profile.php"><button type="button" class="btn btn-sm btn-outline-dark m-1"><i class="fa-solid fa-user"></i> <?= htmlspecialchars($_SESSION['username']); ?></button></a>
        <a href="../home.php"><button type="button" class="btn btn-sm btn-outline-success m-1"><i class="fa-solid fa-house"></i> Home</button></a>        
        </div>
      </div>

      <!-- Main Section -->
      <div class="table-responsive">
        <table class="table table-striped table-borderless">
          <thead>
            <tr>
              <th scope="col">Tools</th>
              <th scope="col">Details</th>
            </tr>
          </thead>
          <tbody>  


          <?php
            if ($value['nikto'] === '1') {
              $parse_filename_nikto = '/opt/lampp/htdocs/horangi_recon/scan_results/nikto_' . $id . '_' . $_SESSION['project_id'] . '.txt';
              $nikto_result = fopen($parse_filename_nikto, "r") or die("Unable to open file!");
              $nikto_file = fread($nikto_result,filesize($parse_filename_nikto));
              fclose($nikto_result);
              echo '
              <!-- Nikto -->
            <tr>
            <td class="text-center"><p class="fs-6 fw-semibold">Nikto</p></td>
            <!-- Button trigger modal -->
            <td>
            <div class="d-grid gap-2">
            <button type="button" class="btn btn-outline-primary btn-sm align-items-end m-1" data-bs-toggle="modal" data-bs-target="#nikto_modal">Show Detail</button>
          </div>            
            </td>
            <!-- Nikto Modal -->
            <div class="modal fade bd-example-modal-lg" id="nikto_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                  <div class="modal-header" style="background-color: #353839; color: white;">
                    <h5 class="modal-title" id="exampleModalLabel"><p class="fs-4 fw-semibold">Nikto Result</p></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body" style="background-color: #353839; color: white;">
                  <pre style="white-space: pre-line;">
                  ' . $nikto_file . '
                  </pre>
                  </div>
                  <div class="modal-footer" style="background-color: #353839; color: white;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- Nikto Modal End -->
            
            </tr>
            <!-- Nikto End--> 
              ';
            } else {
              echo '';
            }
          ?>                          
            <?php
            if ($value['whatweb'] === '1') {
              $parse_filename_whatweb = '/opt/lampp/htdocs/horangi_recon/scan_results/whatweb_' . $id . '_' . $_SESSION['project_id'] .'.txt';
              $whatweb_result = fopen($parse_filename_whatweb, "r") or die("Unable to open file!");
              $whatweb_file = fread($whatweb_result,filesize($parse_filename_whatweb));
              fclose($whatweb_result);
              echo '
              <!-- Whatweb -->
            <tr>
            <td class="text-center" style="vertical-align: middle;"><p class="fs-6 fw-semibold">Whatweb</p></td>
            <!-- Button trigger modal -->
            <td>
            <div class="d-grid gap-2">
            <button type="button" class="btn btn-outline-primary btn-sm align-items-end m-1" data-bs-toggle="modal" data-bs-target="#whatweb_modal">Show Detail</button>
          </div>            
            </td>
            <!-- Whatweb Modal -->
            <div class="modal fade bd-example-modal-lg" id="whatweb_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                  <div class="modal-header" style="background-color: #353839; color: white;">
                    <h5 class="modal-title" id="exampleModalLabel"><p class="fs-4 fw-semibold p-1 m-1">Whatweb Result</p></h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body" style="background-color: #353839; color: white;">
                  <pre style="white-space: pre-line;">
                  ' . $whatweb_file . '
                  </pre> 
                  </div>
                  <div class="modal-footer" style="background-color: #353839; color: white;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- Whatweb Modal End -->
            
            </tr>
            <!-- Whatweb End--> 
              ';
            } else {
              echo '';
            }
          ?>  
            
            <?php
            if ($value['wafw00f'] === '1') {
              $parse_filename_wafw00f = '/opt/lampp/htdocs/horangi_recon/scan_results/wafw00f_' . $id . '_' . $_SESSION['project_id'] . '.txt';
              $wafw00f_result = fopen($parse_filename_wafw00f, "r") or die("Unable to open file!");
              $wafw00f_file = fread($wafw00f_result,filesize($parse_filename_wafw00f));
              fclose($wafw00f_result);
              echo '
              <!-- Wafw00f -->
            <tr>
            <td class="text-center"><p class="fs-6 fw-semibold">Wafw00f</p></td>
            <!-- Button trigger modal -->
            <td>
            <div class="d-grid gap-2">
            <button type="button" class="btn btn-outline-primary btn-sm align-items-end m-1" data-bs-toggle="modal" data-bs-target="#wafw00f_modal">Show Detail</button>
          </div>            
            </td>
            <!-- Wafw00f Modal -->
            <div class="modal fade bd-example-modal-lg" id="wafw00f_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                  <div class="modal-header" style="background-color: #353839; color: white;">
                    <h5 class="modal-title" id="exampleModalLabel"><p class="fs-4 fw-semibold p-1 m-1">Whatweb Result</p></h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body" style="background-color: #353839; color: white;">
                    <pre>
                      ' . $wafw00f_file . '
                    </pre>
                  </div>
                  <div class="modal-footer" style="background-color: #353839; color: white;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- Wafw00f Modal End -->
            
            </tr>
            <!-- Wafw00f End--> 
              ';
            } else {
              echo '';
            }
          ?>
            
            <?php
            if ($value['testssl'] === '1') {
              $parse_filename_testssl = '/opt/lampp/htdocs/horangi_recon/scan_results/testssl_' . $id . '_' . $_SESSION['project_id'] .'.txt';
              $testssl_result = fopen($parse_filename_testssl, "r") or die("Unable to open file!");
              $testssl_file = fread($testssl_result,filesize($parse_filename_testssl));
              fclose($testssl_result);
              echo '
              <!-- testssl -->
            <tr>
            <td class="text-center"><p class="fs-6 fw-semibold">Testssl</p></td>
            <!-- Button trigger modal -->
            <td>
            <div class="d-grid gap-2">
            <button type="button" class="btn btn-outline-primary btn-sm align-items-end m-1" data-bs-toggle="modal" data-bs-target="#testssl_modal">Show Detail</button>
          </div>            
            </td>
            <!-- testssl Modal -->
            <div class="modal fade bd-example-modal-lg" id="testssl_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                  <div class="modal-header" style="background-color: #353839; color: white;">
                    <h5 class="modal-title" id="exampleModalLabel"><p class="fs-4 fw-semibold p-1 m-1">Testssl Result</p></h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body" style="background-color: #353839; color: white;">
                  <pre>
                  ' . $testssl_file . '
                  </pre>
                  </div>
                  <div class="modal-footer" style="background-color: #353839; color: white;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- testssl Modal End -->
            
            </tr>
            <!-- testssl End--> 
              ';
            } else {
              echo '';
            }
          ?>
          <?php
            if ($value['dirsearch'] === '1') {
              $parse_filename_dirsearch = '/opt/lampp/htdocs/horangi_recon/scan_results/dirsearch_' . $id . '_' . $_SESSION['project_id'] .'.txt';
              $dirsearch_result = fopen($parse_filename_dirsearch, "r") or die("Unable to open file!");
              $dirsearch_file = fread($dirsearch_result,filesize($parse_filename_dirsearch));
              fclose($dirsearch_result);
              echo '
              <!-- dirsearch -->
            <tr>
            <td class="text-center"><p class="fs-6 fw-semibold">Dirsearch</p></td>
            <!-- Button trigger modal -->
            <td>
            <div class="d-grid gap-2">
            <button type="button" class="btn btn-outline-primary btn-sm align-items-end m-1" data-bs-toggle="modal" data-bs-target="#dirsearch_modal">Show Detail</button>
          </div>            
            </td>
            <!-- dirsearch Modal -->
            <div class="modal fade bd-example-modal-lg" id="dirsearch_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                  <div class="modal-header" style="background-color: #353839; color: white;">
                    <h5 class="modal-title" id="exampleModalLabel"><p class="fs-4 fw-semibold p-1 m-1">Dirsearch Result</p></h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body" style="background-color: #353839; color: white;">
                  <pre style="white-space: pre-line;">
                  ' . $dirsearch_file . '
                  </pre>
                  </div>
                  <div class="modal-footer" style="background-color: #353839; color: white;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- dirsearch Modal End -->
            
            </tr>
            <!-- dirsearch End--> 
              ';
            } else {
              echo '';
            }
          ?>
          </tbody>
        </table>

        <!-- Pagination -->
        <nav aria-label="...">
          <ul class="pagination">
            <li class="page-item disabled">
              <a class="page-link">Previous</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item active" aria-current="page">
              <a class="page-link" href="#">2</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
              <a class="page-link" href="#">Next</a>
            </li>
          </ul>
        </nav>
        <!-- Pagination End -->
      </div>
      <!-- Main Section End -->
    </main>
  </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
  </body>
</html>
