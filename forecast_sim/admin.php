 <?php
session_start();
include("db.php");
error_reporting(E_ALL ^ E_NOTICE);
if(isset($_POST['btnLogin'])){
	 $user=mysqli_real_escape_string($con,$_POST['username']);
     $pass=mysqli_real_escape_string($con,$_POST['pass']);


    $session_query="SELECT id FROM `session` where status='Active';";
$session_rec=mysqli_query($con,$session_query);
while($row=mysqli_fetch_array($session_rec)){
    $session_id=$row[0];

}

$q="select * from team_master where team_user='".$user."' and team_pass='".$pass."' and session_id = '".$session_id."'";
$recs=mysqli_query($con,$q);
$noofrows=mysqli_num_rows($recs);
$fetch=mysqli_fetch_array($recs);

$q2="select * from login where user='".$user."' and pass='".$pass."' and type='super_admin' ;";
$recs2=mysqli_query($con,$q2);
$noofrows2=mysqli_num_rows($recs2);

$q3="select * from login where user='".$user."' and pass='".$pass."' and type='admin' ;";
$recs3=mysqli_query($con,$q3);
$noofrows3=mysqli_num_rows($recs3);

$q4="select * from login where user='".$user."' and pass='".$pass."' and type='Coach' ;";
$recs4=mysqli_query($con,$q4);
$noofrows4=mysqli_num_rows($recs4);



// $q3="select * from login where user='".$user."' and pass='".$pass."' and status='super admin';";
// $recs3=mysqli_query($con,$q3);
// $noofrows3=mysqli_num_rows($recs3);


if($noofrows==1){

	$_SESSION['id'] = $fetch['team_id'];
    $_SESSION['name'] = $fetch['team_user'];
    $_SESSION['user'] = $user;

	header('location:user/index.php');
	
}elseif($fetch['deal_extra3'] ==1){
	$error='Your Team is already login';
}
else if($noofrows2==1){
	$_SESSION['user3']=$user;
	header('location:session');
	
}
else if($noofrows3==1){
	$_SESSION['user4']=$user;
	header('location:dashboard.php');
}
else if($noofrows4==1){
	$_SESSION['user5']=$user;
	header('location:dashboard.php');
	
}
else{
	$error='Invalid Username and password';
	
}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Forecast Simulations</title>
	<link rel="icon" type="image/png" sizes="96x96" href="images/logo-title.png">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="login/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/css/util.css">
	<link rel="stylesheet" type="text/css" href="login/css/main.css">
<!--===============================================================================================-->
<style>
body{
	background-image: url(images/wms2.png);
    background-repeat: no-repeat;
    background-size: cover;
}
</style>

</head>
<body>
	<div class="limiter">
		<div class="container-login100">
		
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(images/bg-01.jpg);">
					<span class="login100-form-title-1">
						Sign In To Forecast Simulations
					</span>
				</div>
				<form action="" method="post" class="login100-form validate-form">
					<div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
						<span class="label-input100">Username</span>
						<input class="input100" type="text" name="username" placeholder="Enter username">
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="pass" placeholder="Enter password">
						<span class="focus-input100"></span>
					</div>

					<div class="flex-sb-m w-full p-b-30">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								Remember me
							</label>
						</div>

						<div>
							<a href="#" class="txt1">
								Forgot Password?
							</a>
						</div>
					</div>

					<div class="container-login100-form-btn">
						<button type="submit" name="btnLogin" class="login100-form-btn">
							Login
						</button>
					</div>
					
				</form>
				<br>
		
			<img src="images/logoblack.png" style="width: 200px;float: right;margin-top: -10px;margin-right: 20px;" >
			<br>
		<br>
		<br>
	
			</div>

				<div class="row" style="" >
			<div class="col-lg-12" style="text-align:center" >
				<h2 style="color:white" >Partners and Clients</h2>
		 <img src="images/logo/novelops.png" class="fish" style="width: 9vw;"/>
			 <img src="images/logo/surplus.png" class="fish" style="width: 9vw;"/>
			 <img src="images/logo/pm.png" class="fish" style="width: 9vw;"/>
			 <img src="images/logo/hir.png" class="fish" style="width: 9vw;"/>
			 <img src="images/logo/sin.png" class="fish" style="width: 9vw;"/>
			 <img src="images/logo/gc.png" class="fish" style="width: 9vw;"/>
			 <img src="images/logo/art.png" class="fish" style="width: 9vw;"/>
			 <img src="images/logo/frst.png" class="fish" style="width: 9vw;"/>


			 </div>
		
		</div>
		</div>
		

	</div>
	
<!--===============================================================================================-->
	<script src="login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="login/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="login/vendor/bootstrap/js/popper.js"></script>
	<script src="login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="login/vendor/daterangepicker/moment.min.js"></script>
	<script src="login/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="login/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="login/js/main.js"></script>

</body>
</html>