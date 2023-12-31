<?php
session_start();
require_once("partials/_dbconnect.php");

// $doctor_id=$_SESSION['doctor_id'];
// $userID=$_SESSION['id'];
// $slot_id=$_SESSION['slot_id'];
// $doctor_fee=$_SESSION['doc_fee'];
if (isset($_GET['fee'], $_GET['patient_name'], $_GET['doctor_id'], $_GET['userID'], $_GET['slot_id'], $_GET['doctor_fee'])) {
    $fee = $_GET['fee'];
    $patient_name = $_GET['patient_name'];
    $doctor_id = $_GET['doctor_id'];
    $userID = $_GET['userID'];
    $slot_id = $_GET['slot_id'];
    $doctor_fee = $_GET['doctor_fee'];
    echo "Fee: " . $fee . "<br>";
    echo "Patient Name: " . $patient_name . "<br>";
    echo "Doctor ID: " . $doctor_id . "<br>";
    echo "User ID: " . $userID . "<br>";
    echo "Slot ID: " . $slot_id . "<br>";
    echo "Doctor Fee: " . $doctor_fee . "<br>";
}
$sql_insert = "INSERT INTO `appointment` 
                (`Cost`, `Status`, `Doctor ID`, `Patient ID`, `Slot Serial`) 
                VALUES (?, '0', ?, ?, ?)";
$sql_update_slot_st="UPDATE `slots` SET `Slot Status` = '1' WHERE `slots`.`Slot ID` = ?";


$stmt_insert = $conn->prepare($sql_insert);
$stmt_insert->bind_param("ssss", $doctor_fee, $doctor_id, $userID, $slot_id);
$stmt_insert->execute();
$stmt_update_slot = $conn->prepare($sql_update_slot_st);
$stmt_update_slot->bind_param("s", $slot_id);
$stmt_update_slot->execute();
$sql_old = "SELECT `Old` 
    FROM patients 
    WHERE `Patient ID` = '$userID'";
    $result_old=$conn->query($sql_old);
    $rowold = $result_old->fetch_assoc();
    $old_status=$rowold['Old'];
    if ($old_status==0){
        $sql="UPDATE `patients` SET `Old` = '1' WHERE `patients`.`Patient ID` = ?";
        $stmt = $conn->prepare($sql);

        // Bind the user ID parameter
        $stmt->bind_param('i', $userID);
        $stmt->execute();

        
    }
header("Location: " ."patienthome.php")
?>