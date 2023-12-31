<?php
    require_once("partials/_dbconnect.php");

    $userType = "Doctor";
    $firstName = $conn->real_escape_string($_POST["dfname"]);
    $lastName = $conn->real_escape_string($_POST["dlname"]);
    $password = $conn->real_escape_string($_POST["dpass"]);
    $confirmPassword = $conn->real_escape_string($_POST["dcpass"]);
    $regNo = $conn->real_escape_string($_POST["drgno"]);
    $designation = $conn->real_escape_string($_POST["ddeg"]);
    $email = $conn->real_escape_string($_POST["dmail"]);
    $phoneNumber = $conn->real_escape_string($_POST["dpnum"]);
    $address = $conn->real_escape_string($_POST["dloc"]);
    $specialtiesID = $conn->real_escape_string($_POST["dspecial"]);
    $oldfee = $conn->real_escape_string($_POST["dolf"]);
    $newfee = $conn->real_escape_string($_POST["dnwf"]);
    $mbbs = $conn->real_escape_string($_POST["dmmbs"]);
    $fcps = $conn->real_escape_string($_POST["dfcps"]);
    $frcs = $conn->real_escape_string($_POST["dfrcs"]);
    $file = $_FILES['file'];
    $file_contents = file_get_contents($file['tmp_name']);
    $base64_encoded = base64_encode($file_contents);
    

    $fullName = $firstName . '_' . $lastName;
    
    //  Inserting in Users

    $sqlInsertUser = "INSERT INTO users (`Username`, `Password`, `Mobile Number`, `is_doctor`)
                    VALUES ('$fullName', '$password', '$phoneNumber', 1)";

    if ($conn->query($sqlInsertUser) === TRUE) {
        // Get the generated User ID
        $userId = $conn->insert_id;
            
        $fullName = 'Dr. ' .$firstName .' '. $lastName;
        
        // Now, insert into Patients table using the generated User ID
        $sqlInsertDoctor = "INSERT INTO doctors (`Doctor ID`, `Doctor_Name`, `RegNo`, `Designation`, `Specialties ID`, `E-Mail`, `Address`, `Old Fee`, `New Fee`, `Activestatus`)
                                        VALUES ('$userId', '$fullName', '$regNo', '$designation', '$specialtiesID', '$email', '$address', '$oldfee', '$newfee', 'Pending')";
        


        // Execute the query
        if ($conn->query($sqlInsertDoctor) === TRUE) {
            if ($mbbs != 0) {
                $sqlInsertDegree = "INSERT INTO `degree` (`Doctor ID`, `Degree`) VALUES ('$userId', 'MBBS')";
                mysqli_query($conn,$sqlInsertDegree);
                }
            if ($fcps != 0) {
                $sqlInsertDegree = "INSERT INTO `degree` (`Doctor ID`, `Degree`) VALUES ('$userId', 'FCPS')";
                mysqli_query($conn,$sqlInsertDegree);
                }
            if ($frcs != 0) {
                $sqlInsertDegree = "INSERT INTO `degree` (`Doctor ID`, `Degree`) VALUES ('$userId', 'FRCS')";
                mysqli_query($conn,$sqlInsertDegree);
                }
            
            $sql_data = "INSERT INTO `doctor_data` (`Doctor ID`, `Data`) VALUES ('$userId', '$base64_encoded')";

            if ($conn->query($sql_data) === TRUE) {
                header("location: login.php");
                echo "File data inserted into the database!";
            }

        } else {
            echo "Error inserting into Patients table: " . $conn->error;
        }
    } else {
        echo "Error inserting into Users table: " . $conn->error;
    }

?>

        

