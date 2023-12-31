<?php 
    ob_start();
    require './helpers/functions.php';
    require './helpers/config.php';
    include './helpers/db.php';
    
    session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
        header("location: login.php");
    }
    elseif(isset($_SESSION['loggedin'])){
        if($_SESSION['loggedin'] == true){
            if($_SESSION['type'] == "Patient")
            {
                header("location: patienthome.php");
            }
            elseif($_SESSION['type'] == "Admin"){
                header("location: AdminMenu.php");
            }
        }
    }

    $doctor_id = $_SESSION['id'];
    $today = date('d-m-Y');


    // SQL ERROR
    $appointments = mysqli_query($db_connect, "SELECT appointment.*, patients.Name as patient_name 
                                                FROM `appointment` 
                                                JOIN patients ON appointment.`Paitent ID` = patients.`Patient ID` 
                                                WHERE appointment.`Doctor ID`='$doctor_id' AND appointment.`Date`='$today' AND `Time` > CURTIME() 
                                                ORDER BY `Appointment ID` DESC
                                                LIMIT 3");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/doctor_dash.css">
    <title>Document</title>
</head>
<body>
    <div class="logout-container">
        <button class="logout-button">Logout</button>
    </div>

    <div id="left-container">
        <div class="box" id="left-box1"><h1><a href="./slots.php">Slots</a></h1></div>
        <div class="box" id="left-box2"><h1><a href="./booked.php">Booked slots</a></h1></div>
        <div class="box" id="left-box3"><h1><a href="./up_presci.php">New prescription</a></h1></div>
        <div class="box" id="left-box4"><h1><a href="./previous-history.php">Previous patients</a></h1></div>
    </div>

    <div id="right-container">
        <h2>Today's plan</h2>
        <?php 
            if(mysqli_num_rows($appointments) > 0) {
                foreach($appointments as $key => $appointment) {
                    $time = new DateTime($appointment['Time']);
                    $time = date_format($time, 'g:i A');
        ?>
                    <div class="box"><h3><?=($appointment['patient_name'])?></h3>  <h4>Visiting time: <?=($time)?> </h4></div>   
        <?php                    
                }
            }else {
        ?>
            <div class="no-data-found">
                No Record Found!
            </div>
        <?php         
            }
        ?>
    </div> 
</body>
</html>