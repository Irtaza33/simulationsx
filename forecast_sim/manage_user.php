<?php

include('header.php');   

error_reporting(0);

  $session_query="SELECT * FROM `session` where status='Active';";
$session_rec=mysqli_query($con,$session_query);
while($row=mysqli_fetch_array($session_rec)){
     $session_id=$row[0];
     $session_name=$row['des'];
}
	$selectd=mysqli_query($con,"select * from login where user = '".$_SESSION['user5']."' and type = 'Coach' ");
		$ss=mysqli_fetch_array($selectd);
		$user_id = $ss[0];

if(isset($_POST['btn_submit'])){
	$username=$_POST['username'];
	$pass=$_POST['password'];
	$company=$_POST['sku'];
	$dataType=$_POST['dataType'];
	$type_from=$_POST['type_from'];
	$data_from=$_POST['data_from'];
	$type_to=$_POST['type_to'];
	$data_to=$_POST['data_to'];
		$query="INSERT INTO `team_master`( `team_user`, `team_pass`, `team_comp`, `team_datatype`, `tm_datafrom`, `tm_from_num`, `tm_datato`, `tm_to_num`,`session_id`) 
	VALUES ('$username','$pass','$company','$dataType','$type_from','$data_from','$type_to','$data_to','$session_id')";
	$fire=mysqli_query($con,$query);
	//team_comp is using for SKU of company-category-brand
}



//delete

if(isset($_GET['delete'])){
	$delete1 =mysqli_query($con,"delete from team_master where team_id = '".$_GET['delete']."'");
		header('location:manage_user');

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
							
							<form action="" method="post">	
								<div class="row">
									<div class="col-lg-2"></div>
									<div class="col-lg-2">
									<label>username</label>
									<input type="text" placeholder="Username" class="form-control" name="username">										
									</div>
									<div class="col-lg-2">
									<label>Password</label>
									<input type="text" placeholder="Password" class="form-control" name="password">										
									</div>
									 <div class="col-md-4">
						            <label>Datatype</label>
						            <select class="form-control" name="dataType" id="dataType" onchange="hideDiv()">
						                <option selected disabled>Select Datatype</option>
						                <option value="Quarterly">Quarterly</option>
						                <option value="Monthly">Monthly</option>
						            </select>
						        </div>
									<div class="col-lg-2"></div>
								</div>
								<br>
							<div class="row">
								<div class="col-md-2"></div>

<div class="col-md-2">
  <label>Company</label>
  <select class="form-control" name="company" id="companyDropdown">
    <option selected disabled>Select Company</option>
    <?php
    $sll = mysqli_query($con, "select * from company");
    while ($rs = mysqli_fetch_array($sll)) { ?>
      <option value="<?php echo $rs['comp_id'] ?>"><?php echo $rs['comp_name'] ?></option>
    <?php } ?>
  </select>
  <br>
</div>

<div class="col-md-2">
  <label>Category</label>
  <select class="form-control" name="category" id="categoryDropdown">
    <option selected disabled>Select Category</option>
  </select>
  <br>
</div>

<div class="col-md-2">
  <label>Brand</label>
  <select class="form-control" name="brand" id="brandDropdown">
    <option selected disabled>Select Brand</option>
  </select>
  <br>
</div>

<div class="col-md-2">
  <label>SKU</label>
  <select class="form-control" name="sku" id="skuDropdown">
    <option selected disabled>Select SKU</option>
  </select>
  <br>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    $("#companyDropdown").on("change", function() {
      var company_id = $(this).val();
      loadDropdownOptions("category", company_id, "#categoryDropdown");
    });

    $("#categoryDropdown").on("change", function() {
      var category_id = $(this).val();
      loadDropdownOptions("brand", category_id, "#brandDropdown");
    });

    $("#brandDropdown").on("change", function() {
      var brand_id = $(this).val();
      loadDropdownOptions("sku", brand_id, "#skuDropdown");
    });
  });

  function loadDropdownOptions(type, parent_id, dropdownID) {
    $.ajax({
      url: "ajax.php",
      method: "POST",
      data: { type: type, parent_id: parent_id },
      success: function(data) {
      	console.log(parent_id);
        var dropdown = $(dropdownID);
        dropdown.html('<option selected disabled>Select ' + type.charAt(0).toUpperCase() + type.slice(1) + '</option>');
        dropdown.append(data);
      },
      error: function(xhr, status, error) {
        console.error("Error loading dropdown options:", error);
      }
    });
  }
