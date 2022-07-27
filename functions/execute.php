<?php
// Session start
session_start();

// Include the configuration
    include '../config/config.php';
    include '../config/db.php';
    $conn = OpenCon();

    $id = $_GET['id'];
    $project_id = $_SESSION['project_id'];
    
    $sql = "SELECT * FROM projects WHERE project_owner_id='$project_id' AND id='$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();    
    $url = $row['urls'];

// nikto
function runNikto($url, $id, $project_id, $result_path) {
    shell_exec('nikto -host ' . $url . ' | aha --no-header > ' . $result_path . 'nikto_' . $id . '_' . $project_id . '.txt &'); 
}

// whatweb
function runWhatweb($url, $id, $project_id, $result_path) {
    shell_exec('whatweb -v ' . $url . ' | aha --no-header > ' . $result_path . 'whatweb_' . $id . '_' . $project_id . '.txt &'); 
}

// wafw00f
function runWafw00f($url, $id, $project_id, $result_path) {
    shell_exec('wafw00f ' . $url . ' | aha --no-header > ' . $result_path . 'wafw00f_' . $id . '_' . $project_id . '.txt &'); 
}

// testssl
function runTestssl($url, $id, $project_id, $result_path) {
    shell_exec('testssl ' . $url . ' | aha --no-header > ' . $result_path . 'testssl_' . $id . '_' . $project_id . '.txt &'); 
}

// dirsearch
function runDirsearch($url, $id, $project_id, $result_path) {
    echo 'dirsearch -u ' . $url . ' -w /home/soraa/big.txt | aha --no-header > ' . $result_path . 'dirsearch_' . $id . '_' . $project_id . '.txt'; 
}

if ($row['nikto'] === '1') {
    if ($row['is_executed'] === '0') {
        runNikto($url, $id, $project_id, $result_path);
        $update_exec = "UPDATE projects SET is_executed = '1'";
        $result = $conn->query($update_exec);
    } else {
        header('Location: ' . $base_url . '/home.php?message=already_executed');
        die();
    }
}

if ($row['whatweb'] === '1') {
    if ($row['is_executed'] === '0') {
        runWhatweb($url, $id, $project_id, $result_path);
        $update_exec = "UPDATE projects SET is_executed = '1'";
        $result = $conn->query($update_exec);
    } else {
        header('Location: ' . $base_url . '/home.php?message=already_executed');
        die();
    }
}

if ($row['wafw00f'] === '1') {
    if ($row['is_executed'] === '0') {
        runWafw00f($url, $id, $project_id, $result_path);
        $update_exec = "UPDATE projects SET is_executed = '1'";
        $result = $conn->query($update_exec);
    } else {
        header('Location: ' . $base_url . '/home.php?message=already_executed');
        die();
    }
}

if ($row['testssl'] === '1') {
    if ($row['is_executed'] === '0') {
        runTestssl($url, $id, $project_id, $result_path);
        $update_exec = "UPDATE projects SET is_executed = '1'";
        $result = $conn->query($update_exec);
    } else {
        header('Location: ' . $base_url . '/home.php?message=already_executed');
        die();
    }
}

if ($row['dirsearch'] === '1') {
    if ($row['is_executed'] === '0') {
        runDirsearch($url, $id, $project_id, $result_path);
        $update_exec = "UPDATE projects SET is_executed = '1'";
        $result = $conn->query($update_exec);
    } else {
        header('Location: ' . $base_url . '/home.php?message=already_executed');
        die();
    }
}

// header('Location: ' . $base_url . '/home.php');