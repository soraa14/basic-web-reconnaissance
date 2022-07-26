<?php
// Session start
session_start();

// Include the database configuration
    include '../config/db.php';
    $conn = OpenCon();

    $id = $_GET['id'];
    $project_id = $_SESSION['project_id'];
    
    $sql = "SELECT * FROM projects WHERE project_owner_id='$project_id' AND id='$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();    
    $url = $row['urls'];

// nikto
function runNikto($url, $id, $project_id) {
    shell_exec('nikto -host ' . $url . ' | aha --no-header > /opt/lampp/htdocs/horangi_recon/scan_results/nikto_' . $id . '_' . $project_id . '.txt &'); 
}

// whatweb
function runWhatweb($url, $id, $project_id) {
    shell_exec('whatweb -v ' . $url . ' | aha --no-header > /opt/lampp/htdocs/horangi_recon/scan_results/whatweb_' . $id . '_' . $project_id . '.txt &'); 
}

// wafw00f
function runWafw00f($url, $id, $project_id) {
    shell_exec('wafw00f ' . $url . ' | aha --no-header > /opt/lampp/htdocs/horangi_recon/scan_results/wafw00f_' . $id . '_' . $project_id . '.txt &'); 
}

// testssl
function runTestssl($url, $id, $project_id) {
    shell_exec('testssl ' . $url . ' | aha --no-header > /opt/lampp/htdocs/horangi_recon/scan_results/testssl_' . $id . '_' . $project_id . '.txt &'); 
}

// dirsearch
function runDirsearch($url, $id, $project_id) {
    shell_exec('dirsearch -u ' . $url . ' -w ~/haha.txt' . ' | aha --no-header > /opt/lampp/htdocs/horangi_recon/scan_results/dirsearch_' . $id . '_' . $project_id . '.txt'); 
}

if ($row['nikto'] === '1') {
    if ($row['is_executed'] === '0') {
        runNikto($url, $id, $project_id);
        $update_exec = "UPDATE projects SET is_executed = '1'";
        $result = $conn->query($update_exec);
    } else {
        header('Location: ../home.php?message=already_executed');
        die();
    }
}

if ($row['whatweb'] === '1') {
    if ($row['is_executed'] === '0') {
        runWhatweb($url, $id, $project_id);
        $update_exec = "UPDATE projects SET is_executed = '1'";
        $result = $conn->query($update_exec);
    } else {
        header('Location: ../home.php?message=already_executed');
        die();
    }
}

if ($row['wafw00f'] === '1') {
    if ($row['is_executed'] === '0') {
        runWafw00f($url, $id, $project_id);
        $update_exec = "UPDATE projects SET is_executed = '1'";
        $result = $conn->query($update_exec);
    } else {
        header('Location: ../home.php?message=already_executed');
        die();
    }
}

if ($row['testssl'] === '1') {
    if ($row['is_executed'] === '0') {
        runTestssl($url, $id, $project_id);
        $update_exec = "UPDATE projects SET is_executed = '1'";
        $result = $conn->query($update_exec);
    } else {
        header('Location: ../home.php?message=already_executed');
        die();
    }
}

if ($row['dirsearch'] === '1') {
    if ($row['is_executed'] === '0') {
        runDirsearch($url, $id, $project_id);
        $update_exec = "UPDATE projects SET is_executed = '1'";
        $result = $conn->query($update_exec);
    } else {
        header('Location: ../home.php?message=already_executed');
        die();
    }
}

header('Location: ../home.php');
