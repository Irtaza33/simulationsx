<?php

include('../../db.php');
session_start();
if(isset($_SESSION['user3']))
	{
		$id=mysqli_real_escape_string($con,$_GET['id']);
		$session_id=mysqli_real_escape_string($con,$_GET['session_id']);
		$team=mysqli_real_escape_string($con,$_GET['team_id']);

		$delete="delete from round_data where id='".$id."';";
		
		if($res=$con->query($delete) or die($con->error)){
			if(empty($session_id)){
				header('Location:../../session_data.php');
			}else{
				header('Location:../../session_data.php?id='.$session_id.'&team='.$team);
			}
			   
		}else{
			header('Location:../../../session_data.php'); 
		}
	}
	else
	{
		header('location:../../../admin.php');
	}
?>