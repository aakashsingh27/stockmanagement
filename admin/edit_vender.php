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

$clt_prdt = "SELECT * FROM `venders` where `id`='$ctgy_id'";
$qst_clt_prdt=$db->query($clt_prdt);
$clct_clt_prdt=$qst_clt_prdt->fetch_assoc();

$company=$clct_clt_prdt['company'];
$name=$clct_clt_prdt['name'];
$phone=$clct_clt_prdt['phone'];
$email=$clct_clt_prdt['email'];
$address=$clct_clt_prdt['address'];
$status=$clct_clt_prdt['status'];

}
?>
<div id="layoutSidenav_content">
<main>
<div class="container-fluid">

<ol class="breadcrumb mb-30 mt-2">
<li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;">Edit Vendor </li>
</ol>
<div class="container-fluid">


<form method="POST" action="" enctype="multipart/form-data">
<div class="row">
<div class="form-group col-md-6 col-xs-6 ">
<label class="form-label" style="font-size:16px !important;">Company <span style="color:red;">*</span></label>
<input type='text' name="company" value="<?php echo $company ?>" placeholder="Enter Company" class="form-control"  style="border: 2px solid grey!important;" required>
 
</div>

<div class="form-group col-md-6 col-xs-6 ">
<label class="form-label" style="font-size:16px !important;">Contact Name <span style="color:red;">*</span></label>
<input type='text'  value="<?php echo $name ?>" name="contact_name" placeholder="Enter Contact name" class="form-control"  style="border: 2px solid grey!important;" required>
 
</div>

<div class="form-group col-md-6 col-xs-6 ">
<label class="form-label" style="font-size:16px !important;">Phone No. <span style="color:red;">*</span></label>
<input type='number' name="phone"  value="<?php echo $phone ?>" placeholder="Enter Phone No." class="form-control"  style="border: 2px solid grey!important;" required>
 
</div>

<div class="form-group col-md-6 col-xs-6 ">
<label class="form-label" style="font-size:16px !important;">Email. <span style="color:red;">*</span></label>
<input type='email' name="email"  value="<?php echo $email ?>" placeholder="Enter Email." class="form-control"  style="border: 2px solid grey!important;" >
 
</div>


<div class="form-group col-md-6 col-xs-6 ">
<label class="form-label" style="font-size:16px !important;">Address. <span style="color:red;">*</span></label>
<textarea type='text' name="address" placeholder="Enter Address." class="form-control"  style="border: 2px solid grey!important;" required><?php echo $address ?></textarea>
 
</div>

<div class="form-group col-md-6 col-xs-6 ">
<label class="form-label" style="font-size:16px !important;">Status <span style="color:red;">*</span></label>
<select name="status" class="form-control" style="border: 2px solid grey!important;" required>
    <option value="">Select Status</option>
    <option value="enable" <?php echo ($status == 'enable') ? 'selected' : ''; ?>>Enable</option>
    <option value="disable" <?php echo ($status == 'disable') ? 'selected' : ''; ?>>Disable</option>
</select>

 
</div>



<div class="form-group col-md-12" style="margin-top:15px">

<button type='submit' name="submit" class='btn btn-primary'>Submit</button> <a href="view_venders.php" class='btn btn-warning'>Back</a>
</div>
</div>
</form>


<?php 
if(isset($_POST['submit']))
{
    $company = mysqli_real_escape_string($db, $_POST['company']);
    $name = mysqli_real_escape_string($db, $_POST['contact_name']);
    $phone = mysqli_real_escape_string($db, $_POST['phone']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $address = mysqli_real_escape_string($db, $_POST['address']);
    $status = mysqli_real_escape_string($db, $_POST['status']);


$ad_prdt="update `venders` set
            `company`='$company',
            `name`='$name',
            `phone`='$phone',
            `email`='$email',
            `address`='$address',
            `status`='$status' where `id`='$ctgy_id'";

$qst_ad_prdt=$db->query($ad_prdt);

if($qst_ad_prdt)
{
echo "<script>window.alert('Vender updated Successfully');window.location='';</script>";

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