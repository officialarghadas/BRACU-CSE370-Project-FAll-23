<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HealthY-Doctor-Dashboard</title>
    <link rel="stylesheet" href="navbar.css">
</head>
<body>
    <div class = "frame">
        <nav>
            <img src = "images\healthylight.png" class="logo" id="logo">
            <ul>
                <li><a href="slots.php">Cancel Slots</a></li>
                <li><a href="doctordash.php">Dashboard</a></li>
                <li><a href="add-slot.php">Give Slots</a></li>
                <li><a href="previous-history.php">Previous</a></li>
                
            </ul>
            <div>
                <a  class="signup" ><?php echo $_SESSION['name']?></a>
                <a href="logout.php" action="loginpage_login.php" class="btn">Log out</a>
            </div>
        </nav>
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