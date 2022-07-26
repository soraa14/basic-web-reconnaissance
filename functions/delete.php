<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: ../index.php");
  die();
}
    include '../config/db.php';
    $conn = OpenCon();

    $id   = $_GET['id'];
    $project_id = $_SESSION['project_id'];

    $files = array(
      'nikto_' . $id . '_' . $project_id . '.txt', 
      'whatweb_' . $id . '_' . $project_id . '.txt', 
      'wafw00f_' . $id . '_' . $project_id . '.txt', 
      'testssl_' . $id . '_' . $project_id . '.txt', 
      'dirsearch_' . $id . '_' . $project_id . '.txt'
    );

    foreach ($files as $file) {
      if ( unlink ( '/opt/lampp/htdocs/horangi_recon/scan_results' . '/' . $file ) ) {
        echo 'Scan results successfully deleted!<br />';
      } else {
        echo 'Scan results was not deleted!<br />';
      }
    }

    $sql = "DELETE FROM projects WHERE id='$id'";
    $conn->query($sql);

    $conn->close();
        
    header('Location: ../home.php');
?>