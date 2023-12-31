<?php
    session_start();
    if(isset($_SESSION['loggedin'])){
        if($_SESSION['loggedin'] == true){
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
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <style>
        body {
            font-family: 'Poppins';font-size: 14px;
        }
    </style>
</head>
<body>
    <div class = "content">  
        <div class = "wrapper">
            <form action="loginpage_login.php" method="post">
                <h1>Log in</h1>
                
                <div class = "form-group">
                    <input type = "text"  name= "uname" id = "Username" placeholder="Username" required>
                </div>

                <div class = "form-group">
                    <input type="password" name= "upass" placeholder="Password" id = "Password" required>
                    <img src="images\blue_eye500.png" id = "eyeicon" />
                </div>

                <div class="forgot">
                    <label> <input type="checkbox">Remember me</label>
                    <a href="#">Forgot Password</a>
                </div>

                <button type="submit" class="button"> Login</button>
                <div class="registration">
                    <p> Don't an account <a href="signuppage.php"> Sign up</a>
                    </p>
                </div>
            </form>
        </div>
        
        <img src="images\sun.png" id="icono"/>
    </div>
    
    
    
    <!-- ============================================log in page end========================== -->
<script>

    let eyeicon = document.getElementById('eyeicon');
    let password = document.getElementById('Password');
    let icono = document.getElementById('icono');
    

    eyeicon.onclick = function(){
        if(password.type == "password"){
            password.type = "text"
            eyeicon.src = "images\\Grey_eye500.png"
        }
        else{
            password.type = "password"
            eyeicon.src = "images\\blue_eye500.png"
        }
    }

    icono.onclick = function(){
        document.body.classList.toggle("light-mode");
        if(document.body.classList.contains("light-mode")){
            icono.src = "images\\moon.png"
        }
        else{
            icono.src = "images\\sun.png"
        }
    }

</script>


    <!-- ============================================ Registration start ========================== -->

  	
</body>
</html>
