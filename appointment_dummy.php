<?php
    date_default_timezone_set("Asia/Dhaka");
    session_start();
    echo !isset($_SESSION['loggedin']) ;
    echo $_SESSION['loggedin'] != true ;
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
    <title>HealthY-Admin-Dashboard</title>
    <link rel="stylesheet" href="appointment_css_dumm.css">
    <!-- <meta http-equiv="refresh" content="2"> -->
</head>
<body>
    <div class = "frame">
        <nav>
            <a href="homepage.php"><img src = "images\healthylight.png" class="logo" id="logo"></a>
            <ul>
                <li><a href="patientdash.php">Dashboard</a></li>
                <li><a href="test.php">Book Tests</a></li>
                <li><a href="appointment_dummy.php">Book an Apointment</a></li>
                <li><a href="medicine.php">Buy Medicine</a></li>
                <li><a href="patientorders.php">Orders</a></li>
            </ul>
            <div class = "sidepanel">
                <a  class="signup" ><?php echo $_SESSION['name']?></a>
                <a href="logout.php" action="loginpage_login.php" class="btn">Log out</a>
                <img src="images\sun.png" id="icono"/>
            </div>
        </nav>
        <form id="filterForm"  method="post">
            <div class="content">
                <main class="table1">
                    <section class="filters">
                        <!-- First Dropdown -->
                        <select id="filter1" name="select1">
                            <option value="dhaka">DHAKA</option>
                            <option value="mymensingh">MYMENSINGH</option>
                            <option value="KHULNA">KHULNA</option>
                            <option value="BARISAL">BARISAL</option>
                            <option value="CHITTAGONG">CHITTAGONG</option>
                            <option value="RAJSHAHI">RAJSHAHI</option>
                            <option value="RANGPUR">RANGPUR</option>
                            <option value="SYLHET">SYLHET</option>
                        </select>

                        <!-- Second Dropdown -->
                        <select id="filter2" name="select2">
                            <option value="medicine">MEDICINE</option>
                            <option value="Skin & VD">Skin & VD</option>
                            <option value="Pediatrics">Pediatrics</option>
                            <option value="Gastroenterolog">Gastroenterolog</option>
                            <option value="Oncology">Oncology</option>
                            <option value="Endocrinology">Endocrinology</option>
                            <option value="Pulmonology">Pulmonology</option>
                            <option value="Urology">Urology</option>
                            <option value="Rheumatology">Rheumatology</option>
                            <option value="Hematology">Hematology</option>
                            <option value="Nephrology">Nephrology</option>
                            <option value="Otolaryngology">Otolaryngology</option>
                            <option value="Gynecology">Gynecology</option>
                        </select>

                        <!-- Search Input -->
                        <input type="text" id="search" name="search" class="search-input" placeholder="Search...">

                        <!-- Button for search/filter action -->
                        <button type="submit" id="searchBtn">Search</button>
                    </section>
                </main>
            </div>
        </form>
        <div class="view">
        <!-- <div class="icon_row">  -->
        <!-- <div class="iconb"> -->
            <?php  
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Retrieve form data and sanitize inputs
                    $division = $_POST["select1"];
                    $speciality = $_POST["select2"];
                    $dname = $_POST["search"];
                    
                    require_once("partials/_dbconnect.php");
                    if ($dname !== "") {
                        $sql = "SELECT `doctors`.`Doctor_Name`,`doctors`.`Doctor ID`, `specialities`.`Specialities`, `doctors`.`Address`
                                FROM `doctors` 
                                LEFT JOIN `specialities` ON `doctors`.`Specialties ID` = `specialities`.`Specialties ID`
                                WHERE `doctors`.`Doctor_Name` LIKE '%$dname%' AND `specialities`.`Specialities` = '$speciality' AND `doctors`.`Address` = '$division'";
                    } else {
                        $sql = "SELECT doctors.Doctor_Name, doctors.`Doctor ID`, specialities.Specialities, doctors.Address
                                FROM doctors
                                LEFT JOIN specialities ON doctors.`Specialties ID` = specialities.`Specialties ID`
                                WHERE specialities.Specialities = '$speciality' AND doctors.Address = '$division'";
                    }
                
                    // Prepare and execute the query
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                
                    // Check for errors in query execution
                    if ($stmt === false) {
                        die("Error in SQL query: " . $conn->error);
                    }
                
                    // Get the result
                    $result = $stmt->get_result();
                    $count=0;
                    echo '<div class="icon_row">';
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="iconb">';
                       
                        echo '<img src="images/umanw.png" id="doctor_dp"/>';
                        echo '<a class="hypertext"  href="appointment_details_html.php?id=' . $row['Doctor ID'] . '>';
                        echo '<div class="doc_details">';
                       
                        echo '<p class="doc_text">' . $row['Doctor_Name'] . '</p>';
                        echo '<p class="doc_text">' . $row['Specialities'] . '</p>';
                        echo '<p class="doc_text">' . $row['Address'] . '</p>';
                       
                       
                        echo '</a>';
                
                        echo '</div>';
                       
                        

                        
                        // echo '</div>';
                    }
                    echo '</div>';
                }

                
            ?>
        
            
                
        <!-- </div> -->
        <!-- </div> -->
        </div>
        
        
    </div>
    

    <script>


    let icono = document.getElementById('icono');
    let logoa = document.getElementById('logo');
    let imageft = document.getElementById('imageft');

    icono.onclick = function(){
        document.body.classList.toggle("light-home");
        if(document.body.classList.contains("light-home")){
            icono.src = "images\\moon.png";
            logoa.src = "images\\healthy.png";
            $_SESSION['dark']
        }
        else{
            icono.src = "images\\sun.png";
            logoa.src = "images\\healthylight.png";
        }
    }

    </script>

</body>
</html>