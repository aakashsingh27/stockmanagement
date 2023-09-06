
<?php
@ob_start();
//session_start();
require_once 'config/config.php';
date_default_timezone_set("Asia/Kolkata");
$cr_dt_ymd=date('Y-m-d');

$query ="select * from `category`";
$category = $db->query($query);

$query1 ="select * from `unit`";
$unit = $db->query($query1);

$query2 ="select * from `venders`";
$venders = $db->query($query2);

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
<li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;">Add New Product</li>
</ol>
<div class="container-fluid">


<form method="POST" action="" enctype="multipart/form-data">
<div class="row">
<div class="form-group col-md-12 col-xs-12 ">
<label class="form-label" style="font-size:16px !important;">Enter Product Name <span style="color:red;">*</span></label>
<input type='text' name="product" placeholder="Enter Product Name" class="form-control"  style="border: 2px solid grey!important;" required>
 
</div>

<div class="form-group col-md-6 col-xs-6 ">
<label class="form-label" style="font-size:16px !important;"> Select Category <span style="color:red;">*</span></label>
<select name="category_id" class="form-control"  style="border: 2px solid grey!important;" required>
    <option value="">-Select Category-</option>
    <?php while($cat=$category->fetch_assoc()){ ?>
    <option value="<?php echo $cat['id'] ?>"> <?php echo $cat['name']  ?> </option>
    <?php } ?>

</select>
 
</div>

<div class="form-group col-md-6 col-xs-6 ">
<label class="form-label" style="font-size:16px !important;">Select Unit<span style="color:red;">*</span></label>
<select name="unit_id" class="form-control"  style="border: 2px solid grey!important;" required>
    <option value="">-Select Unit-</option>
    <?php while($un=$unit->fetch_assoc()){ ?>
    <option value="<?php echo $un['id'] ?>"> <?php echo $un['name']  ?> </option>
    <?php } ?>

</select>

</div>





<div class="form-group col-md-6 col-xs-6 ">
<label class="form-label" style="font-size:16px !important;">Status <span style="color:red;">*</span></label>
<select  name="status" class="form-control"  style="border: 2px solid grey!important;" required>
      <option value="">Select Status</option>
    <option value="enable">Enable</option>
      <option value="disable">Disable</option>
    
</select>
 
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

    $product = mysqli_real_escape_string($db, $_POST['product']);
    $category_id = mysqli_real_escape_string($db, $_POST['category_id']);
    $unit_id = mysqli_real_escape_string($db, $_POST['unit_id']);
    $status = mysqli_real_escape_string($db, $_POST['status']);

    $clt_dplc = "SELECT * FROM `product` WHERE `product_name`='$product'";
    $qst_clt_dplc = $db->query($clt_dplc);
    $ctgy_count = mysqli_num_rows($qst_clt_dplc);

    if($ctgy_count == 0)
    {


        $ad_prdt = "INSERT INTO `product` SET
            `product_name`='$product',
            `category_id`='$category_id',
            `unit_id`='$unit_id',
            `status`='$status',
            `created_by`='$admin_id',
            `added_on`='$timestamp'";

        $qst_ad_prdt = $db->query($ad_prdt);

        if($qst_ad_prdt)
        {
            echo "<script>window.alert('Product Added Successfully');window.location='';</script>";
        }
        else
        {
            echo "<script>window.alert('Error');window.location='';</script>";
        }
    }
    else
    {
        echo "<script>window.alert('This Product is already exist please try again');window.location='';</script>";
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