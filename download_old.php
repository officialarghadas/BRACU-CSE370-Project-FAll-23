<?php 
    ob_start();
    session_start();
    require './helpers/functions.php';
    require './helpers/config.php';
    include './helpers/db.php';
    // include './helpers/auth.php';

    if(isset($_SESSION['presid'])) {

        $id = $_SESSION['presid'];
        if($id != "") {
            $prescription = mysqli_query($db_connect, "SELECT * FROM `makes prescription` WHERE `ID`='$id'");

            if($prescription) {
                $row = mysqli_fetch_assoc($prescription);
                $file_name = $row['File'];
                $file_dir = "./assets/uploads/" . $file_name;

                if(file_exists($file_dir)) {
                    // Set the appropriate headers for download
                    header('Content-Description: File Transfer');
                    header('Content-Type: application/octet-stream');
                    header('Content-Disposition: attachment; filename="' . basename($file_dir) . '"');
                    header('Content-Length: ' . filesize($file_dir));
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate');
                    header('Pragma: public');

                    // Read the file and output it to the browser
                    readfile($file_dir);
                    exit;
                }else {
                    $_SESSION['error'] = "File does not exists!";
                    header("Location: ./previous-history.php");
                    exit;
                }
            }else {
                $_SESSION['error'] = "Prescription not found!";
                header("Location: ./previous-history.php");
                exit;
            }
        }else {
            $_SESSION['error'] = "Record not found!";
            header("Location: ./previous-history.php");
            exit;
        }
    }else {
        $_SESSION['error'] = "Record not found!";
        header("Location: ./previous-history.php");
        exit;
    }

?>