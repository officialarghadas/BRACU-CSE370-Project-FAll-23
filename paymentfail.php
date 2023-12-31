<?php
// Start the session
session_start();

// Include your database connection file
require_once("partials/_dbconnect.php");

session_unset();
header("location: login.php")


?>
