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

          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="reports.php">
              <span data-feather="reports"></span>
              Reports
            </a>
          </li>
        </ul>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 fw-semibold"><i class="fa-solid fa-magnifying-glass"></i> Scans</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="profile.php"><button type="button" class="btn btn-sm btn-outline-dark m-1"><i class="fa-solid fa-user"></i> <?= htmlspecialchars($_SESSION['username']); ?></button></a>
            <a href="new_scan.php"><button type="button" class="btn btn-sm btn-outline-success m-1"><i class="fa-solid fa-magnifying-glass-plus"></i> New Scan</button></a>
          
        </div>
      </div>

      <!-- Main Section -->
      <?php
    if (isset($_GET['message']) && $_GET['message'] == 'already_executed' )
{
     echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
     You already ran the scan!
   </div>';
}
?>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">No.</th>
              <th scope="col">Project Name</th>
              <th scope="col">Tools</th>
              <th scope="col">Details</th>
            </tr>
          </thead>
          <tbody>  
            <?php
            $limit = 7;
            $page = @$_GET['page'];
            if(empty($page)){
              $position = 0;
              $position = 1;
            } else {
              $position = ($page-1) * $limit;
            }

            $no = $position + 1;
            $project_id = $_SESSION['project_id'];
            $sql = "SELECT id, project_name, nikto, whatweb, wafw00f, testssl, gobuster FROM projects WHERE project_owner_id = ? limit ?, ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sii", $project_id, $position, $limit);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
              // output data of each row
              while($row = $result->fetch_assoc()) { ?>
                <?= '<tr>' ?>
                <?= '<td>'?>
                <?= $no++; ?>
                <?= '</td>'?> 
                <?= '<td>'?> 
                <?= htmlspecialchars($row['project_name']); ?> 
                <?= '</td>' ?>
                
                <?= '<td>' ?>
                <?php
                if ($row['nikto'] === 1) {
                  echo '<span class="badge bg-dark m-1">Nikto</span>';
                }
                if ($row['whatweb'] === 1) {
                  echo '<span class="badge bg-dark m-1">Whatweb</span>';
                }
                if ($row['wafw00f'] === 1) {
                  echo '<span class="badge bg-dark m-1">Wafw00f</span>';
                }
                if ($row['testssl'] === 1) {
                  echo '<span class="badge bg-dark m-1">Testssl</span>';
                }
                if ($row['gobuster'] === 1) {
                  echo '<span class="badge bg-dark m-1">Gobuster</span>';
                }
                ?>
                <?= '<td>' ?>
                <?= '<a href="functions/execute.php?id=' . $row['id'] . ' "><button type="button" class="btn btn-outline-success btn-sm align-items-end" id="runScan">Run Scan</button></a>' ?>

                <?= '<a href="scans/index.php?id=' . $row['id'] . ' "><button type="button" class="btn btn-outline-primary btn-sm align-items-end">Details</button></a>' ?>

                <?= '<button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</button></a>' ?>
                <?= '</tr>' ?>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete This Project?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-sm-12 text-center">
                          <?= '<a href="functions/delete.php?id=' . $row['id'] . ' "><button type="button" class="btn btn-success m-1" style="width:220px;" data-bs-dismiss="modal">Yes</button></a>' ?>
                            <button type="button" class="btn btn-danger m-1" style="width:220px;" data-bs-dismiss="modal">No</button> 
                        </div>
                        </div>    
                      </div>
                    </div>
                  </div>
                </div>
             <?php }
            } else {
              echo "-";
            }
            
            ?>
            <?php for ($i = 0; $i <= 2; $i++) { ?>

              <?php 
              }
              $stmt->get_result();
              ?> 
          </tbody>
        </table>


<?php
    $sql2 = "SELECT * FROM projects WHERE project_owner_id = '$project_id'";
    $result = $conn->query($sql2);
    $total_data = mysqli_num_rows($result);
    $total_page = ceil($total_data/$limit);
    CloseCon($stmt);
    ?>
        


        <!-- Pagination -->
        <nav aria-label="...">
          <ul class="pagination">
          <?php
            for($i=1;$i<=$total_page;$i++) {
                if ($i != $page) {
                    echo "<li class='page-item'><a class='page-link' href='home.php?page=$i'>$i</a></li>";
                } else {
                    echo "<li class='page-item active'><a class='page-link' href='#'>$i</a></li>";
                }
            }
            ?>
          </ul>
        </nav>
        <!-- Pagination End -->
      </div>
      <!-- Main Section End -->
    </main>
  </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
    $(document).ready(function() {
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
            });
        }, 800);
    });    
      </script>
      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
  </body>
</html>
