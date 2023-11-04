<?php
include('../db.php');
session_start();


  $user = $_SESSION['id'];

 $mquery = mysqli_query($con,"update login set deal_extra3='0' where id='$user'");

session_destroy();
header('location: ../admin');


?>