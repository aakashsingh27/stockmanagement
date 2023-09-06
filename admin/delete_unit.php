<?php 
include("config/config.php");

$unt_id = $_GET['id'];



$clt_unt_dtl="select * from `product` where `unit_id`='$unt_id'";
$qst_clt_unt_dtl=$db->query($clt_unt_dtl);
$cprdt_cnt = mysqli_num_rows($qst_clt_unt_dtl);
if($cprdt_cnt==0)
{

$dlt_unit="delete from `unit` where `id`='$unt_id'";
$qst_dlt_unit=$db->query($dlt_unit);
if($qst_dlt_unit)
{
    echo "<script>window.alert('Unit Deleted successfully');window.location='manage_unit.php?target=view_unit';</script>";
}
}
else
{
    echo "<script>window.alert('This unit is already assigned to product first delete the product then delete this category');window.location='manage_unit.php?target=view_unit';</script>";
}
?>