<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $test_name = $_POST["search"];
    
    require_once("partials/_dbconnect.php");
    $sql= "SELECT `tests`.`Test Code`, `tests`.`Cost`, `tests`.`Test Name`
    FROM `tests`
    WHERE `tests`.`Test Name` LIKE '%$test_name%'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    if ($stmt === false) {
        die("Error in SQL query: " . $conn->error);
    }
    $result = $stmt->get_result();
    $searchResults = [];
    while ($row = $result->fetch_assoc()) {
        $searchResults[] = array(
            'Test Name' => $row['Test Name'],
            'Cost' => $row['Cost'],
            'Testcode'=> $row['Test Code']
        );
    }
     header('Content-Type: application/json');
     echo json_encode($searchResults);
     $stmt->close();
     $conn->close();
 }
 ?>
 

