<?php 
include('config/config.php');

$prdt_id=$_POST['txt1'];
$user_id=$_POST['txt2'];

$clt_chk_prdt_st_price = "select * from `set_product_price` where `product_id`='$prdt_id' and `customer_id`='$user_id'";
$qst_clt_chk_prdt_st_price=$db->query($clt_chk_prdt_st_price);
$prdt_asgn_count = mysqli_num_rows($qst_clt_chk_prdt_st_price);

if($prdt_asgn_count == 0)
{
    $clt_prdt_dflt_prce="select * from `default_price` where `product_id`='$prdt_id'";
    $qst_clt_prdt_dflt_prce=$db->query($clt_prdt_dflt_prce);
    $clct_clt_prdt_dflt_prce=$qst_clt_prdt_dflt_prce->fetch_assoc();
    
    $sale_price= $clct_clt_prdt_dflt_prce['price'];
    echo json_encode(['status'=>1,'response'=>$sale_price]);
}
else
{
    $clct_get_prdt_perec = $qst_clt_chk_prdt_st_price->fetch_assoc();
    
    $sale_price=$clct_get_prdt_perec['price'];
    echo json_encode(['status'=>1,'response'=>$sale_price]);
}
?>