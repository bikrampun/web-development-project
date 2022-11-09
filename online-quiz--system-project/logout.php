<?php
// Initialize the session
session_start();
 
// Destroy the single session.
session_unset();
 
// Redirect to login page
header("location: index.php");

?>