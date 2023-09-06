<?php 
include('config/config.php');


$prdt_id=$_POST['txt2'];
$prdt_prec=$_POST['txt1'];

$clt_qnty="select sum(`quantity`) as `prdt_qty` from `stock_quantity` where `product_id`='$prdt_id' and `per_product_price`='$prdt_prec'";
$qst_clt_qnty=$db->query($clt_qnty);
$clct_qnnnty = $qst_clt_qnty->fetch_assoc();

$prdt_qty = $clct_qnnnty['prdt_qty'];
if($prdt_qty!='')
{
echo json_encode(['status'=>1,'response'=>$prdt_qty]);
}
else
{
    echo json_encode(['status'=>1,'response'=>0]);
}
?>