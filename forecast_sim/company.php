<?php
include('header.php');
include('db.php');

// error_reporting(E_ALL ^ E_NOTICE);

    $session_query="SELECT * FROM `session` where status='Active';";
$session_rec=mysqli_query($con,$session_query);
while($row=mysqli_fetch_array($session_rec)){
     $session_id=$row[0];
     $session_name=$row['des'];
}


if(isset($_POST['btn_submit'])) {

 // Variables to hold the values to be inserted
$comp_name = $_POST['comp_name'];
$ph_number = $_POST['ph_number'];
$comp_address = $_POST['comp_address'];

$sql = mysqli_query($con,"INSERT INTO `company`(`comp_name`, `ph_number`, `comp_address`) VALUES('$comp_name', '$ph_number', '$comp_address')");


}



?>
<div class="page-container ">
   <!--/content-inner-->
	<div class="left-content">


	<!--working-->

	
		<div class="w3-agile-chat">
				<div class="charts">
						<div class="col-md-12 w3layouts-char">
						<div class="charts-grids widget">	
						<div class="row">
						<div class="col-lg-2"></div>
						<div class="col-lg-8">
							<form  method="post">
								<label for="cat_name">Company Name:</label>
					        <input type="text" name="comp_name" class="form-control" required>
					        <br>
					        <label for="cat_name">Phone number:</label>
					        <input type="tel" name="ph_number" class="form-control" required>
					        <br>
					        <label for="cat_description">Company Address:</label>
					        <textarea name="comp_address"  class="form-control"  required></textarea>
					        <br>
					        <button class="btn btn-primary" name="btn_submit" >Submit</button>
                        </form>
                        </div>
						<div class="col-lg-2"></div>

                        </div>
							<br>
							<br>
							
							<div class="row">
								
								<div class="col-md-12">
								
								</div>
							</div>
								<div class="row">
									<div class="col-lg-2"></div>
									<div class="col-lg-8">
							<table class="table table-bordered" > 
								<thead>
									<tr>
										<th>Company Id</th>
										<th>Company Name</th>
										<th>Phone Number</th>
										<th>Company Address</th>
									</tr>
								</thead>
								<tbody>
									 <?php
									 $query = mysqli_query($con, "SELECT  * FROM `company`");
									 while($rows = mysqli_fetch_array($query)){
										?>								       
										<tr>
											<td><?php echo $rows['comp_id'] ?></td>
											<td><?php echo $rows['comp_name'] ?></td>
											<td><?php echo $rows['ph_number'] ?></td>
											<td><?php echo $rows['comp_address'] ?></td>
										</tr>
									<?php } ?>
								</tbody>
								
							</table>
							<br>
							</div>
							</div>
						</div>
					</div>
				</div>			
		</div>

<div class="copyrights">
	 <p>Copyright © 2023 Powered by <a href="https://simulationsx.com/" target="_blank">Simulations Xperience Pvt. Ltd.</a>. All Rights Reserved   </p>
</div>




	</div>
	
	<script>



	function checkdelete(){
	
	return confirm("Are you sure");
}
		function checkdelete1(){
	
	return confirm("Are you sure");
}

	</script>
	
<?php

include('footer.php');
?>