<?php
@ob_start();

include("config/config.php");
$usr_id = $_SESSION['a_id'];
$product_id=$_POST['txt1'];


if($usr_id==1)
{
$clt_stk_count="select sum(`quantity`) as `stock_qty` from `stock_quantity` where `product_id`='$product_id'";
$qst_clt_stk_count=$db->query($clt_stk_count);
$clct_clt_stk_count=$qst_clt_stk_count->fetch_assoc();

$stk_qty = $clct_clt_stk_count['stock_qty'];

$ttl_assign_qty = "select sum(`qty`) as `assign_quantity` from `assign_product` where `product_id`='$product_id'";
$qst_ttl_assign_qty=$db->query($ttl_assign_qty);
$clct_ttl_assign_qty=$qst_ttl_assign_qty->fetch_assoc();

$asg_qty = $clct_ttl_assign_qty['assign_quantity'];

$main_qunty = $stk_qty-$asg_qty;

if($main_qunty==0 or $main_qunty =="")
{
    echo json_encode(['status'=>1, 'response'=>0,'color'=>'red']);
}
else
{
    
echo json_encode(['status'=>1, 'response'=>$main_qunty, 'assign_qty'=>$asg_qty, 'color'=>'black']);
}

}
else
{
$ttl_assign_qty = "select sum(`qty`) as `assign_quantity` from `assign_product` where `product_id`='$product_id' and `assign_user_id`='$usr_id'";
$qst_ttl_assign_qty=$db->query($ttl_assign_qty);
$clct_ttl_assign_qty=$qst_ttl_assign_qty->fetch_assoc();

$asg_qty = $clct_ttl_assign_qty['assign_quantity'];



$assgn_cont = "select * from `assign_product` where `created_by`='$usr_id' and `product_id`='$product_id' ";
$qst_assgn_cont=$db->query($assgn_cont);
$asgn_count= mysqli_num_rows($qst_assgn_cont);


$assgn_sum = "select sum(`qty`) as `assgn_qnty` from `assign_product` where `created_by`='$usr_id' and `product_id`='$product_id' ";
$qst_assgn_sum=$db->query($assgn_sum);
$clct_assgn_sum=$qst_assgn_sum->fetch_assoc();

$asg_quantity = $clct_assgn_sum['assgn_qnty'];

$main_qntiy = $asg_qty-$asg_quantity;





if($asgn_count==0)
{
if($asg_qty==0 or $asg_qty =="")
{
    echo json_encode(['status'=>1, 'response'=>0,'color'=>'red']);
}
else
{
    
echo json_encode(['status'=>1, 'response'=>$asg_qty, 'assign_qty'=>0, 'color'=>'black']); 
}
    
}
else
{
    if($asg_qty==0 or $asg_qty =="")
{
    echo json_encode(['status'=>1, 'response'=>0,'color'=>'red']);
}
else
{
    
echo json_encode(['status'=>1, 'response'=>$main_qntiy, 'assign_qty'=>$asg_quantity, 'color'=>'black']);
}
}
}
    

ob_flush();
?>




