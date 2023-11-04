<?php 
include '../db.php';
 error_reporting(E_ALL ^ E_NOTICE);
    $session_query="SELECT * FROM `session` where status='Active';";
$session_rec=mysqli_query($con,$session_query);
while($row=mysqli_fetch_array($session_rec)){
    $session_id=$row[0];
    $session_name=substr($row['des'], 0,3);
}
 ?>
<style type="text/css">
    /* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}



th{
    font-size: 14px;
}
</style>
<br>

<?php 
 $variable = 25978;



    if(isset($_GET['month_id'])){

     $mid=$_GET['month_id'];
    $fm=mysqli_query($con,"select * from months where session_id = '".$session_id."' AND m_id = '".$mid."'  ");
      while($sm=mysqli_fetch_array($fm)){
       
      //var 1

      if($sm['m_name'] == "Month-1"){
            $var1 = $variable;
        }elseif($sm['m_status']==1 || $sm['m_status']==2  ){
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
          if($sm['m_name'] == "Month-1"){
                $var2 = 0;
            }elseif($sm['m_status']==1 || $sm['m_status']==2){

              $m2=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
               AND team_id = '".$_SESSION['id']."' order by g_id DESC ");
              $fetch_m2=mysqli_fetch_array($m2);

               $var2 = $fetch_m2['no_order_units'];
            }else{
               $var2 = 0;
            }

      //var 3
         if($sm['m_name'] == "Month-1"){
              $var3 = $variable;
          }elseif($sm['m_status']==1 || $sm['m_status']==2){  

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
     $ordered_unit = $_GET['ordered_unit'] *24 ;

      //var 5
        if($sm['m_name'] == "Month-1"){
              $var4 = "5000";
          }elseif($sm['m_status']==1 || $sm['m_status']==2 ){  

            $m3=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
             AND team_id = '".$_SESSION['id']."' AND month_id = '".$mid."' order by g_id DESC ");
            $fetch_m4=mysqli_fetch_array($m3);

             $var4 = "5000";
          }else{
             $var4 = 0;
          }

          //var 6
           if($sm['m_status'] == 1 || $sm['m_status'] == 2 ){
               $var5 = $sm['forecasted_dmd'];
            }else{
               $var5 = 0;
            }

          //var 7
           if($sm['m_status'] == 1 || $sm['m_status'] == 2 ){
               $var6 = $sm['actual_demand'];
            }else{
               $var6 = 0;
            }
          //var 8

             if($sm['m_name']=="Month-1"){
                 $var8c = $var3 - $var6;
                  if($var8c < 0){
                   $var8 = 0;
                }else{
                   $var8 = $var8c;
                }
             }elseif($sm['m_status']==1 || $sm['m_status'] == 2 ){  

              $m3=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
               AND team_id = '".$_SESSION['id']."' AND month_id = '".$mid."'");
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
             if($sm['m_name']=="Month-1"){
               $var9 = ($var3+$var8)/2;
             }
             elseif($sm['m_status']==1 || $sm['m_status'] == 2 ){  
            $m9=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
             AND team_id = '".$_SESSION['id']."' AND month_id = '".$mid."' order by g_id DESC ");
            $fetch_m9=mysqli_fetch_array($m9);

                           $var9 = ($var3+$var8)/2;

          }else{
             $var9 = 0;
          }
          //var 10A
             if($sm['m_status'] == 1 || $sm['m_status'] == 2 ){
                 $var10 = $sm['shrunkage'];
              }else{
                 $var10 = 0;
              }
          //var 10B

               if($sm['m_status'] == 1 || $sm['m_status'] == 2 ){
                   $var11 = 75 * $sm['shrunkage'];
                }else{
                   $var11 = 0;
                }
          //var 10C
             if($sm['m_name']=="Month-1"){

                $m12=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
               AND team_id = '".$_SESSION['id']."' AND month_id = '".$mid."' order by g_id DESC ");
              $fetch_m12=mysqli_fetch_array($m12);

                $nine=($var3 + $var8)/2;

               $var12 =  (75 * $sm['shrunkage']) + (2 * $nine) ;

             }
             elseif($sm['m_status']==1 || $sm['m_status'] == 2  ){  
              $m12=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
               AND team_id = '".$_SESSION['id']."' AND month_id = '".$mid."' order by g_id DESC ");
              $fetch_m12=mysqli_fetch_array($m12);
               $nine=($var3 + $var8)/2;

               $var12 =  (75 * $sm['shrunkage']) + (2 * $nine) ;
            }else{
               $var12 = 0;
            }


          //var 11
             if($sm['m_name']=="Month-1"){
                $m13=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
             AND team_id = '".$_SESSION['id']."' AND month_id = '".$mid."' order by g_id DESC ");
              $fetch_m13=mysqli_fetch_array($m13);

                if($fetch_m13['actual_dmd'] > $fetch_m13['available_inv']){

                 $var13 =  $var6 - $var3;

                }else{
                 $var13 =  0;

                }
              }elseif($sm['m_status']==1 || $sm['m_status']==2){  

            $m13=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
             AND team_id = '".$_SESSION['id']."' AND month_id = '".$mid."' order by g_id DESC ");
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
             if($sm['m_name']=="Month-1"){

                $m14=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
                 AND team_id = '".$_SESSION['id']."' AND month_id = '".$mid."' order by g_id DESC ");
                  $fetch_m14=mysqli_fetch_array($m14);

                    if($var6 > $var3){
                     $var14 =  ($var6 - $var3)*20;
                    }else{
                     $var14 =  0;
                    }

             }elseif($sm['m_status']==1 || $sm['m_status']==2  ){  

                $m14=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
                 AND team_id = '".$_SESSION['id']."' AND month_id = '".$mid."' order by g_id DESC ");
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
          if($sm['m_name']=="Month-1"){
            $m15=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
               AND team_id = '".$_SESSION['id']."' AND month_id = '".$mid."' order by g_id DESC ");
                $fetch_m15=mysqli_fetch_array($m15);

                $nines=($var3 + $var8)/2;

                 $carying_c =  (75 * $var10) + (2 * $nines) ; //10C

                   if($var6 > $var3){
                       $shortage_c =  ($var6 - $var3)*20;
                      }else{
                        $shortage_c =  0;
                      }
                   $var15 = ($var4 + $carying_c) + $shortage_c;

            }elseif($sm['m_status']==1 || $sm['m_status']==2  ){  

              $m15=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
               AND team_id = '".$_SESSION['id']."' AND month_id = '".$mid."' order by g_id DESC ");
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
            if($sm['m_name']=="Month-1"){
              $var16 = $var15;
            }elseif($sm['m_status']==1 || $sm['m_status']==2 ){

              $m16=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
                                   AND team_id = '".$_SESSION['id']."' AND month_id = '".$mid."' order by g_id DESC ");
                                  $fetch_m16=mysqli_fetch_array($m16);

                                   $rr=$mid-1;

                                  $ms16=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
                                   AND team_id = '".$_SESSION['id']."' AND month_id = '".$rr."' order by g_id DESC limit 1");
                                  $fetch_ms16=mysqli_fetch_array($ms16);

                                   $var16 = $fetch_ms16['cumulative_cost'] + $var15;

                // $var16 = $fetch_m16['cumulative_cost'] + $var15;

            }else{
               $var16 = 0;

            }

          //var 14

          $month_id = $_GET['month_id'];
          
          $team_id =$_SESSION['id'];
     $insert_data=mysqli_query($con,"INSERT INTO `gameboard_data`(`month_id`, `team_id`, `session_id`, `beginning_inv`, `u_order_placed`, `available_inv`, `no_order_units`, `order_cost`, `forcasted_dmd`, `actual_dmd`, `ending_inv`, `avg_inv`, `shrunkage`, `u_cost_shrunk`, `carrying_cost`,
     `units_short`, `shortage_cost`, `total_cost`, `cumulative_cost`) VALUES ('$month_id','$team_id','$session_id','$var1','$var2','$var3','$ordered_unit','5000','$var5','$var6','$var8','$var9','$var10','$var11','$var12','$var13','$var14','$var15','$var16')");

    // $um=mysqli_query($con,"UPDATE months set `m_status`=2  where m_id= '".$month_id."'");
    echo "<script>window.location.href = 'gameboard.php';</script>";



}
  }
    
 ?>
<style type="text/css">




table {
  margin: 0;
  border: none;
  border-collapse: separate;
  border-spacing: 0;
  table-layout: fixed;
  border: 1px solid black;
}
table td,
table th {
  border: 1px solid black;
  padding: 0.5rem 1rem;
}

table thead .headcol {
  position: sticky;
  top: 0;
  z-index: 1;
  width: 10vw;
  background: purple;
}


table thead th {
  position: sticky;
  top: 0;
  z-index: 1;
  width: 80px;
  background: purple;
  color:white;
}

table tbody th {
  font-weight: 700;
  position: relative;
}
table thead th:first-child {
  position: sticky;
  left: 0;
  z-index: 2;

}


table tbody th {
  position: sticky;
  left: 0;
  background: white;
  z-index: 1;

}


[role="region"][aria-labelledby][tabindex] {
  width: 100%;
  max-height: 98vh;
  overflow: auto;
}
[role="region"][aria-labelledby][tabindex]:focus {
  box-shadow: 0 0 0.5em rgba(0, 0, 0, 0.5);
  outline: 0;
}
/*
.table-bordered{
    background-image: url('img/instruction.jpg');
  background-size: cover;
  background-repeat: no-repeat;
  width: 100%;
}*/

