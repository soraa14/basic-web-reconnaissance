<?php 
 
session_start();
session_destroy();

include '../config/config.php';

header('Location: ' . $base_url . '/index.php');
 
?>