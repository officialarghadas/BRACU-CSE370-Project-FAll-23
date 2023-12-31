<?php

$server = "localhost";
$username = "root";
$password = "";
$database = "hospital_project_0.2";

$conn = mysqli_connect($server,$username,$password,$database);

if(!$conn){
    die("Error". mysqli_connect_error());
}

?>