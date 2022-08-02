<?php
include '../config/config.php';
include '../config/db.php';
$conn = OpenCon();
$sql = "SELECT * FROM projects WHERE project_owner_id='e7befa1b031712662ff52e82f2caaa14' AND id='67'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();    
$url = $row['whatweb_ua'];

if ($url != '0') {
    echo 'filled';
} else {
    echo 'not filled';
}