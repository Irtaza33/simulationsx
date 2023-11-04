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
    // Retrieve the data from the POST request
    $cat_name = $_POST["cat_name"];
    $cat_description = $_POST["cat_description"];

   
    $query = mysqli_query($con,"INSERT INTO `category`(`cat_name`, `cat_desctiption`) VALUES('$cat_name','$cat_description')");

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
								<label for="cat_name">Category Name:</label>
					        <input type="text" name="cat_name" class="form-control" required>
					        <br>
					        <label for="cat_description">Category Description:</label>
					        <textarea name="cat_description"  class="form-control"  required></textarea>
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
										<th>Category Id</th>
										<th>Category Name</th>
										<th>Category Description</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									 <?php
									 $query = mysqli_query($con, "SELECT  * FROM `category`");
									 while($rows = mysqli_fetch_array($query)){
										?>								       
										<tr>
											<td><?php echo $rows['cat_id'] ?></td>
											<td><?php echo $rows['cat_name'] ?></td>
											<td><?php echo $rows['cat_desctiption'] ?></td>
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