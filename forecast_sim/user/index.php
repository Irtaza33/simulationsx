<?php include 'header.php';
// session_start();
include("../db.php");
 error_reporting(E_ALL ^ E_NOTICE);

     $session_query="SELECT * FROM `session` where status='Active';";
$session_rec=mysqli_query($con,$session_query);
while($row=mysqli_fetch_array($session_rec)){
    $session_id=$row[0];
    $session_name=$row['des'];
}

$select_user = mysqli_query($con,"select * from team_master 
JOIN sku_unit on sku_unit.sku_id = team_master.team_comp 
JOIN company on company.comp_id = sku_unit.company_id 
 where team_id = '".$_SESSION['id']."' AND session_id = '".$session_id."' ");
$fetch=mysqli_fetch_array($select_user);

 $sku= $fetch['sku_id'];
 $company= $fetch['company_id'];

$team= $fetch[0];
$type=$fetch['team_datatype'];
$year1=$fetch['tm_from_num'];
$year2=$fetch['tm_to_num'];

$startYear = $fetch['tm_from_num'];
$endYear = $fetch['tm_to_num'];

$numberOfYears = $endYear - $startYear + 1;

$total = $numberOfYears * 4;
	
$sel_team=mysqli_query($con,"select * from team_input where team_id = '".$team."' and session_id = '".$session_id."' ");
$fetch2=mysqli_num_rows($sel_team);


?>

 
  
	<div class="container-fluid">
		<br>
		<div class="row column-gap" >
			<div class="col-lg-6 " >

			</div>
			<div class="col-lg-6 " >
			<p style="float: right;"  >
			<?php echo $session_name; ?> | <?php echo $_SESSION['name']; ?> 
			</p>
			</div>
		</div>
	</div>
		<?php if(isset($_GET['generate_forecast_dmd'])){ ?>
		<div class="container-fluid "   >
			<?php if($fetch2 == 1){
			echo "<script>window.location.href = 'functions.php';</script>";
		}else{ ?>
				<form method="POST" >
					<div class="container" > 
						<div class="row"  style="margin-left: 5vw;" >
							<div class="col-lg-3">
								<label>Category Name</label>
								<input type="text" class="form-control" disabled value="<?php echo $fetch['sku_des']; ?>">
							</div>
							<div class="col-lg-2">
								<label>Alpha (α)</label>
								<input type="text" class="form-control" required name="alpha">
							</div>
							<div class="col-lg-2">
								<label>Beta (β)</label>
								<input type="text" class="form-control" required name="beta">
							</div>
							<div class="col-lg-2">
								<label>Gamma (γ)</label>
								<input type="text" class="form-control" required name="gamma">
							</div>
							<div class="col-lg-2">
								<label>Lead Time</label>
								<input type="text" class="form-control" required name="lead_time">
							</div>
						</div>
						<div class="row" style="margin-left: 5vw;" >
							<div class="col-lg-3">
								<label>Month opening stock</label>
								<input type="text" class="form-control" required name="mos">
							</div>
							<div class="col-lg-2">
								<label>Pending Arrivals</label>
								<input type="text" class="form-control" required name="pa">
							</div>
							<div class="col-lg-2">
								<label>Pending arrivals date</label>
								<input type="date" class="form-control" required name="pad">
							</div>
							<div class="col-lg-2">
								<label>MOQ</label>
								<input type="text" class="form-control" required name="moq">
							</div>
							<div class="col-lg-2">
								<label>Data type</label>
								<input type="text" class="form-control" disabled value="<?php echo $fetch['team_datatype']; ?>" name="">
							</div>
						</div>
					</div>
					<br>
			<div class="row"  >
					
					<div class="col-lg-2"></div>
				<div class="col-lg-8" style="text-align: center;border-style:solid;border-width: 1px;" >
						<h2>Historical Data</h2>
						<?php if($type == 'Monthly'){?>
						<div style="display: flex;">
    <!-- First Table -->
				    <table class="table table-bordered" style="flex: 1;">
				        <thead style="background: purple;color:white">
				            <tr>
				                <th>Months</th>
				                <th>Sales</th>
				            </tr>
				        </thead>
				        <tbody>
				            <?php
				            $rowCounter = 0;
				            $months = array(
				                "Jan", "Feb", "Mar", "Apr", "May", "June",
				                "July", "Aug", "Sep", "Oct", "Nov", "Dec","Jan", "Feb", "Mar", "Apr", "May", "June",
				                "July", "Aug", "Sep", "Oct", "Nov", "Dec"
				            );

				            for ($i = 0; $i < 12; $i++) {
				                ?>
				                <tr>
				                    <td><?php echo $months[$rowCounter]."-".$year1; ?></td>

				                    <td><input type="number" min="0" name="sale_number<?php echo $rowCounter; ?>" class="form-control" style="width:100px"></td>
				                </tr>
				                <?php
				                $rowCounter++;
				            }
				            ?>
				        </tbody>
				    </table>
				    
				    <!-- Second Table -->
				    <table class="table table-bordered" style="flex: 1;">
				        <thead style="background: purple;color:white">
				            <tr>
				                <th>Months</th>
				                <th>Sales</th>
				            </tr>
				        </thead>
				        <tbody>
				            <?php
				            $rowCounter = 12; // Start from 12 to display the second set of months

				            for ($i = 0; $i < 12; $i++) {
				                ?>
				                <tr>
				                    <td><?php echo $months[$rowCounter]."-".$year2; ?></td>
				                    <td><input type="number" min="0" name="sale_number<?php echo $rowCounter; ?>" class="form-control" style="width:100px"></td>
				                </tr>
				                <?php
				                $rowCounter++;
				            }
				            ?>
				        </tbody>
				    </table>
				</div>

						<button class="btn btn-primary" name="btn_submit_mon" style="border-radius: 0;" >SUBMIT</button><br><br>

						<!-- For quarterly -->
						<?php } elseif($type == 'Quarterly'){ ?>
						<table class="table table-bordered">
						<thead style="background: purple;color:white" >
						<tr>
						<th>Months</th>
						<th>Sales</th>
						
						</tr>
						</thead>
						<tbody>
							<?php // Loop to print data dynamically for each year
							$rowCounter = 1;

							for ($year = $startYear; $year <= $endYear; $year++) {
							    for ($i = 0; $i < 4; $i++) {
							        
							 ?>  
							<tr>
								<td><?php if($year == $startYear){echo $fetch['tm_datafrom']."- ".$year;}else{echo $fetch['tm_datato']."- ".$year;} ?></td>

								<td><input type="number" min="0" name="sale_number<?php echo $rowCounter; ?>"  class="form-control" style="width:100px" ></td>
							</tr>
							<?php 
							        $rowCounter++;
							 }
							}?>
						</tbody>
						</table>
						<button class="btn btn-primary" name="btn_submit" style="border-radius: 0;" >SUBMIT</button><br><br>

					<?php }?>


				</div>
			</div>

				</form>
			<br>
			
			<?php } 
			if(isset($_POST['btn_submit']))
			{	
				$alpha = $_POST['alpha'];
				$beta = $_POST['beta'];
				$gamma = $_POST['gamma'];
				$lead_time = $_POST['lead_time'];
				$mos = $_POST['mos'];
				$pa = $_POST['pa'];
				$pad = $_POST['pad'];
				$moq = $_POST['moq'];
				$dta_tp = $fetch['team_datatype'];

				$rowCounter = 0;

			for ($year = $startYear; $year <= $endYear; $year++) {
			
				for ($i = 0; $i < 4; $i++) {
				if($year == $startYear){ $code = $fetch['tm_datafrom']."-".$year;}else{ $code =$fetch['tm_datato']."-".$year;};	
				$team_id = $team;
				 $month = $code;
				 $sale= $_POST['sale_number'.$rowCounter];
				 $ccd = $rowCounter+1;

				 // $insert = mysqli_query($con,"INSERT INTO `forecast_data`(`ser_num`,`comp_id`, `team_id`, `sku_id`, `month`, `data`) 
				 // 	VALUES('$ccd','$company','$team_id','$sku','$month','$sale')");

				$rowCounter++;
					}
				}
				// $insert_input = mysqli_query($con,"INSERT INTO `team_input`(`input_sku`, `input_alpha`, `input_beta`, `input_gama`, `lead_time`, `month_ostock`, `pend_arr`, `pend_arr_date`, `input_moq`, `data_type`, `team_id`, `session_id`) VALUES ('$sku','$alpha','$beta','$gamma','$lead_time','$mos','$pa','$pad','$moq','$dta_tp','$team_id','$session_id')");

				// echo "<script>window.location.href = 'functions.php';</script>";
			}

			if(isset($_POST['btn_submit_mon']))
			{	
				$alpha = $_POST['alpha'];
				$beta = $_POST['beta'];
				$gamma = $_POST['gamma'];
				$lead_time = $_POST['lead_time'];
				$mos = $_POST['mos'];
				$pa = $_POST['pa'];
				$pad = $_POST['pad'];
				$moq = $_POST['moq'];
				$dta_tp = $fetch['team_datatype'];

				$rowCounter = 0;
				 $ccd = $rowCounter+1;

				$months = array(
				"Jan", "Feb", "Mar", "Apr", "May", "June",
				"July", "Aug", "Sep", "Oct", "Nov", "Dec","Jan", "Feb", "Mar", "Apr", "May", "June",
				"July", "Aug", "Sep", "Oct", "Nov", "Dec"
				);
			for ($year = $startYear; $year <= $endYear; $year++) {
				for ($i = 0; $i < 12; $i++) {
				if($year == $startYear){ $code = $months[$rowCounter]."-".$year;}else{ $code =$months[$rowCounter]."-".$year;};	
				$team_id = $team;
				 $month = $code;
				 $sale= $_POST['sale_number'.$rowCounter];

				 $ccd = $rowCounter+1;
				
				 $insert = mysqli_query($con,"INSERT INTO `forecast_data`(`ser_num`,`comp_id`, `team_id`, `sku_id`, `month`, `data`) 
				 	VALUES('$ccd','$company','$team_id','$sku','$month','$sale')");

				$rowCounter++;

					}
				}

				 $insert_input = mysqli_query($con,"INSERT INTO `team_input`(`input_sku`, `input_alpha`, `input_beta`, `input_gama`, `lead_time`, `month_ostock`, `pend_arr`, `pend_arr_date`, `input_moq`, `data_type`, `team_id`, `session_id`) VALUES ('$sku','$alpha','$beta','$gamma','$lead_time','$mos','$pa','$pad','$moq','$dta_tp','$team_id','$session_id')");

				echo "<script>window.location.href = 'functions.php';</script>";


			}

			 ?>
		</div>
		
		<?php }

		else{ ?>
		<div class="container "   >

			<div class="row" style="text-transform: uppercase;text-align: center;margin-top:0px;border-style:solid;padding:70px ;border-width: 1px;" >
						<h1><b><?php echo $fetch['comp_name']; ?> | <?php echo $fetch['sku_des']; ?></b></h1>
				
				<a href="?generate_forecast_dmd"><h1>Enter Historical Data</h1></a>
				<br><br>
				<img src="../images/graph.png" style="width: 100%;" >
				
        	</div>
		</div>
         <?php } ?>    
       
           
		
<br/>

		
<br/>

 <?php include 'footer.php'; ?>