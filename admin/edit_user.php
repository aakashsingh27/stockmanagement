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
$permission = $db->query("select * from `roles_and_permission`");
$clt_prdt = "SELECT * FROM `user` where `id`='$ctgy_id'";
$qst_clt_prdt=$db->query($clt_prdt);
$clct_clt_prdt=$qst_clt_prdt->fetch_assoc();

$name=$clct_clt_prdt['name'];
$username=$clct_clt_prdt['username'];
$role_id=$clct_clt_prdt['role_id'];

$company=$clct_clt_prdt['company'];
$contact=$clct_clt_prdt['contact'];
$address=$clct_clt_prdt['address'];

$password=$clct_clt_prdt['without_md5_pwd'];
$status=$clct_clt_prdt['status'];

}
?>
<div id="layoutSidenav_content">
<main>
<div class="container-fluid">

<ol class="breadcrumb mb-30 mt-2">
<li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;">Edit User </li>
</ol>
<div class="container-fluid">


<form method="POST" action="" enctype="multipart/form-data">
<div class="row">
    
    
       
    <div class="form-group col-md-6 col-xs-6 ">
<label class="form-label" style="font-size:16px !important;">Company Name<span style="color:red;"></span></label>
<input type='text' name="company" value="<?php echo $company ?>" placeholder="Enter Company" class="form-control"  style="border: 2px solid grey!important;">
 
</div>


<div class="form-group col-md-6 col-xs-6 ">
<label class="form-label" style="font-size:16px !important;">Name <span style="color:red;">*</span></label>
<input type='text' name="name" placeholder="Enter name" class="form-control"  style="border: 2px solid grey!important;" value="<?php echo $name ?>" required>
 
</div>

<div class="form-group col-md-6 col-xs-6 ">
<label class="form-label" style="font-size:16px !important;">Username <span style="color:red;">*</span></label>
<input type='text' name="username" placeholder="Enter Category name" class="form-control" value="<?php echo $username ?>"  style="border: 2px solid grey!important;" required>
 
</div>

<div class="form-group col-md-6 col-xs-6 ">
<label class="form-label" style="font-size:16px !important;">Contact No.<span style="color:red;"></span></label>
<input type='text' name="contact" value="<?php echo $contact ?>" placeholder="Enter Contact Name" class="form-control"  style="border: 2px solid grey!important;" required>
 
</div>

<div class="form-group col-md-6 col-xs-6 ">
<label class="form-label" style="font-size:16px !important;">Select Role <span style="color:red;">*</span></label>
<select  name="role" class="form-control"  style="border: 2px solid grey!important;" required>
      <option value="">Select Role</option>
       <?php while($role = $permission->fetch_assoc()){ ?>
       <option <?php echo ($role['id'] == $role_id) ? 'selected' : ''; ?> value="<?php echo $role['id'] ?>"><?php echo $role['roles_name'] ?></option>
       <?php } ?>
    
</select>
 
</div>


<div class="form-group col-md-6 col-xs-6 ">
<label class="form-label" style="font-size:16px !important;">Password <span style="color:red;">*</span></label>
<input type='text' name="password" placeholder="Enter Category name" class="form-control" value="<?php echo $password ?>" style="border: 2px solid grey!important;" required>
 
</div>

<div class="form-group col-md-6 col-xs-6 ">
<label class="form-label" style="font-size:16px !important;">Enter Address <span style="color:red;">*</span></label>
<textarea type='text' name="address" placeholder="Enter Address" class="form-control"  style="border: 2px solid grey!important;" required><?php echo $address ?></textarea>
 
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

<button type='submit' name="submit" class='btn btn-primary'>Submit</button> <a href="view_users.php" class='btn btn-warning'>Back</a>
</div>
</div>
</form>


<?php 
if(isset($_POST['submit']))
{
$name=mysqli_real_escape_string($db , $_POST['name']);
$username=mysqli_real_escape_string($db , $_POST['username']);
$password=mysqli_real_escape_string($db , $_POST['password']);
$status=mysqli_real_escape_string($db , $_POST['status']);
$role=mysqli_real_escape_string($db , $_POST['role']);
$company=mysqli_real_escape_string($db , $_POST['company']);
$contact=mysqli_real_escape_string($db , $_POST['contact']);
$address=mysqli_real_escape_string($db , $_POST['address']);
 


$ad_prdt="update `user` set
`name`='$name',
`company`='$company',
`contact`='$contact',
`address`='$address',
`role_id`='$role',
`username`='$username',
`password`=md5('$password'),
`status`='$status',
`without_md5_pwd`='$password' where `id`='$ctgy_id'";

$qst_ad_prdt=$db->query($ad_prdt);

if($qst_ad_prdt)
{
echo "<script>window.alert('User updated Successfully');window.location='';</script>";

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