<?php 
    date_default_timezone_set('Asia/Dhaka');

    $project_dir = "/hospital-management/doctor-panel";

    define('STATUS_ACTIVE',1);
    define('STATUS_CANCEL',0);

    define("BOOKING_CANCEL_PREVIOUS_TIME", "4 hours") // define value that compatible with strtotime() function in php
?>