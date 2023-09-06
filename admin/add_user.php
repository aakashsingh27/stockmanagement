<?php
@ob_start();
//session_start();
require_once 'config/config.php';
date_default_timezone_set("Asia/Kolkata");
$cr_dt_ymd=date('Y-m-d');

$permission1 = $db->query("select * from `roles_and_permission`")

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
<li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;">Add New User</li>
</ol>
<div class="container-fluid">


<form method="POST" action="" enctype="multipart/form-data">
<div class="row">
    
    
    <div class="form-group col-md-6 col-xs-6 ">
<label class="form-label" style="font-size:16px !important;">Company Name<span style="color:red;"></span></label>
<input type='text' name="company" placeholder="Enter Company" class="form-control"  style="border: 2px solid grey!important;">
 
</div>
    
<div class="form-group col-md-6 col-xs-6 ">
<label class="form-label" style="font-size:16px !important;">Name <span style="color:red;">*</span></label>
<input type='text' name="name" placeholder="Enter name" class="form-control"  style="border: 2px solid grey!important;" required>
 
</div>

<div class="form-group col-md-6 col-xs-6 ">
<label class="form-label" style="font-size:16px !important;">Username <span style="color:red;">*</span></label>
<input type='text' name="username" placeholder="Enter Username" class="form-control"  style="border: 2px solid grey!important;" required>
 
</div>


<div class="form-group col-md-6 col-xs-6 ">
<label class="form-label" style="font-size:16px !important;">Contact No.<span style="color:red;"></span></label>
<input type='text' name="contact" placeholder="Enter Contact Name" class="form-control"  style="border: 2px solid grey!important;" required>
 
</div>

<div class="form-group col-md-6 col-xs-6 ">
<label class="form-label" style="font-size:16px !important;">Password <span style="color:red;">*</span></label>
<input type='text' name="password" placeholder="Enter Password" class="form-control"  style="border: 2px solid grey!important;" required>
 
</div>

<div class="form-group col-md-6 col-xs-6 ">
<label class="form-label" style="font-size:16px !important;">Select Role <span style="color:red;">*</span></label>
<select  name="role" class="form-control"  style="border: 2px solid grey!important;" required>
      <option value="">Select Role</option>
       <?php while($role = $permission1->fetch_assoc()){ ?>
       <option value="<?php echo $role['id'] ?>"><?php echo $role['roles_name'] ?></option>
       <?php } ?>
    
</select>
 
</div>

<div class="form-group col-md-6 col-xs-6 ">
<label class="form-label" style="font-size:16px !important;">Enter Address <span style="color:red;">*</span></label>
<textarea type='text' name="address" placeholder="Enter Address" class="form-control"  style="border: 2px solid grey!important;" required></textarea>
 
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

<button type='submit' name="submit" class='btn btn-primary mt-2'>Submit</button>
</div>
</div>
</form>


<?php 
if(isset($_POST['submit']))
{

$name=mysqli_real_escape_string($db , $_POST['name']);
$username=mysqli_real_escape_string($db , $_POST['username']);
$password=mysqli_real_escape_string($db , $_POST['password']);
$role=mysqli_real_escape_string($db , $_POST['role']);
$status=mysqli_real_escape_string($db , $_POST['status']);


$company=mysqli_real_escape_string($db , $_POST['company']);
$contact=mysqli_real_escape_string($db , $_POST['contact']);
$address=mysqli_real_escape_string($db , $_POST['address']);
 



$clt_dplc="select * from `user` where `username`='$username'";
$qst_clt_dplc=$db->query($clt_dplc);
$ctgy_count=mysqli_num_rows($qst_clt_dplc);

if($ctgy_count==0)
{
$ad_prdt="insert into `user` set
`name`='$name',
`company`='$company',
`contact`='$contact',
`address`='$address',
`username`='$username',
`role_id`='$role',
`password`=md5('$password'),
`status`='$status',
`created_by`='$admin_id',
`without_md5_pwd`='$password',
`added_on`='$timestamp'";


$qst_ad_prdt=$db->query($ad_prdt);

if($qst_ad_prdt)
{
echo "<script>window.alert('User Added Successfully');window.location='';</script>";

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