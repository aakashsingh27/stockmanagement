<?php
@ob_start();
//session_start();
require_once 'config/config.php';
date_default_timezone_set("Asia/Kolkata");
$cr_dt_ymd = date('Y-m-d');

$id = $_SESSION['a_id'];
$query = "select * from `user` where `id`='$id'";
$query_conn = $db->query($query);
$getuserdata = $query_conn->fetch_assoc();
$user_id = $getuserdata['role_id'];
$getAllPer = $db->query("select * from `roles_and_permission` where `id`='$user_id'");
$allper = $getAllPer->fetch_assoc();
$alPermission = $allper['permissions'];

$permissionArray = explode(' ,',$alPermission);
// Middleware function to check permission
class permission{
public static function checkPermission($permission) {
    global $permissionArray;
    
    if (in_array($permission, $permissionArray)) {
    ?>
    
    <script>
    window.location=event.target.href;</script>
    <?php
  
    } else {// Redirect back or display an e
    
    if($_GET['target']!='dashboard'){
    ?>
    <script>
    
    window.history.back();
    </script>
         <?php
         exit();
    }
    }
}



/////////////////////////////

public static function hidePemission($permission) {
    global $permissionArray;
    
    if (in_array($permission, $permissionArray)) {
      return true;
  
    } else {// Redirect back or display an e
    
   
   
      return false;
    
    }
}


}




ob_flush();
?>
