<?php 
include '../../db.php';
session_start();
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

     $team_id = $fetch['team_id'];
     $company= $fetch['company_id'];
     $sku= $fetch['sku_id'];

if(isset($_POST['exponential_smoothing'])){
    // 6 for exponential_smoothing 
                    
     $insert_header = mysqli_query($con,"INSERT INTO `historical_header`( `team_id`, `session_id`, `company_id`, `sku_id`,`functions_type`)
      VALUES ('$team_id','$session_id','$company','$sku','6')"); 
     //insert_query

     $select_hd=mysqli_query($con,"select * from historical_header where team_id = '".$team_id."' AND session_id = '".$session_id."' ORDER BY hs_id DESC");
     $fetch_hs = mysqli_fetch_array($select_hd);
     $header_id= $fetch_hs[0];

        $select_data=mysqli_query($con,"select * from forecast_data where team_id = '".$team_id."' AND comp_id = '".$company."' ");
        $count = 0;
        while($row=mysqli_fetch_array($select_data)){
        $month= $row['month'];

         $act_data= $row['data'];

        $insert_data=mysqli_query($con,"INSERT INTO `historical_details`(`header_id`, `serial_num`, `month`,`actual_data`) 
        VALUES ('$header_id','$count','$month','$act_data')"); 
         //insert_query
        $count++;
        }

        $select_mn=mysqli_query($con,"select * from forecast_data where team_id = '".$team_id."' AND comp_id = '".$company."'  ORDER by id DESC ");
        $fetch_mn = mysqli_fetch_array($select_mn);
        $var = $fetch_mn['month'];
        $dateObj = DateTime::createFromFormat('M-Y', $var);
        $dateObj->modify('+1 year');
        $dateObj->modify('first day of January');
        $month2 = $dateObj->format('M-Y');
        $insert_data=mysqli_query($con,"INSERT INTO `historical_details`(`header_id`, `serial_num`, `month`,`actual_data`) 
        VALUES ('$header_id','24','$month2','')"); 
        //insert_query

        $fc_data = array();
        $fcerror_data = array();
        $running_sum = array();
        $abs_dev = array();
        $cae_data = array();
        $tracking_sig = array();
        $mape_data = array();

        $count1 = 0;

        $select_fr=mysqli_query($con,"select * from historical_details where header_id = '".$header_id."'  ");
        while ($fetch_fr = mysqli_fetch_array($select_fr)) {    
            //forecast
            if ($count1 == 0) {
                $fc_data[] = 0; // For count 0, set forecast data to 0
                $fcerror_data[] = 0; // For count 0, set forecast data to 0
                $running_sum[] = 0;
                $abs_dev[] = 0;
                $cae_data[] = 0;
                $tracking_sig[] = 0;
                $mape_data[] = 0;

            } elseif ($count1 == 1) {
                $select_fr3=mysqli_query($con,"select * from forecast_data where team_id = '".$team_id."' AND comp_id = '".$company."' ORDER BY id ASC ");
                $fetch_fr3 = mysqli_fetch_array($select_fr3);
                $fc_data[] = $fetch_fr3['data']; // For count 1, set forecast data to the first value of actual_data

                $fcerror_data[] = 0; // For count 0, set forecast data to 0
                $running_sum[] = 0;
                $abs_dev[] = 0;
                $cae_data[] = 0;
                $tracking_sig[] = 0;
                $mape_data[] = 0;


            } else {
                    //forcast 
                    $dd = $count1-1;

                    if($dd == 1){
                        $D_data = $fetch_fr3['data']; // D18 data
                    }else{
                        $D_data = $formula; // D18 data
                    }
                    $cc = $count1;
                    $select_fr4=mysqli_query($con,"select * from forecast_data where team_id = '".$team_id."' AND comp_id = '".$company."' AND ser_num = '".$cc."' ");
                    $fetch_fr4 = mysqli_fetch_array($select_fr4);
                    $select_alpa = mysqli_query($con,"select * from team_input where team_id = '".$team_id."' AND session_id = '".$session_id."' ");
                    $fts=mysqli_fetch_array($select_alpa);
                    $alpha =  $fts['input_alpha'];

                    $C_data =  $fetch_fr4['data'];
                    $formula = $D_data + $alpha * ($C_data - $D_data);  
                    $fc_data[] = round($formula);
                    //forcast 



                    //forcast error
                    $cc2 = $count1+1;
                    $select_fr_err=mysqli_query($con,"select * from forecast_data where team_id = '".$team_id."' AND comp_id = '".$company."' AND ser_num = '".$cc2."' ");
                    $fetch_fr_err = mysqli_fetch_array($select_fr_err);

                    $forcast_d = $fc_data[$cc];

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
                    
                    $E_data = $fcerror_data[$cc];

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

                    $M_data=$fcerror_data[$cc];

                    $abs_dev[]= abs($M_data);
                    //Mad

                    //CAE
                    $select_cae=mysqli_query($con,"select * from historical_details where header_id = '".$header_id."' AND serial_num = $cc2 ");
                    $fetch_cae = mysqli_fetch_array($select_cae);

                    $G_data=$abs_dev[$cc];

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

                    $data_I=$cae_data[$cc];
                    $data_F=$running_sum[$cc];
                    $data_A=$cc;

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

                    $data_G = $abs_dev[$cc];
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


                    }

            $count1++;
        }
        // echo $fc_data[2];
        // print_r($mape_data);

        
        $num1=0;
        foreach ($fc_data as $forecast) {
                // echo $ser." ".$forecast."<br>";

                $update_fc = mysqli_query($con,"UPDATE `historical_details` SET `forecast_data`='".$forecast."' WHERE serial_num = '".$num1."' AND header_id = '".$header_id."' ");
        //insert_query
        $num1++;
        }

        $num2=0;
        foreach ($fcerror_data as $forecast_err) {
                // echo $ser." ".$forecast."<br>";
                $update_fc = mysqli_query($con,"UPDATE `historical_details` SET `forecast_error`='".$forecast_err."' WHERE serial_num = '".$num2."'  AND header_id = '".$header_id."'  ");
        //      //insert_query
        $num2++;
        }

        $num3=0;
        foreach ($running_sum as $run_sum) {
                // echo $ser." ".$forecast."<br>";
            $update_fc = mysqli_query($con,"UPDATE `historical_details` SET `running_sum`='".$run_sum."' WHERE serial_num = '".$num3."'  AND header_id = '".$header_id."'  ");
        //      //insert_query
        $num3++;
        }

        $num4=0;
        foreach ($abs_dev as $run_sum) {
                // echo $ser." ".$forecast."<br>";
            $update_fc = mysqli_query($con,"UPDATE `historical_details` SET `ad_data`='".$run_sum."' WHERE serial_num = '".$num4."'  AND header_id = '".$header_id."'  ");
        //      //insert_query
        $num4++;
        }

        $num5=0;
        foreach ($cae_data as $cae_sum) {
                // echo $ser." ".$forecast."<br>";
            $update_fc = mysqli_query($con,"UPDATE `historical_details` SET `cae_data`='".$cae_sum."' WHERE serial_num = '".$num5."'  AND header_id = '".$header_id."'  ");
        //      //insert_query
        $num5++;
        }

        $num6=0;
        foreach ($tracking_sig as $trc_sum) {
                // echo $ser." ".$forecast."<br>";
            $update_fc = mysqli_query($con,"UPDATE `historical_details` SET `tracking_signal`='".$trc_sum."' WHERE serial_num = '".$num6."'  AND header_id = '".$header_id."'  ");
        //      //insert_query
        $num6++;
        }

        $num7=0;
        foreach ($mape_data as $map_sum) {
                // echo $ser." ".$forecast."<br>";
            $update_fc = mysqli_query($con,"UPDATE `historical_details` SET `map_data`='".$map_sum."' WHERE serial_num = '".$num7."'  AND header_id = '".$header_id."'  ");
        //      //insert_query
        $num7++;
        }

        echo "<script>window.location.href = '../data.php?exponential_smoothing&type=6';</script>";
}













// naive_approach

if(isset($_POST['naive_approach'])){
    // 1 for naive_approach 

     $insert_header = mysqli_query($con,"INSERT INTO `historical_header`( `team_id`, `session_id`, `company_id`, `sku_id`,`functions_type`)
      VALUES ('$team_id','$session_id','$company','$sku','1')"); 
     //insert_query

     $select_hd=mysqli_query($con,"select * from historical_header where team_id = '".$team_id."' AND session_id = '".$session_id."' ORDER BY hs_id DESC");
     $fetch_hs = mysqli_fetch_array($select_hd);
     $header_id= $fetch_hs[0];

        $select_data=mysqli_query($con,"select * from forecast_data where team_id = '".$team_id."' AND comp_id = '".$company."' ");
        $count = 0;
        while($row=mysqli_fetch_array($select_data)){
        $month= $row['month'];

         $act_data= $row['data'];

        $insert_data=mysqli_query($con,"INSERT INTO `historical_details`(`header_id`, `serial_num`, `month`,`actual_data`) 
        VALUES ('$header_id','$count','$month','$act_data')"); 
         //insert_query
        $count++;
        }

        $select_mn=mysqli_query($con,"select * from forecast_data where team_id = '".$team_id."' AND comp_id = '".$company."'  ORDER by id DESC ");
        $fetch_mn = mysqli_fetch_array($select_mn);
        $var = $fetch_mn['month'];
        $dateObj = DateTime::createFromFormat('M-Y', $var);
        $dateObj->modify('+1 year');
        $dateObj->modify('first day of January');
        $month2 = $dateObj->format('M-Y');
        $insert_data=mysqli_query($con,"INSERT INTO `historical_details`(`header_id`, `serial_num`, `month`,`actual_data`) 
        VALUES ('$header_id','24','$month2','')"); 
        //insert_query

        $fc_data = array();
        $fcerror_data = array();
        $running_sum = array();
        $abs_dev = array();
        $cae_data = array();
        $tracking_sig = array();
        $mape_data = array();

        $count1 = 0;

        $select_fr=mysqli_query($con,"select * from historical_details where header_id = '".$header_id."'  ");
        while ($fetch_fr = mysqli_fetch_array($select_fr)) {    
            //forecast
            if ($count1 == 0) {
                $fc_data[] = 0; // For count 0, set forecast data to 0
                $fcerror_data[] = 0; // For count 0, set forecast data to 0
                $running_sum[] = 0;
                $abs_dev[] = 0;
                $cae_data[] = 0;
                $tracking_sig[] = 0;
                $mape_data[] = 0;

            } elseif ($count1 == 1) {
                $select_fr3=mysqli_query($con,"select * from forecast_data where team_id = '".$team_id."' AND comp_id = '".$company."' ORDER BY id ASC ");
                $fetch_fr3 = mysqli_fetch_array($select_fr3);
                $fc_data[] = $fetch_fr3['data']; // For count 1, set forecast data to the first value of actual_data

                $fcerror_data[] = 0; // For count 0, set forecast data to 0
                $running_sum[] = 0;
                $abs_dev[] = 0;
                $cae_data[] = 0;
                $tracking_sig[] = 0;
                $mape_data[] = 0;


            } else {
                    //forcast 
                        $dd = $count1-1;
                    $cc = $count1;
                    $select_fr4=mysqli_query($con,"select * from forecast_data where team_id = '".$team_id."' AND comp_id = '".$company."' AND ser_num = '".$cc."' ");
                    $fetch_fr4 = mysqli_fetch_array($select_fr4);
                    $select_alpa = mysqli_query($con,"select * from team_input where team_id = '".$team_id."' AND session_id = '".$session_id."' ");
                    $fts=mysqli_fetch_array($select_alpa);

                    $C_data =  $fetch_fr4['data'];
                        $fc_data[] = $C_data;
                    //forcast    

                        //forcast error
                    $cc2 = $count1+1;
                    $select_fr_err=mysqli_query($con,"select * from forecast_data where team_id = '".$team_id."' AND comp_id = '".$company."' AND ser_num = '".$cc2."' ");
                    $fetch_fr_err = mysqli_fetch_array($select_fr_err);
                    $forcast_d = $fc_data[$cc];

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
                    
                    $E_data = $fcerror_data[$cc];

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

                    $M_data=$fcerror_data[$cc];

                    $abs_dev[]= abs($M_data);
                    //Mad

                    //CAE
                    $select_cae=mysqli_query($con,"select * from historical_details where header_id = '".$header_id."' AND serial_num = $cc2 ");
                    $fetch_cae = mysqli_fetch_array($select_cae);

                    $G_data=$abs_dev[$cc];

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

                    $data_I=$cae_data[$cc];
                    $data_F=$running_sum[$cc];
                    $data_A=$cc;

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

                    $data_G = $abs_dev[$cc];
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

                    }

            $count1++;
        }

        // print_r($running_sum);


        
        $num1=0;
        foreach ($fc_data as $forecast) {
                // echo $ser." ".$forecast."<br>";

                $update_fc = mysqli_query($con,"UPDATE `historical_details` SET `forecast_data`='".$forecast."' WHERE serial_num = '".$num1."' AND header_id = '".$header_id."' ");
        //insert_query
        $num1++;
        }

        $num2=0;
        foreach ($fcerror_data as $forecast_err) {
                // echo $ser." ".$forecast."<br>";
                $update_fc = mysqli_query($con,"UPDATE `historical_details` SET `forecast_error`='".$forecast_err."' WHERE serial_num = '".$num2."'  AND header_id = '".$header_id."'  ");
        //      //insert_query
        $num2++;
        }

        $num3=0;
        foreach ($running_sum as $run_sum) {
                // echo $ser." ".$forecast."<br>";
            $update_fc = mysqli_query($con,"UPDATE `historical_details` SET `running_sum`='".$run_sum."' WHERE serial_num = '".$num3."'  AND header_id = '".$header_id."'  ");
        //      //insert_query
        $num3++;
        }

        $num4=0;
        foreach ($abs_dev as $run_sum) {
                // echo $ser." ".$forecast."<br>";
            $update_fc = mysqli_query($con,"UPDATE `historical_details` SET `ad_data`='".$run_sum."' WHERE serial_num = '".$num4."'  AND header_id = '".$header_id."'  ");
        //      //insert_query
        $num4++;
        }

        $num5=0;
        foreach ($cae_data as $cae_sum) {
                // echo $ser." ".$forecast."<br>";
            $update_fc = mysqli_query($con,"UPDATE `historical_details` SET `cae_data`='".$cae_sum."' WHERE serial_num = '".$num5."'  AND header_id = '".$header_id."'  ");
        //      //insert_query
        $num5++;
        }

        $num6=0;
        foreach ($tracking_sig as $trc_sum) {
                // echo $ser." ".$forecast."<br>";
            $update_fc = mysqli_query($con,"UPDATE `historical_details` SET `tracking_signal`='".$trc_sum."' WHERE serial_num = '".$num6."'  AND header_id = '".$header_id."'  ");
        //      //insert_query
        $num6++;
        }

        $num7=0;
        foreach ($mape_data as $map_sum) {
                // echo $ser." ".$forecast."<br>";
            $update_fc = mysqli_query($con,"UPDATE `historical_details` SET `map_data`='".$map_sum."' WHERE serial_num = '".$num7."'  AND header_id = '".$header_id."'  ");
        //      //insert_query
        $num7++;
        }

        echo "<script>window.location.href = '../data.php?naive_approach&type=1';</script>";

    }























// moving_average

if(isset($_POST['moving_average'])){
    // 2 for moving_average 

     $insert_header = mysqli_query($con,"INSERT INTO `historical_header`( `team_id`, `session_id`, `company_id`, `sku_id`,`functions_type`)
      VALUES ('$team_id','$session_id','$company','$sku','2')"); 
     //insert_query

     $select_hd=mysqli_query($con,"select * from historical_header where team_id = '".$team_id."' AND session_id = '".$session_id."' ORDER BY hs_id DESC");
     $fetch_hs = mysqli_fetch_array($select_hd);
     $header_id= $fetch_hs[0];

        $select_data=mysqli_query($con,"select * from forecast_data where team_id = '".$team_id."' AND comp_id = '".$company."' ");
        $count = 0;
        while($row=mysqli_fetch_array($select_data)){
        $month= $row['month'];

         $act_data= $row['data'];

        $insert_data=mysqli_query($con,"INSERT INTO `historical_details`(`header_id`, `serial_num`, `month`,`actual_data`) 
        VALUES ('$header_id','$count','$month','$act_data')"); 
         //insert_query
        $count++;
        }

        $select_mn=mysqli_query($con,"select * from forecast_data where team_id = '".$team_id."' AND comp_id = '".$company."'  ORDER by id DESC ");
        $fetch_mn = mysqli_fetch_array($select_mn);
        $var = $fetch_mn['month'];
        $dateObj = DateTime::createFromFormat('M-Y', $var);
        $dateObj->modify('+1 year');
        $dateObj->modify('first day of January');
        $month2 = $dateObj->format('M-Y');
        $insert_data=mysqli_query($con,"INSERT INTO `historical_details`(`header_id`, `serial_num`, `month`,`actual_data`) 
        VALUES ('$header_id','24','$month2','')"); 
        //insert_query

        $fc_data = array();
        $fcerror_data = array();
        $running_sum = array();
        $abs_dev = array();
        $cae_data = array();
        $tracking_sig = array();
        $mape_data = array();

        $count1 = 0;

        $select_fr=mysqli_query($con,"select * from historical_details where header_id = '".$header_id."'  ");
        while ($fetch_fr = mysqli_fetch_array($select_fr)) {    
            //forecast
            if ($count1 == 0) {
                $fc_data[] = 0; // For count 0, set forecast data to 0
                $fcerror_data[] = 0; // For count 0, set forecast data to 0
                $running_sum[] = 0;
                $abs_dev[] = 0;
                $cae_data[] = 0;
                $tracking_sig[] = 0;
                $mape_data[] = 0;

            } elseif ($count1 == 1) {
                $select_fr3=mysqli_query($con,"select * from forecast_data where team_id = '".$team_id."' AND comp_id = '".$company."' ORDER BY id ASC ");
                $fetch_fr3 = mysqli_fetch_array($select_fr3);
                $fc_data[] = 0; 

                $fcerror_data[] = 0; // For count 0, set forecast data to 0
                $running_sum[] = 0;
                $abs_dev[] = 0;
                $cae_data[] = 0;
                $tracking_sig[] = 0;
                $mape_data[] = 0;


            } else {

                    //forcast 
                        $dd = $count1-1;
                    $cc = $count1;
                    $gg = $dd+1;
                    $select_fr4=mysqli_query($con,"select * from forecast_data where team_id = '".$team_id."' AND comp_id = '".$company."'
                     AND ser_num = '".$cc."' ");
                    $fetch_fr4 = mysqli_fetch_array($select_fr4);

                    if($dd == 1){
                    //$C_data = $fetch_fr3['data'];
                     $C_data =  round(($fetch_fr3['data'] + $fetch_fr4['data'])/2);

                    }else{

                    $select_fr8=mysqli_query($con,"select * from forecast_data where team_id = '".$team_id."' AND comp_id = '".$company."'
                     AND ser_num = '".$dd."' ");
                    $fetch_fr8 = mysqli_fetch_array($select_fr8);
                    $vv = $dd-1;
                    $kk = $dd+1;
                    $select_fr9=mysqli_query($con,"select * from forecast_data where team_id = '".$team_id."' AND comp_id = '".$company."'
                     AND ser_num = '".$vv."' ");
                    $fetch_fr9 = mysqli_fetch_array($select_fr9);

                    $select_fr10=mysqli_query($con,"select * from forecast_data where team_id = '".$team_id."' AND comp_id = '".$company."'
                     AND ser_num = '".$kk."' ");
                    $fetch_fr10 = mysqli_fetch_array($select_fr10);

                    $C_data =  ($fetch_fr9['data'] + $fetch_fr8['data'] +  $fetch_fr10['data'])/3 ;
                     // $C_data =  $fetch_fr10['data'];

                    }
                        $fc_data[] = round($C_data); 
                    //forcast
                        

                        //forcast error
                    $cc2 = $count1+1;
                    $select_fr_err=mysqli_query($con,"select * from forecast_data where team_id = '".$team_id."' AND comp_id = '".$company."' AND ser_num = '".$cc2."' ");
                    $fetch_fr_err = mysqli_fetch_array($select_fr_err);
                    $forcast_d = $fc_data[$cc];

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
                    
                    $E_data = $fcerror_data[$cc];

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

                    $M_data=$fcerror_data[$cc];

                    $abs_dev[]= abs($M_data);
                    //Mad

                    //CAE
                    $select_cae=mysqli_query($con,"select * from historical_details where header_id = '".$header_id."' AND serial_num = $cc2 ");
                    $fetch_cae = mysqli_fetch_array($select_cae);

                    $G_data=$abs_dev[$cc];

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

                    $data_I=$cae_data[$cc];
                    $data_F=$running_sum[$cc];
                    $data_A=$cc;

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

                    $data_G = $abs_dev[$cc];
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

                    }

            $count1++;
        }

        // print_r($fc_data);


        $num1=0;
        foreach ($fc_data as $forecast) {
                // echo $ser." ".$forecast."<br>";

                $update_fc = mysqli_query($con,"UPDATE `historical_details` SET `forecast_data`='".$forecast."' WHERE serial_num = '".$num1."' AND header_id = '".$header_id."' ");
        //insert_query
        $num1++;
        }

        $num2=0;
        foreach ($fcerror_data as $forecast_err) {
                // echo $ser." ".$forecast."<br>";
                $update_fc = mysqli_query($con,"UPDATE `historical_details` SET `forecast_error`='".$forecast_err."' WHERE serial_num = '".$num2."'  AND header_id = '".$header_id."'  ");
        //      //insert_query
        $num2++;
        }

        $num3=0;
        foreach ($running_sum as $run_sum) {
                // echo $ser." ".$forecast."<br>";
            $update_fc = mysqli_query($con,"UPDATE `historical_details` SET `running_sum`='".$run_sum."' WHERE serial_num = '".$num3."'  AND header_id = '".$header_id."'  ");
        //      //insert_query
        $num3++;
        }

        $num4=0;
        foreach ($abs_dev as $run_sum) {
                // echo $ser." ".$forecast."<br>";
            $update_fc = mysqli_query($con,"UPDATE `historical_details` SET `ad_data`='".$run_sum."' WHERE serial_num = '".$num4."'  AND header_id = '".$header_id."'  ");
        //      //insert_query
        $num4++;
        }

        $num5=0;
        foreach ($cae_data as $cae_sum) {
                // echo $ser." ".$forecast."<br>";
            $update_fc = mysqli_query($con,"UPDATE `historical_details` SET `cae_data`='".$cae_sum."' WHERE serial_num = '".$num5."'  AND header_id = '".$header_id."'  ");
        //      //insert_query
        $num5++;
        }

        $num6=0;
        foreach ($tracking_sig as $trc_sum) {
                // echo $ser." ".$forecast."<br>";
            $update_fc = mysqli_query($con,"UPDATE `historical_details` SET `tracking_signal`='".$trc_sum."' WHERE serial_num = '".$num6."'  AND header_id = '".$header_id."'  ");
        //      //insert_query
        $num6++;
        }

        $num7=0;
        foreach ($mape_data as $map_sum) {
                // echo $ser." ".$forecast."<br>";
            $update_fc = mysqli_query($con,"UPDATE `historical_details` SET `map_data`='".$map_sum."' WHERE serial_num = '".$num7."'  AND header_id = '".$header_id."'  ");
        //      //insert_query
        $num7++;
        }

        echo "<script>window.location.href = '../data.php?moving_average&type=2';</script>";



    }













    //Holt Method
    if(isset($_POST['holt_method'])){
        // 4 for holt_method 
                    
     $insert_header = mysqli_query($con,"INSERT INTO `historical_header`( `team_id`, `session_id`, `company_id`, `sku_id`,`functions_type`)
      VALUES ('$team_id','$session_id','$company','$sku','4')"); 
     //insert_query

     $select_hd=mysqli_query($con,"select * from historical_header where team_id = '".$team_id."' AND session_id = '".$session_id."' ORDER BY hs_id DESC");
     $fetch_hs = mysqli_fetch_array($select_hd);
     $header_id= $fetch_hs[0];

        $select_data=mysqli_query($con,"select * from forecast_data where team_id = '".$team_id."' AND comp_id = '".$company."' ");
        $count = 0;
        while($row=mysqli_fetch_array($select_data)){
        $month= $row['month'];

         $act_data= $row['data'];

        $insert_data=mysqli_query($con,"INSERT INTO `historical_details`(`header_id`, `serial_num`, `month`,`actual_data`) 
        VALUES ('$header_id','$count','$month','$act_data')"); 
         //insert_query
        $count++;
        }

      $select_mn = mysqli_query($con, "SELECT * FROM forecast_data WHERE team_id = '".$team_id."' AND comp_id = '".$company."' ORDER BY id DESC");
$fetch_mn = mysqli_fetch_array($select_mn);

if ($fetch_mn) {
    $var = $fetch_mn['month'];

    $dateObj = DateTime::createFromFormat('M-Y', $var);
    $dateObj->modify('+1 month'); // Move to the next year

    $monthsToInsert = 4;
    $cnt = 24;
    for ($i = 1; $i <= $monthsToInsert; $i++) {
        // Format the current month and year
        $currentMonth = $dateObj->format('M-Y');

        $insert_data = mysqli_query($con, "INSERT INTO `historical_details`(`header_id`, `serial_num`, `month`,`actual_data`) 
         VALUES ('$header_id','$cnt','$currentMonth','')");


        $dateObj->modify('+1 month');
        $cnt++;
    }
} else {
    echo "No data found in the forecast_data table.";
}


 
        //insert_query

        $fc_data = array();
        $level = array();
        $fcerror_data = array();
        $running_sum = array();
        $abs_dev = array();
        $cae_data = array();
        $tracking_sig = array();
        $mape_data = array();

        $count1 = 0;

        $select_fr=mysqli_query($con,"select * from historical_details where header_id = '".$header_id."'  ");
        while ($fetch_fr = mysqli_fetch_array($select_fr)) {    
            //forecast
            if ($count1 == 0) {
                $level[] = 0; // For count 0, set forecast data to 0
                $smtnd[] = 0; // For count 0, set forecast data to 0
                $fc_data[] = 0; // For count 0, set forecast data to 0
                $fcerror_data[] = 0; // For count 0, set forecast data to 0
                $running_sum[] = 0;
                $abs_dev[] = 0;
                $cae_data[] = 0;
                $tracking_sig[] = 0;
                $mape_data[] = 0;

            } elseif ($count1 == 1) {
                    $bb =$count1+1;
                    $jk =$bb-1;
                $select_fr3=mysqli_query($con,"select * from forecast_data where team_id = '".$team_id."' AND comp_id = '".$company."' AND ser_num = '".$bb."' ");
                $fetch_fr3 = mysqli_fetch_array($select_fr3);
                    $level[] = $fetch_fr3['data']; // For count 1, set forecast data to the first value of actual_data


                $select_frf=mysqli_query($con,"select * from forecast_data where team_id = '".$team_id."' AND comp_id = '".$company."' AND ser_num = '".$jk."' ");
                $fetch_frf = mysqli_fetch_array($select_frf);
                    $smtnd[] = $fetch_frf['data']-$fetch_fr3['data']; 
                $fc_data[] = 0; // For count 0, set forecast data to 0

                $fcerror_data[] = 0; // For count 0, set forecast data to 0
                $running_sum[] = 0;
                $abs_dev[] = 0;
                $cae_data[] = 0;
                $tracking_sig[] = 0;
                $mape_data[] = 0;


            } else {

                    //level 
                    $dd = $count1+1;
                    $ll = $dd-2;
                $select_alpa = mysqli_query($con,"select * from team_input where team_id = '".$team_id."' AND session_id = '".$session_id."' ");
                $fts=mysqli_fetch_array($select_alpa);
                 $alpha =  $fts['input_alpha'];
                $beta =  $fts['input_beta'];

                $select_fr4=mysqli_query($con,"select * from forecast_data where team_id = '".$team_id."' AND comp_id = '".$company."' AND ser_num = '".$dd."' ");
                $fetch_fr4 = mysqli_fetch_array($select_fr4);
                $C_data =  $fetch_fr4['data'];

                $select_fr5=mysqli_query($con,"select * from forecast_data where team_id = '".$team_id."' AND comp_id = '".$company."' AND ser_num = '".$ll."' ");
                $fetch_fr5= mysqli_fetch_array($select_fr5);
                



                if($dd == 3){
                    $E_data = $level[1]; // D18 data
                    $F_data =  $fetch_fr5['data'] - $E_data ;

                }else{
                    $E_data = $forumula; // D18 data
                    $F_data = $forumula2;
                }


                $forumula = $alpha * $C_data + (1 - $alpha) * ($E_data + $F_data); //for E formula
                if($dd == 25){
                        $level[] = 0;
                        }else{
                            $level[] = round($forumula) ;
                        }
                    //level 
                        
                    //Smoothed trend

                $bg = $ll+1;
                $forumula2 = $beta * ($level[$bg]-$level[$ll]) + (1-$beta) * 12327;

                    if($dd == 25){
                        $smtnd[] = 0;
                    }else{
                        $smtnd[] = round($forumula2) ;
                    }
                    //Smoothed trend





                    
                    //forecast
                    $fc_data[]=$level[$ll] + $smtnd[$ll];
                    //forecast


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



                    }


            $count1++;
        }

        // print_r($mape_data);
        // echo "<br>Smoth<br>";
        // print_r($smtnd);



        $num1=0;
        foreach ($fc_data as $forecast) {
             // echo $ser." ".$forecast."<br>";

             $update_fc = mysqli_query($con,"UPDATE `historical_details` SET `forecast_data`='".$forecast."' WHERE serial_num = '".$num1."' AND header_id = '".$header_id."' ");
        //insert_query
        $num1++;
        }
             $num2=0;
        foreach ($fcerror_data as $forecast_err) {
             // echo $ser." ".$forecast."<br>";
             $update_fc = mysqli_query($con,"UPDATE `historical_details` SET `forecast_error`='".$forecast_err."' WHERE serial_num = '".$num2."'  AND header_id = '".$header_id."'  ");
        //       //insert_query
        $num2++;
        }

        $num3=0;
        foreach ($running_sum as $run_sum) {
             // echo $ser." ".$forecast."<br>";
         $update_fc = mysqli_query($con,"UPDATE `historical_details` SET `running_sum`='".$run_sum."' WHERE serial_num = '".$num3."'  AND header_id = '".$header_id."'  ");
        //       //insert_query
        $num3++;
        }

        $num4=0;
        foreach ($abs_dev as $run_sum) {
             // echo $ser." ".$forecast."<br>";
         $update_fc = mysqli_query($con,"UPDATE `historical_details` SET `ad_data`='".$run_sum."' WHERE serial_num = '".$num4."'  AND header_id = '".$header_id."'  ");
        //       //insert_query
        $num4++;
        }

        $num5=0;
        foreach ($cae_data as $cae_sum) {
             // echo $ser." ".$forecast."<br>";
         $update_fc = mysqli_query($con,"UPDATE `historical_details` SET `cae_data`='".$cae_sum."' WHERE serial_num = '".$num5."'  AND header_id = '".$header_id."'  ");
        //       //insert_query
        $num5++;
        }

        $num6=0;
        foreach ($tracking_sig as $trc_sum) {
             // echo $ser." ".$forecast."<br>";
         $update_fc = mysqli_query($con,"UPDATE `historical_details` SET `tracking_signal`='".$trc_sum."' WHERE serial_num = '".$num6."'  AND header_id = '".$header_id."'  ");
        //       //insert_query
        $num6++;
        }

        $num7=0;
        foreach ($mape_data as $map_sum) {
             // echo $ser." ".$forecast."<br>";
         $update_fc = mysqli_query($con,"UPDATE `historical_details` SET `map_data`='".$map_sum."' WHERE serial_num = '".$num7."'  AND header_id = '".$header_id."'  ");
        //       //insert_query
        $num7++;
        }



        $num8=0;
        foreach ($level as $levelh) {
             // echo $ser." ".$forecast."<br>";

             $update_fc = mysqli_query($con,"UPDATE `historical_details` SET `holt_level`='".$levelh."' WHERE serial_num = '".$num8."' AND header_id = '".$header_id."' ");
        //insert_query
        $num8++;
        }
        $num9=0;
        foreach ($smtnd as $smtndh) {
             // echo $ser." ".$forecast."<br>";

             $update_fc = mysqli_query($con,"UPDATE `historical_details` SET `holt_smtnt`='".$smtndh."' WHERE serial_num = '".$num9."' AND header_id = '".$header_id."' ");
        //insert_query
        $num9++;
        }

        echo "<script>window.location.href = '../data.php?holt_method&type=4';</script>";

        
    }//holt method end



?>

