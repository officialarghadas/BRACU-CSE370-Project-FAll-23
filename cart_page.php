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
    <link rel="stylesheet" href="cart.css">
    <!-- Add other necessary stylesheets or scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="frame">
        <nav>
            <a href="homepage.php"><img src="images\healthylight.png" class="logo" id="logo"></a>
            <div class="sidepanel">
                <a class="signup"><?php echo $_SESSION['name'] ?></a>
                <a href="clear_cart.php" class="btn">Clear Cart</a>
                <a href="logout.php" class="btn">Log out</a>
                
                <img src="images\sun.png" id="icono"/>
            </div>
        </nav>
    <div class="content">
        <main class="table">
            <section class="table__header">
                <h1 class="">Available Medicines </h1>
            </section>
            <section class="table__body">
                <table id="doctorTable">
                    <thead>
                        <tr >
                            <th>Medicine Name</th>
                            <th>Quantity</th>
                            
                            <th>Cost</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            require_once("partials/_dbconnect.php");
                            
                            
                            $patientID=$_SESSION['id'];
                            $Totalcost=0;
                            $sql ="SELECT `cart`.`Medicine Id`, `cart`.`Patient Id`, `cart`.`Quantity`
                            FROM `cart`
                            WHERE `cart`.`Patient Id` = '$patientID'
                            AND `cart`.`Payment Status` = 0";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            if ($result->num_rows > 0) {
                                // Output data of each row
                                while ($row = $result->fetch_assoc()) {
                                    $med_code= $row['Medicine Id'];
                                    $quantity= $row['Quantity'];

                                    $sql2="SELECT `medicine`.`Medicine Name`, `medicine`.`Cost`
                                    FROM `medicine`
                                    WHERE `medicine`.`Medicine Code` = '$med_code'";
                                    $stmt2 = $conn->prepare($sql2);
                                    $stmt2->execute();
                                    $result2 = $stmt2->get_result();
                                    if ($result2->num_rows > 0) {
                                        // Output data of medicine details
                                        while ($row2 = $result2->fetch_assoc()){
                                            $cost= $quantity*$row2['Cost'];
                                            
                                            $Totalcost+=$cost;
                                            echo '<tr>';
                                            echo '<td>' . $row2['Medicine Name'] . '</td>';
                                            echo '<td>' . $quantity .'</td>';
                                            echo '<td>' . $cost . '</td>';
                                            echo '<tr>';
                                        }

                                    }
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </section>
        </main>
    </div>
    <div class="content">
        <main class="table">
            <section class="table__header">
                <h1 class="">Available Tests </h1>
            </section>
            <section class="table__body">
                <table id="doctorTable">
                    <thead>
                        <tr >
                            <th>Test Name</th>
                             
                            <th>Cost</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once("partials/_dbconnect.php");
                            
                            
                        $patientID=$_SESSION['id'];
                        $sql3 ="SELECT `testcart`.`Test Id`FROM `testcart`
                        WHERE `testcart`.`Patient Id` = '$patientID' AND `testcart`.`Payment Status` = '0'";
                        $stmt3 = $conn->prepare($sql3);
                        $stmt3->execute();
                        $result3 = $stmt3->get_result();
                        if ($result3->num_rows > 0) {
                            // Output data of medicine details
                            while ($row3= $result3->fetch_assoc()){
                                $test_code= $row3['Test Id'];
                                // $quantity= $row['Quantity'];

                                $sql4="SELECT `tests`.`Test Name`, `tests`.`Cost`
                                FROM `tests`
                                WHERE `tests`.`Test Code` = '$test_code';";
                                $stmt4 = $conn->prepare($sql4);
                                $stmt4->execute();
                                $result4 = $stmt4->get_result();
                                while ($row4 = $result4->fetch_assoc()){
                                    $cost2= $row4['Cost'];
                                    // $Totalcost=0;
                                    $Totalcost+=$cost2;
                                    echo '<tr>';
                                    echo '<td>' . $row4['Test Name'] . '</td>';
                                    // echo '<td>' . $quantity .'</td>';
                                    echo '<td>' . $cost2 . '</td>';
                                    echo '<tr>';
                                }

                            }
                            
                        }
                                
                        

                        // echo '<tr>';
                        // echo '<td>' . $Totalcost . '</td>';
                        // echo '<td>' . $Totalcost .'</td>';
                        
                        // echo '<tr>';
                            // This part should be replaced with an AJAX call in a separate script
                            // You cannot use PHP directly inside JavaScript
                        ?>
                    </tbody>
                </table>
            </section>
        </main>
    </div>
    <div class="content">
    <div class="total-cost">
        <table>
            <tr class="blue-box">
                <td>Total Cost:</td>
                <td><?php echo $Totalcost; ?></td>
            </tr>
            <tr>
                <td colspan="2">
                <a href="cart_payment.php?amount=<?php echo $Totalcost; ?>"style="display: block; font-size: 20px; background-color: green; color: white; padding: 10px; text-align: center; text-decoration: none;">Proceed to Payment</a>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>