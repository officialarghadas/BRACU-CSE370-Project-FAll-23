<?php
    require_once("partials/_dbconnect.php");
    session_start();
    $did = $_GET['did'];

    $sql = "SELECT * FROM `doctor_data` WHERE `Doctor ID` = '$did'";
    $result = $conn->query($sql);
    if ($conn->query($sql)) {
        $row = $result->fetch_assoc();
        $dbfile = $row['Data'];

        $decoded = base64_decode($dbfile);

    
        header('Content-Description: File Transfer');
        header('Content-Type: application/pdf'); 
        header('Content-Disposition: attachment; filename="' . $did . '.pdf"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . strlen($decoded));


        echo $decoded;
        header('location: Adminapproval.php');

    } else {
        
        echo "Error executing query: " . $conn->error;
    }
    
?>