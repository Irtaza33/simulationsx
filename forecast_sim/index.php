<?php
include 'header.php';
include('db.php');


error_reporting(E_ALL ^ E_NOTICE);
$id=mysqli_real_escape_string($con,$_GET['id']);





?>



<div class="copyrights">
	 <p>Copyright © 2023 Powered by <a href="https://simulationsx.com/" target="_blank">Simulations Xperience Pvt. Ltd.</a>. All Rights Reserved   </p>
</div>




	</div>

	
<?php

include('footer.php');
?>