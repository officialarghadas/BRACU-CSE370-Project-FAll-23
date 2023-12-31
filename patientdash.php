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
    <title>HealthY-Patient-Dashboard</title>
    <link rel="stylesheet" href="patientdash.css">
    <meta http-equiv="refresh" content="120">
</head>
<body>
    <div class = "frame">
        <nav>
            <a href="patienthome.php"><img src = "images\healthylight.png" class="logo" id="logo"></a>
            <ul>
                <li><a href="patienthistory.php">History</a></li>
                <li><a href="test.php">Book Tests</a></li>
                <li><a href="appointment_dummy.php">Book an Apointment</a></li>
                <li><a href="medicine.php">Buy Medicine</a></li>
                <li><a href="patientorders.php">Orders</a></li>
            </ul>
            <div>
                <a  class="signup" ><?php echo $_SESSION['name']?></a>
                <a href="logout.php" action="loginpage_login.php" class="btn">Log out</a>
                <img src="images\sun.png" id="icono"/>
            </div>
        </nav>
        <div class = "cont">
            <?php
            require_once("partials/_dbconnect.php");
            $pid = $_SESSION['id'];
            $CurrentDate= date('Y-m-d');
            $sql = "SELECT *
            FROM `appointment`
            LEFT JOIN `slots` ON `appointment`.`Slot Serial` = `slots`.`Slot ID`
            WHERE `appointment`.`Status` != '1' AND `appointment`.`Patient ID` = $pid AND `slots`.`Date` > '$CurrentDate'
            ORDER BY `slots`.`Date` ASC, `slots`.`Time` ASC";
            $result = mysqli_query($conn, $sql);
            $num_row = mysqli_num_rows($result);
            if($num_row > 0){
                            $row = mysqli_fetch_assoc($result);
                            $Atime = $row["Time"];
                            $Adate = $row["Date"];
                            $Aserial = $row["Serial Number"];
                            if ($row["Status"] != 2){
                                $Astatus = "Active";
                                $idtype = "activestatus";
                                }
                            else{
                                $Astatus = "Canceled";
                                $idtype = "inactivestatus";
                            }
                            $Did = $row['Doctor ID'];
                            $sql2 = "SELECT * FROM `doctors` LEFT JOIN `specialities` ON `doctors`.`Specialties ID` = `specialities`.`Specialties ID` WHERE `doctors`.`Doctor ID` = '$Did'";
                            $result2 = mysqli_query($conn, $sql2);
                            
                            $row2 = mysqli_fetch_assoc($result2);
                            
                            
                            $Dname= $row2['Doctor_Name'];
                            $Ddesign= $row2['Designation'];
                            $Dspeciality = $row2['Specialities'];



                            $PCid = $row['CompName'];
                            if ($PCid !== NULL){
                                                $sql3 = "SELECT * FROM `patient companions` WHERE `Name` = '$PCid' AND `Patient ID` = $pid";
                                                $result3 = mysqli_query($conn, $sql3);
                                                $row3 = mysqli_fetch_assoc($result3);

                                                $PCname= $row3['Name'];
                                                $PCnum= $row3['Mobile Number'];
                                                $PCr = $row3['Relation'];
                                            }
                            else{
                                $PCname= "No Companion";
                                $PCnum= '---' ;
                                $PCr = '---' ;
                            }
                        }
            

            $sql4 = "SELECT * FROM `patients` WHERE `Patient ID` = $pid";
            $result4 = mysqli_query($conn, $sql4);
            $row4 = mysqli_fetch_assoc($result4);
            $pag=$row4['Age'];
            $pbg=$row4['Blood Group'];
            $pgen=$row4['Gender'];
            $pms=$row4['Marital Status'];
            $pnum=$_SESSION['number'];
            $pemail=$row4['Email'];

            if ($pgen == 'Male'){
                $lighticon2 = "images/umanb.png";
                $darkicon2  = "images/umanw.png";
                }
            else{
                $lighticon2 = "images/wmanb.png";
                $darkicon2  = "images/wmanw.png";
            }
            

            if($num_row > 0){
                            echo
                            '<div class="leftside">
                                <h1 class="headtext">Next Apointment</h1>
                                <div class="leftside-bigdiv">
                                    <div class="bigdiv-parts">  
                                        <h2 class="bigtext">'.date("h:i", strtotime($Atime)).'</h2>
                                        <h2 class="smalltext">'.date("a", strtotime($Atime)).'</h2>
                                    </div>
                                    <div class="bigdiv-parts2">
                                        <h2 class="serialtext">Serial Number</h2>
                                        <h2 class="bigtext2">'.$Aserial.'</h2>
                                    </div>
                                </div>
                                <div  class="leftside-buttondiv">
                                    <h2 class="smalltext type2" >'.date("d-m-y",strtotime($Adate)).'</h2>
                                    <h2 class="smalltext type2">'.date("l",strtotime($Adate)).'</h2>
                                    <h2 class="smalltext type2" id="'.$idtype.'">'.$Astatus.'</h2>
                                </div>
                                <div class="leftdoc">
                                    <div class="leftdoc-row">
                                        <div class="leftdoc-lebel">
                                            <h3 class="normtext-label" >Doctor Name:</h3>
                                        </div>
                                        <div class="leftdoc-bar">
                                        </div>
                                        <div class="leftdoc-details">
                                            <h3 class="normtext" >'.$Dname.'</h3>
                                        </div>
                                    </div>
                                    <div class="leftdoc-row">
                                        <div class="leftdoc-lebel">
                                            <h3 class="normtext-label" >Designation:</h3>   
                                        </div>
                                        <div class="leftdoc-bar">

                                        </div>
                                        <div class="leftdoc-details">
                                            <h3 class="normtext" >'.$Ddesign.'</h3>
                                        </div>
                                    </div>
                                    <div class="leftdoc-row">
                                        <div class="leftdoc-lebel">
                                            <h3 class="normtext-label" >Speciality:</h3> 
                                        </div>
                                        <div class="leftdoc-bar">

                                        </div>
                                        <div class="leftdoc-details">
                                            <h3 class="normtext" >'.$Dspeciality.'</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="leftdoc" id="leftdoc2">
                                    <div class="leftdoc-row">
                                        <div class="leftdoc-lebel">
                                            <h3 class="normtext-label" >Companion Name:</h3> 
                                        </div>
                                        <div class="leftdoc-bar">

                                        </div>
                                        <div class="leftdoc-details">
                                            <h3 class="normtext" >'.$PCname.'</h3>
                                        </div>
                                    </div>
                                    <div class="leftdoc-row">
                                        <div class="leftdoc-lebel">
                                            <h3 class="normtext-label" >Contact Number:</h3> 
                                        </div>
                                        <div class="leftdoc-bar">

                                        </div>
                                        <div class="leftdoc-details">
                                            <h3 class="normtext" >'.$PCnum.'</h3>
                                        </div>
                                    </div>
                                    <div class="leftdoc-row">
                                        <div class="leftdoc-lebel">
                                            <h3 class="normtext-label" >Relation:</h3> 
                                        </div>
                                        <div class="leftdoc-bar">

                                        </div>
                                        <div class="leftdoc-details">
                                            <h3 class="normtext" >'.$PCr.'</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="warning">
                                    <h3 class="warntext">&#128128; Apointment can be canceled at any time, keep an eye in active status !!!</h3>
                                </div>
                            </div>';
            }
            else{
                echo '
                <div class="leftside">
                                <h1 class="headtext">No Appointments</h1>
                </div>
                ';
            }

            echo
            '<div class="middiv"></div>
            <div class="rightside">
                <h1 class="headtext">Patient Info</h1>
                <div class="leftside-bigdiv">
                    <img src="'.$darkicon2.'" id="profilepic">
                </div>
                <div class="leftdoc" id="right">
                    <div class="leftdoc-row">
                        <div class="leftdoc-lebel">
                            <h3 class="normtext-label" >Patient Name:</h3>
                        </div>
                        <div class="leftdoc-bar">
                        </div>
                        <div class="leftdoc-details">
                            <h3 class="normtext" >'.$_SESSION['name'].'</h3>
                        </div>
                    </div>
                    <div class="leftdoc-row">
                        <div class="leftdoc-lebel">
                            <h3 class="normtext-label" > Age:</h3>   
                        </div>
                        <div class="leftdoc-bar">

                        </div>
                        <div class="leftdoc-details">
                            <h3 class="normtext" >'.$pag.'</h3>
                        </div>
                    </div>
                    <div class="leftdoc-row">
                        <div class="leftdoc-lebel">
                            <h3 class="normtext-label" >Blood Group:</h3> 
                        </div>
                        <div class="leftdoc-bar">

                        </div>
                        <div class="leftdoc-details">

                            <h3 class="normtext" >'.$pbg.'</h3>
                        </div>
                    </div>
                    <div class="leftdoc-row">
                        <div class="leftdoc-lebel">
                            <h3 class="normtext-label" >Gender:</h3> 
                        </div>
                        <div class="leftdoc-bar">

                        </div>
                        <div class="leftdoc-details">
                            
                            <h3 class="normtext" >'.$pgen.'</h3>
                        </div>
                    </div>
                    <div class="leftdoc-row">
                        <div class="leftdoc-lebel">
                            <h3 class="normtext-label" >Marital status:</h3> 
                        </div>
                        <div class="leftdoc-bar">

                        </div>
                        <div class="leftdoc-details">
                            
                            <h3 class="normtext" >'.$pms.'</h3>
                        </div>
                    </div>
                    <div class="leftdoc-row">
                        <div class="leftdoc-lebel">
                            <h3 class="normtext-label" >Mobile No:</h3> 
                        </div>
                        <div class="leftdoc-bar">

                        </div>
                        <div class="leftdoc-details">
                            
                            <h3 class="normtext" >'.$pnum.'</h3>
                        </div>
                    </div>
                    <div class="leftdoc-row">
                        <div class="leftdoc-lebel">
                            <h3 class="normtext-label" >Email:</h3> 
                        </div>
                        <div class="leftdoc-bar">

                        </div>
                        <div class="leftdoc-details">
                            
                            <h3 class="normtext" >'.$pemail.'</h3>
                        </div>
                    </div>
                </div>
            
            </div>
        </div>
    </div>
    

    <script>


    let icono = document.getElementById("icono");
    let logoa = document.getElementById("logo");
    let profpic = document.getElementById("profilepic");
    let imageft = document.getElementById("imageft");

    icono.onclick = function(){
        document.body.classList.toggle("light-home");
        if(document.body.classList.contains("light-home")){
            icono.src = "images/moon.png";
            logoa.src = "images/healthy.png";
            profpic.src = "'.$lighticon2.'";

        }
        else{
            icono.src = "images/sun.png";
            logoa.src = "images/healthylight.png";
            profpic.src = "'.$darkicon2.'";


        }
    }

    </script>';
    ?>
</body>
</html>