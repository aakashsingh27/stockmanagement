<?php 
include('config/config.php');

$vendor_id = $_GET['id'];

$clt_prdt_cnt = "select * from `stock_quantity` where `vendor_id`='$vendor_id'";
$qst_clt_prdt_cnt=$db->query($clt_prdt_cnt);

$clt_count=mysqli_num_rows($qst_clt_prdt_cnt);
if($clt_count==0)
{


$dlt_vndr="delete from `venders` where `id`='$vendor_id'";
$qst_dlt_vndr=$db->query($dlt_vndr);
if($qst_dlt_vndr)
{
    echo "<script>window.alert('Vendor deleted successfully');window.location='view_venders.php?target=view_vendor';</script>";
}
}
else
{
    echo "<script>window.alert('This vendor entry is already exist in stock quantity please try again');window.location='view_venders.php?target=view_vendor';</script>";
}
?>