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

function runWhatwebUserAgent($url, $id, $project_id, $result_path, $params) {
    shell_exec('whatweb --user-agent ' . $params . ' -v ' . $url . ' | aha --no-header > ' . $result_path . 'whatweb_' . $id . '_' . $project_id . '.txt &'); 
}

function runWhatwebHeader($url, $id, $project_id, $result_path, $params) {
    shell_exec('whatweb --header ' . $params . ' -v ' . $url . ' | aha --no-header > ' . $result_path . 'whatweb_' . $id . '_' . $project_id . '.txt &'); 
}

function runWhatwebAllParams($url, $id, $project_id, $result_path, $param1, $param2) {
    shell_exec('whatweb --user-agent ' . $param1 . ' --header ' . $param2 . ' -v ' . $url . ' | aha --no-header > ' . $result_path . 'whatweb_' . $id . '_' . $project_id . '.txt &'); 
}

// wafw00f
function runWafw00f($url, $id, $project_id, $result_path) {
    shell_exec('wafw00f ' . $url . ' | aha --no-header > ' . $result_path . 'wafw00f_' . $id . '_' . $project_id . '.txt &'); 
}

// testssl
function runTestssl($url, $id, $project_id, $result_path) {
    shell_exec('testssl ' . $url . ' | aha --no-header > ' . $result_path . 'testssl_' . $id . '_' . $project_id . '.txt &');
    
}

// gobuster
function runGobuster($url, $id, $project_id, $result_path, $wordlist) {
    shell_exec('gobuster dir -u ' . $url . ' -w ' . $wordlist . ' -o ' . $result_path . 'gobuster_' . $id . '_' . $project_id . '.txt --random-agent &'); 
}

// Nikto
if ($row['nikto'] === '1') {
    if ($row['is_executed'] === '0') {
        runNikto($url, $id, $project_id, $result_path);
        $update_exec = "UPDATE projects SET is_executed = '1'";
        $result = $conn->query($update_exec);
    } else {
        header('Location: ' . $base_url . '/home.php?page=1&message=already_executed');
        die();
    }
}

// Whatweb
if ($row['whatweb'] === '1' AND $row['whatweb_ua'] === '0' AND $row['whatweb_header'] === '0') {
    if ($row['is_executed'] === '0') {
        runWhatweb($url, $id, $project_id, $result_path);
        $update_exec = "UPDATE projects SET is_executed = '1'";
        $result = $conn->query($update_exec);
    } else {
        header('Location: ' . $base_url . '/home.php?page=1&message=already_executed');
        die();
    }
}

if ($row['whatweb'] === '1' AND $row['whatweb_ua'] != '0' AND $row['whatweb_header'] === '0') {
    if ($row['is_executed'] === '0') {
        runWhatwebUserAgent($url, $id, $project_id, $result_path, $row['whatweb_ua']);
        $update_exec = "UPDATE projects SET is_executed = '1'";
        $result = $conn->query($update_exec);
    } else {
        header('Location: ' . $base_url . '/home.php?page=1&message=already_executed');
        die();
    }
}

if ($row['whatweb'] === '1' AND $row['whatweb_ua'] === '0' AND $row['whatweb_header'] != '0') {
    if ($row['is_executed'] === '0') {
        runWhatwebHeader($url, $id, $project_id, $result_path, $row['whatweb_header']);
        $update_exec = "UPDATE projects SET is_executed = '1'";
        $result = $conn->query($update_exec);
    } else {
        header('Location: ' . $base_url . '/home.php?page=1&message=already_executed');
        die();
    }
}

if ($row['whatweb'] === '1' AND $row['whatweb_ua'] != '0' AND $row['whatweb_header'] !='0') {
    if ($row['is_executed'] === '0') {
        runWhatwebAllParams($url, $id, $project_id, $result_path, $row['whatweb_ua'], $row['whatweb_header']);
        $update_exec = "UPDATE projects SET is_executed = '1'";
        $result = $conn->query($update_exec);
    } else {
        header('Location: ' . $base_url . '/home.php?page=1&message=already_executed');
        die();
    }
}

// Wafw00f
if ($row['wafw00f'] === '1') {
    if ($row['is_executed'] === '0') {
        runWafw00f($url, $id, $project_id, $result_path);
        $update_exec = "UPDATE projects SET is_executed = '1'";
        $result = $conn->query($update_exec);
    } else {
        header('Location: ' . $base_url . '/home.php?page=1&message=already_executed');
        die();
    }
}

// Testssl
if ($row['testssl'] === '1') {
    if ($row['is_executed'] === '0') {
        runTestssl($url, $id, $project_id, $result_path);
        $update_exec = "UPDATE projects SET is_executed = '1'";
        $result = $conn->query($update_exec);
    } else {
        header('Location: ' . $base_url . '/home.php?page=1&message=already_executed');
        die();
    }
}

// Gobuster
if ($row['gobuster'] === '1') {
    if ($row['is_executed'] === '0') {
        runGobuster($url, $id, $project_id, $result_path, $row['gobuster_wordlist']);
        $update_exec = "UPDATE projects SET is_executed = '1'";
        $result = $conn->query($update_exec);
    } else {
        header('Location: ' . $base_url . '/home.php?page=1&message=already_executed');
        die();
    }
}
// header('Location: ' . $base_url . '/home.php?page=1');