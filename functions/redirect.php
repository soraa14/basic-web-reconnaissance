<?php
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off')
    $protocol = "https//";
else
    $protocol = "http//";
 
$url_redirect = $protocol . $_SERVER['HTTP_HOST'];
// Outputs: Full URL

?>