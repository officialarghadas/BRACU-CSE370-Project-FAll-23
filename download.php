<?php 
    ob_start();
    session_start();
    require './helpers/functions.php';
    require './helpers/config.php';
    include './helpers/db.php';
    include './helpers/auth.php';

    require 'vendor/autoload.php';

    if(isset($_GET['ap_id'])) {
        $appointment_id = $_GET['ap_id'];

        $appointment_result = mysqli_query($db_connect, "SELECT appointment.*, patients.Name as patient_name, patients.Age as patient_age, patients.`Patient ID`, doctors.`Doctor ID`, doctors.`Doctor_Name` as doctor_name, doctors.`Designation` as doctor_designation
        FROM appointment 
        JOIN patients ON appointment.`Patient ID` = patients.`Patient ID`
        JOIN doctors ON appointment.`Doctor ID` = doctors.`Doctor ID`
        WHERE appointment.`Appointment ID`='$appointment_id'");

        if(mysqli_num_rows($appointment_result) == 0) {
            $_SESSION['error'] = "Invalid appointment selected! Please try again";
            header("Location: ./booked.php");
            exit();
        }

        $appointment = mysqli_fetch_assoc($appointment_result);

        $prescription_result = mysqli_query($db_connect, "SELECT `makes prescription`.*, `symptoms`.`Symptom Name` as symptom_name FROM `makes prescription`
        JOIN symptoms ON `makes prescription`.`Symptoms ID` = symptoms.`Symptoms ID`
        WHERE `Appointment ID`='$appointment_id'");

        if(mysqli_num_rows($prescription_result) == 0) {
            $_SESSION['error'] = "Oops! Prescription not found, Please try again";
            header("Location: ./booked.php");
            exit();
        }

        $prescription = mysqli_fetch_assoc($prescription_result);
    }else {
        $_SESSION['error'] = "Appointment not found!";
        header("Location: ./booked.php");
        exit();
    }

    $medicines = json_decode($prescription['Medicines']);

    $medicines_html = '';
    foreach($medicines as $medicine) {
        $medicines_html .= '
            <li>
                <strong>Name:</strong> <span>'.$medicine.'</span>
            </li>
        ';
    }


    use Dompdf\Dompdf;

    $dompdf = new Dompdf();

    $html = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>PDF Document</title>
            <style>
                /* Add your CSS styles here */
                body {
                    font-family: Arial, sans-serif;
                }
                .prescription-title {
                    font-size: 18px;
                    color: #092635;
                    margin: 0 auto;
                    text-align: center;
                    margin-bottom: 15px; 
                }
                .block ul {
                    list-style-type: none;
                }

                .block {
                    margin-bottom: 15px;
                }
            </style>
        </head>
        <body>
            <h3 class="prescription-title">Patient Prescription</h3>
        
            <div class="block">
                <div class="block-title">
                    Patient Information
                </div>
                <ul class="ul">
                    <li>
                        <strong>Patient Name:</strong> <span>'. $appointment['patient_name'] .'</span>
                    </li>
                    <li>
                        <strong>Patient Age:</strong> <span>'. $appointment['patient_age'] .'</span>
                    </li>
                </ul>
            </div>

            <div class="block">
                <div class="block-title">
                    Symptom Details
                </div>
                <ul class="ul">
                    <li>
                        <strong>Name:</strong> <span>'. $prescription['symptom_name'] .'</span>
                    </li>
                </ul>
            </div>


            <div class="block">
                <div class="block-title">
                    Medicines
                </div>
                <ul class="ul">
                    '.$medicines_html.'
                </ul>
            </div>


            <div class="block">
                <div class="block-title">
                    Description/Note
                </div>
                <ul class="ul">
                    <li>
                        <span>
                            '. $prescription['Description'] .'
                        </span>
                    </li>
                </ul>
            </div>


            <div class="block">
                <div class="block-title">
                    Doctor Information
                </div>
                <ul class="ul">
                    <li>
                        <strong>Name:</strong> <span>'. $appointment['doctor_name'] .'</span>
                    </li>
                    <li>
                        <strong>Designation :</strong> <span>'. $appointment['doctor_designation'] .'</span>
                    </li>
                </ul>
            </div>
        
        </body>
        </html>
    ';

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    $pdf_encode = base64_encode($dompdf->output());

    // upload prescription to database as base64 logic
    $update_appointment_prescription = mysqli_query($db_connect, "UPDATE `appointment` SET `Prescription`='$pdf_encode' WHERE `Appointment ID`='$appointment_id'");

    $file_name = 'p-' . $appointment['Appointment ID'] . '-' . date('d-m-Y') . '.pdf';
    $dompdf->stream($file_name, array('Attachment' => 0));
?>