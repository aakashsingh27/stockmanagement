<?php 
include('config/config.php');

$prdt_id=$_GET['id'];

$chk_stk_qnty="select * from `stock_quantity` where `product_id`='$prdt_id'";
$qst_chk_stk_qnty=$db->query($chk_stk_qnty);
$stk_cnt=mysqli_num_rows($qst_chk_stk_qnty);

if($stk_cnt==0)
{
$dlt_prdt="delete from `product` where `id`='$prdt_id'";
$qst_dlt_prdt=$db->query($dlt_prdt);

if($qst_dlt_prdt)
{
    echo "<script>window.location='view_product.php?target=view_product';window.alert('Product deleted successfullt');</script>";
}
}
else
{
    echo "<script>window.alert('This product entry is already exist in stock entry firstly delete from there');window.location='view_product.php?target=view_product';</script>";
}
?>