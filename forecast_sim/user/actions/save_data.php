<?php 

include '../../db/php';
session_start();

$fm=mysqli_query($con,"select * from months where session_id = '".$session_id."' && m_crash = 0 ");
  while($sm=mysqli_fetch_array($fm)){
	if(isset($_POST['btn_save'.$sm['m_id']])){

    echo $var1 = $_POST['var1'];
    echo $var2 = $_POST['var2'];
    echo $var3 = $_POST['var3'];
    echo $month_id = $_POST['month_id'];

    echo $ordered_unit = $_POST['ordered_unit'];
    exit();
}
  }
	
 ?>