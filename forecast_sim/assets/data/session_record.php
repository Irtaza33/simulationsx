<?php


include('../../db.php');
if(isset($_POST['btn_sess'])){
	
	$session_id=mysqli_real_escape_string($con,$_POST['session']);
	if(!empty($session_id)){
		header('location:../../noncollabvscolab.php?id='.$session_id);
	}else{
		header('location:../../noncollabvscolab.php');
	}
}
?>   