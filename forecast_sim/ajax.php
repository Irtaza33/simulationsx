<?php

include 'db.php';
session_start();

if (isset($_POST['type']) && isset($_POST['parent_id'])) {
  $type = $_POST['type'];
  $parent_id = $_POST['parent_id'];
    $company = '';

  if ($type === 'category') {
    $_SESSION['company'] =   $parent_id;
    $select_cat= mysqli_query($con,"select * from sku_unit 
      JOIN category on category.cat_id = sku_unit.category_id 
     where company_id = '".$parent_id."' GROUP BY category_id");
    while ($row=mysqli_fetch_array($select_cat)) {
      
    $categories = '<option value="'.$row['cat_id'].'">'.$row['cat_name'].'</option>';
    echo $categories;
    }

  } elseif ($type === 'brand') {
    
    $select_br= mysqli_query($con,"select * from sku_unit 
      JOIN brand on brand.brand_id = sku_unit.brand_id 

     where category_id = '".$parent_id."' AND company_id = '".$_SESSION['company']."' GROUP by sku_unit.brand_id ");
    while ($row=mysqli_fetch_array($select_br)) {
      
    $brand = '<option value="'.$row['brand_id'].'">'.$row['brand_name'].'</option>';
    echo $brand;
   
  }
  }
   elseif ($type === 'sku') {
      
    $select_sku= mysqli_query($con,"select * from sku_unit 
     where brand_id = '".$parent_id."' AND company_id = '".$_SESSION['company']."' ");
    while ($row=mysqli_fetch_array($select_sku)) {
      
    $sku = '<option value="'.$row['sku_id'].'">'.$row['sku_des'].'</option>';
    echo $sku;
  }}
}
?>
