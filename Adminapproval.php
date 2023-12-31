<?php
    date_default_timezone_set("Asia/Dhaka");
    session_start();
    echo !isset($_SESSION['loggedin']) ;
    echo $_SESSION['loggedin'] != true ;
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
        header("location: login.php");
    }
    elseif(isset($_SESSION['loggedin'])){
        if($_SESSION['loggedin'] == true){
            if($_SESSION['type'] == "Doctor")
            {
                header("location: doctordash.php");
            }
            elseif($_SESSION['type'] == "Patient"){
                header("location: patienthome.php");
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
    <title>HealthY-Admin-Dashboard</title>
    <link rel="stylesheet" href="Admin_approval.css">
    <!-- <meta http-equiv="refresh" content="2"> -->
</head>
<body>
    <div class = "frame">
        <nav>
            <a href="homepage.php"><img src = "images\healthylight.png" class="logo" id="logo"></a>
            <!-- <ul>
                <li><a href="#">History</a></li>
                <li><a href="#">Book Tests</a></li>
                <li><a href="#">Book an Apointment</a></li>
                <li><a href="#">Buy Medicine</a></li>
                <li><a href="#">Orders</a></li>
            </ul> -->
            <div class = "sidepanel">
                <a  class="signup" ><?php echo $_SESSION['name']?></a>
                <a href="logout.php" action="loginpage_login.php" class="btn">Log out</a>
                <img src="images\sun.png" id="icono"/>
            </div>
        </nav>

        <div class="content">
        <main class="table">
            <section class="table__header">
                <h1 class="" >Doctors Waiting For Approval</h1>
            </section >
            <section class="table__body">
                <table>
                    <thead>
                        <tr>
                            <th>Doctor ID</th>
                            <th>Doctor Name</th>
                            <th>Email Address:</th>
                            <th>Registration No:</th>
                            <th>Details</th>
                            <th>Accept</th>
                            <th>Reject</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            require_once("partials/_dbconnect.php");

                            $sql = "SELECT * FROM `doctors` WHERE `Activestatus` = 'Pending'";
                            $result = mysqli_query($conn, $sql);
                            $num = mysqli_num_rows($result);
                            $row = mysqli_fetch_assoc($result);
                            while ($row) {
                                $Did = $row['Doctor ID'];
                                $_SESSION['Did'] = $Did;
                                $Dname= $row['Doctor_Name'];
                                $Demail= $row['E-Mail'];
                                $Dreg=  $row['RegNo'];

                                echo
                                    '<tr>
                                        <td>'.$Did.'</td>
                                        <td>'.$Dname.'</td>
                                        <td>'.$Demail.'</td>
                                        <td>'.$Dreg.'</td>
                                        <td class = "tdb">
                                            <a href="adminapproval_click.php?did='.$Did.'" class="click_btn">Click</a>
                                        </td>
                                        <td class = "tdb">
                                            <a href="adminapproval_accept.php?did='.$Did.'" class="accept_btn">Accept</a>
                                        </td>
                                        <td class = "tdb">
                                            <a href="adminapproval_reject.php?did='.$Did.'" class="reject_btm">Reject</a>
                                        </td>
                                    </tr>';
                                $row = mysqli_fetch_assoc($result);                           
                              }
                        ?>

                    </tbody>
                </table>
            </section>
        </main>
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


