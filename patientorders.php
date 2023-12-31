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
    <title>HealthY-Admin-Dashboard</title>
    <link rel="stylesheet" href="patientorders.css">
    <!-- <meta http-equiv="refresh" content="2"> -->
</head>
<body>
    <div class = "frame">
        <nav>
            <a href="homepage.php"><img src = "images\healthylight.png" class="logo" id="logo"></a>
            <ul>
                <li><a href="patienthistory.php">History</a></li>
                <li><a href="test.php">Book Tests</a></li>
                <li><a href="appointment_dummy.php">Book an Apointment</a></li>
                <li><a href="medicine.php">Buy Medicine</a></li>
                <li><a href="patientdash.php">Dashboard</a></li>
                
            </ul>
            <div class = "sidepanel">
                <a  class="signup" ><?php echo $_SESSION['name']?></a>
                <a href="logout.php" action="loginpage_login.php" class="btn">Log out</a>
                <img src="images\sun.png" id="icono"/>
            </div>
        </nav>

        <div class="content">
        <main class="table">
            <section class="table__header">
                <h1 class="tabhead" > Previous Orders </h1>
            </section >
            <section class="table__body">
                <table>
                    <thead>
                        <tr>
                            <th>Medicine Name</th>
                            <th>Date</th>
                            <th>Cost</th>
                            <th>Amount of items</th>
                            <th>Total Cost</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            require_once("partials/_dbconnect.php");
                            $pid = $_SESSION['id'];
                            $sql = "SELECT * FROM `pays for` LEFT JOIN `medicine` ON `pays for`.`Medicine Code` = `medicine`.`Medicine Code` WHERE `pays for`.`Patient ID` = $pid";
                            $result = mysqli_query($conn, $sql);
                            $num = mysqli_num_rows($result);
                            $row = mysqli_fetch_assoc($result);
                            // echo var_dump($row);
                            while ($row) {

                                $mname= $row['Medicine Name'];
                                $pfdate= $row['Date'];
                                $pfcost= $row['Cost'];
                                $mqty= $row['Quantity'];
                                $mprice= $row['Total Amount'];

                                echo
                                    '<tr>
                                        <td>'.$mname.'</td>
                                        <td>'.date("d-m-y", strtotime($pfdate)).'</td>
                                        <td>'.$pfcost.'</td>
                                        <td>'.$mqty.'</td>
                                        <td>'.$pfcost*$mqty.'</td>
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