<?php
    ob_start();
    session_start();
    require './helpers/functions.php';
    require './helpers/config.php';
    include './helpers/db.php';

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
        }
    }

    $available_slot_dates = get_slot_dates();

    $error = $success = null;
    $doctor_id  = $_SESSION['id'];
    
?>
<?php include 'Navbar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/add--slot.css">
    <title>Add New Slot</title>
</head>
<body>
    <div id="navbbar">
        
    </div>
    <h1>Add Slot</h1>
    <?php 
        if($error != null) {
    ?>
        <div class="error" style="background: #F0323B; padding: 15px 20px; color: #ddd; border-radius: 8px; margin-bottom: 15px; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">
            <?=($error)?>
        </div>
    <?php 
        }
    ?>

    <?php 
        if($success != null) {
    ?>
        <div class="error" style="background: #07A647; padding: 15px 20px; color: #ddd; border-radius: 8px; margin-bottom: 15px; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">
            <?=($success)?>
        </div>
    <?php 
        }
    ?>

    <div class="container">
        <form method="POST" action="add_slot_process.php">
            <label for="available-dates">Select Date</label>
            <?php 
                $old_date = $date ?? "";
            ?>
            <select name="date" id="available-dates">
                <option value="" selected disabled>Choose One</option>
                <?php
                    $today = date("Y-m-d");
                    $tomorrow = date("Y-m-d", strtotime($today . ' + 1 day'));
                    $dayAfterTomorrow = date("Y-m-d", strtotime($today . ' + 2 days'));

                    echo "<option value=\"$tomorrow\">$tomorrow</option>";
                    echo "<option value=\"$dayAfterTomorrow\">$dayAfterTomorrow</option>";
                ?>
            </select>
            <br>
            <label for="num_of_slots">Select Slots</label>
            <select name="num_of_slots" id="num_of_slots">
                <option value="" selected disabled>Choose One</option>
                <option value="10" >10</option>
                <option value="20" >20</option>
                <option value="30" >30</option>
            </select>
            <br>
            <label for="slot_duration">Duration</label>
            <select name="slot_duration" id="slot_duration">
                <option value="" selected disabled>Choose One</option>
                <option value="10" >10 Minutes</option>
                <option value="20" >20 Minutes</option>
                <option value="30" >30 Minutes</option>
            </select>
            <br>
            <label for="startTime">Start Time</label>
            <input type="time" name="start_time" value="<?=(isset($start_time) ? $start_time : "")?>">
            <br>
            <button type="submit" name="add-slot">Add</button>
        </form>
    </div>

</body>
</html>