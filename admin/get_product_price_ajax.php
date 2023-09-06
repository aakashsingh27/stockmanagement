<?php 
include("config/config.php");

$prdt_id=$_POST['txt1'];

$clt_prdt_prc="select distinct `per_product_price` from `stock_quantity` where `product_id`='$prdt_id' and `per_product_price`!=''";
$qst_clt_prdt_prc=$db->query($clt_prdt_prc);
?>
<option value="">Choose Price</option>
<?php
while($clct_clt_prdt_prc=$qst_clt_prdt_prc->fetch_assoc())
{
$prec = $clct_clt_prdt_prc['per_product_price'];
?>
<option value="<?php echo $prec;?>"><?php echo $prec;?></option>
<?php
}
?>