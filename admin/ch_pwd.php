<?php
@ob_start();
//session_start();
require_once 'config/config.php';
require_once 'config/helper.php';

?>

<?php include 'header.php'; ?>
<?php

?>
<div id="layoutSidenav_content">
<main>
<div class="container-fluid">
<h2 class="mt-30 page-title">Change Password</h2>
<ol class="breadcrumb mb-30">
<li class="breadcrumb-item active">Change Password</li>
</ol>

  
  
  
  
  <div class="card-body">
<form action='' method='POST'>

  <div class="form-group">
<label class="form-label" for="inputPasswordOld">Name*</label>
<input class="form-control py-3" id="inputPasswordOld" name='nme' type="text" placeholder="Enter name" value="<?php echo $usr_nme;?>" required>
</div>
  
  <div class="form-group">
<label class="form-label" for="inputPasswordOld">Old Password*</label>
<input class="form-control py-3" id="inputPasswordOld" name='old_pwd' type="password" placeholder="Enter old password" required>
</div>
<div class="form-group">
<label class="form-label" for="inputPasswordNew">New Password*</label>
<input class="form-control py-3" id="inputPasswordNew" name='nw_pwd' type="password" placeholder="Enter new password" required>
</div>
<div class="form-group">
<label class="form-label" for="inputPasswordNewConfirm">Confirmation Password*</label>
<input class="form-control py-3" id="inputPasswordNewConfirm" name='cnfrm_pwd' type="password" placeholder="Enter New confirmation password" required>
</div>
<div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
<button type='submit' name='submit' class="btn btn-sign hover-btn">Change Password</button>
</div>
</form>
  <?php 
if(isset($_POST['submit']))
  {
  $old_pwd=$_POST['old_pwd'];  
   $nw_pwd=$_POST['nw_pwd'];  
   $nw_c_pwd=$_POST['cnfrm_pwd'];  
  $neem=$_POST['nme'];
  $nw_md_pwd=md5($nw_pwd);
  if(md5($old_pwd)==$old_pwssd)
    {
    
    if($nw_pwd==$nw_c_pwd)
      { 
      
      $udt_pwd="update `user` set `password`='$nw_md_pwd',`without_md5_pwd`='$nw_pwd',`name`='$neem' where `id`='$emp_id'";
      $qst_udt_pwd=$db->query($udt_pwd);
      if($qst_udt_pwd)
        {
       echo "<script>window.alert('Password Updated Successfully');</script>"; 
      }
    }
    else {
      
       echo "<script>window.alert('Password and confirm password not match !');</script>";
    }
    
  }
  else
    {
    echo "<script>window.alert('Old Password is not match !');</script>";
  }
  
  }
  
  ?>

</div>

  
  
  
  
</div>
</main>

<?php include 'footer.php'; 

ob_flush();

?>