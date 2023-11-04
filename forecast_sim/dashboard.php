<?php

include('header.php');
error_reporting(E_ALL ^ E_NOTICE);

?>



<div class="page-container ">
   <!--/content-inner-->
    <div class="left-content">


    <!--working-->

    
        <div class="w3-agile-chat">
                <div class="charts">
                    <div class="col-md-12 w3layouts-char">
                    
                        <div class="charts-grids widget">   
                            
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-8">
                                    <form action="assets/data/session/active.php" method="post">
                                    
                                    <select name="session" class="form-control" required>
                                        <option value="" disabled selected>--Select Session--</option>
                                        <?php
                                        $query="SELECT * FROM `session` order by id desc;";
                                        $rec=mysqli_query($con,$query);
                                        while($row=mysqli_fetch_array($rec)){
                                            echo '<option value="'.$row['id'].'">'.$row['des'].' - '.$row['status'].'</option>';
                                            
                                        }
                                        ?>
                                    </select>
                                    <br>
                                   <button type="submit" name="btnactive" class="btn btn-success">Active</button>
                           <button type="submit" name="btnsave" class="btn btn-primary">Inactive</button>
                        </form>
                                    </form>
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                            <br>
                            <br>
                            
                            <div class="row">
                                
                                <div class="col-md-12">
                                    <table class="table table-stripped">
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
                                                <?php
                                                if($row['status']!='Active'){
                                                    
                                                
                                                ?>
                                                    <a onclick="return checkdelete()" href="assets/data/session/delete.php?id=<?php echo $row['id'];?>&login=<?php echo $row['coach_id']; ?>" class="btn btn-delete"><span class="fa fa-trash"></span></a>
                                                <?php
                                                }
                                                ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        
                                        ?>
                                    </table>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>          
        </div>

<div class="copyrights">
     <p>Copyright © 2023 Powered by <a href="https://simulationsx.com/" target="_blank">Simulations Xperience Pvt. Ltd.</a>. All Rights Reserved   </p>
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