<?php
@ob_start();
//session_start();
require_once 'config/config.php';




?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php include 'header.php'; ?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>


<?php

if(isset($_GET['id']))
{
    $ctgy_id=$_GET['id'];

$clt_prdt = "SELECT * FROM `default_price` where `id`='$ctgy_id'";
$qst_clt_prdt=$db->query($clt_prdt);
$clct_clt_prdt=$qst_clt_prdt->fetch_assoc();


$product_id=$clct_clt_prdt['product_id'];
$per_product_price=$clct_clt_prdt['price'];


$cat_query = "select * from `product`";
$cat_exquit = $db->query($cat_query);


}
?>
<div id="layoutSidenav_content">
<main>
<div class="container-fluid">

<ol class="breadcrumb mb-30 mt-2">
<li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;">Edit Price </li>
</ol>
<div class="container-fluid">


<form method="POST" action="" enctype="multipart/form-data">
<div class="row">


<div class="form-group col-md-6 col-xs-6 ">
<label class="form-label" style="font-size:16px !important;"> Select Product <span style="color:red;">*</span></label>
<select name="product" class="form-control"  style="border: 2px solid grey!important;" required>
    <option value="">-Select Product-</option>
    <?php while($cat=$cat_exquit->fetch_assoc()){ ?>
    <option <?php echo ( $cat['id'] == $product_id ) ? 'selected' : ''; ?> value="<?php echo $cat['id'] ?>"> <?php echo $cat['product_name']  ?> </option>
    <?php } ?>

</select>
 
</div>

<div class="form-group col-md-6 col-xs-6 ">
<label class="form-label" style="font-size:16px !important;">Enter Price <span style="color:red;">*</span></label>
<input type='number' name="price" placeholder="Enter Price" class="form-control"  style="border: 2px solid grey!important;" value="<?php echo $per_product_price ?>" required>
 
</div>



<div class="form-group col-md-12" style="margin-top:15px">

<button type='submit' name="submit" class='btn btn-primary'>Submit</button> <a href="view_price.php?target=view_basic_price" class='btn btn-warning'>Back</a>
</div>
</div>
</form>


<?php 
if(isset($_POST['submit']))
{
$product=mysqli_real_escape_string($db , $_POST['product']);
$price=mysqli_real_escape_string($db , $_POST['price']);




$ad_prdt="update `default_price` set

`product_id`='$product',
`price`='$price' where `id`='$ctgy_id'";

$qst_ad_prdt=$db->query($ad_prdt);

if($qst_ad_prdt)
{
echo "<script>window.alert('Price updated Successfully');window.location='';</script>";

}
else
{
    echo "<script>window.alert('Error');window.location='';</script>";
}


}
?>


</div>
</div>
</main>




<?php include 'footer.php'; 
?>


<script>




$(document).ready(function() { 
 $("#ddsd").select2();
});
</script>


<script>
CKEDITOR.replace( 'descptn' );
CKEDITOR.replace( 'short_descptn' );

</script>

<?php
ob_flush();

?>