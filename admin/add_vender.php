
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
<li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;">Add New Vender</li>
</ol>
<div class="container-fluid">


<form method="POST" action="" enctype="multipart/form-data">
<div class="row">
<div class="form-group col-md-6 col-xs-6 ">
<label class="form-label" style="font-size:16px !important;">Company <span style="color:red;">*</span></label>
<input type='text' name="company" placeholder="Enter Company" class="form-control"  style="border: 2px solid grey!important;" required>
 
</div>

<div class="form-group col-md-6 col-xs-6 ">
<label class="form-label" style="font-size:16px !important;">Contact Name <span style="color:red;">*</span></label>
<input type='text' name="contact_name" placeholder="Enter Contact name" class="form-control"  style="border: 2px solid grey!important;" required>
 
</div>

<div class="form-group col-md-6 col-xs-6 ">
<label class="form-label" style="font-size:16px !important;">Phone No. <span style="color:red;">*</span></label>
<input type='number' name="phone" placeholder="Enter Phone No." class="form-control"  style="border: 2px solid grey!important;" required>
 
</div>

<div class="form-group col-md-6 col-xs-6 ">
<label class="form-label" style="font-size:16px !important;">Email. <span style="color:red;">*</span></label>
<input type='email' name="email" placeholder="Enter Email." class="form-control"  style="border: 2px solid grey!important;" >
 
</div>


<div class="form-group col-md-6 col-xs-6 ">
<label class="form-label" style="font-size:16px !important;">Address. <span style="color:red;">*</span></label>
<textarea type='text' name="address" placeholder="Enter Address." class="form-control"  style="border: 2px solid grey!important;" required></textarea>
 
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

    $company = mysqli_real_escape_string($db, $_POST['company']);
    $name = mysqli_real_escape_string($db, $_POST['contact_name']);
    $phone = mysqli_real_escape_string($db, $_POST['phone']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $address = mysqli_real_escape_string($db, $_POST['address']);
    $status = mysqli_real_escape_string($db, $_POST['status']);

    $clt_dplc = "SELECT * FROM `venders` WHERE `phone`='$phone' AND `email`='$email'";
    $qst_clt_dplc = $db->query($clt_dplc);
    $ctgy_count = mysqli_num_rows($qst_clt_dplc);

    if($ctgy_count == 0)
    {


        $ad_prdt = "INSERT INTO `venders` SET
            `company`='$company',
            `name`='$name',
            `phone`='$phone',
            `email`='$email',
            `address`='$address',
            `status`='$status',
            `created_by`='$admin_id',
            `added_on`='$timestamp'";

        $qst_ad_prdt = $db->query($ad_prdt);

        if($qst_ad_prdt)
        {
            echo "<script>window.alert('Vendor Added Successfully');window.location='';</script>";
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