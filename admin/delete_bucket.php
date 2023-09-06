<?php 
include('config/config.php');

$buckt_id = $_GET['id'];

$dlt_bkct="delete from `product_bucket` where `id`='$buckt_id'";
$qst_dlt_bkct=$db->query($dlt_bkct);
if($qst_dlt_bkct)
{
    echo "<script>window.location='view_bucket.php?target=view_bucket';window.alert('Bucket Deleted successfully');</script>";
}

?>