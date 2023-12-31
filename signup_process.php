<?php
    require_once("partials/_dbconnect.php");

    $userType = $conn->real_escape_string($_POST["user_type"]);
if ($userType == "Patient") {
        $firstName = $conn->real_escape_string($_POST["pfname"]);
        $lastName = $conn->real_escape_string($_POST["plname"]);
        $password = $conn->real_escape_string($_POST["ppass"]);
        $confirmPassword = $conn->real_escape_string($_POST["pconfirmpass"]);
        $gender = $conn->real_escape_string($_POST["pgender"]);
        if($gender == "Female"){
            $pregnant = $conn->real_escape_string($_POST["ppregnant"]);
            $breastfeeding = $conn->real_escape_string($_POST["pbreastfeeding"]);
        }
        else{
            $pregnant = "0";
            $breastfeeding = "0";
        }
        
        $age = $conn->real_escape_string($_POST["page"]);
        $bloodGroup = $conn->real_escape_string($_POST["pblood"]);
        $maritalStatus = $conn->real_escape_string($_POST["pmstatus"]);
        $email = $conn->real_escape_string($_POST["pemail"]);
        $phoneNumber = $conn->real_escape_string($_POST["pphonenum"]);
        $address = $conn->real_escape_string($_POST["padress"]);
        
        $previousHistory = isset($_POST["phistory"]) ? $conn->real_escape_string($_POST["phistory"]) : "None";

        $fullName = $firstName . '_' . $lastName;
        //  Inserting in Users

        $sqlInsertUser = "INSERT INTO users (`Username`, `Password`, `Mobile Number`, `is_doctor`)
                        VALUES ('$fullName', '$password', '$phoneNumber', 0)";

        if ($conn->query($sqlInsertUser) === TRUE) {
            // Get the generated User ID
            $userId = $conn->insert_id;

            $fullName = $firstName . ' ' . $lastName;
            
            // Now, insert into Patients table using the generated User ID
            $sqlInsertPatient = "INSERT INTO patients (`Patient ID`, `Name`, `Age`, `Gender`, `Pregnant`, `Breast Feeding`, `Email`, `Discount`, `Blood Group`, `Marital Status`, `Old`, `Previous History ID`)
                                VALUES ('$userId', '$fullName', '$age', '$gender', '$pregnant', '$breastfeeding', '$email', 0, '$bloodGroup', '$maritalStatus', 0, '$previousHistory')";

            // Execute the query
            if ($conn->query($sqlInsertPatient) === TRUE) {
                header("location: login.php");
                echo "Record inserted successfully";
                
            } else {
                echo "Error inserting into Patients table: " . $conn->error;
            }
        } else {
            echo "Error inserting into Users table: " . $conn->error;
        }
}

?>

        

