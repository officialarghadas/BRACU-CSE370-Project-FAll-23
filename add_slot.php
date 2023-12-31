<?php
session_start();
require_once("partials/_dbconnect.php");

if(isset($_GET['dcid'], $_GET['slotId'], $_GET['serialNumber'])) {
    $doctor_id = $_GET['dcid'];
    $_SESSION['doctor_id'] = $doctor_id;
    $userID = $_SESSION['id'];
    $slot_id = $_GET['slotId'];
    $_SESSION['slot_id'] = $slot_id;
    $serial_number = $_GET['serialNumber'];
    $_SESSION['serial_number'] = $serial_number;
    
    
    $sql_old = "SELECT `Old` 
    FROM patients 
    WHERE `Patient ID` = '$userID'";
    $result_old=$conn->query($sql_old);
    $rowold = $result_old->fetch_assoc();
    $old_status=$rowold['Old'];
    if ($old_status==1){
        $sql_fee = "SELECT `Old Fee`
                FROM `doctors`
                WHERE `Doctor ID` = ?";
        $stmt = $conn->prepare($sql_fee);
        $stmt->bind_param("s", $doctor_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $doctor_fee = $row['Old Fee'];
            $_SESSION['doc_fee'] = $doctor_fee;
        }
    }
    else {
        $sql_fee = "SELECT `New Fee`
                FROM `doctors`
                WHERE `Doctor ID` = ?";
        $stmt = $conn->prepare($sql_fee);
        $stmt->bind_param("s", $doctor_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $doctor_fee = $row['New Fee'];
            $_SESSION['doc_fee'] = $doctor_fee;
        }
    }
    

}


header("Location: " ."payment.php?doctor_fee=" . urlencode($doctor_fee))
?>