<?php
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
            else{
                if($_SESSION["Dstatus"] == "Pending"){
                    header("location: doctordash_pending.php");}
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
    <title>HealthY-Doctor-Dashboard</title>
    <link rel="stylesheet" href="ddash.css">
</head>
<body>
    <div class = "frame">
        <nav>
            <img src = "images\healthylight.png" class="logo" id="logo">
            <ul>
                <li><a href="slots.php">Cancel Slots</a></li>
                <li><a href="add-slot.php">Give Slots</a></li>
                <li><a href="previous-history.php">Previous</a></li>
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
            $did = $_SESSION['id'];
            $CurrentDate= date('Y-m-d');
            $sql = "SELECT *
            FROM `appointment`
            LEFT JOIN `slots` ON `appointment`.`Slot Serial` = `slots`.`Slot ID`
            WHERE `appointment`.`Status` = '0' AND `appointment`.`Doctor ID` = $did AND `slots`.`Date` > '$CurrentDate'
            ORDER BY `slots`.`Date` ASC, `slots`.`Time` ASC";
            $result = mysqli_query($conn, $sql);
            $num_row = mysqli_num_rows($result);

            $lighticon2 = "images/umanb.png";
            $darkicon2  = "images/umanw.png";
    
            // if($num_row > 0){
            //                 $row = mysqli_fetch_assoc($result);
            //                 $Atime = $row["Time"];
            //                 $Adate = $row["Date"];
            //                 $Aserial = $row["Serial Number"];
            //                 if ($row["Status"] != 2){
            //                     $Astatus = "Active";
            //                     $idtype = "activestatus";
            //                     }
            //                 else{
            //                     $Astatus = "Canceled";
            //                     $idtype = "inactivestatus";
            //                 }
            //                 $Did = $row['Doctor ID'];
            //                 $sql2 = "SELECT * FROM `doctors` LEFT JOIN `specialities` ON `doctors`.`Specialties ID` = `specialities`.`Specialties ID` WHERE `doctors`.`Doctor ID` = '$Did'";
            //                 $result2 = mysqli_query($conn, $sql2);
                            
            //                 $row2 = mysqli_fetch_assoc($result2);
                            
                            
            //                 $Dname= $row2['Doctor_Name'];
            //                 $Ddesign= $row2['Designation'];
            //                 $Dspeciality = $row2['Specialities'];



            //                 $PCid = $row['CompName'];
            //                 if ($PCid !== NULL){
            //                                     $sql3 = "SELECT * FROM `patient companions` WHERE `Name` = '$PCid' AND `Patient ID` = $pid";
            //                                     $result3 = mysqli_query($conn, $sql3);
            //                                     $row3 = mysqli_fetch_assoc($result3);

            //                                     $PCname= $row3['Name'];
            //                                     $PCnum= $row3['Mobile Number'];
            //                                     $PCr = $row3['Relation'];
            //                                 }
            //                 else{
            //                     $PCname= "No Companion";
            //                     $PCnum= '---' ;
            //                     $PCr = '---' ;
            //                 }
            //             }
            

            
            

            if($num_row > 0){
                            echo
                            '<div class="leftside">
                            <section class="table__header">
                                <h1 class="" >Waiting Paitents</h1>
                            </section >
                            <section class="table__body">
                            <table name = "tables">
                                <thead>
                                    <tr>
                                        <th>Patient Name</th>
                                        <th>Date</th>
                                        <th>Serial</th>
                                        <th>Prescription</th>
                                        <!-- <th>Details</th>
                                        <th>Accept</th>
                                        <th>Reject</th> -->
                                    </tr>
                                </thead>
                                <tbody>';
                                        $did = $_SESSION['id'];
                                        $sql2 = "SELECT * FROM `appointment` WHERE `Status` = '0' AND `Doctor ID` = $did";
                                        $result2 = mysqli_query($conn, $sql2);
                                        $num2 = mysqli_num_rows($result2);
                                        $row2 = mysqli_fetch_assoc($result2);
                                        while ($row2) {
                                            $ap_id = $row2['Appointment ID'];;
                                            $pid = $row2['Patient ID'];
                                            $sql3 = "SELECT * FROM `patients` WHERE `Patient ID` = $pid";
                                            $result3 = mysqli_query($conn, $sql3);
                                            $row3 = mysqli_fetch_assoc($result3);
                                            $Pname= $row3['Name'];
            
                                            $Slotid = $row2['Slot Serial'];
                                            $sql3 = "SELECT * FROM `slots` WHERE `Slot ID` = $Slotid ";
                                            $result3 = mysqli_query($conn, $sql3);
                                            $row3 = mysqli_fetch_assoc($result3);
                                            $Adate= $row3['Date'];
                                            $Aseriali= $row3['Serial Number'];
                                            echo
                                                '<tr>
                                                    <td>'.$Pname.'</td>
                                                    <td>'.$Adate.'</td>
                                                    <td>'.$Aseriali.'</td>
                                                    <td class = "tdb">
                                                    <a href="doctordash_temp.php?patientid='.$pid.'&apid='.$ap_id.'" class="click_btn">Details</a>
                                                    </td>
                                                </tr>';
                                            $row2 = mysqli_fetch_assoc($result2);                           
                                          }
                                    echo '
            
                                </tbody>
                            </table>
                        </section>
                            </div>';
            }
            else{
                echo '
                <div class="leftside">
                                <h1 class="headtext">No Appointments</h1>
                </div>
                ';
            }

            echo'
            <div class="middiv"></div>
            <div class="rightside">';

            if (isset($_SESSION['details_id'])) {
                $pid = $_SESSION['details_id'];
                $sql5 = "SELECT * FROM `patients` WHERE `Patient ID` = $pid";
                $result5 = mysqli_query($conn, $sql5);
                $row5 = mysqli_fetch_assoc($result5);
                $pname = $row5['Name'];
                $pag=$row5['Age'];
                $pbg=$row5['Blood Group'];
                $pgen=$row5['Gender'];
                $pms=$row5['Marital Status'];
                $pemail=$row5['Email'];

                if ($pgen == 'Male'){
                    $lighticon2 = "images/umanb.png";
                    $darkicon2  = "images/umanw.png";
                    }
                else{
                    $lighticon2 = "images/wmanb.png";
                    $darkicon2  = "images/wmanw.png";
                }

                echo
                '<h1 class="headtext">Patient Info</h1>
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
                            <h3 class="normtext" >'.$pname.'</h3>
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
                            <h3 class="normtext-label" >Email:</h3> 
                        </div>
                        <div class="leftdoc-bar">

                        </div>
                        <div class="leftdoc-details">
                            
                            <h3 class="normtext" >'.$pemail.'</h3>
                        </div>
                    </div>
                    <div class="leftdoc-row" id="presc">
                    </div>
                    <div class="leftdoc-row" id="presc">
                        <a href="up_presci.php" class="click_btn">Prescribe</a>
                    </div>

                </div>';}
            else{

            }

            echo '</div>
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