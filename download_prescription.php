<?php
    require_once("partials/_dbconnect.php");
    session_start();
    $presci = $_GET['presci'];
    // echo''.$presci.'';
    $sql = "SELECT * FROM appointment WHERE `Appointment ID` = '$presci'";
    $result = $conn->query($sql);
    if ($conn->query($sql)) {
        $row = $result->fetch_assoc();
        $dbfile = $row['Prescription'];

        $decoded = base64_decode($dbfile);

    
        header('Content-Description: File Transfer');
        header('Content-Type: application/pdf'); 
        header('Content-Disposition: attachment; filename="Prescription'. $presci . '.pdf"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . strlen($decoded));

        echo $decoded;

    } else {
        
        echo "Error executing query: " . $conn->error;
    }
    
?>