<?php
    require_once("partials/_dbconnect.php");
    session_start();
    $did = $_GET['did'];

    $sql = "UPDATE `doctors` SET `Activestatus` = 'Active' WHERE `doctors`.`Doctor ID` = $did";

    mysqli_query($conn, $sql);
    header('location: Adminapproval.php');
    exit;
?>