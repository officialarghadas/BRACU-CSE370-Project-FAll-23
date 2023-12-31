<?php
session_start();
require_once("partials/_dbconnect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Testcode'])) {
    $Testcode = $_POST['Testcode'];
    $patientId = $_SESSION['id'];

    // Check if the patient ID and test ID combination already exist in the testcart table
    $checkQuery = "SELECT COUNT(*) AS patient_count FROM testcart WHERE `Patient Id` = ? AND `Test Id` = ? AND `payment status` = 0";

    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("ii", $patientId, $Testcode);
    $checkStmt->execute();
    $result = $checkStmt->get_result();
    $row = $result->fetch_assoc();

    if ($row['patient_count'] > 0) {
        // The patient ID and test ID combination exists in the cart table, update the quantity
        echo "Already in cart";
    } else {
        // If the combination doesn't exist, insert it with payment status '0'
        $insertQuery = "INSERT INTO `testcart` (`Test Id`, `Patient Id`, `Payment Status`) VALUES (?, ?, '0')";
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->bind_param("ii", $Testcode, $patientId);
        if ($insertStmt->execute()) {
            echo 'Added to the cart';
        } else {
            echo "Error adding to cart: " . $conn->error;
        }
        $insertStmt->close();
    }

    $checkStmt->close();
    $conn->close();
} else {
    echo "Invalid request";
}
?>
