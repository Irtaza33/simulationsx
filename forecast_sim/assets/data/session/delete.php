<?php

include('../../../db.php');
session_start();
if(isset($_SESSION['user3']))
	{

		$id=mysqli_real_escape_string($con,$_GET['id']);
		$login=mysqli_real_escape_string($con,$_GET['login']);
		$delete=mysqli_query($con,"delete from session where id='".$id."';");
		// $delete_log=mysqli_query($con,"delete from login where id = '".$login."'");
		header('location:../../../active_session.php');
	}
	else
	{
		header('location:../../../session.php');
	}
?>