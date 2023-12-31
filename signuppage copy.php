<?php
    session_start();
    if(isset($_SESSION['loggedin'])){
        if($_SESSION['loggedin'] == true){
            if($_SESSION['type'] == "Patient"){
                header("location: patienthome.php");
            }
            elseif($_SESSION['type'] == "Doctor")
            {
                header("location: doctordash.php");
            }
            else{
                header("location: AdminMenu.php");
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
    <title>Healthy-Sign up</title>
    <link rel="stylesheet" href="signuppage2.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class= wrapmain>
        <img src="images\sun.png" id="icono"/>
        <form method="post" action="signup_process.php" class="wrapper">
            <div class="title">
                Sign up
            </div>
            <div class="form">
                <div class="inputfield">
                    <label>Sign up as</label>
                    <div class="custom_select" >
                        <select id="user_type" name="user_type" onchange="checkInput()" required>
                            <option value="">Select</option>
                            <option value="Doctor">Doctor</option>
                            <option value="Patient">Patient</option>
                        </select>
                    </div>
                </div>

                <div id="patientForm" style="display: none;">
                    <div class="inputfield" >
                        <label>First Name</label>
                        <input type="text" class="input" name="pfname" required>
                    </div>  
                    <div class="inputfield">
                        <label>Last Name</label>
                        <input type="text" class="input" name="plname" required>
                    </div>  
                    <div class="inputfield">
                        <label>Password</label>
                        <input type="password" class="input" name="pconfirmpass">
                    </div> 
                    <div class="inputfield">
                        <label>Confirm Password</label>
                        <input type="password" class="input" name="ppass" required>
                    </div> 
                    <div class="inputfield">
                        <label>Gender</label>
                        <div class="custom_select">
                            <select id="pgender" name="pgender" onchange="updateForm()" required>
                                <option value="">Select</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>

                    <div id="additionalFields" style="display:none;">
                    <div class="inputfield">
                        <label>Pregnant</label>
                        <div class="custom_select">
                            <select name="ppregnant">
                                <option value="" selected disabled>Select</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="inputfield">
                        <label>Breastfeeding</label>
                        <div class="custom_select">
                            <select name="pbreastfeeding" >
                                <option value="" selected disabled>Select</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>
                    </div>
                   
                    <div class="inputfield">
                        <label>Age</label>
                        <input type="text" class="input" name="page" required>
                    </div> 
                    <div class="inputfield">
                        <label>Blood group</label>
                        <input type="text" class="input" name="pblood" required>
                    </div> 
                    <div class="inputfield">
                        <label>Marital Status</label required>
                        <div class="custom_select">
                            <select name="pmstatus">
                                <option value="" selected disabled>Select</option>
                                <option value="Unmarried">Unmarried</option>
                                <option value="Married">Married</option>
                            </select>
                        </div>
                    </div> 
                    <div class="inputfield">
                        <label>Email Address</label>
                        <input type="text" class="input" name="pemail" required>
                    </div> 
                    <div class="inputfield">
                        <label>Phone Number</label>
                        <input type="text" class="input" name="pphonenum" required>
                    </div> 
                    <div class="inputfield">
                        <label>Address</label>
                        <textarea class="textarea" name="padress"required></textarea>
                    </div>
                    <div class="inputfield">
                        <label>Previous history</label>
                        <textarea class="textarea" name="phistory"required></textarea>
                    </div>
                    <div class="inputfield terms">
                        <label class="check">
                            <input type="checkbox" required>
                            <span class="checkmark"></span>
                        </label>
                        <p>Agreed to terms and conditions</p>
                    </div> 
                    <div class="inputfield">
                        <input type="submit" value="Register" class="btn">
                        
                    </div>
                </div>
                </form>

<!-- -----------------------------doctor part from here------------------------------------------ -->
            
                <div id="doctorForm" style="display: none;">
                <form method="post" action="signup_process_doctor.php" >
                <div class="form">
            <div class="inputfield">
                <label>First Name</label>
                <input type="text" class="input" name = "dfname">
            </div>  
            <div class="inputfield">
                <label>Last Name</label>
                <input type="text" class="input" name = "dlname">
            </div>  
            <div class="inputfield">
                <label>Password</label>
                <input type="password" class="input" name = "dpass">
             </div> 
             <div class="inputfield">
                <label>Confirm Password</label>
                <input type="password" class="input" name = "dcpass">
             </div> 
             <div class="inputfield">
                <label>Reg No</label>
                <input type="text" class="input" name = "drgno">
            </div>
             <div class="inputfield">
                <label>Designation</label>
                <input type="text" class="input" name = "ddeg">
            </div>
            <div class="inputfield">
                <label>Email Address</label>
                <input type="text" class="input" name = "dmail">
            </div> 
            <div class="inputfield">
                <label>Phone Number</label>
                <input type="text" class="input" name = "dpnum">
            </div> 
            <div class="inputfield">
                <label>Address</label>
                <div class="custom_select">
                    <select name = "dloc">
                        <option value="" >Select Address </option>
                        <option value="Mymensingh">Mymensingh</option>
                        <option value="Dhaka">Dhaka</option>
                        <option value="Chittagong">Chittagong</option>
                        <option value="Rajshahi">Rajshahi</option>
                        <option value="Barisal">Barisal</option>
                        <option value="Khulna">Khulna</option>
                        <option value="Sylhet">Sylhet</option>
                        <option value="Rangpur">Rangpur</option>
                    </select>
                </div>
            </div>
            <div class="inputfield">
                <label>Specialities</label>
                <div class="custom_select">
                    <select name = "dspecial" required >
                        <option value="" selected disabled>Choose Specialities</option>
                        <?php
                            require_once("partials/_dbconnect.php");
                            $sql = "SELECT * FROM `specialities`";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<option value="' . $row['Specialties ID'] . '">' . $row['Specialities'] . '</option>';
                            }
                            mysqli_free_result($result);
                        ?>
                        
                    </select>
                </div>
            </div>
            <div class="inputfield">
                <label>Old Fee</label>
                <input type="text" class="input" name = "dolf">
            </div>
            <div class="inputfield">
                <label>New Fee</label>
                <input type="text" class="input" name = "dnwf">
            </div>
            <div class="inputfield">
                <label>MBBS</label>
                <div class="custom_select">
                    <select name="dmmbs" >
                        <option value="1">Yes</option>
                        <option value="0" selected>No</option>
                    </select>
                </div>
            </div>
            <div class="inputfield">
                <label>FCPS</label>
                <div class="custom_select">
                    <select name="dfcps" >
                        <option value="1">Yes</option>
                        <option value="0" selected>No</option>
                    </select>
                </div>
            </div>
            <div class="inputfield">
                <label>FRCS</label>
                <div class="custom_select">
                    <select name="dfrcs" >
                        <option value="1">Yes</option>
                        <option value="0" selected>No</option>
                    </select>
                </div>
            </div>
            <div class="inputfield terms">
                <label class="check">
                    <input type="checkbox" required>
                    <span class="checkmark"></span>
                </label>
                <p>Agreed to terms and conditions</p>
            </div> 
            <div class="inputfield">
                <input type="submit" value="Register" class="btn">
            </div>
        </div>
        </form>
                </div>

            </div>
            <div class="registration">
            <p> Already have an account? <a href="login.php"> Log in</a></p>
            </div>
        </div>
        
    </div>

    <script>
        let icono = document.getElementById('icono');
        let input = document.getElementById('user_type');

        icono.onclick = function(){
            document.body.classList.toggle("light-mode");
            if(document.body.classList.contains("light-mode")){
                icono.src = "images\\moon.png"
            }
            else{
                icono.src = "images\\sun.png"
            }
        }

        function checkInput() {
            let userInput = document.getElementById('user_type').value;

            if (userInput === 'Patient') {
                document.getElementById('patientForm').style.display = 'block';
                document.getElementById('doctorForm').style.display = 'none';
            } else if (userInput === 'Doctor') {
                document.getElementById('patientForm').style.display = 'none';
                document.getElementById('doctorForm').style.display = 'block';
            } else {
                document.getElementById('patientForm').style.display = 'none';
                document.getElementById('doctorForm').style.display = 'none';
            }
        }

        function updateForm() {
        var genderSelect = document.getElementById('pgender');
        var additionalFields = document.getElementById('additionalFields');

        if (genderSelect.value === 'Female') {
            additionalFields.style.display = 'block';
        } else {
            additionalFields.style.display = 'none';
        }
    }
    </script>

</body>
</html>