<?php


session_start();

if(isset($_GET['dashboard'])){

	if(isset($_SESSION['user4']))
	{
		unset($_SESSION["user4"]);
		session_destroy();
		header('location:admin');
	}
	else{
		
		header('location:admin');
	}
	
}else{

	if(isset($_SESSION['user3']))
	{
		unset($_SESSION["user3"]);
		session_destroy();
		header('location:admin');
	}
	else{
		
		header('location:admin');
	}

	if(isset($_SESSION['user5']))
	{
		unset($_SESSION["user5"]);
		session_destroy();
		header('location:admin');
	}
	else{
		
		header('location:admin');
	}

}




?>