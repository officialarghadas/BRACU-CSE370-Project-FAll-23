<?php
session_start();
require_once("partials/_dbconnect.php");

// Fetching the Patient Id from the session variable
$patientid = $_SESSION['id'];

// SQL queries to update the 'Payment Status' in the 'cart' table and 'testcart' table
date_default_timezone_set('Asia/Dhaka');
$currentDate = date("Y-m-d");
// $sql ="UPDATE `cart`
//         SET `Payment Status` = 1,
//         `Date` = '$currentDate'
//         WHERE `Patient Id` = '$patientid'" ;
$sql4="SELECT * FROM `cart` WHERE `Patient Id`='$patientid' ";
$result4 = mysqli_query($conn, $sql4);
if (mysqli_num_rows($result4) > 0) {
    // Loop through each result and insert into pays for table
    while ($row = mysqli_fetch_assoc($result4)) {
        $medicineCode = $row['Medicine Id'];
        $quantity = $row['Quantity'];
        $totalcost = $quantity *$row['cost'] ;

        // Insert into pays for table
        $sql3 = "INSERT INTO `pays for` (`Patient ID`, `Medicine Code`, `Quantity`, `Date`, `Total Amount`)
                 VALUES ('$patientid', '$medicineCode', '$quantity', '$currentDate', 0)";
        $result3 = mysqli_query($conn, $sql3);
    }
    }

// $sql3="INSERT INTO `pays for` (`Patient ID`, `Medicine Code`, `Quantity`, `Date`, `Total Amount`)
// VALUES ('$patientid', , your_quantity_value, '2023-12-10 14:30:00', your_total_amount_value)";

// $sql2 = "UPDATE `testcart`
//          SET `Payment Status` = 1
//          WHERE `Patient Id` = '$patientid'";

$sql = "DELETE FROM `cart`  WHERE `Patient Id` = '$patientid'";
$sql2 = "DELETE FROM `testcart`  WHERE `Patient Id` = '$patientid'";


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
