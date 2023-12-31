<?php
session_start();
require_once("partials/_dbconnect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['medCode'])) {
    $medCode = $_POST['medCode'];
    $patientId = $_SESSION['id'];

    // Check if the patient ID and medicine ID combination already exists in the cart table
    $checkQuery = "SELECT COUNT(*) AS patient_count, Quantity FROM cart WHERE `Patient Id` = ? AND `Medicine Id` = ? AND `payment status` = 0 ";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("ii", $patientId, $medCode);
    $checkStmt->execute();
    $result = $checkStmt->get_result();
    $row = $result->fetch_assoc();

    if ($row['patient_count'] > 0) {
        // The patient ID and medicine ID combination exists in the cart table, update the quantity
        $newQuantity = $row['Quantity'] + 1;

        $updateQuery = "UPDATE cart SET `Quantity` = ? WHERE `Patient Id` = ? AND `Medicine Id` = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param("iii", $newQuantity, $patientId, $medCode);
        if ($updateStmt->execute()) {
            echo 'Added to the cart';
        } else {
            echo "Error updating quantity: " . $conn->error;
        }
        $updateStmt->close();
    } else {
        // If the combination doesn't exist, insert it with quantity = 1
        $insertQuery = "INSERT INTO `cart` (`Patient Id`, `Medicine Id`, `Payment Status`, `Quantity`) VALUES (?, ?, '0', '1')";
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->bind_param("ii", $patientId, $medCode);
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
