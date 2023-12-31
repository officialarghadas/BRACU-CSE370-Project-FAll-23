<?php
session_start();
$_SESSION['details_id'] = $_GET['patientid'];
$_SESSION['ap_id'] = $_GET['apid'];

header('location: doctordash.php');
?>