<?php 
include("config/config.php");

$role_id=$_POST['txt1'];

$clt_role_user="select * from `user` where `role_id`='$role_id'";
$qst_clt_role_user=$db->query($clt_role_user);
?>
<option value="">Choose user</option>
<?php
while($clct_clt_role_user=$qst_clt_role_user->fetch_assoc())
{
$usr_neme = $clct_clt_role_user['name'];
$usr_id = $clct_clt_role_user['id'];
?>
<option value="<?php echo $usr_id;?>"><?php echo $usr_neme;?></option>
<?php
}
?>