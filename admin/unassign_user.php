<?php 
include('config/config.php');

if(isset($_GET['id']))
{
$iid=$_GET['id'];
$uassign="delete from `assign_product` where `id`='$iid'";
$qst_uassign=$db->query($uassign);
if($qst_uassign)
{

    echo "<script>window.location='view_assign_product.php';window.alert('Unassign successfully');</script>";
}
}
?>