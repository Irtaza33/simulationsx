<?php

$server="localhost";
$user="root";
$pass="";
$dbname="forecast_sim";
$con=mysqli_connect($server,$user,$pass,$dbname);

if($con->connect_error){
die("Database Error: Can't Reach Database.");
}
