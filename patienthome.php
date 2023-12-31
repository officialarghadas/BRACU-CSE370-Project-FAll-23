<?php
    date_default_timezone_set("Asia/Dhaka");
    session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
        header("location: login.php");
    }
    elseif(isset($_SESSION['loggedin'])){
        if($_SESSION['loggedin'] == true){
            if($_SESSION['type'] == "Doctor")
            {
                header("location: doctordash.php");
            }
            elseif($_SESSION['type'] == "Admin"){
                header("location: Adminapproval.php");
            }
        }
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HealthY-Patient-Home</title>
    <link rel="stylesheet" href="patienthome.css">
</head>
<body>


    <div class = "frame">
        <nav>
            <img src = "images\healthylight.png" class="logo" id="logo">
            <ul>
                <li><a href="patientdash.php">Dashboard</a></li>
            </ul>
            <div>
                <a  class="signup" ><?php echo $_SESSION['name'];?></a>
                <a href="logout.php" action="loginpage_login.php" class="btn">Log out</a>
                <img src="images\sun.png" id="icono"/>
            </div>
        </nav>
        <div class = "content">
                <a class = "butn1" href="appointment_dummy.php"><img class="fimage1" src="images\Doctors2.png"> <p class = "lik1">Book an<br>Appointment</p></a>
                <a class = "butn2" href="medicine.php"><img class="fimage2" src="images\Medicines.png"><p class = "lik2">Buy<br>Medicines</p></a>
                <a class = "butn2" href="test.php"><img class="fimage3" src="images\tests1.png"><p class = "lik3">Take a<br> Test</p></a>
        </div>
    </div>
    

    <script>


    let icono = document.getElementById('icono');
    let logoa = document.getElementById('logo');
    let imageft = document.getElementById('imageft');

    icono.onclick = function(){
        document.body.classList.toggle("light-home");
        if(document.body.classList.contains("light-home")){
            icono.src = "images\\moon.png";
            logoa.src = "images\\healthy.png";
        }
        else{
            icono.src = "images\\sun.png";
            logoa.src = "images\\healthylight.png";
        }
    }

    </script>

</body>
</html>