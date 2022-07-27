<?php
// Session start
session_start();

// Include configuration
include '../config/config.php';
include '../config/db.php';
$conn = OpenCon();
 
// Get value from POST form
$username = $_POST['username'];
$userpass = $_POST['password'];

$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc(); 

// If a user existed in the database
if (mysqli_num_rows($result) > 0) {

    // Run this
    // Verify the hashed password with the password inputted by the user
    if (password_verify($userpass, $row['pass'])){

        // If the password was valid set a global session value (username, project_owner_id)
        $_SESSION['username'] = $username;
        $_SESSION['project_id'] = $row['project_owner_id'];

        // Redirect to home page
        header('Location: '. $base_url . '/home.php');
    } else {

        // If login was unsuccessful, redirect to login page with failed message
        header('Location: ' . $base_url . '/index.php?message=login_failed');
    }
} else {
    
    // If login was unsuccessful, redirect to login page with failed message
    header('Location: ' . $base_url . '/index.php?message=login_failed');
}
?>