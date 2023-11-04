<?php 

				

		        	//CAE
					$select_cae=mysqli_query($con,"select * from historical_details where header_id = '".$header_id."' AND serial_num = $cc2 ");
					$fetch_cae = mysqli_fetch_array($select_cae);

					$G_data=$fetch_cae['ad_data'];

					if($dd == 2){
						$I_data=$cae_data[2];
					}else{
						$I_data=$cae_sum;
					}
					$cae_sum = $I_data + $G_data;

		        	if($cc2 == 24){
		        	$cae_data[] = 0;
		       		}else{

		        		$cae_data[] = $cae_sum;

		        	}
		        	//CAE

		        	//tracking

		        	$select_trc=mysqli_query($con,"select * from historical_details where header_id = '".$header_id."' AND serial_num = $cc2 ");
					$fetch_trc = mysqli_fetch_array($select_trc);

					$data_I=$fetch_trc['cae_data'];
					$data_F=$fetch_trc['running_sum'];
					$data_A=$fetch_trc['serial_num'];

					// $tr_for = $data_F/($data_I/($data_A - 1));

					if($cc2 == 24){
		        		$tracking_sig[] = 0;
		       		}else{

		        		$tracking_sig[] = round($tr_for,2);

		        	}


		        	//tracking

 ?>