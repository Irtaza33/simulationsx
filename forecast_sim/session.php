<?php
include('header.php');
error_reporting(E_ALL ^ E_NOTICE);
include('db.php');
if(isset($_POST['int_save'])){
	$int_name = $_POST['int_name'];
	$int_dsc = $_POST['int_dsc'];

	$insert_int=mysqli_query($con,"INSERT into `institute`(`ins_name`,`ins_des`) VALUES('$int_name','$int_des')");

}
?>
<!-- Include the jQuery library from a CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include the Bootstrap library from a CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<link rel="stylesheet" href="http://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    <script>
$(function() {
$("#table_id").dataTable({
    "aaSorting":[[0, "DESC"]],
    
});

});
</script>

<div class="page-container ">
   <!--/content-inner-->
	<div class="left-content">


	<!--working-->

	
		<div class="w3-agile-chat">
				<div class="charts">
					<div class="col-md-12 w3layouts-char">
					
						<div class="charts-grids widget">	
							
							<div class="row">
								<div class="container-fluid">
								<div class="col-md-2"></div>
								<div class="col-md-8">
									<h2 style="text-align: Center;" >CREATE NEW SESSION</h2><br>
									<form action="assets/data/session/save.php"   method="post" enctype="multipart/form-data">
									<div class="row">
										<div class="col-lg-6">
										<label>Session Name</label>

									<input type="text" name="name" pattern="[A-Z]{3}[-]{1}[A-Z]{3}[-]{1}[A-Z]{2,3}[-]{1}[0-9]{2}" title="Please Insert The Value Like (PGM-CRS-UNI-YR)"  placeholder="Session Name  " class="form-control" required>
									</div>
									<div class="col-lg-6">
										<label>Session Date</label>
										<input type="date" name="date" placeholder="Logo"  class="form-control"  >
										<br>
										</div>
									</div>

									<br>
									
									<div class="col-lg-12">
									<br>
										
									<button type="submit" name="btnsave" class="btn btn-success"  style="float: right;width:100px;height:40px" >Create</button>
									</div>
									<!-- <button type="submit" class="btn btn-primary">Save</button> -->


									</form>
								</div>
								<div class="col-md-2"></div>
							</div>
							</div>
							<script type="text/javascript">
										const checkbox = document.getElementById('myCheckbox');
										const myDiv = document.getElementById('myDiv');
										const sDiv = document.getElementById('sDiv');
										    sDiv.style.display = 'none'; 

										checkbox.addEventListener('change', function() {
										  if (this.checked) {
										    myDiv.style.display = 'none'; 
										    sDiv.style.display = 'block'; 

										  } else {
										    myDiv.style.display = 'block'; 
										    sDiv.style.display = 'none'; 

										  }
										});

									</script>
							<br>
							<br>
						<!-- 	<div class="row">
								<div class="col-md-9"></div>
								
								<div class="col-md-2">
									<a href="active_session.php" class="btn btn-success">Activate Session</a>
								</div>
								<div class="col-md-1"></div>
							</div> -->
							<div class="row">
								
								<!-- <div class="col-md-12">
									<table class="table table-stripped"  id="table_id">
										<tr>
											<th>Id</th>
											<th>Session Name</th>
											<th>Status</th>
											<th>Date</th>
											<th>Delete</th>
										</tr>
										<?php
										$query="SELECT * FROM `session` order by id desc;";
										$rec=mysqli_query($con,$query);
										while($row=mysqli_fetch_array($rec)){
											
											?>
											<tr>
												<td><?php echo $row['id'];?></td>
												<td><?php echo $row['des'];?></td>
												<td><?php echo $row['status'];?></td>
												<td><?php echo $row['date'];?></td>
												<td>
											
													<a onclick="return checkdelete()" href="assets/data/session/delete.php?id=<?php echo $row['id'];?>" class="btn btn-delete"><span class="fa fa-trash"></span></a>
												
												</td>
											</tr>
											<?php
										}
										
										?>
									</table>
								</div> -->
							</div>
							
						</div>
					</div>
				</div>			
		</div>

<div class="copyrights">
	 <p>Copyright © 2023 Powered by <a href="https://simulationsx.com/" target="_blank">Simulations Xperience Pvt. Ltd.</a>. All Rights Reserved   </p>
</div>



							<!-- Modal -->
							<div class="modal fade" id="senderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Add Institute</h5>
									</div>
									<form action="" method="post">
										<div class="modal-body">
											<input type="text" name="int_name" placeholder="Institute Name" class="form-control" required><br>
											<textarea class="form-control" name="int_dsc" placeholder="Description" rows="3" ></textarea>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											<button type="submit" name="int_save" class="btn btn-primary">Save</button>
										</div>
									</form>
									</div>
								</div>
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