<?php
// process_form.php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and sanitize inputs
    $use = $_POST["select1"];
    $type = $_POST["select2"];
    $med_name = $_POST["search"];
    
    require_once("partials/_dbconnect.php");

    // Perform appropriate sanitation to prevent SQL injection (e.g., using prepared statements)

    // Prepare SQL statement using prepared statement to prevent SQL injection
    // $prev_sql="SELECT `medicine`.`Medicine Name`, `medicine`.`Medicine Code`
    // FROM `medicine`
    // WHERE `medicine`.`Medicine Name` LIKE '%$med_name%'";
    // $prev_stmt = $conn->prepare($prev_sql);
    // $prev_stmt->execute();
    // $prev_result = $prev_stmt->get_result();

    if ($med_name !== "") {
        $sql = "SELECT `medicine`.`Medicine Name`,`medicine`.`Medicine Code` ,`medicine`.`Cost`, `medicine`.`type`, `medicine`.`internal`
        FROM `medicine`
        WHERE `medicine`.`Medicine Name` LIKE '%$med_name%' AND `medicine`.`type` = '$type' AND `medicine`.`internal` = '$use';";
    } else {
        $sql = "SELECT `medicine`.`Medicine Name`, `medicine`.`Medicine Code`, `medicine`.`Cost`, `medicine`.`type`, `medicine`.`internal`
        FROM `medicine`
        WHERE  `medicine`.`type` = '$type' AND `medicine`.`internal` = '$use'";
    }

    // Prepare and execute the query
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // Check for errors in query execution
    if ($stmt === false) {
        die("Error in SQL query: " . $conn->error);
    }

    // Get the result
    $result = $stmt->get_result();

    // Process the result
    $searchResults = [];
    while ($row = $result->fetch_assoc()) {
        $searchResults[] = array(
            'Medicine Name' => $row['Medicine Name'],
            'Cost' => $row['Cost'],
            'Type' => $row['type'],
            'internal' => $row['internal'],
            'Medcode'=> $row['Medicine Code']
        );
    }

    // Set header and output JSON
    header('Content-Type: application/json');
    echo json_encode($searchResults);

    // Close statement and database connection
    $stmt->close();
    $conn->close();
}
?>
