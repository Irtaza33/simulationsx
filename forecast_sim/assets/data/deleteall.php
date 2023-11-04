<?php

include('../../db.php');
session_start();
if(isset($_SESSION['user3']))
	{

		$chk=mysqli_real_escape_string($con,$_POST['txtcheck']);
		$delete="delete from round_data;";
		if($chk==true){
			
		
			if($res=$con->query($delete) or die($con->error)){
				if(empty($team_id)){
					header('Location:../../index.php');
				}else{
					header('Location:../../index.php?id='.$team_id);
				}
				   
			}else{
				header('Location:../../index.php'); 
			}
		}
		else{
			header('Location:../../index.php'); 
		}
	}
	else
	{
		header('location:../../../admin.php');
	}
?>