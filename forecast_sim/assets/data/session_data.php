<?php


include('../../db.php');
if(isset($_POST['btn_sess'])){
	
	$session_id=mysqli_real_escape_string($con,$_POST['session']);
	$team_id=mysqli_real_escape_string($con,$_POST['team']);
	if(!empty($session_id && $team_id)){
		header('location:../../session_data.php?id='.$session_id.'&team='.$team_id);
	}else{
		header('location:../../session_data.php');
	}
}
?>   