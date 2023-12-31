<?php
    require_once("partials/_dbconnect.php");
    session_start();
    $slid = $_GET['slid'];

    $sql = "UPDATE `appointment` SET `Status` = '2' WHERE `Slot Serial` = '$slid'";
    if(mysqli_query($conn, $sql)){
        $sql2 = "UPDATE `slots` SET `Slot Status` = '2' WHERE `slots`.`Slot ID` = '$slid'";
        if(mysqli_query($conn, $sql2)){
            header('location: slots.php');
        } else {
            die("Error in query: " . mysqli_error($conn));
        }
    }
    else {
        die("Error in query: " . mysqli_error($conn));
    }
    exit;
?>
