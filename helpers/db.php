<?php 
    ob_start();
    define('HOSTNAME','localhost');
    define('USERNAME','root');
    define('PASSWORD','');
    define('DATABASE_NAME','hospital_project_0.2');

    $db_connect = mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DATABASE_NAME);

    if(!$db_connect){
        echo "Something went wrong! Please try again.";
        die();
    }
?>