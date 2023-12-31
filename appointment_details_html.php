<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HealthY-Admin-Dashboard</title>
    <link rel="stylesheet" href="appointment_details.css">
    <!-- Add other necessary stylesheets or scripts -->
</head>
<body>
    <div class="frame">
       
        <nav>
            <a href="homepage.php"><img src="images\healthylight.png" class="logo" id="logo"></a>
            <div class="sidepanel">
                <a class="signup"><?php echo $_SESSION['name'] ?></a>
                <a href="logout.php" class="btn">Log out</a>
                <img src="images\sun.png" id="icono"/>
            </div>
        </nav>
        

        <div class="content">
            <main class="table">
                <section class="table__header">
                    <h1 class="">Doctors Waiting For Approval</h1>
                </section>
                <section class="table__body">
                    <table>
                        <thead>
                            <tr>
                                <th>Doctor ID</th>
                                <th>Slot</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_GET['id'])) {
                                $doctor_id = $_GET['id'];
                                require_once("partials/_dbconnect.php");
                                $sql = "SELECT * FROM `slots` WHERE `Doctor ID` = ? AND `Slot Status` = 0";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("s", $doctor_id);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $doctorId = $row['Doctor ID'];
                                        $serialNumber = $row['Serial Number'];
                                        $slotId = $row['Slot ID'];
                                        $time_24_hour_format = $row['Time'];

                                        
                                        $time_12_hour_format = date("h:i A", strtotime($time_24_hour_format));

                                        $url = 'add_slot.php?dcid=' . $doctorId . '&serialNumber=' . $serialNumber . '&slotId=' . $slotId;

                                        echo '<tr>';
                                        echo '<td>' . $row['Doctor ID'] . '</td>';
                                        echo '<td>' . $time_12_hour_format .'</td>';
                                        echo '<td>' . $row['Date'] . '</td>';
                                        echo '<td class="tdb">
                                                <a href="' .$url. '" class="accept_btn">BOOK</a>
                                            </td>';
                                        echo '</tr>';
                                    }
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </section>
            </main>
        </div>
    </div>

    <!-- Other scripts or closing HTML tags -->
</body>
</html>
