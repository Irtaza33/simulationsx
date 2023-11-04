        
<?php include 'header.php';
include("../db.php");
     $session_query="SELECT * FROM `session` where status='Active';";
$session_rec=mysqli_query($con,$session_query);
while($row=mysqli_fetch_array($session_rec)){
    $session_id=$row[0];
    $session_name=$row['des'];
}

$team= $_SESSION['id'];


$sel_hs1=mysqli_query($con,"select * from historical_header where team_id = '".$team."' and session_id = '".$session_id."' AND functions_type = 1 ");
$fetch1=mysqli_num_rows($sel_hs1);

$sel_hs2=mysqli_query($con,"select * from historical_header where team_id = '".$team."' and session_id = '".$session_id."' AND functions_type = 2 ");
$fetch2=mysqli_num_rows($sel_hs2);

$sel_hs3=mysqli_query($con,"select * from historical_header where team_id = '".$team."' and session_id = '".$session_id."' AND functions_type = 3 ");
$fetch3=mysqli_num_rows($sel_hs3);

$sel_hs4=mysqli_query($con,"select * from historical_header where team_id = '".$team."' and session_id = '".$session_id."' AND functions_type = 4 ");
$fetch4=mysqli_num_rows($sel_hs4);

$sel_hs5=mysqli_query($con,"select * from historical_header where team_id = '".$team."' and session_id = '".$session_id."' AND functions_type = 5 ");
$fetch5=mysqli_num_rows($sel_hs5);

$sel_hs6=mysqli_query($con,"select * from historical_header where team_id = '".$team."' and session_id = '".$session_id."' AND functions_type = 6 ");
$fetch6=mysqli_num_rows($sel_hs6);


// echo $fetch1."<br>";
// echo $fetch2."<br>";
// echo $fetch3."<br>";
// echo $fetch4."<br>";
// echo $fetch5."<br>";
// echo $fetch6."<br>";


 ?>

<br>
<br>
<br>
<br>
            <div class="container-fluid">
                <div class="row">
                    <form action="actions/formulas.php" method="post" >

                    <div class="col-lg-2"></div>
                    

                        <div class="col-lg-8" style="text-align:center;border-style: solid;padding: 20px;border-width: 1px;" >
                        
                        <h3 style="font-weight: 600" >Select Appropriate Forecasting Method</h3><br>
                        <?php if($fetch1 == 1){ ?>
                            <a href="data.php?naive_approach&type=1" class="btn btn-primary" style="border-radius: 0;padding: 20px;background: purple;border: none;" >Naive Approach</a>
                        <?php }else{ ?>
                        <button class="btn btn-primary" name="naive_approach" value="naive_approach" style="border-radius: 0;padding: 20px;background: purple;border: none;" >Naive Approach</button>
                        <?php }?>

                        <?php if($fetch2 == 1){ ?>
                            <a href="data.php?moving_average&type=2" class="btn btn-primary" style="border-radius: 0;padding: 20px;background: purple;border: none;" >Moving Average</a>
                        <?php }else{ ?>
                        <button   name="moving_average" class="btn btn-primary" style="border-radius: 0;padding: 20px;background: purple;border: none;"  >Moving Average</button>
                        <?php }?>

                       <?php if($fetch6 == 1){ ?>
                            <a href="data.php?exponential_smoothing&type=6" class="btn btn-primary" style="border-radius: 0;padding: 20px;background: purple;border: none;" >Exponential Smoothing</a>
                        <?php }else{ ?>
                        <button class="btn btn-primary" name="exponential_smoothing" style="border-radius: 0;padding: 20px;background: purple;border: none;" >Exponential Smoothing  </button>
                        <?php }?>
                        <br><br>

                        <?php if($fetch4 == 1){ ?>
                            <a href="data.php?holt_method&type=4" class="btn btn-primary" style="border-radius: 0;padding: 20px;background: purple;border: none;" >Holt Method</a>
                        <?php }else{ ?>
                        <button class="btn btn-primary" name="holt_method" style="border-radius: 0;padding: 20px;background: purple;border: none;" >Holt Method</button>
                        <?php }?>

                        <?php if($fetch5 == 1){ ?>
                            <a href="data.php?winter_method&type=5" class="btn btn-primary" style="border-radius: 0;padding: 20px;background: purple;border: none;" >Winter Method</a>
                        <?php }else{ ?>
                        <button class="btn btn-primary" name="winter_method" style="border-radius: 0;padding: 20px;background: purple;border: none;" >Winter Method  </button>
                        <?php }?>
                          
                       
                        </div>
                    </form>
                    <div class="col-lg-2"></div>

                </div>
            </div>
<br>
<br>
<br>
<br>



<?php include 'footer.php'; ?>
