
<?php
@ob_start();
//session_start();
require_once 'config/config.php';
date_default_timezone_set("Asia/Kolkata");
$cr_dt_ymd=date('Y-m-d');

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
<label class="form-label" style="font-size:16px !important;">Role <span style="color:red;">*</span></label>
<select name="role" id="role_id" class="form-control"  onchange="get_user(this.value)" style="border: 2px solid grey!important;" required>
 <option value="">Choose Role</option>

<?php 
$clt_rle = "select * from `roles_and_permission`";
$qst_clt_rle=$db->query($clt_rle);
while($clct_clt_rle=$qst_clt_rle->fetch_assoc())
{
$role_id=$clct_clt_rle['id'];
$role_name=$clct_clt_rle['roles_name'];

?>
<option value="<?php echo $role_id;?>"><?php echo $role_name;?></option>
<?php
}
?>


 </select>
</div>

<div class="form-group col-md-6 col-xs-6 ">
<label class="form-label" style="font-size:16px !important;">Users <span style="color:red;">*</span></label>
<select name="user_id" id="assgn_usr" class="form-control"  style="border: 2px solid grey!important;" required>
 <option value="">Choose User</option>
 </select>
</div>

<div class="form-group col-md-6 col-xs-6 ">
<label class="form-label" style="font-size:16px !important;">Choose product <span style="color:red;">*</span></label>
<select name="product_id" id="prdrt_id" class="form-control"  style="border: 2px solid grey!important;" required>
<option value="">Choose product</option>

<?php 
$clt_prdt="select * from `product`";
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
<input type='number' name="price" placeholder="Enter Price" class="form-control"  style="border: 2px solid grey!important;" >
 
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
   
    $clt_dplc = "SELECT * FROM `set_product_price` WHERE `customer_id`='$usr_iid' AND `product_id`='$prdt_iid'";
    $qst_clt_dplc = $db->query($clt_dplc);
    $ctgy_count = mysqli_num_rows($qst_clt_dplc);

    if($ctgy_count == 0)
    {
        $ad_prdt = "INSERT INTO `set_product_price` SET
            `product_id`='$prdt_iid',
            `price`='$prece',
            `customer_id`='$usr_iid',
            `assign_by_id`='$admin_id'";

        $qst_ad_prdt = $db->query($ad_prdt);

        if($qst_ad_prdt)
        {
            echo "<script>window.alert('Product price is assigned Successfully');window.location='';</script>";
        }
        else
        {
            echo "<script>window.alert('Error');window.location='';</script>";
        }
    }
    else
    {
        echo "<script>window.alert('This User is already exist please try again');window.location='';</script>";
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