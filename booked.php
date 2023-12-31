<?php
    ob_start();
    session_start();
    require './helpers/functions.php';
    require './helpers/config.php';
    include './helpers/db.php';
    include './helpers/auth.php';

    $doctor_id = $login_user_id;

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        if(isset($_POST['booking-cancel'])) {
            $appointment_id = mysqli_real_escape_string($db_connect,data_sanitize($_POST['target']));
            if($appointment_id != "") {

                $status_cancel = STATUS_CANCEL;
                $appointment_update_to_canceled = mysqli_query($db_connect, "UPDATE `appointment` SET `Status`= '$status_cancel' WHERE `Appointment ID`='$appointment_id'");

                if($appointment_update_to_canceled == true) {
                    $success = "Information Updated Successfully!";
                }else {
                    $error = "Something Went Wrong! Please try again";
                }
            }
        }
    }

    $all_appointments = mysqli_query($db_connect, "SELECT appointment.*, patients.Name as patient_name, patients.`Patient ID`, patients.Status as patient_status
    FROM appointment JOIN patients ON appointment.`Paitent ID` = patients.`Patient ID` WHERE appointment.`Doctor ID` = '$doctor_id'");

    $booking_cancel_previous_time = BOOKING_CANCEL_PREVIOUS_TIME;

    $search_text = $error = $success = null;

    if($_SERVER['REQUEST_METHOD'] == "GET") {
        if(isset($_GET['search-btn'])) {
            $search_text = mysqli_real_escape_string($db_connect,data_sanitize($_GET['search']));
            if($search_text != "") {
                $all_appointments = mysqli_query($db_connect, "SELECT appointment.*, patients.Name as patient_name, patients.`Patient ID`, patients.Status as patient_status
                FROM appointment JOIN patients ON appointment.`Appointment ID` = patients.`Patient ID` WHERE appointment.`Doctor ID` = '$doctor_id' AND patients.Name LIKE '%$search_text%' ORDER BY `Appointment ID` DESC ");
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en" title="Coding design">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Booked Slots</title>
    <link rel="stylesheet" href="./assets/css/booked.css">
</head>

<body>
    <div class="logout-container">
        <button class="logout-button">Logout</button>
    </div>

    <?php 
        if($error != null) {
    ?>
        <div class="error" style="background: #F0323B; padding: 15px 20px; color: #ddd; border-radius: 8px; margin-bottom: 15px; font-family: Arial, Helvetica, sans-serif; font-size: 15px; max-width:40%; margin: 0 auto 15px auto;">
            <?=($error)?>
        </div>
    <?php 
        }
    ?>

    <?php 
        if($success != null) {
    ?>
        <div class="error" style="background: #07A647; padding: 15px 20px; color: #ddd; border-radius: 8px; margin-bottom: 15px; font-family: Arial, Helvetica, sans-serif; font-size: 15px; max-width:40%; margin: 0 auto 15px auto;">
            <?=($success)?>
        </div>
    <?php 
        }
    ?>

    <main class="table">
        <section class="table__header">
            <h1>Patient's schedule</h1>
            <div class="input-group">
                <form action="" method="GET">
                    <input type="search" placeholder="Search" name="search" value="<?=($search_text)?>">
                    <button type="submit" name="search-btn">
                        <img src="./assets/img/src.png" alt="src.png">
                    </button>
                </form>
            </div>
        </section>
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th> Sl no <span class="icon-arrow">&UpArrow;</span></th>
                        <th> AP ID <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Patient Name<span class="icon-arrow">&UpArrow;</span></th>
                        <th> Status <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Date <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Time<span class="icon-arrow">&UpArrow;</span></th>
                        <th> Decline <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Amount <span class="icon-arrow">&UpArrow;</span></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        if(mysqli_num_rows($all_appointments) > 0) {
                            foreach($all_appointments as $key => $appointment) {

                                $date = new DateTime($appointment['Date']);
                                $date = date_format($date, "Y-m-d");

                                $time = new DateTime($appointment['Time']);
                                $time_print = date_format($time, 'h:i:s A');
                                $time = date_format($time, "H:i:s");
                                $date_time = $date . " " . $time;
                                $date_time_unix = strtotime($date_time);
                                $current_time = date("h:i:s");
                                $current_time_unix = strtotime($current_time);
                                $current_time_with_addition = strtotime("+". $booking_cancel_previous_time, $current_time_unix);
                    ?>
                            <tr>
                                <td><?=($key + 1)?></td>
                                <td><?=($appointment['Appointment ID'])?></td>
                                <td><?=($appointment['patient_name'])?></td>
                                <td><?=($appointment['patient_status'])?></td>
                                <td><?=($appointment['Date'])?></td>
                                <td><?=($time_print)?></td>
                                <td>
                                    <?php 
                                        if($current_time_with_addition < $date_time_unix && $appointment['Status'] == 1) {
                                    ?>
                                        <form action="" method="POST">
                                            <input type="hidden" name="target" value="<?=($appointment['Appointment ID'])?>">
                                            <button type="submit" class="status" name="booking-cancel">Cancel</button>
                                        </form>
                                    <?php         
                                        }else {
                                    ?>
                                        <p class="status warning">Can't take any action</p>
                                    <?php         
                                        }
                                    ?>
                                </td>
                                <td> <strong> <?=($appointment['Cost'])?> </strong></td>
                            </tr>
                    <?php             
                            }
                        }
                    ?>
                </tbody>
            </table>
        </section>
    </main>
</body>

</html>