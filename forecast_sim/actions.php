<?php 

// ========================Crash btn========================
include 'db.php';
session_start();
    $session_query="SELECT id FROM `session` where status='Active';";
$session_rec=mysqli_query($con,$session_query);
while($row=mysqli_fetch_array($session_rec)){
    $session_id=$row[0];

}

if(isset($_POST['show_featured_btn'])){
    $post_status = $_POST['show_featured_btn'];
    $post_id = $_POST['post_featured'];

    if($post_status == '0'){
        $pos_q = "UPDATE `months` SET `m_crash` = '1' WHERE `m_id` = '$post_id'";
    }else if($post_status == '1') {
        $pos_q = "UPDATE `months` SET `m_crash` = '0' WHERE `m_id` = '$post_id'";
    }
    $pos_res = mysqli_query($con, $pos_q);
    if(!empty($pos_res)){
        echo 'true'; exit;
    }
    else{
        echo 'false'; exit;
    }
}


if(isset($_POST['show_featured_btn1'])){
    $post_status1 = $_POST['show_featured_btn1'];
    $post_id1 = $_POST['post_featured1'];

    $pos_q1 = "UPDATE `months` SET `m_status` = '1',`mc_status`='1' WHERE `m_id` = '$post_id1'";

    $up1=mysqli_query($con,"UPDATE `months` SET `m_status` = '2' where `m_status`='1' ");
    $pos_res1 = mysqli_query($con, $pos_q1);

    $select_month=mysqli_query($con,"select * from months where session_id ='".$session_id."' AND m_status = '1' ");
    $fmonth=mysqli_fetch_array($select_month);

    $mm = $fmonth['m_id'] -1; 
    $user = array();


        // echo $fmonth1['m_id']+1;

    // exit();

    $month = array();

    $select_month1=mysqli_query($con,"select * from months where session_id ='".$session_id."' AND m_crash != 1");
        while($fmonth1=mysqli_fetch_array($select_month1)){

            $month[] = $fmonth1['m_id'];

        }
        echo $fmonth['m_id'];
        echo $month[0]."arr";
        var_dump($month);
        // exit();
    if($fmonth['m_name'] == 'Month-1' ||  $fmonth['m_id'] == $month[0]  ||  $fmonth['m_id'] == $month[12] ||$fmonth['m_crash'] == 1 ){

    // $select_month1=mysqli_query($con,"select * from months where session_id ='".$session_id."' AND m_crash = '1' OR m_status = '2' AND m_crash = '1' OR m_status = '1'  ");
    
    //     $fmonth1=mysqli_fetch_array($select_month1);    
    //     echo "DELETE FROM `gameboard_data` WHERE  month_id ='".$mm."' "; 
    //     $delete =mysqli_query($con,"DELETE FROM `gameboard_data` WHERE  month_id ='".$month[0]."' ");
        
    }
    else{

    $select_user=mysqli_query($con,"select * from login where login_session ='".$session_id."'  ");
    while($fuser=mysqli_fetch_array($select_user)){
     


        $select_board=mysqli_query($con,"select count(*) from gameboard_data
         where team_id ='".$fuser['id']."' AND session_id = '".$session_id."' AND month_id = '".$mm."' ");

        $fboard=mysqli_fetch_array($select_board);

         if($fboard[0] > 0){

         }else{

            // echo $fuser[0];
            $user[]=$fuser[0];

         }
    }

    if(!empty($user)){
        $variable = 25978;

        foreach($user as $key){

         $smo=mysqli_query($con,"select * from months where m_id ='".$mm."' and session_id = '".$session_id."' ");
         $m_id=mysqli_fetch_array($smo);

         //var1 
         if($m_id['m_name']=="Month-1"){
             $var1 = $variable;
         }elseif($m_id['m_status']==1 || $m_id['m_status']==2  ){
          $m1=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
           AND team_id = '".$_SESSION['id']."'  order by g_id DESC ");
          $fetch_m1=mysqli_fetch_array($m1);

            $varc1 = $fetch_m1['ending_inv'] - $fetch_m1['shrunkage'];
           if($varc1 < 0){
            $var1= 0;
           }else{
            $var1 = $fetch_m1['ending_inv'] - $fetch_m1['shrunkage'];

           }
            }else{
               $var1 = 0;
            }

            //var 2
          if($m_id['m_name'] == "Month-1"){
                $var2 = 0;
            }elseif($m_id['m_status']==1 || $m_id['m_status']==2){

              $m2=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
               AND team_id = '".$_SESSION['id']."' order by g_id DESC ");
              $fetch_m2=mysqli_fetch_array($m2);

               $var2 = $fetch_m2['no_order_units'];
            }else{
               $var2 = 0;
            }
            //var 3
             if($m_id['m_name'] == "Month-1"){
                  $var3 = $variable;
              }elseif($m_id['m_status']==1 || $m_id['m_status']==2){  

                $m3=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
                 AND team_id = '".$_SESSION['id']."'  order by g_id DESC ");
                $fetch_m3=mysqli_fetch_array($m3);

                 $d=$fetch_m3['ending_inv'] - $fetch_m3['shrunkage'];
                  if($d<0){
                    $s=0;
                  }else{
                    $s=$fetch_m3['ending_inv'] - $fetch_m3['shrunkage'];

                  }

                 $var3 = $fetch_m3['no_order_units'] + $s;
              }else{
                 $var3 = 0;
              }

              //var 4
                $ordered_unit = 0 *24 ;
                //var 5
                $var4 = "5000";

                //var 6
               if($m_id['m_status'] == 1 || $m_id['m_status'] == 2 ){
                   $var5 = $m_id['forecasted_dmd'];
                }else{
                   $var5 = 0;
                }
                //var 7
               if($m_id['m_status'] == 1 || $m_id['m_status'] == 2 ){
                   $var6 = $m_id['actual_demand'];
                }else{
                   $var6 = 0;
                }
                 //var 8

             if($m_id['m_name']=="Month-1"){
                 $var8c = $var3 - $var6;
                  if($var8c < 0){
                   $var8 = 0;
                    }else{
                    $var8 = $var8c;
                    }
                 }
                 elseif($m_id['m_status']==1 || $m_id['m_status'] == 2 ){  

                  $m3=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
                   AND team_id = '".$_SESSION['id']."' AND month_id = '".$m_id['m_id']."'");
                  $fetch_m8=mysqli_fetch_array($m3);

                   $var8c = $var3 - $var6;

                  if($var8c < 0){
                   $var8 = 0;
                }else{
                   $var8 = $var8c;
                }
              }
              else{
                 $var8 = 0;
              }
               //var 9

             if($m_id['m_name']=="Month-1"){
               echo $var9 = ($var3+$var8)/2;
             }
             elseif($m_id['m_status']==1 || $m_id['m_status'] == 2 ){  
            $m9=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
             AND team_id = '".$_SESSION['id']."' AND month_id = '".$m_id['m_id']."' order by g_id DESC ");
            $fetch_m9=mysqli_fetch_array($m9);

            echo $var9 = ($var3+$var8)/2;

          }else{
             $var9 = 0;
          } 

          //var 10A
             if($m_id['m_status'] == 1 || $m_id['m_status'] == 2 ){
                 $var10 = $m_id['shrunkage'];
              }else{
                 $var10 = 0;
              }
          //var 10B

               if($m_id['m_status'] == 1 || $m_id['m_status'] == 2 ){
                   $var11 = 75 * $m_id['shrunkage'];
                }else{
                   $var11 = 0;
                }
          //var 10C
             if($m_id['m_name']=="Month-1"){

                $m12=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
               AND team_id = '".$_SESSION['id']."' AND month_id = '".$m_id['m_id']."' order by g_id DESC ");
              $fetch_m12=mysqli_fetch_array($m12);

                $nine=($var3 + $var8)/2;

               $var12 =  (75 * $m_id['shrunkage']) + (2 * $nine) ;

             }
             elseif($m_id['m_status']==1 || $m_id['m_status'] == 2  ){  
              $m12=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
               AND team_id = '".$_SESSION['id']."' AND month_id = '".$m_id['m_id']."' order by g_id DESC ");
              $fetch_m12=mysqli_fetch_array($m12);
               $nine=($var3 + $var8)/2;

               $var12 =  (75 * $m_id['shrunkage']) + (2 * $nine) ;
            }else{
               $var12 = 0;
            }
            //var 11
             if($m_id['m_name']=="Month-1"){
                $m13=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
             AND team_id = '".$_SESSION['id']."' AND month_id = '".$m_id['m_id']."' order by g_id DESC ");
              $fetch_m13=mysqli_fetch_array($m13);

                if($fetch_m13['actual_dmd'] > $fetch_m13['available_inv']){

                 $var13 =  $var6 - $var3;

                }else{
                 $var13 =  0;

                }
              }elseif($m_id['m_status']==1 || $m_id['m_status']==2){  

            $m13=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
             AND team_id = '".$_SESSION['id']."' AND month_id = '".$m_id['m_id']."' order by g_id DESC ");
              $fetch_m13=mysqli_fetch_array($m13);

                if($var6 > $var3){

                 $var13 =  $var6 - $var3;

                }else{
                 $var13 =  0;
                }

          }else{
              $var13 = 0;
          }

          //var 12
             if($m_id['m_name']=="Month-1"){

                $m14=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
                 AND team_id = '".$_SESSION['id']."' AND month_id = '".$m_id['m_id']."' order by g_id DESC ");
                  $fetch_m14=mysqli_fetch_array($m14);

                    if($var6 > $var3){
                     $var14 =  ($var6 - $var3)*20;
                    }else{
                     $var14 =  0;
                    }

             }elseif($m_id['m_status']==1 || $m_id['m_status']==2  ){  

                $m14=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
                 AND team_id = '".$_SESSION['id']."' AND month_id = '".$m_id['m_id']."' order by g_id DESC ");
                  $fetch_m14=mysqli_fetch_array($m14);

                    if($var6 > $var3){
                     $var14 =  ($var6 - $var3)*20;
                    }else{
                     $var14 =  0;
                    }
              }else{
                  $var14 = 0;
              }

          //var 13
          if($m_id['m_name']=="Month-1"){
            $m15=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
               AND team_id = '".$_SESSION['id']."' AND month_id = '".$m_id['m_id']."' order by g_id DESC ");
                $fetch_m15=mysqli_fetch_array($m15);

                $nines=($var3 + $var8)/2;

                 $carying_c =  (75 * $var10) + (2 * $nines) ; //10C

                   if($var6 > $var3){
                       $shortage_c =  ($var6 - $var3)*20;
                      }else{
                        $shortage_c =  0;
                      }
                   $var15 = ($var4 + $carying_c) + $shortage_c;

            }elseif($m_id['m_status']==1 || $m_id['m_status']==2  ){  

              $m15=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
               AND team_id = '".$_SESSION['id']."' AND month_id = '".$m_id['m_id']."' order by g_id DESC ");
                $fetch_m15=mysqli_fetch_array($m15);

                $nines=($var3 + $var8)/2;

                 $carying_c =  (75 * $var10) + (2 * $nines) ; //10C

                   if($var6 > $var3){
                       $shortage_c =  ($var6 - $var3)*20;
                      }else{
                        $shortage_c =  0;
                      }
                   $var15 = ($var4 + $carying_c) + $shortage_c;
            }else{
               $var15 = 0;
            }

            //var 16
            if($m_id['m_name']=="Month-1"){
              $var16 = $var15;
            }elseif($m_id['m_status']==1 || $m_id['m_status']==2 ){

              $m16=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
                                   AND team_id = '".$_SESSION['id']."' AND month_id = '".$m_id['m_id']."' order by g_id DESC ");
                                  $fetch_m16=mysqli_fetch_array($m16);

                                   $rr=$m_id['m_id']-1;

                                  $ms16=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
                                   AND team_id = '".$_SESSION['id']."' AND month_id = '".$rr."' order by g_id DESC limit 1");
                                  $fetch_ms16=mysqli_fetch_array($ms16);

                                   $var16 = $fetch_ms16['cumulative_cost'] + $var15;

                // $var16 = $fetch_m16['cumulative_cost'] + $var15;

            }else{
               $var16 = 0;

            }






             
// exit();

               $insert_data=mysqli_query($con,"INSERT INTO `gameboard_data`(`month_id`, `team_id`, `session_id`, `beginning_inv`, `u_order_placed`, `available_inv`, `no_order_units`, `order_cost`, `forcasted_dmd`, `actual_dmd`, `ending_inv`, `avg_inv`, `shrunkage`, `u_cost_shrunk`, `carrying_cost`,
     `units_short`, `shortage_cost`, `total_cost`, `cumulative_cost`) VALUES ('".$mm."','$key','$session_id','$var1','$var2','$var3','$ordered_unit','5000','$var5','$var6','$var8','$var9','$var10','$var11','$var12','$var13','$var14','$var15','$var16')");


            // $insert=mysqli_query($con,"insert into gameboard_data (`month_id`,`team_id`,`no_order_units`,`session_id`) VALUES('".$mm."','$key','0','$session_id')");
        }
    }else{

    }

}   

    // var_dump($user);

    
    


	


    if(!empty($pos_res1)){

        echo 'true'; exit;

    }
    else{
        echo 'false'; exit;
    }
}

 ?> 