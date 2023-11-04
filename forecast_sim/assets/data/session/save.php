<?php

include('../../../db.php');
session_start();
if(isset($_SESSION['user3']))
	{


	
		$name=mysqli_real_escape_string($con,$_POST['name']);
		$status="Active";
	
		date_default_timezone_set("Asia/Karachi");
		
		$date=mysqli_real_escape_string($con,$_POST['date']);
		
		if($status=='Active'){
			$update="update `session` set `status`='Inactive';";
		mysqli_query($con,$update);
			
		}

    $insert = "INSERT INTO `session` (`des`, `status`, `date`) 
               VALUES ('".$name."', '".$status."', '".$date."');";
    mysqli_query($con, $insert);

		header('location:../../../active_session.php');
		
	}
	else
	{
		header('location:../../../admin.php');
	}
?>

