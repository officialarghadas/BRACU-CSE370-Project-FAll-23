<?php
session_start();
require_once("partials/_dbconnect.php");

// Fetching the Patient Id from the session variable
$patientid = $_SESSION['id'];

// SQL queries to update the 'Payment Status' in the 'cart' table and 'testcart' table
$sql = "DELETE FROM `cart`  WHERE `Patient Id` = '$patientid' AND `Payment Status` = 0";
$sql2 = "DELETE FROM `testcart`  WHERE `Patient Id` = '$patientid' AND `Payment Status` = 0";



// Executing the SQL queries
$result = mysqli_query($conn, $sql);
$result2 = mysqli_query($conn, $sql2);

// Checking for query execution success
if ($result && $result2) {
    $_SESSION['success_message'] = "successfull.";
    // Queries executed successfully
    header("location: patienthome.php");
} else {
    // Error in executing queries
    echo "Error updating payment status: " . mysqli_error($conn);
}
?>
