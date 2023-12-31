<?php 
    ob_start();
    session_start();
    require './helpers/functions.php';
    require './helpers/config.php';
    require 'vendor/autoload.php';
    include "partials/_dbconnect.php";

    $success = $error = null;
    $doctor_id = $_SESSION['id'];


    $appointment_id = $_SESSION['ap_id'];
    

    $appointment_result = mysqli_query($conn, "SELECT `appointment`.*, `patients`.`Name` as patient_name, `patients`.`Age` as patient_age FROM `appointment` JOIN patients ON appointment.`Patient ID` = patients.`Patient ID` WHERE `Appointment ID`='$appointment_id'");
    

    if(mysqli_num_rows($appointment_result) > 0) {
        $appointment = mysqli_fetch_assoc($appointment_result);

    }else {
        echo "Error: " . mysqli_error($conn);
        
    }

    $symptoms_result = mysqli_query($conn, "SELECT * FROM `symptoms` ORDER BY `Symptoms ID` DESC");
    $medicine_results = mysqli_query($conn, "SELECT * FROM `medicine`");

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        if(isset($_POST['create'])) {

            $symptom = $new_symptom = $desc = null;
            $medicines = [];
            $symptom_id = null;

            if(isset($_POST['symptom'])) {
                $symptom        = mysqli_real_escape_string($conn,data_sanitize($_POST['symptom']));
                $symptom_id     = $symptom;
            }

            $symptom_new    = mysqli_real_escape_string($conn,data_sanitize($_POST['symptom_new']));
            $desc           = mysqli_real_escape_string($conn,data_sanitize($_POST['desc']));

            if(isset($_POST['medicines'])) {
                $medicines      = $_POST['medicines'];
            }

            if(count($medicines) == 0) {
                $error = "Medicine filed is required!";
            }

            $medicines_json      = json_encode($medicines);

            if($symptom == null && $symptom_new == null) {
                $error = "Symptom is required! Please select or write symptom";
            }

            // If have new symptom
            if($symptom_new != null && $symptom == null) {
                // Add new symptom is it's not exists
                $symptom_exists_result = mysqli_query($conn, "SELECT * FROM `symptoms` WHERE `Symptom Name`='$symptom_new'");
                if(mysqli_num_rows($symptom_exists_result) == 0) {
                    // inert new symptom to record
                    $symptom_insert_result = mysqli_query($conn, "INSERT INTO `symptoms`(`Symptom Name`) VALUES ('$symptom_new')");
                    if($symptom_insert_result != true) {
                        $error = "New Symptom Insert Failed! Please try again";
                    }else {
                        $symptom_id = mysqli_insert_id($conn);
                    }
                }
            }

            if(!is_numeric($symptom_id)) {
                $error = "Invalid Symptom! Please try again";
            }

            // check prescription is already exists or not
            $prescription_exists_result = mysqli_query($conn, "SELECT * FROM `makes prescription` WHERE `Appointment ID`='$appointment_id'");
            if(mysqli_num_rows($prescription_exists_result) > 0) {
                $error = "Prescription already exists!";
            }

            if($error == null) {
                $date = date('d-m-Y');
                // Insert prescription data
                $prescription_insert_result = mysqli_query($conn, "INSERT INTO `makes prescription`(`Appointment ID`, `Symptoms ID`, `Medicines`, `Description`, `Date`) VALUES ('$appointment_id','$symptom_id','$medicines_json','$desc','$date')");
                if($prescription_insert_result == true) {

                    $status_active = STATUS_ACTIVE;
                    // update prescription status on appointment table
                    $prescription_status_on_appointment = mysqli_query($conn, "UPDATE `appointment` SET `Prescription Status`='$status_active' WHERE `Appointment ID`='$appointment_id' ");

                    $_SESSION['success'] = "Prescription created successfully!";
                    
                    exit();
                }else {
                    $error = "Failed to create prescription. Please try again";
                }
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
    <link rel="stylesheet" href="up_prescii.css">
    <title>Prescription Update</title>
</head>
<body>

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

    <div class="container">
        <h1 class="title">Make prescription</h1>
        <div class="patient-information">
            <h3 class="section-title">Patient Information</h3>
            <ul style="list-style-type: none;">
                <li>
                    <strong>
                        Patient Name: 
                    </strong>
                    <span>
                        <?=($appointment['patient_name'])?>
                    </span>
                </li>
                <li>
                    <strong>
                        Patient Age: 
                    </strong>
                    <span>
                        <?=($appointment['patient_age'])?>
                    </span>
                </li>
            </ul>
        </div>


        <div class="placeholders">
            <form action="" method="POST" enctype="multipart/form-data">
                <br>
                <div class="input-group">
                    <label for="symptoms">Select Symptoms</label>
                    <?php 
                        $old_symptom = $symptom ?? 0;
                    ?>
                    <select name="symptom" id="symptoms" class="">
                        <option value="" selected disabled>Choose One</option>
                        <?php 
                            if(mysqli_num_rows($symptoms_result) > 0) {
                                foreach($symptoms_result as $symptom) {
                        ?>  
                                    <option value="<?=($symptom['Symptoms ID'])?>" <?=($old_symptom == $symptom['Symptoms ID'] ? "selected" : "")?>><?=($symptom['Symptom Name'])?></option>
                        <?php             
                                }                         
                            }
                        ?>
                    </select>
                </div>

                <div class="">Or</div>

                <div class="input-group">
                    <label for="write-symptom">Write Symptom</label>
                    <br>
                    <input type="text" name="symptom_new" placeholder="Write Symptom" value="<?=($new_symptom ?? "")?>">
                </div>

                <div class="input-group">
                    <label for="medicine">Select Medicine</label>
                    <br>
                    <?php 
                        $old_medicines = $medicines ?? [];
                    ?>
                    <select name="medicines[]" id="medicines" multiple>
                        <option value="" selected disabled>Choose Medicines</option>
                        <?php 
                            if(mysqli_num_rows($medicine_results) > 0) {
                                foreach($medicine_results as $medicine) {
                        ?>
                                    <option value="<?=($medicine['Medicine Name'])?>" <?=(in_array($medicine['Medicine Name'], $old_medicines) ? "selected" : "")?>><?=($medicine['Medicine Name'])?></option>
                        <?php 
                                }
                            }
                        ?>
                    </select>
                </div>

                <div class="input-group">
                    <label for="desc">Description</label>
                    <br>
                    <textarea name="desc" id="desc" cols="30" rows="5" placeholder="Write any description/note"><?=($desc ?? "")?></textarea>
                </div>

                <br>
                <button type="submit" class="submit-btn" name="create">Create</button>
            </form>
        </div>

    </div>
</body>
</html>