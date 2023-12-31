<?php
    require_once("partials/_dbconnect.php");

    if(isset($_POST['uname']) && isset($_POST['upass'])) 

        $given_u = $_POST['uname'];
        $given_p = $_POST['upass'];

        $sql = "SELECT * FROM users WHERE Username = '$given_u' AND Password = '$given_p'";

        $result = mysqli_query($conn, $sql);

        $num = mysqli_num_rows($result);


        if ($given_u == "Admin123" && $given_p == "admin123"){
            session_start();
            ini_set('session.gc_maxlifetime', 3600);
            $_SESSION['type'] = 'Admin';
            $_SESSION['name'] = 'Admin';
            $_SESSION['loggedin'] = true;
            echo $_SESSION['type'];
            echo $_SESSION['name'];
            echo $_SESSION['loggedin'];
            header('location: Adminapproval.php');
            // exit();
        } 
        

        elseif ($num == 1){
            $login = true;
            $row = mysqli_fetch_assoc($result);
            $is_doctor = $row['is_doctor'];
            session_start();
            ini_set('session.gc_maxlifetime', 3600);
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $given_u;
            $_SESSION['number'] = $row['Mobile Number'];
            if ($is_doctor == 1){
                $_SESSION['type'] = 'Doctor';
                $id = $row['User ID'];
                $_SESSION['id'] = $id;
                $sql2 = "SELECT * FROM `doctors` WHERE `Doctor ID` = '$id'";
                $res = mysqli_query($conn, $sql2);
                $doctorinfo = mysqli_fetch_assoc($res);
                $_SESSION['name'] = $doctorinfo['Doctor_Name'];
                $_SESSION['Dstatus'] = $doctorinfo['Activestatus'];
                if ($_SESSION['Dstatus'] == "Active"){
                    header("location: doctordash.php");
                }
                else{
                    header("location: doctordash_pending.php");
                }
            }
            else{
                $_SESSION['type'] = 'Patient';
                $id = $row['User ID'];
                $_SESSION['id'] = $id;
                $sql3 = "SELECT * FROM `patients` WHERE `Patient ID` = '$id'";
                $res3 = mysqli_query($conn, $sql3);
                $patientinfo = mysqli_fetch_assoc($res3);
                $_SESSION['name'] =  $patientinfo['Name'] ;
                header("location: patienthome.php");
            }          
        }

        else{
            header("location: loginerror.php");
        }
    exit;
?>