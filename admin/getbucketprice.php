<?php

@ob_start();
//session_start();
require_once 'config/config.php';
date_default_timezone_set("Asia/Kolkata");
$cr_dt_ymd=date('Y-m-d');


if (isset($_POST['txt1'])) {
    $id = $_POST['txt1'];
    $buketlist = $db->query("SELECT * FROM `product_bucket` WHERE `id`='$id'");
    $bucket_data = $buketlist->fetch_assoc();
    $product_id_array = $bucket_data['product_id']; 
    $quantity_id_array = $bucket_data['product_qty']; 
    $product_explode = explode(',',$product_id_array);
    $quantity_explode = explode(',',$quantity_id_array);
    $price_total=0; 
    $i=0;
    foreach($product_explode as $list){
          $price_ = $db->query("SELECT sum(`price`) as total_price FROM `default_price` WHERE `product_id`='$list'");
          $price_sum = $price_->fetch_assoc();
        
          $price_total+= $price_sum['total_price'] * $quantity_explode[$i];
        
          $i++;
          }
          echo json_encode(['prec'=>$price_total]);
  }
  ob_flush();
  ?>
