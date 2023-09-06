
<?php
@ob_start();
//session_start();
require_once 'config/config.php';
date_default_timezone_set("Asia/Kolkata");
$cr_dt_ymd=date('Y-m-d');
if(isset($_GET['id']))
{
$iid=$_GET['id'];

    $clt_dtl="select * from `set_product_price` where `id`='$iid'";
    $qst_clt_dtl=$db->query($clt_dtl);
    $clct_clt_dtl=$qst_clt_dtl->fetch_assoc();
    
    $prdt_id = $clct_clt_dtl['product_id'];
    $cst_id = $clct_clt_dtl['customer_id'];
    $prc = $clct_clt_dtl['price'];
    
    $cstm_dtl = "select * from `user` where `id`='$cst_id'";
    $qst_cstm_dtl = $db->query($cstm_dtl);
    $clct_cstm_dtl=$qst_cstm_dtl->fetch_assoc();
    
    $cstrm_neme = $clct_cstm_dtl['name'];
    
    
    
    $clt_prdt= "select * from `product` where `id`='$prdt_id'";
    $qst_clt_prdt=$db->query($clt_prdt);
    $clct_clt_prdt=$qst_clt_prdt->fetch_assoc();
    
    $prdt_neme = $clct_clt_prdt['product_name'];
    
    
    
    
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php include 'header.php'; ?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>

<div id="layoutSidenav_content">
<main>
<div class="container-fluid">

<ol class="breadcrumb mb-30 mt-2">
<li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;">Add product sale price</li>
</ol>
<div class="container-fluid">


<form method="POST" action="" enctype="multipart/form-data">
<div class="row">

<div class="form-group col-md-6 col-xs-6 ">
<label class="form-label" style="font-size:16px !important;">Users <span style="color:red;">*</span></label>
<select name="user_id" id="assgn_usr" class="form-control"  style="border: 2px solid grey!important;" required>
 <option value="<?php echo $cst_id;?>"><?php echo $cstrm_neme?></option>
 
    <?php 
    $cstms_dtl = "select * from `user` where `id`!='$cst_id'";
    $qst_cstm_sdtl = $db->query($cstms_dtl);
    while($clct_scstm_dtl=$qst_cstm_sdtl->fetch_assoc())
    {
    $ccst_id= $clct_scstm_dtl['id'];
    $ccst_nemee= $clct_scstm_dtl['name'];
    ?>
    <option value="<?php echo $ccst_id;?>"><?php echo $ccst_nemee?></option>
    <?php
    }
    ?>
 
 
 </select>
</div>

<div class="form-group col-md-6 col-xs-6 ">
<label class="form-label" style="font-size:16px !important;">Choose product <span style="color:red;">*</span></label>
<select name="product_id" id="prdrt_id" class="form-control"  style="border: 2px solid grey!important;" required>
<option value="<?php echo $prdt_id;?>"><?php echo $prdt_neme;?></option>

<?php 
$clt_prdt="select * from `product` where `id`!='$prdt_id'";
$qst_clt_prdt=$db->query($clt_prdt);
while($clct_clt_prdt=$qst_clt_prdt->fetch_assoc())
{
    $predt_neme = $clct_clt_prdt['product_name'];
     $predt_id = $clct_clt_prdt['id'];
    ?>
    
    <option value="<?php echo $predt_id;?>"><?php echo $predt_neme;?></option>
    <?php
}
?>
</select>
 
</div>

<div class="form-group col-md-6 col-xs-6 ">
<label class="form-label" style="font-size:16px !important;">Price. <span style="color:red;">*</span></label>
<input type='number' name="price" placeholder="Enter Price" value="<?php echo $prc;?>" class="form-control"  style="border: 2px solid grey!important;" >
 
</div>



<div class="form-group col-md-4">
<label class="form-label" style="font-size:16px !important;"><span style="color:white;">.</span></label><br>
<button type='submit' name="submit" class='btn btn-primary mt-2'>Submit</button>
</div>
</div>
</form>

<?php 
if(isset($_POST['submit']))
{
    // Assuming the database connection is already established and stored in the variable $db.

    $usr_iid = mysqli_real_escape_string($db, $_POST['user_id']);
    $prdt_iid = mysqli_real_escape_string($db, $_POST['product_id']);
    $prece = mysqli_real_escape_string($db, $_POST['price']);
   
 
        $ad_prdt = "update `set_product_price` SET
            `product_id`='$prdt_iid',
            `price`='$prece',
            `customer_id`='$usr_iid' where `id`='$iid'";

        $qst_ad_prdt = $db->query($ad_prdt);

        if($qst_ad_prdt)
        {
            echo "<script>window.alert('Product price is updated Successfully');window.location='';</script>";
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
function get_user(txt)
{
  $.ajax
(
{
url: "user_data_ajax.php",
type: "POST",
data    : {txt1:txt},
cache: false,
success: function(data)
{

$('#assgn_usr').html(data);

}
}
);
}

$(document).ready(function() { 
 $("#assgn_usr , #role_id , #prdrt_id").select2();
});
</script>


<script>
CKEDITOR.replace( 'descptn' );
CKEDITOR.replace( 'short_descptn' );
</script>

<?php
ob_flush();

?>