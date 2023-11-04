<?php
include('header.php');
include('db.php');

if(isset($_GET['delete'])){
	$delete = mysqli_query($con,"DELETE FROM `historical_header` WHERE hs_id = '".$_GET['delete']."'");

}
if(isset($_GET['delete1'])){
	$delete1 = mysqli_query($con,"DELETE FROM `team_input` WHERE team_id = '".$_GET['delete1']."'");
	$delete2 = mysqli_query($con,"DELETE FROM `forecast_data` WHERE team_id = '".$_GET['delete1']."'");
}

?>

<div class="page-container ">
	<div class="left-content">
		<div class="w3-agile-chat">
			<div class="charts">
				<a href="?Team_input">Team Input</a> | <a href="?Naive_Approach">Naive Approach</a> | <a href="?Exponential_Smoothing">Exponential Smoothing</a> 
					<div class="col-md-12 w3layouts-char">
					<div class="charts-grids widget">
						<?php if(isset($_GET['Team_input'])){ ?>
							<table class="table table-bordered" > 
							<thead>
								<tr>
									<th>Id</th>
									<th>Alpha</th>
									<th>Beta</th>
									<th>Gama</th>
									<th>Lead Time</th>
									<th>Month opening stock</th>
									<th>Pending Arrivals</th>
									<th>Pending arrivals date</th>
									<th>MOQ</th>
									<th>Sku</th>
									<th>Data type</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								 <?php
								 $query = mysqli_query($con, "SELECT  * FROM `team_input` 
								 	JOIN team_master on team_master.team_id = team_input.team_id
								 	JOIN session on session.id = team_input.session_id
								 	JOIN sku_unit on sku_unit.sku_id = team_input.input_sku
								 	 ");
								 while($rows = mysqli_fetch_array($query)){
									?>								       
									<tr>
										<td><?php echo $rows['input_id'] ?></td>
										<td><?php echo $rows['input_alpha'] ?></td>
										<td><?php echo $rows['input_beta'] ?></td>
										<td><?php echo $rows['input_gama'] ?></td>
										<td><?php echo $rows['lead_time'] ?></td>
										<td><?php echo $rows['month_ostock'] ?></td>
										<td><?php echo $rows['pend_arr'] ?></td>
										<td><?php echo $rows['pend_arr_date'] ?></td>
										<td><?php echo $rows['input_moq'] ?></td>
										<td><?php echo $rows['sku_des'] ?></td>
										<td><?php echo $rows['data_type'] ?></td>
										<td>
												<a onclick="return checkdelete()" href="?delete1=<?php echo $rows['team_id'];?>" class="btn btn-delete"><span class="fa fa-trash"></span></a>
											
											</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>	
						<?php }elseif(isset($_GET['Naive_Approach'])){ ?>	
							<table class="table table-bordered" > 
								<thead>
									<tr>
										<th>Header Id</th>
										<th>Team Name</th>
										<th>Session Name</th>
										<th>Company Name</th>
										<th>Sku</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									 <?php
									 $query = mysqli_query($con, "SELECT  * FROM `historical_header` 
									 	JOIN team_master on team_master.team_id = historical_header.team_id
									 	JOIN session on session.id = historical_header.session_id
									 	JOIN company on company.comp_id = historical_header.company_id
									 	JOIN sku_unit on sku_unit.sku_id = historical_header.sku_id
									 	where functions_type = 1
									 	 ");
									 while($rows = mysqli_fetch_array($query)){
										?>								       
										<tr>
											<td><?php echo $rows['hs_id'] ?></td>
											<td><?php echo $rows['team_user'] ?></td>
											<td><?php echo $rows['des'] ?></td>
											<td><?php echo $rows['comp_name'] ?></td>
											<td><?php echo $rows['sku_des'] ?></td>
											<td>
													<a onclick="return checkdelete()" href="?delete=<?php echo $rows[0];?>" class="btn btn-delete"><span class="fa fa-trash"></span></a>
												
												</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						<?php }elseif(isset($_GET['Exponential_Smoothing'])){ ?>	
							<table class="table table-bordered" > 
								<thead>
									<tr>
										<th>Header Id</th>
										<th>Team Name</th>
										<th>Session Name</th>
										<th>Company Name</th>
										<th>Sku</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									 <?php
									 $query = mysqli_query($con, "SELECT  * FROM `historical_header` 
									 	JOIN team_master on team_master.team_id = historical_header.team_id
									 	JOIN session on session.id = historical_header.session_id
									 	JOIN company on company.comp_id = historical_header.company_id
									 	JOIN sku_unit on sku_unit.sku_id = historical_header.sku_id
									 	where functions_type = 6
									 	 ");
									 while($rows = mysqli_fetch_array($query)){
										?>								       
										<tr>
											<td><?php echo $rows['hs_id'] ?></td>
											<td><?php echo $rows['team_user'] ?></td>
											<td><?php echo $rows['des'] ?></td>
											<td><?php echo $rows['comp_name'] ?></td>
											<td><?php echo $rows['sku_des'] ?></td>
											<td>
													<a onclick="return checkdelete()" href="?delete=<?php echo $rows[0];?>" class="btn btn-delete"><span class="fa fa-trash"></span></a>
												
												</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						<?php } ?>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>

	<script>
		
	function checkdelete(){
	
	return confirm("Are you sure");
}
	
	</script>
<?php

include('footer.php');
?>