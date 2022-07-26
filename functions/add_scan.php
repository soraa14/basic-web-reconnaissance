<?php
// Session start
session_start();

// Include the database configuration
    include '../config/db.php';
    $conn = OpenCon();

    // Get the value from POST form
    $project_name = $_POST['project_name'];
    $url = $_POST['url'];
    $nikto = $_POST['nikto_check'];
    $whatweb = $_POST['whatweb_check'];
    $wafw00f = $_POST['wafw00f_check'];
    $testssl = $_POST['testssl_check'];
    $dirsearch = $_POST['dirsearch_check'];

    if ( empty($nikto) ) $nikto = '0';
    if ( empty($whatweb) ) $whatweb = '0';
    if ( empty($wafw00f) ) $wafw00f = '0';
    if ( empty($testssl) ) $testssl = '0';
    if ( empty($dirsearch) ) $dirsearch = '0';
    
    // Get project_owner_id from session
    $project_id = $_SESSION['project_id'];
    $sql = "INSERT INTO projects (project_owner_id, project_name, urls, nikto, whatweb, wafw00f, testssl, dirsearch, is_executed) VALUES ('$project_id', '$project_name', '$url', '$nikto', '$whatweb', '$wafw00f', '$testssl', '$dirsearch', '0')";
    
    // Execute query
    $conn->query($sql);
    $conn->close();

    // Redirect to home page
    header('Location: ../home.php');
    ?>