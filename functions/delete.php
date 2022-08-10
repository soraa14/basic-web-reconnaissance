<?php
session_start();
include '../config/config.php';
if (!isset($_SESSION['username'])) {
  header('Location: ' . $base_url . '/index.php');
  die();
}
    // Include configuration
    include '../config/config.php';
    include '../config/db.php';
    $conn = OpenCon();

    $id = $_GET['id'];
    $project_id = $_SESSION['project_id'];

    $files = array(
      'nikto_' . $id . '_' . $project_id . '.html', 
      'whatweb_' . $id . '_' . $project_id . '.html', 
      'wafw00f_' . $id . '_' . $project_id . '.html', 
      'testssl_' . $id . '_' . $project_id . '.html', 
      'feroxbuster_' . $id . '_' . $project_id . '.html'
    );

    foreach ($files as $file) {
      if ( unlink ( $result_path . '/' . $file ) ) {
        echo 'Scan results successfully deleted!<br />';
      } else {
        echo 'Scan results was not deleted!<br />';
      }
    }

    $sql = "DELETE FROM projects WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    CloseCon($stmt);
        
    header('Location: ' . $base_url . '/home.php?page=1');
?>