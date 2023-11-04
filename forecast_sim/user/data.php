<?php include 'header.php';
include("../db.php");

     $session_query="SELECT * FROM `session` where status='Active';";
$session_rec=mysqli_query($con,$session_query);
while($row=mysqli_fetch_array($session_rec)){
    $session_id=$row[0];
    $session_name=$row['des'];
}
	$st=mysqli_query($con,"select * from historical_header where team_id = '".$_SESSION['id']."' AND session_id = '".$session_id."' 
		AND functions_type = '".$_GET['type']."' ");
	$ft=mysqli_fetch_array($st);
	$hs_id = $ft['hs_id'];

        if($_GET['type'] == 4){
        $select_trc=mysqli_query($con,"select * from historical_details where header_id = '".$hs_id."' LIMIT 17 ");

        }
        elseif($_GET['type'] == 5){
        $select_trc=mysqli_query($con,"select * from historical_details where header_id = '".$hs_id."' AND tracking_signal != 0 ");

        }
        else{
        $select_trc=mysqli_query($con,"select * from historical_details where header_id = '".$hs_id."' AND tracking_signal >= 0.1 ");
        }
	$dataPoints = array();
		while ($graph = mysqli_fetch_array($select_trc)) {
		    $mape = $graph['tracking_signal'];
		    $dataPoints[] = array("label" => $graph['serial_num'], "y" => $mape);
		}
        if($_GET['type'] == 4){
        $select_grp=mysqli_query($con,"select * from historical_details where header_id = '".$hs_id."' AND actual_data!= 0 AND forecast_data !=0  ");

        }else{

		$select_grp=mysqli_query($con,"select * from historical_details where header_id = '".$hs_id."' AND actual_data!= 0 AND forecast_data !=0 LIMIT 17 ");
        }
		while ($graph2 = mysqli_fetch_array($select_grp)) {
		    // Assuming you have 'date_column' as the x-axis label and 'actual_data_column' and 'forecast_data_column' as the y-axis values.
		    
		    $actual_value = (float) $graph2['actual_data'];
		    $forecast_value = (float) $graph2['forecast_data'];

		    $actual_data[] = array("y" => $actual_value);
		    $forecast_data[] = array( "y" => $forecast_value);
		}

		?>



<br>
<a href="functions.php" style="margin-left: 10px;border-radius: 0;padding: 7px;background: purple;border: none;" class="btn btn-primary" >Back to Functions</a>

<br>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>

    <style type="text/css">
    /* Add this CSS to style the fixed header */
.fixed-header{
    position: sticky;
    top: 100;
    background-color: purple;
    color: white;
    z-index: 1;
}
.func{
    position: sticky;
    top: 60;
    background-color: white;
    z-index: 1;
}
</style>

	<div class="container" style="width:100%" >
        <div class="col-lg-1"></div>
	<div class="col-lg-10">
    <div class="row">
		<div class="col-lg-6">
        <canvas id="myChart1"></canvas>

		</div>
		<div class="col-lg-6">
        <canvas id="myChart"></canvas>
		</div>
	</div>
    <hr>
 <?php 
     $select_alpa = mysqli_query($con,"select * from team_input where team_id = '".$_SESSION['id']."' AND session_id = '".$session_id."' ");
                    $fts=mysqli_fetch_array($select_alpa);
                    $alpha =  $fts['input_alpha'];
                    $beta =  $fts['input_beta'];
                    $gama =  $fts['input_gama'];
     ?>
	<div class="row">
        <div style="text-align: Center;" class="func" > 
        <img src="../images/alpha.png" style="width:40px" ><strong style="font-size: 15px" ><?php echo $alpha; ?></strong> 
        <img src="../images/beta.png" style="width:40px" ><strong style="font-size: 15px" ><?php echo $beta; ?></strong> 
        <img src="../images/gama.png" style="width:40px" ><strong style="font-size: 15px" ><?php echo $gama; ?></strong> 
        </div>
		<table class="table table-bordered" >
			<thead class="fixed-header" style="background: purple;color: white;" >
				<tr>
					<th>S#</th>
					<th>Months</th>
					<th>Actual Sales</th>

                    <?php 
                        if($_GET['type'] == 4){
                    ?>

                        <th>Forecast including Trend</th>
                        <th>Level</th>
                        <th>Smoothed trend</th>

                    <?php }elseif($_GET['type'] == 5){
                         
                         ?>
                        <th>Forecast including Trend</th>
                        <th>Level</th>
                        <th>Smoothed trend</th>
                        <th>Season</th>
                    <?php 
                     } else{ ?>
					<th>Forecast</th>
                    <?php } ?>

					<th>Error/Bias</th>
					<th>Running Sum</th>
					<th>Mean Absolute deviation (MAD)</th>
					<th>Mean Absolute Percentage error (MAPE)</th>
					<th>Commulative Absolute Error</th>
					<th>Tracking Signal</th>
				</tr>
			</thead>
			<tbody>
				<?php $select=mysqli_query($con,"select * from historical_details where header_id ='".$hs_id."'  ");
				while($row=mysqli_fetch_array($select)){ ?>
				<tr>
					<td style="background-color: purple;color: white;" ><?php echo $row['serial_num'] ?></td>
					<td style="width:120px;" ><b><?php echo $row['month']; ?></b></td>
					<td><?php echo $row['actual_data']; ?></td>

                     <?php 
                        if($_GET['type'] == 4){
                     ?>
                    <td><?php echo $row['forecast_data']; ?></td>
                    <td><?php echo $row['holt_level']; ?></td>
                    <td><?php echo $row['holt_smtnt']; ?></td>
                     <?php }elseif($_GET['type'] == 5){
                         ?>
                    <td><?php echo $row['forecast_data']; ?></td>
                    <td><?php echo $row['holt_level']; ?></td>
                    <td><?php echo $row['holt_smtnt']; ?></td> 
                    <td><?php echo round($row['season'],2); ?></td> 
                     <?php 
                     }else{ ?>

					<td><?php echo $row['forecast_data']; ?></td>
                    <?php } ?>

					<td><?php echo $row['forecast_error']; ?></td>
					<td><?php echo $row['running_sum']; ?></td>
					<td><?php echo $row['ad_data']; ?></td>
					<td><?php echo $row['map_data']; ?></td>
					<td><?php echo $row['cae_data']; ?></td>
					<td><?php echo $row['tracking_signal']; ?></td>
				</tr>
			    <?php } ?>
			</tbody>
			
		</table>
	</div>
    </div>
   
    <div class="col-lg-1">
    </div>
</div>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');

        // Sample data points (replace with your actual data)
        var dataPoints = <?php echo json_encode($dataPoints); ?>;

        var labels = dataPoints.map(function(item) {
            return item.label;
        });

        var values = dataPoints.map(function(item) {
            return item.y;
        });

        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Tracking Signal',
                    data: values,
                    borderColor: '#78281F',
                    borderWidth: 2,
                    pointRadius: 4,
                    pointBackgroundColor: '#78281F',
                    fill: false,
                    tension: 0.4
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: true,
                    },
                    datalabels: {
                        display: true,
                        anchor: 'center',
                        align: 'top',
                        backgroundColor: 'rgba(255, 255, 255, 0.8)',
                        borderRadius: 4,
                        font: {
                            weight: 'bold'
                        },
                        formatter: function(value, context) {
                            var index = context.dataIndex;
                            return index.toString(); // Display index label
                        }
                    }
                }
            }
        });
    </script>
 

  <script>
        var ctx = document.getElementById('myChart1').getContext('2d');

        // Sample data (replace with your actual data)
        var actualData = <?php echo json_encode($actual_data); ?>;
        var forecastData = <?php echo json_encode($forecast_data); ?>;

        var labels = actualData.map(function(_, index) {
            return (index + 1);
        });

        var actualValues = actualData.map(function(item) {
            return item.y;
        });

        var forecastValues = forecastData.map(function(item) {
            return item.y;
        });

        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Actual Data',
                        data: actualValues,
                        borderColor: '#1A5276',
                        borderWidth: 2,
                        pointRadius: 2,
                        pointBackgroundColor: '#1A5276',
                        fill: false,
                        tension: 0 // Set tension to 0 for sharp curves
                    },
                    {
                        label: 'Forecast Data',
                        data: forecastValues,
                        borderColor: '#C0392B',
                        borderWidth: 2,
                        pointRadius: 2,
                        pointBackgroundColor: '#C0392B',
                        fill: false,
                        tension: 0 // Set tension to 0 for sharp curves
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                    }
                }
            }
        });
    </script>


<?php include 'footer.php'; ?>
