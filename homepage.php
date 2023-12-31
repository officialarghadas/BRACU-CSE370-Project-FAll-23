<?php
    session_start();
    $_SESSION['light'] = 0;
    if(isset($_SESSION['loggedin'])){
        if($_SESSION['type'] == "Patient"){
            header("location: patienthome.php");
        }
        elseif($_SESSION['type'] == "Doctor")
        {
            header("location: doctordash.php");
        }
        else{
            header("location: Adminapproval.php");
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HealthY</title>
    <link rel="stylesheet" href="homepage.css">
</head>
<body>


    <div class = "frame">
        <nav>
            <img src = "images\healthylight.png" class="logo" id="logo">
            <ul>
                <li><a href="https://docs.google.com/document/d/19HG72-gNa70banPmygDL-TmchYlnVjorCoidG864djY/edit">Features</a></li>
                <li><a href="https://www.figma.com/file/9EQ2OPksLAfw8KZljUdiXc/Untitled?type=whiteboard&node-id=0%3A1&t=7aPy2LFdlyvhXYr0-1">How it works</a></li>
                <li><a href="https://drive.google.com/drive/folders/1mYmLEcQzkHPZ3AMmkgxepWEVKN5Pa9UM?usp=sharing">Download</a></li>
            </ul>
            <div>
                <a href="signuppage.php" class="signup" >Sign up</a>
                <a href="login.php" class="btn">Log in</a>
                <img src="images\sun.png" id="icono"/>
            </div>
        </nav>

        <div class="content">
            <h1 class= "anim"> A step towards<br> Healthy life</h1>
            <p class= "anim">One website for all your <b>Health </b>related needs</p>
            <a href="signuppage.php" class="btn anim"> Get Started</a>
        </div>
        <img src="images\home.png" class="feature-img anim" id="imageft">
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
            $_SESSION['dark']
        }
        else{
            icono.src = "images\\sun.png";
            logoa.src = "images\\healthylight.png";
        }
    }

    </script>

</body>
</html>