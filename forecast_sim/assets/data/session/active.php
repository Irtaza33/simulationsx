<?php

include('../../../db.php');
session_start();
if(isset($_SESSION['user3']))
	{
		$session=mysqli_real_escape_string($con,$_POST['session']);
		if (isset($_POST['btnactive'])) {
			// $update="update `session` set `status`='Inactive';";
			// mysqli_query($con,$update);
				
			$update2="update `session` set `status`='Active' where id='".$session."';";
			mysqli_query($con,$update2);
		}	
		else{
			// $update="update `session` set `status`='Inactive';";
			// mysqli_query($con,$update);
				
			$update2="update `session` set `status`='Inactive' where id='".$session."';";
			mysqli_query($con,$update2);
		}
		
		
		header('location:../../../active_session.php');
		
	}
	else
	{
		header('location:../../../admin.php');
	}
?>