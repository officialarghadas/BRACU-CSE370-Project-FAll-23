<?php 
    ob_start();
    session_start();
    require './helpers/functions.php';
    require './helpers/config.php';
    include './helpers/db.php';

    $error = $success = null;

    // if($_SERVER['REQUEST_METHOD'] == "POST") {
    //     if(isset($_POST['slot-cancel'])) {
    //         // Cancel Request
    //         $slot_id = mysqli_real_escape_string($db_connect,data_sanitize($_POST['target']));

    //         $status_cancel = STATUS_CANCEL;
    //         $slot_update_to_canceled = mysqli_query($db_connect, "UPDATE `slots` SET `Slot Status`= '2' WHERE `Slot ID`='$slot_id'");

    //         if($slot_update_to_canceled == true) {
    //             $success = "Information Updated Successfully!";
    //         }else {
    //             $error = "Something Went Wrong! Please try again";
    //         }
        // }else if(isset($_POST['slot-active'])) {
        //     $slot_id = mysqli_real_escape_string($db_connect,data_sanitize($_POST['target']));

        //     $status_active = STATUS_ACTIVE;
        //     $slot_update_to_active = mysqli_query($db_connect, "UPDATE `slots` SET `Slot Status`= '$status_active' WHERE `Slot ID`='$slot_id'");

        //     if($slot_update_to_active == true) {
        //         $success = "Information Updated Successfully!";
        //     }else {
        //         $error = "Something Went Wrong! Please try again";
        //     }
        // }
    // }

    $doctor_is = $_SESSION['id'];
    $currentDate = date("Y-m-d");

    $all_slots = mysqli_query($db_connect, "SELECT * FROM `slots` WHERE `Doctor ID`='$doctor_is' AND  `Date` > '$currentDate' AND `Slot Status`!= '2' ORDER BY `Date` DESC");

    $search_text = null;

    // if($_SERVER['REQUEST_METHOD'] == "GET") {
    //     if(isset($_GET['search-btn'])) {
    //         $search_text = mysqli_real_escape_string($db_connect,data_sanitize($_GET['search']));
    //         if($search_text != "") {
    //             $all_slots = mysqli_query($db_connect, "SELECT * FROM `slots` WHERE `Doctor ID`='$doctor_is' AND `Serial Number` LIKE '%$search_text%' ORDER BY `Slot ID` DESC");
    //         }
    //     }
    // }


?>
<?php include 'Navbar.php'; ?>

<!DOCTYPE html>
<html lang="en" title="Coding design">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Slots</title>
    <link rel="stylesheet" href="assets\css\slots.css">
</head>

<body>
    <!-- <iframe src="Navbar.php" width="100%" height="20px" frameborder="0"></iframe> -->
    <div id = "tabfaka"></div>


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

    <main class="table" >
        <section class="table__header" >
            <h1>My Slot List</h1>
            <!-- <div class="input-group">
                <form action="" method="GET">
                    <input type="search" placeholder="Search With Serial Number" name="search" value="<?=($search_text)?>">
                    <button type="submit" name="search-btn">
                        <img src="./assets/img/src.png" alt="src.png">
                    </button>
                </form>
            </div> -->
            <div class="slot-add-btn">
                <a href="./add-slot.php">Add Slot</a>
            </div>
        </section>
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th> Sl no <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Serial Number <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Date <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Time<span class="icon-arrow">&UpArrow;</span></th>
                        <th> Decline <span class="icon-arrow">&UpArrow;</span></th>

                    </tr>
                </thead>
                <tbody>
                    <?php 
                        if(mysqli_num_rows($all_slots) > 0) {
                            foreach($all_slots as $key => $slot) {
                                $time = new DateTime($slot['Time']);
                                $time = date_format($time, "g:i A");
                                $slotid = $slot['Slot ID'];
                    ?>
                        <tr>
                            <td> <?=($key + 1)?> </td>
                            <td> <?=($slot['Serial Number'])?> </td>
                            <td><?=($slot['Date'])?></td>
                            <td><?=($time)?></td>
                            <td>
                                <?php
                                echo '<a href="slot_reject.php?slid='.$slotid.'" class="reject_btm">Reject</a>'
                                ?>
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