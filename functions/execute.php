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
    $command_nik = 'nikto -host ' . $url . ' | aha --title export_nikto > ' . $result_path . 'nikto_' . $id . '_' . $project_id . '.html &'; 
    shell_exec($command_nik);
}

// whatweb
function runWhatweb($url, $id, $project_id, $result_path) {
    $command_whatw = 'whatweb -v "' . $url . '" | aha --title export_whatweb > ' . $result_path . 'whatweb_' . $id . '_' . $project_id . '.html &'; 
    shell_exec($command_whatw);
}

// wafw00f
function runWafw00f($url, $id, $project_id, $result_path) {
    $command_waf = 'wafw00f "' . $url . '" | aha --title export_wafw00f > ' . $result_path . 'wafw00f_' . $id . '_' . $project_id . '.html &'; 
    shell_exec($command_waf);
}

// testssl
function runTestssl($url, $id, $project_id, $result_path) {
    $command_test = 'testssl "' . $url . '" | aha --title export_testssl > ' . $result_path . 'testssl_' . $id . '_' . $project_id . '.html &';
    shell_exec($command_test);
}

// feroxbuster
function runFeroxbuster($url, $id, $project_id, $result_path, $wordlist) {
    $command_ferox = 'feroxbuster --url "' . $url . '" -w "' . $wordlist . '" -q --no-state | aha --title export_feroxbuster > ' . $result_path . 'feroxbuster_' . $id . '_' . $project_id . '.html &'; 
    shell_exec($command_ferox);
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
if ($row['whatweb'] === '1') {
    if ($row['is_executed'] === '0') {
        runWhatweb($url, $id, $project_id, $result_path);
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

// feroxbuster
if ($row['feroxbuster'] === '1') {
    if ($row['is_executed'] === '0') {
        runFeroxbuster($url, $id, $project_id, $result_path, $row['feroxbuster_wordlist']);
        $update_exec = "UPDATE projects SET is_executed = '1'";
        $result = $conn->query($update_exec);
    } else {
        header('Location: ' . $base_url . '/home.php?page=1&message=already_executed');
        die();
    }
}

header('Location: ' . $base_url . '/home.php?page=1');
