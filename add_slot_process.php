<?php
require_once("partials/_dbconnect.php");
session_start();
$date= $_POST['date'];
$did= $_SESSION['id'];
$num_slots=$_POST['num_of_slots'];
$slot_duration=$_POST['slot_duration'];
$start_time=$_POST['start_time'];
$formattedDate = date('Y/m/d', strtotime($date));

$startDateTime = new DateTime($start_time);
for ($i = 0; $i < $num_slots; $i++) {
    // Insert record into the slots table
    
    // echo $i+1;

    $insertQuery = "INSERT INTO `slots` (`Date`, `Time`, `Serial Number`, `Slot Status`, `Doctor ID`) VALUES ('$date', '" . $startDateTime->format('H:i:s') . "',$i+1,0, '$did')";
    $result = mysqli_query($conn, $insertQuery);

    // Increment the start time by the slot duration
    $startDateTime->add(new DateInterval('PT' . $slot_duration . 'M'));
}
header("Location: doctordash.php");


?>