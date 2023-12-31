<?php
    ob_start();
    session_start();
    require './helpers/functions.php';
    require './helpers/config.php';
    include './helpers/db.php';



    $doctor_id = $_SESSION['id'];
    $search_text = $error = $success = null;

    $previous_patients = mysqli_query($db_connect, "SELECT
    appointment.`Appointment ID` AS APID,
    patients.Name AS PatientName,
    slots.Date AS AppointmentDate,
    slots.Time AS AppointmentTime,
    appointment.Prescription,
    appointment.`Slot Serial` AS SlotSerial FROM appointment JOIN slots ON appointment.`Slot Serial` = slots.`Slot ID` JOIN
    patients ON appointment.`Patient ID` = patients.`Patient ID` WHERE appointment.`Doctor ID` = '$doctor_id'");

    if($_SERVER['REQUEST_METHOD'] == "GET") {
        if(isset($_GET['search'])) {
            $name = mysqli_real_escape_string($db_connect,data_sanitize($_GET['name']));
            $date = mysqli_real_escape_string($db_connect,data_sanitize($_GET['date']));
            $query = "SELECT
            appointment.`Appointment ID` AS APID,
            patients.Name AS PatientName,
            slots.Date AS AppointmentDate,
            slots.Time AS AppointmentTime,
            appointment.Prescription,
            appointment.`Slot Serial` AS SlotSerial FROM appointment JOIN slots ON appointment.`Slot Serial` = slots.`Slot ID` JOIN
            patients ON appointment.`Patient ID` = patients.`Patient ID` WHERE appointment.`Doctor ID` = '$doctor_id'  ";

            if($name != "") {
                $query .= " AND patients.Name LIKE '%$name%'";
            }

            if($date != "") {
                $query .= "AND slots.Date = '$date'";
            }

            // $query .= " ORDER BY `ID` DESC";
            
            if($name != null || $date != null) {
                $previous_patients = mysqli_query($db_connect, $query);
            }
        }
    }

    if(isset($_SESSION['error'])) {
        $error = $_SESSION['error'];
    }

?>

<?php include 'Navbar.php'; ?>

<!DOCTYPE html>
<html lang="en" title="Coding design">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Booked Slots</title>
    <link rel="stylesheet" href="./assets/css/pp.css">
</head>

<body>

    <div id ="tabfaka"></div>

    <?php 
        if($error != null) {
    ?>
        <div class="error" style="background: #F0323B; padding: 15px 20px; color: #ddd; border-radius: 8px; margin-bottom: 15px; font-family: Arial, Helvetica, sans-serif; font-size: 15px; max-width:40%; margin: 0 auto 15px auto; margin-top: 20px;">
            <?=($error)?>
        </div>
    <?php 
        }
    ?>

    <?php 
        if($success != null) {
    ?>
        <div class="error" style="background: #07A647; padding: 15px 20px; color: #ddd; border-radius: 8px; margin-bottom: 15px; font-family: Arial, Helvetica, sans-serif; font-size: 15px; max-width:40%; margin: 0 auto 15px auto; margin-top: 20px;">
            <?=($success)?>
        </div>
    <?php 
        }
    ?>

    <main class="table">
        <section class="table__header">
            <h1>Previous Patients</h1>
            <a href="./history-search.php" class="search-btn">Search</a>
        </section>
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th> <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Slot Serial <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Patient Name<span class="icon-arrow">&UpArrow;</span></th>
                        <th> Date <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Time <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Action <span class="icon-arrow">&UpArrow;</span></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        if(mysqli_num_rows($previous_patients) > 0) {
                            foreach($previous_patients as $key => $patient) {
                    ?>
                            <tr>
                                <td><?=($key + 1)?></td>
                                <td><?=($patient['SlotSerial'])?></td>
                                <td><?=($patient['PatientName'])?></td>
                                <td><?=($patient['AppointmentDate'])?></td>
                                <td><?=($patient['AppointmentTime'])?></td>
                                <td>
                                    <a href="download_prescription.php?presci=<?=($patient['APID'])?>" id="downloadbtn">Download</a>
                                </td>
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

<?php 
    unset($_SESSION['error']);
?>