</script>

								
							</div>
							<div class="row">
								<div class="col-md-2"></div>
								<div class="col-md-4">
									<label >Data From</label>
										<div class="row">
											<div class="col-lg-6 " id="myDiv">
										<select class="form-control" name="type_from" >
											<option selected disabled >Select Datatype</option>
											<?php $sll=mysqli_query($con,"select * from data_type");

											 while($rs=mysqli_fetch_array($sll)){ ?>
											 	<option value="<?php echo $rs['data_short'] ?>"><?php echo $rs['data_short'] ?> | <?php echo $rs['data_months'] ?></option>
											 <?php } ?>
										</select>
											</div>
											<div class="col-lg-6">
											<input type="text" class="form-control" placeholder="Enter data from" id="hs_year" onkeyup="autoPopulate()" name="data_from">
											</div>		
										</div>						
								</div>
								<div class="col-md-4">
									<label>Data To</label>
										<div class="row">
											<div class="col-lg-6" id="myDiv1">
										<select class="form-control" name="type_to" >
											<option selected disabled >Select Datatype</option>
											<?php $sll=mysqli_query($con,"select * from data_type");

											 while($rs=mysqli_fetch_array($sll)){ ?>
											 	<option value="<?php echo $rs['data_short'] ?>"><?php echo $rs['data_short'] ?> | <?php echo $rs['data_months'] ?></option>
											 <?php } ?>
										</select>
											</div>
											<div class="col-lg-6">
											<input type="text" class="form-control" placeholder="Enter data To" name="data_to" id="rf_year" readonly >
											</div>		
										</div>						
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-2"></div>
								<div class="col-md-8">
								   <button type="submit" name="btn_submit" style="float:right;" class="btn btn-success">Create</button>
								
								</div>
								
							</div>
		  <script>
    function hideDiv() {
      var selectBox = document.getElementById("dataType");
      var selectedValue = selectBox.value;
      var myDiv = document.getElementById("myDiv");
      var myDiv1 = document.getElementById("myDiv1");

      if (selectedValue === "Monthly") {
        myDiv.style.display = "none";
        myDiv1.style.display = "none";
      } else {
        myDiv.style.display = "block";
        myDiv1.style.display = "block";

      }
    }
  </script>

  <script>
        function autoPopulate() {
            var hsYearInput = document.getElementById("hs_year");
            var rfYearInput = document.getElementById("rf_year");

            // Get the entered value in hs_year
            var hsYear = parseInt(hsYearInput.value);

            // Calculate the next year
            var nextYear = hsYear + 1;

            // Set the value of rf_year input to the next year
            rfYearInput.value = nextYear;
        }
    </script>


                        </form>

							<br>
							<br>
							
							<div class="row">
								
								<div class="col-md-12">
									<table class="table table-stripped">
										<tr>
											<th>Id</th>
											<th>Username</th>
											<th>Password</th>
											<th>Company</th>
											<th>Data Type</th>
											<th>Type From</th>
											<th>Data From</th>
											<th>Type To</th>
											<th>Data To</th>
											<th></th>
										</tr>
										<?php
										$query="SELECT * FROM `team_master` 
										JOIN sku_unit on sku_unit.sku_id = team_master.team_comp
										JOIN company on company.comp_id = sku_unit.company_id
										where session_id = '".$session_id."'
										";
										$rec=mysqli_query($con,$query);
										while($row=mysqli_fetch_array($rec)){
											?>
											<tr>
												<td><?php echo $row[0];?></td>
												<td><?php echo $row['team_user'];?></td>
												<td><?php echo $row['team_pass'];?></td>
												<td><?php echo $row['comp_name']." | ".$row['sku_des'];?></td>
												<td><?php echo $row['team_datatype'];?></td>

												<td><?php echo $row['tm_datafrom'];?></td>
												<td><?php echo $row['tm_from_num'];?></td>

												<td><?php echo $row['tm_datato'];?></td>
												<td><?php echo $row['tm_to_num'];?></td>
												<td>
												<?php
												if($row['status']!='Active'){
													
												
												?>
													<a onclick="return checkdelete()" href="?delete=<?php echo $row[0];?>" class="btn btn-delete"><span class="fa fa-trash"></span></a>
												<?php
												}
												?>
												</td>
											</tr>
											<?php
										}
										
										?>
									</table>
								</div>
								<div class="col-md-1"></div>

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
	$(document).ready(function(){
		
		// $('.page-container').addClass('sidebar-collapsed');
		
		
		// $("#txtname").change(function(){
			// var name=$(this).val();
			// $.ajax({
					// url:"team.php",
					// method:"POST",
					// data:'name='+name,
					// success:function(data)
					// {
						// $("#table_data").html(data);
					// }
				// });
		// });
	});
	function checkdelete(){
	
	return confirm("Are you sure");
}
	
	</script>
	
<?php

include('footer.php');
?>