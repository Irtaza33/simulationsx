<?php


                    //forcast error
                        $cc2 = $count1+1;
                    $select_fr_err=mysqli_query($con,"select * from forecast_data where team_id = '".$team_id."' AND comp_id = '".$company."' AND ser_num = '".$cc2."' ");
                    $fetch_fr_err = mysqli_fetch_array($select_fr_err);
                    $forcast_d = $fc_data[$bg];

                    $C_data_er =  $fetch_fr_err['data']; //Actual data
                    $D_data_er =  $forcast_d; 
                    $error_data = $C_data_er - $D_data_er;

                    if($cc2 == 25){
                            $fcerror_data[] = 0;
                    }else{
                            $fcerror_data[] = $error_data;
                        }
                    //forcast error
                     //Running Sum
                    
                    $E_data = $fcerror_data[$bg];

                    if($dd == 2){
                        $F_data=$running_sum[2];
                    }else{
                        $F_data=$run_sum;
                    }
                    $run_sum = $F_data + $E_data;

                    if($cc2 == 25){
                    $running_sum[] = 0;
                    }else{

                        $running_sum[] = $run_sum;
                    }
                    //Running Sum

                    //Mad
                    
                    $select_mad=mysqli_query($con,"select * from historical_details where header_id = '".$header_id."' AND serial_num = $count1 ");
                    $fetch_mad = mysqli_fetch_array($select_mad);

                    $M_data=$fcerror_data[$bg];

                    $abs_dev[]= abs($M_data);
                    //Mad
                 //CAE
                    $select_cae=mysqli_query($con,"select * from historical_details where header_id = '".$header_id."' AND serial_num = $cc2 ");
                    $fetch_cae = mysqli_fetch_array($select_cae);

                    $G_data=$abs_dev[$bg];

                    if($dd == 2){
                        $I_data=$cae_data[2];
                    }else{
                        $I_data=$cae_sum;
                    }
                    $cae_sum = $I_data + $G_data;

                    if($cc2 == 25){
                    $cae_data[] = 0;
                    }else{

                        $cae_data[] = $cae_sum;

                    }
                    //CAE
                    //tracking

                    $select_trc=mysqli_query($con,"select * from historical_details where header_id = '".$header_id."' AND serial_num = $cc2 ");
                    $fetch_trc = mysqli_fetch_array($select_trc);

                    $data_I=$cae_data[$bg];
                    $data_F=$running_sum[$bg];
                    $data_A=$bg;

                    // Assuming the values of $data_F, $data_I, and $data_A are already defined
                    $data_A_minus_1 = $data_A - 1;

                    if ($data_I != 0) {
                        $tr_for = $data_F / ($data_I / $data_A_minus_1);
                    } else {
                        // Handling the division by zero case
                        $tr_for = -$data_F;
                    }
                    if($cc2 == 25){
                        $tracking_sig[] = 0;
                    }else{

                        $tracking_sig[] = round($tr_for,2);
                        // $tracking_sig[] = $data_A;

                    }
                    //tracking

                    //MAPE
                    $select_mape=mysqli_query($con,"select * from forecast_data where team_id = '".$team_id."' AND comp_id = '".$company."' AND ser_num = '".$cc2."' ");
                    $fetch_mape = mysqli_fetch_array($select_mape);

                    $data_C =  $fetch_mape['data'];

                    $data_G = $abs_dev[$bg];
                    // Assuming the values of $data_G and $data_C are already defined

                    if ($data_C != 0) {
                        $formula_map = $data_G / $data_C;
                    } else {
                        // Handling the division by zero case
                        $formula_map = 0; // You can set it to any value you want or leave it as 0, depending on your requirement
                    }


                    if($cc2 == 25){
                        $mape_data[] = 0;
                    }else{

                        $mape_data[] = round($formula_map,2);

                    }

                    //MAPE





?>
