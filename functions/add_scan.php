<?php
// Session start
session_start();

// Include the configuration
    include '../config/config.php';
    include '../config/db.php';
    $conn = OpenCon();

    // Get the value from POST form
    $project_name = $_POST['project_name'];
    $url = $_POST['url'];
    $nikto = $_POST['nikto_check'];
    $whatweb = $_POST['whatweb_check'];
    $wafw00f = $_POST['wafw00f_check'];
    $testssl = $_POST['testssl_check'];
    $gobuster = $_POST['gobuster_check'];

    if ( empty($nikto) ) $nikto = '0';
    if ( empty($whatweb) ) $whatweb = '0';
    if ( empty($wafw00f) ) $wafw00f = '0';
    if ( empty($testssl) ) $testssl = '0';
    if ( empty($gobuster) ) $gobuster = '0';
    
    // Get project_owner_id from session
    $project_id = $_SESSION['project_id'];
    
    $sql = "INSERT INTO projects (project_owner_id, project_name, urls, nikto, whatweb, wafw00f, testssl, gobuster, is_executed) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 0)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssiiiii", $project_id, $project_name, $url, $nikto, $whatweb, $wafw00f, $testssl, $gobuster);
    $stmt->execute();
    CloseCon($stmt);
    
    // Redirect to home page
    header('Location: ' . $base_url . '/home.php?page=1');
    ?>