</style>
                <!-- <h1 style="text-align:center;font-weight:700" >DASHBOARD</h1> -->

 <div class="table table-responsive" >

    <table class="table table-bordered " style="font-size:11px" >
                        <thead >
                            <tr >
                                <th style="width:170px;" class="headcol">Details</th>
                                <?php 
                                $count =1;
                                

                                $fm=mysqli_query($con,"select * from months where session_id = '".$session_id."' ");
                                while($row=mysqli_fetch_array($fm)){
                                if($count >= 1 && $count <= 12){
                                    $s =1;
                                }else{
                                    $s = 2;
                                }
                                    ?>

                                  <th class="headcol1" > <?php echo date('M', mktime(0, 0, 0, $count, 1));echo $s ?> </th>

                                <?php   $count++;
                                
                            }
                                 ?>

                            </tr>
                        </thead>
                        <tbody>
                            <tr  >

                                <th style="line-height: 100%"  class="headcol">Beginning inventory</th>
                            <?php 
                             $select_m=mysqli_query($con,"select * from months where session_id = '".$session_id."'  ");
                              while($row1=mysqli_fetch_array($select_m)){ 

                                $sr=mysqli_query($con,"select * from gameboard_data where month_id ='".$row1['m_id']."' AND session_id = '".$session_id."' AND team_id = '".$_SESSION['id']."' ");
                                $fsr=mysqli_fetch_array($sr);
                                 $fsr['month_id'];
                             ?>
                            <td class="long" >
                              <?php 
                                if($row1['m_name'] == "Month-1"){
                                  echo  $var1 = $variable;
                                }

                                elseif($row1['m_status']==1 && $row1['m_crash']==0 && $row1['m_id']!=$fsr['month_id']){
                                        $d=$row1['m_id']-1;

                                  $m1=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
                                   AND team_id = '".$_SESSION['id']."'  AND month_id = '".$d."'  order by g_id DESC ");
                                  $fetch_m1=mysqli_fetch_array($m1);

                                  $varc1 = $fetch_m1['ending_inv'] - $fetch_m1['shrunkage'];
                                  if($varc1 < 0){
                                 echo  $var1 = 0;
                                  }else{
                                  echo $var1 = $fetch_m1['ending_inv'] - $fetch_m1['shrunkage'];
                                  }

                                }
                                elseif($row1['m_status']==2 && $row1['m_crash']==1 ){
                                        $d=$row1['m_id']-1;
                                  $m1=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
                                   AND team_id = '".$_SESSION['id']."' AND month_id = '".$d."' order by g_id DESC ");
                                  $fetch_m1=mysqli_fetch_array($m1);

                                  $varc1 = $fetch_m1['ending_inv'] - $fetch_m1['shrunkage'];
                                  if($varc1 < 0){
                                 echo  $var1 = 0;
                                  }else{
                                  echo $var1 = $fetch_m1['ending_inv'] - $fetch_m1['shrunkage'];
                                  }

                                }


                                elseif($row1['m_id']==$fsr['month_id'] ){
                                   $m1=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
                                   AND team_id = '".$_SESSION['id']."' AND month_id = '".$row1['m_id']."' order by g_id DESC ");
                                  $fetch_m1=mysqli_fetch_array($m1);

                                  echo $var1 = $fetch_m1['beginning_inv'];
                                }

                                elseif($row1['mc_status']!=0 ){
                                   $m1=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
                                   AND team_id = '".$_SESSION['id']."' AND month_id = '".$row1['m_id']."' order by g_id DESC ");
                                  $fetch_m1=mysqli_fetch_array($m1);

                                  echo $var1 = $fetch_m1['beginning_inv'];
                                }else{
                                    echo $var1 =0;
                                }
                               ?>
                              <input type="hidden" value="<?php echo  $var1; ?>" name="var1" style="font-size:12px"  >
                            </td>
                              <?php }?>
                            </tr>

                            <!-- //Row 2 -->


                            <tr>
                                <th style="line-height: 100%"  class="headcol">Scheduled Receipt</th>
                                
                                
                               <?php 
                             $select_m=mysqli_query($con,"select * from months where session_id = '".$session_id."'  ");
                              while($row2=mysqli_fetch_array($select_m)){ 

                                $sr=mysqli_query($con,"select * from gameboard_data where month_id ='".$row2['m_id']."' AND session_id = '".$session_id."' AND team_id = '".$_SESSION['id']."' ");
                                $fsr=mysqli_fetch_array($sr);
                                 $fsr['month_id'];
                             ?>
                            <td class="long">
                              <?php 
                                if($row2['m_name'] == "Month-1"){
                                  echo  $var2 = 0;
                                }elseif($row2['m_status']==1 && $row2['m_crash']==0  && $row2['m_id']!=$fsr['month_id'] ){
                                        $d=$row2['m_id']-1;

                                  $m2=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
                                   AND team_id = '".$_SESSION['id']."' AND month_id = '".$d."' order by g_id DESC ");
                                  $fetch_m2=mysqli_fetch_array($m2);

                                  echo $var2 = $fetch_m2['no_order_units'];
                                }
                                elseif($row2['m_status']==2 && $row2['m_crash']==1 ){
                                        $d=$row2['m_id']-1;

                                   $m2=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
                                   AND team_id = '".$_SESSION['id']."' AND month_id = '".$d."' order by g_id DESC ");
                                  $fetch_m2=mysqli_fetch_array($m2);

                                  echo $var2 = $fetch_m2['no_order_units'];
                                }
                                elseif($row2['m_id']==$fsr['month_id']  ){
                                     $m2=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
                                   AND team_id = '".$_SESSION['id']."' AND month_id = '".$row2['m_id']."'  order by g_id DESC ");
                                  $fetch_m2=mysqli_fetch_array($m2);

                                  echo $var2 = $fetch_m2['u_order_placed'];
                                }

                                elseif($row2['mc_status']!=0 ){
                                   $m2=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
                                   AND team_id = '".$_SESSION['id']."' AND month_id = '".$row2['m_id']."'  order by g_id DESC ");
                                  $fetch_m2=mysqli_fetch_array($m2);

                                  echo $var2 = $fetch_m2['u_order_placed'];
                                }else{
                                    echo $var2 = 0;
                                }
                               ?>
                              <input type="hidden" value="<?php echo  $var2; ?>" name="var2" style="font-size:12px"  >
                            </td>

                                <?php } ?>
                            </tr>



                            <!-- //Row 3 -->
                            <tr>
                                <th style="line-height: 100%" class="headcol">Available inventory</th>
                                                   
                               <?php 
                             $select_m=mysqli_query($con,"select * from months where session_id = '".$session_id."'  ");
                              while($row3=mysqli_fetch_array($select_m)){ 
                                 $sr=mysqli_query($con,"select * from gameboard_data where month_id ='".$row3['m_id']."' AND session_id = '".$session_id."' AND team_id = '".$_SESSION['id']."' ");
                                $fsr=mysqli_fetch_array($sr);
                                 $fsr['month_id'];
                             ?>
                            <td class="long">
                              <?php 
                                if($row3['m_name'] == "Month-1"){
                                  echo  $var3 = $variable;
                                }elseif($row3['m_status']==1 && $row3['m_crash']==0  && $row3['m_id']!=$fsr['month_id'] ){
                                        
                                    $d=$row3['m_id']-1;
                                        
                                  $m3=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
                                   AND team_id = '".$_SESSION['id']."' AND month_id = '".$d."' order by g_id DESC ");
                                  $fetch_m3=mysqli_fetch_array($m3);
                                  $d=$fetch_m3['ending_inv'] - $fetch_m3['shrunkage'];
                                  if($d<0){
                                    $s=0;
                                  }else{
                                    $s=$fetch_m3['ending_inv'] - $fetch_m3['shrunkage'];

                                  }
                                  echo $var3 = $fetch_m3['no_order_units'] + $s;

                                }
                                elseif($row3['m_status']==2 && $row3['m_crash']==1 ){
                                    $d=$row3['m_id']-1;
                                      $m3=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
                                   AND team_id = '".$_SESSION['id']."' AND month_id = '".$d."' order by g_id DESC ");
                                  $fetch_m3=mysqli_fetch_array($m3);
                                  $d=$fetch_m3['ending_inv'] - $fetch_m3['shrunkage'];
                                  if($d<0){
                                    $s=0;
                                  }else{
                                    $s=$fetch_m3['ending_inv'] - $fetch_m3['shrunkage'];

                                  }
                                  echo $var3 = $fetch_m3['no_order_units'] + $s;

                                }
                                elseif($row3['m_id']==$fsr['month_id']  ){
                                    $m3=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
                                   AND team_id = '".$_SESSION['id']."' AND month_id = '".$row3['m_id']."' order by g_id DESC ");
                                  $fetch_m3=mysqli_fetch_array($m3);

                                  echo $var3 = $fetch_m3['available_inv'];
                                }
                                elseif($row3['mc_status']!=0 ){
                                
                                    $m3=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
                                   AND team_id = '".$_SESSION['id']."' AND month_id = '".$row3['m_id']."' order by g_id DESC ");
                                  $fetch_m3=mysqli_fetch_array($m3);

                                  echo $var3 = $fetch_m3['available_inv'];

                                }else{
                                    echo $var3 = 0;
                                }
                               ?>
                              <input type="hidden" value="<?php echo  $var3; ?>" name="var3" style="font-size:12px"  >
                            </td>
                                <?php } ?>
                            </tr>

                          <!-- //Row 4 -->

                            <tr>

                                <th style="line-height: 100%" class="headcol">Order (Boxes)</th>

                                        <?php 
                                $count =1;


                                $fm=mysqli_query($con,"select * from months where session_id = '".$session_id."'  ");
                                while($row=mysqli_fetch_array($fm)){

                                  $fr=mysqli_query($con,"select * from gameboard_data where month_id ='".$row['m_id']."' AND team_id = '".$_SESSION['id']."' AND session_id = '".$session_id."' ");
                                  $sl=mysqli_fetch_array($fr);

                                    if($row['m_status'] == 0 && $row['m_crash'] !=1  ||
                                     $row['m_status'] == 2 && $row['m_crash'] !=1  || 
                                      $sl['month_id'] == $row['m_id'] 
                                    && $row['m_crash'] ==1  || $row['m_status'] == 0  || 
                                      $sl['month_id'] == $row['m_id']  ){



                                    // if($row['m_status'] == 0 && $row['m_crash'] !=1  || $row['m_status'] == 2 && $row['m_crash'] !=1  ||  $sl['month_id'] == $row['m_id']  ){
                                                            
                                      $active = "disabled";
                                      $clas ="cursor: not-allowed;";
                                      $clas1 = "background-color:grey;";

                                    }else{
                                      
                                      $active = "";
                                      $clas ="";
                                      $clas1 = "background-color:purple;";
                                      
                                    }  

                                     ?>  
                        <form > 

                                  <td class="long">
                                    <input type="hidden" value="<?php echo $row['m_id'] ?>" name="month_id" >
                                    <input type="number" max="1500" <?php echo $active; ?> value="<?php $ds = $sl['no_order_units'] /24; 
                                    if($ds==0){echo "";}else{echo $ds; } ?>" name="ordered_unit" class="" style="<?php echo $clas ?>width:55px;font-size:12px;border-color: grey;border-style: solid;border-width: 1px;height: 30px;" required >
                                  
                                    <button style="<?php echo $clas ?><?php echo $clas1 ?>border: none;margin-top: 5px;" 
                                    <?php echo $active; ?>  class="btn btn-success btn-sm" name="btn_save" >SAVE</button>

                                  <!-- <?php echo $active; ?> --> 
                              </td>
                            </form>


                                <?php $count++;  } ?>

                            </tr>


                          <!-- //Row 5 -->

                            <tr>
                                <th style="line-height: 100%" class="headcol">Ordering cost <span style="font-size:10px" >(PKR)</span></th>
                                        <?php 
                             $select_m=mysqli_query($con,"select * from months where session_id = '".$session_id."'  ");
                              while($row4=mysqli_fetch_array($select_m)){ 
                                 $sr=mysqli_query($con,"select * from gameboard_data where month_id ='".$row4['m_id']."' AND session_id = '".$session_id."' AND team_id = '".$_SESSION['id']."' ");
                                $fsr=mysqli_fetch_array($sr);

                             ?>
                            <td class="long">
                              <?php 

                                if($row4['m_name'] == "Month-1"){

                                if($row4['m_status'] == 2 && $row4['m_id']==$fsr['month_id'] ){  
                                  echo  $var4 = number_format("5000",0, '.', ',');
                                  }else{
                                    echo 0;
                                  }
                                }else if($row4['m_name'] == "Month-24"){

                                if($row4['m_status'] == 1 && $row4['m_id']==$fsr['month_id'] ){  
                                  echo  $var4 = number_format("5000",0, '.', ',');
                                  }else{
                                    echo 0;
                                  }
                                }

                                elseif($row4['m_status'] ==2){  

                                  $m3=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
                                   AND team_id = '".$_SESSION['id']."' AND month_id = '".$row4['m_id']."'  order by g_id DESC ");
                                  $fetch_m4=mysqli_fetch_array($m3);

                                  echo $var4 = number_format($fetch_m4['order_cost'],0, '.', ',');

                                }elseif($row4['m_status'] ==1){
                                  echo $var4 = 0;
                                }
                                else{
                                  echo $var4 = 0;
                                }
                               ?>
                              <input type="hidden" value="5000" name="var4" style="font-size:12px"  >
                            </td>
                                <?php } ?>
                            </tr>

                          <!-- //Row 6-->
                            <tr>
                                <th style="line-height: 100%" class="headcol">Forecasted demand</th>
                                              <?php 
                                $fm=mysqli_query($con,"select * from months where session_id = '".$session_id."' ");
                                while($row5=mysqli_fetch_array($fm)){

                                  
                                    ?>
                                  <td class="long">
                                    <?php
                                        echo $var5 = $row5['forecasted_dmd'];

                                ?>
                                    <input type="hidden" name="" style="font-size:12px" class="form-control" >

                                  </td>
                                <?php   } ?>
                            </tr>

                          <!-- //Row 7-->

                            <tr>
                                <th style="line-height: 100%" class="headcol">Actual demand</th>
                                           <?php 
                                $fm=mysqli_query($con,"select * from months where session_id = '".$session_id."' ");
                                while($row6=mysqli_fetch_array($fm)){
                                     $sr=mysqli_query($con,"select * from gameboard_data where month_id ='".$row6['m_id']."' AND session_id = '".$session_id."' AND team_id = '".$_SESSION['id']."' ");
                                $fsr=mysqli_fetch_array($sr); ?>
                                  <td class="long">
                                    <?php
                                      if($row6['m_status'] == 2 && $row6['m_id']==$fsr['month_id']){
                                      echo $var6 = $row6['actual_demand'];
                                    }else if($row6['m_name'] == "Month-24"){
                                      echo $var6 = $row6['actual_demand'];
                                        
                                }
                                elseif($row6['m_status'] == 1 && $row6['m_id']==$fsr['month_id']){
                                    echo $var6 = 0;
                                }
                                    elseif($row6['m_id']==$fsr['month_id']  ){

                                    }else{
                                      echo $var6 = 0;
                                    }
                                ?>
                                    <input type="hidden" name="" style="font-size:12px" class="form-control" >

                                  </td>
                                <?php   } ?>
                            </tr>

                          <!-- //Row 8-->
                            <tr>
                                <th style="line-height: 100%" class="headcol">Ending inventory</th>
                                             <?php 
                             $select_m=mysqli_query($con,"select * from months where session_id = '".$session_id."'  ");
                              while($row8=mysqli_fetch_array($select_m)){ 
                                  $sr=mysqli_query($con,"select * from gameboard_data where month_id ='".$row8['m_id']."' AND session_id = '".$session_id."' AND team_id = '".$_SESSION['id']."' ");
                                $fsr=mysqli_fetch_array($sr);
                             ?>
                            <td class="long">
                              <?php 
                                if($row8['m_status'] == 2 && $row8['m_id']==$fsr['month_id']){  

                                  $m3=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
                                   AND team_id = '".$_SESSION['id']."' AND month_id = '".$row8['m_id']."' order by g_id DESC ");
                                  $fetch_m8=mysqli_fetch_array($m3);

                                  $var8c = $fetch_m8['available_inv'] - $fetch_m8['actual_dmd'];

                                  if($var8c < 0){

                                    echo $var8 = 0;

                                  }else{

                                    echo $var8 = $var8c;
                                  }

                                }else if($row8['m_name'] == "Month-24"){

                                  $m3=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
                                   AND team_id = '".$_SESSION['id']."' AND month_id = '".$row8['m_id']."' order by g_id DESC ");
                                  $fetch_m8=mysqli_fetch_array($m3);

                                  $var8c = $fetch_m8['available_inv'] - $fetch_m8['actual_dmd'];

                                  if($var8c < 0){

                                    echo $var8 = 0;

                                  }else{

                                    echo $var8 = $var8c;
                                  }
                                } elseif($row8['m_status'] == 1 && $row8['m_id']==$fsr['month_id']){
                                    echo $var8 = 0;
                                }
                                elseif($row8['m_id']==$fsr['month_id']  ){}
                                else{

                                  echo $var8 = 0;
                                }
                               ?>
                              <input type="hidden" value="<?php echo $var8; ?>" name="var8" style="font-size:12px"  >
                            </td>
                                <?php } ?>
                            </tr>

                          <!-- //Row 9-->

                            <tr>
                                <th style="line-height: 100%" class="headcol">Average inventory</th>
                                           <?php 
                             $select_m=mysqli_query($con,"select * from months where session_id = '".$session_id."'  ");
                              while($row9=mysqli_fetch_array($select_m)){ 
                                           $sr=mysqli_query($con,"select * from gameboard_data where month_id ='".$row9['m_id']."' AND session_id = '".$session_id."' AND team_id = '".$_SESSION['id']."' ");
                                $fsr=mysqli_fetch_array($sr);
                             ?>
                            <td class="long">
                              <?php 
                                if($row9['m_status'] == 2 && $row9['m_id']==$fsr['month_id']){  

                                  $m9=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
                                   AND team_id = '".$_SESSION['id']."' AND month_id = '".$row9['m_id']."'  order by g_id DESC ");
                                  $fetch_m9=mysqli_fetch_array($m9);

                                  echo $var9 = ($fetch_m9['available_inv'] + $fetch_m9['ending_inv'])/2;
                                }else if($row9['m_name'] == "Month-24"){
                                     $m9=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
                                   AND team_id = '".$_SESSION['id']."' AND month_id = '".$row9['m_id']."'  order by g_id DESC ");
                                  $fetch_m9=mysqli_fetch_array($m9);

                                  echo $var9 = ($fetch_m9['available_inv'] + $fetch_m9['ending_inv'])/2;
                                }elseif($row9['m_status'] == 1 && $row9['m_id']==$fsr['month_id']){
                                  echo $var9 = 0;

                                }
                                elseif($row9['m_id']==$fsr['month_id']  ){}else{
                                  echo $var9 = 0;
                                }
                               ?>
                              <input type="hidden" value="<?php echo $var9; ?>" name="var9" style="font-size:12px"  >
                            </td>
                                <?php } ?>
                            </tr>

                          <!-- //Row 10-->
                            <tr>
                                <th style="line-height: 100%" class="headcol">Shrinkage Units</th>
                                               <?php 
                                $fm=mysqli_query($con,"select * from months where session_id = '".$session_id."' ");
                                while($row10=mysqli_fetch_array($fm)){ 
                                     $sr=mysqli_query($con,"select * from gameboard_data where month_id ='".$row10['m_id']."' AND session_id = '".$session_id."' AND team_id = '".$_SESSION['id']."' ");
                                $fsr=mysqli_fetch_array($sr);?>
                                  <td class="long">
                                    <?php
                                      if( $row10['m_status'] == 2 && $row10['m_id']==$fsr['month_id']){
                                      echo $var10 = $row10['shrunkage'];
                                    }else if($row10['m_name'] == "Month-24"){
                                      echo $var10 = $row10['shrunkage'];

                                    }elseif($row10['m_status'] == 1 && $row10['m_id']==$fsr['month_id'] ){
                                      echo $var10 = 0;
                                    }elseif($row10['m_id']==$fsr['month_id']  ){}else{
                                      echo $var10 = 0;
                                    }
                                ?>
                                    <input type="hidden" name="" style="font-size:12px" class="form-control" >

                                  </td>
                                <?php   } ?>
                            </tr>

                          <!-- //Row 11-->
                            <tr>
                                <th style="line-height: 100%" class="headcol">Shrinkage Cost <span style="font-size:10px" >(PKR)</span></th>
                                            <?php 
                                $fm=mysqli_query($con,"select * from months where session_id = '".$session_id."' ");
                                while($row11=mysqli_fetch_array($fm)){
                                $sr=mysqli_query($con,"select * from gameboard_data where month_id ='".$row11['m_id']."' AND session_id = '".$session_id."' AND team_id = '".$_SESSION['id']."' ");
                                $fsr=mysqli_fetch_array($sr); ?>
                                  <td class="long">
                                    <?php
                                      if($row11['m_status'] == 2 && $row11['m_id']==$fsr['month_id']){
                                      echo $var11 = number_format(75 * $row11['shrunkage'],0, '.', ',');
                                    }else if($row11['m_name'] == "Month-24"){
                                      echo $var11 = number_format(75 * $row11['shrunkage'],0, '.', ',');
                                    }
                                    elseif($row11['m_status'] == 1 && $row11['m_id']==$fsr['month_id']){
                                      echo $var11 = 0;

                                    }elseif($row11['m_id']==$fsr['month_id']  ){}else{
                                      echo $var11 = 0;
                                    }
                                ?>
                                    <input type="hidden" name="" style="font-size:12px" class="form-control" >

                                  </td>
                                <?php   } ?>
                            </tr>

                          <!-- //Row 12-->
                            <tr>
                                <th style="line-height: 100%" class="headcol">Carrying cost <span style="font-size:10px" >(PKR)</span></th>
                                           <?php 
                             $select_m=mysqli_query($con,"select * from months where session_id = '".$session_id."'  ");
                              while($row12=mysqli_fetch_array($select_m)){ 
                                $sr=mysqli_query($con,"select * from gameboard_data where month_id ='".$row12['m_id']."' AND session_id = '".$session_id."' AND team_id = '".$_SESSION['id']."' ");
                                $fsr=mysqli_fetch_array($sr); 
                             ?>
                            <td class="long">
                              <?php 
                                if($row12['m_status'] == 2 && $row12['m_id']==$fsr['month_id']){  

                                  $m12=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
                                   AND team_id = '".$_SESSION['id']."' AND month_id = '".$row12['m_id']."'  order by g_id DESC ");
                                  $fetch_m12=mysqli_fetch_array($m12);
                                    $nine=($fetch_m12['available_inv'] + $fetch_m12['ending_inv'])/2;

                                  echo $var12 =  number_format((75 * $row12['shrunkage']) + (2 * $nine),0, '.', ',') ;

                                }else if($row12['m_name'] == "Month-24"){   

                                  $m12=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
                                   AND team_id = '".$_SESSION['id']."' AND month_id = '".$row12['m_id']."'  order by g_id DESC ");
                                  $fetch_m12=mysqli_fetch_array($m12);
                                    $nine=($fetch_m12['available_inv'] + $fetch_m12['ending_inv'])/2;

                                  echo $var12 =  number_format((75 * $row12['shrunkage']) + (2 * $nine),0, '.', ',') ;
                                  
                                }
                                elseif($row12['m_status'] == 1 && $row12['m_id']==$fsr['month_id'] ){
                                  echo $var12 = 0;

                                }elseif($row12['m_id']==$fsr['month_id']  ){}else{
                                  echo $var12 = 0;
                                }
                               ?>
                              <input type="hidden" value="<?php echo $var12; ?>" name="var12" style="font-size:12px"  >
                            </td>
                                <?php } ?>
                            </tr>

                          <!-- //Row 13-->

                            <tr>
                                <th style="line-height: 100%" class="headcol">Unit short <span style="font-size:10px" >(Lost Sales)</span></th>
                                             <?php 
                             $select_m=mysqli_query($con,"select * from months where session_id = '".$session_id."'  ");
                              while($row13=mysqli_fetch_array($select_m)){ 
                                $sr=mysqli_query($con,"select * from gameboard_data where month_id ='".$row13['m_id']."' AND session_id = '".$session_id."' AND team_id = '".$_SESSION['id']."' ");
                                $fsr=mysqli_fetch_array($sr); 
                             ?>
                            <td class="long">
                              <?php 
                                if($row13['m_status'] == 2 && $row13['m_id']==$fsr['month_id']){  

                                   $m13=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
                                   AND team_id = '".$_SESSION['id']."' AND month_id = '".$row13['m_id']."'  order by g_id DESC ");
                                    $fetch_m13=mysqli_fetch_array($m13);
                                      if($fetch_m13['actual_dmd'] > $fetch_m13['available_inv']){
                                      echo $var13 =  $fetch_m13['actual_dmd'] - $fetch_m13['available_inv'];
                                      }else{
                                      echo $var13 =  0;

                                      }
                                }else if($row13['m_name'] == "Month-24"){ 
                                $m13=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
                                   AND team_id = '".$_SESSION['id']."' AND month_id = '".$row13['m_id']."'  order by g_id DESC ");
                                    $fetch_m13=mysqli_fetch_array($m13);
                                      if($fetch_m13['actual_dmd'] > $fetch_m13['available_inv']){
                                      echo $var13 =  $fetch_m13['actual_dmd'] - $fetch_m13['available_inv'];
                                      }else{
                                      echo $var13 =  0;

                                      } 
                                 }
                                elseif($row13['m_status'] == 1 && $row13['m_id']==$fsr['month_id']){
                                  echo $var13 = 0;

                                }elseif($row13['m_id']==$fsr['month_id']  ){}else{
                                  echo $var13 = 0;
                                }
                               ?>
                              <input type="hidden" value="<?php echo $var13; ?>" name="var13" style="font-size:12px"  >
                            </td>
                                <?php } ?>
                            </tr>


                          <!-- //Row 14-->
                            <tr>
                                <th style="line-height: 100%" class="headcol">Shortage cost <span style="font-size:10px" >(PKR)</span></th>
                                               <?php 
                             $select_m=mysqli_query($con,"select * from months where session_id = '".$session_id."'  ");
                              while($row14=mysqli_fetch_array($select_m)){ 
                                  $sr=mysqli_query($con,"select * from gameboard_data where month_id ='".$row14['m_id']."' AND session_id = '".$session_id."' AND team_id = '".$_SESSION['id']."' ");
                                $fsr=mysqli_fetch_array($sr); 
                             ?>
                            <td class="long">
                              <?php 
                                if($row14['m_status'] == 2 && $row14['m_id']==$fsr['month_id']){  

                                  $m14=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
                                   AND team_id = '".$_SESSION['id']."' AND month_id = '".$row14['m_id']."'  order by g_id DESC ");
                                    $fetch_m14=mysqli_fetch_array($m14);
                                      if($fetch_m14['actual_dmd'] > $fetch_m14['available_inv']){
                                      echo $var14 =  number_format(($fetch_m14['actual_dmd'] - $fetch_m14['available_inv'])*20,0, '.', ',');
                                      }else{
                                      echo $var14 =  0;

                                      }
                                }
                                else if($row14['m_name'] == "Month-24"){ 
                                     $m14=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
                                   AND team_id = '".$_SESSION['id']."' AND month_id = '".$row14['m_id']."'  order by g_id DESC ");
                                    $fetch_m14=mysqli_fetch_array($m14);
                                      if($fetch_m14['actual_dmd'] > $fetch_m14['available_inv']){
                                      echo $var14 =  number_format(($fetch_m14['actual_dmd'] - $fetch_m14['available_inv'])*20,0, '.', ',');
                                      }else{
                                      echo $var14 =  0;

                                      }
                                }
                                    elseif($row14['m_status'] == 1 && $row14['m_id']==$fsr['month_id']){
                                  echo $var14 = 0;

                                }elseif($row14['m_id']==$fsr['month_id']  ){}else{
                                  echo $var14 = 0;
                                }
                               ?>
                              <input type="hidden" value="<?php echo $var14; ?>" name="var14" style="font-size:12px"  >
                            </td>
                                <?php } ?>
                            </tr>

                          <!-- //Row 15-->

                            <tr>
                                <th style="line-height: 100%" class="headcol">Total cost <span style="font-size:10px" >(PKR)</span></th>
                                               <?php 
                             $select_m=mysqli_query($con,"select * from months where session_id = '".$session_id."'  ");
                              while($row15=mysqli_fetch_array($select_m)){ 
                                   $sr=mysqli_query($con,"select * from gameboard_data where month_id ='".$row15['m_id']."' AND session_id = '".$session_id."' AND team_id = '".$_SESSION['id']."' ");
                                $fsr=mysqli_fetch_array($sr); 
                             ?>
                            <td class="long">
                              <?php 
                                if( $row15['m_status'] == 2 && $row15['m_id']==$fsr['month_id']){  

                                  $m15=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
                                   AND team_id = '".$_SESSION['id']."'  AND month_id = '".$row15['m_id']."'  order by g_id DESC ");
                                    $fetch_m15=mysqli_fetch_array($m15);

                                
                                      echo $var15 = number_format($fetch_m15['total_cost'],0, '.', ',');
                                }else if($row15['m_name'] == "Month-24"){ 
                                         $m15=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
                                   AND team_id = '".$_SESSION['id']."'  AND month_id = '".$row15['m_id']."'  order by g_id DESC ");
                                    $fetch_m15=mysqli_fetch_array($m15);

                                
                                      echo $var15 = number_format($fetch_m15['total_cost'],0, '.', ',');
                                }
                                elseif($row15['m_status'] == 1 && $row15['m_id']==$fsr['month_id']){
                                  echo $var15 = 0;

                                }elseif($row15['m_id']==$fsr['month_id']  ){}else{
                                  echo $var15 = 0;
                                }
                               ?>
                              <input type="hidden" value="<?php echo $var15; ?>" name="var15" style="font-size:12px"  >
                            </td>
                                <?php } ?>
                            </tr>

                          <!-- //Row 16-->

                            <tr>
                                <th style="line-height: 100%;background-color: purple;color:white" class="headcol">Cumulative cost <span style="font-size:10px" >(PKR)</span></th>
                                              <?php 
                             $select_m=mysqli_query($con,"select * from months where session_id = '".$session_id."'  ");
                              while($row16=mysqli_fetch_array($select_m)){ 
                                $sr=mysqli_query($con,"select * from gameboard_data where month_id ='".$row16['m_id']."' AND session_id = '".$session_id."' AND team_id = '".$_SESSION['id']."' ");
                                $fsr=mysqli_fetch_array($sr); 
                             ?>
                            <td class="long" style="color:purple;font-weight: 700;" >
                              <?php 
                                if($row16['m_name'] == "Month-1"){

                                    $m16=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
                                   AND team_id = '".$_SESSION['id']."'  AND month_id = '".$row16['m_id']."'  order by g_id DESC ");
                                    $fetch_m16=mysqli_fetch_array($m16);
                                  $nines=($fetch_m16['available_inv'] + $fetch_m16['ending_inv'])/2;

                                    $carying_c =  (75 * $row16['shrunkage']) + (2 * $nines) ;

                                       if($fetch_m16['actual_dmd'] > $fetch_m16['available_inv']){
                                           $shortage_c =  ($fetch_m16['actual_dmd'] - $fetch_m16['available_inv'])*60;
                                          }else{
                                            $shortage_c =  0;
                                          }

                                        if($row16['m_status'] == 2 && $row16['m_id']==$fsr['month_id'] ){  
                                     echo  $var16 = number_format(($fetch_m16['order_cost'] + $carying_c) + $shortage_c,0, '.', ',');

                                        }else{
                                            echo 0;
                                        }

                                } elseif($row16['m_name'] == "Month-24"){

                                    $m16=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
                                   AND team_id = '".$_SESSION['id']."'  AND month_id = '".$row16['m_id']."'  order by g_id DESC ");
                                    $fetch_m16=mysqli_fetch_array($m16);
                                        echo $fetch_m16['cumulative_cost'];
                                    }

                                elseif($row16['m_status'] == 2 && $row16['m_id']==$fsr['month_id'] ){  

                                  $m16=mysqli_query($con,"SELECT * FROM `gameboard_data` where session_id = '".$session_id."'
                                   AND team_id = '".$_SESSION['id']."' AND month_id = '".$row16['m_id']."' order by g_id DESC ");
                                  $fetch_m16=mysqli_fetch_array($m16);

                                  echo $var16 = number_format($fetch_m16['cumulative_cost'],0, '.', ',');
                                }elseif($row16['m_status'] == 1 && $row16['m_id']==$fsr['month_id']){
                                  echo $var16 = 0;

                                }elseif($row16['m_id']==$fsr['month_id']  ){}
                                else{
                                  echo $var16 = 0;
                                }
                               ?>
                              <input type="hidden" value="5000" name="var16" style="font-size:12px"  >
                            </td>
                                <?php } ?>
                                
                            </tr>






                        </tbody>
                    </table>

</div>

