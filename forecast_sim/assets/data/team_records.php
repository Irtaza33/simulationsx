<?php


include('../../db.php');
if(isset($_POST['btnload'])){
	
	$team_id=mysqli_real_escape_string($con,$_POST['txtname']);
	if(!empty($team_id)){
		header('location:../../index.php?id='.$team_id);
	}else{
		header('location:../../index.php');
	}
	
}
?>   