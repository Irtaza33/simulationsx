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
$sku_des = $_POST['sku_des'];
$category_id = $_POST['cat_id'];
$company_id = $_POST['comp_id'];
$brand_id = $_POST['brand_id'];


$sql = mysqli_query($con,"INSERT INTO `sku_unit`(`sku_des`, `category_id`, `company_id`, `brand_id`) VALUES ('$sku_des','$category_id','$company_id','$brand_id')");


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
								<label for="cat_name">SKU:</label>
					        <input type="text" name="sku_des" class="form-control" required>
					        <br>
					      
					        <label for="cat_id" >Category:</label>
					        <select class="form-control" name="cat_id" >
					        	<option>-Select category-</option>
					        	 <?php
									 $query = mysqli_query($con, "SELECT  * FROM `category`");
									 while($rows = mysqli_fetch_array($query)){
										?>								       
										<option value="<?php echo $rows['cat_id'] ?>" ><?php echo $rows['cat_name'] ?></option>
									<?php } ?>
					        </select>
					        <br>
					        <label for="cat_description">Company:</label>
					          <select class="form-control" name="comp_id" >
					        	<option>-Select Company-</option>
					        	 <?php
									 $query = mysqli_query($con, "SELECT  * FROM `company`");
									 while($rows = mysqli_fetch_array($query)){
										?>								       
										<option value="<?php echo $rows['comp_id'] ?>" ><?php echo $rows['comp_name'] ?></option>
									<?php } ?>
					        </select>
					          <br>
					        <label for="cat_description">Brand:</label>
					          <select class="form-control" name="brand_id" >
					        	<option>-Select Brand-</option>
					        	 <?php
									 $query = mysqli_query($con, "SELECT  * FROM `brand`");
									 while($rows = mysqli_fetch_array($query)){
										?>								       
										<option value="<?php echo $rows['brand_id'] ?>" ><?php echo $rows['brand_name'] ?></option>
									<?php } ?>
					        </select>
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
										<th>Sku Id</th>
										<th>SKU</th>
										<th>Brand</th>
										<th>Category</th>
										<th>Company</th>
									</tr>
								</thead>
								<tbody>
									 <?php
									 $query = mysqli_query($con, "SELECT  * FROM `sku_unit`  
									 	JOIN company on company.comp_id = sku_unit.company_id
									 	JOIN category on category.cat_id = sku_unit.category_id
									 	JOIN brand on brand.brand_id = sku_unit.brand_id
									 	");
									 while($rows = mysqli_fetch_array($query)){
										?>								       
										<tr>
											<td><?php echo $rows['sku_id'] ?></td>
											<td><?php echo $rows['sku_des'] ?></td>
											<td><?php echo $rows['brand_name'] ?></td>
											<td><?php echo $rows['cat_name'] ?></td>
											<td><?php echo $rows['comp_name'] ?></td>

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