<?php 
session_start();
date_default_timezone_set('Asia/Kolkata');
$timestamp = date("Y-m-d H:i:s");
require('RolesMiddleware.php');
$current_date = date("Y-m-d");
if (!empty($_SESSION['ibc'])) {
if ($_SESSION['ibc'] != session_id()) {
header('Location: index.php');
exit;
}
} else {
header('Location: login.php');
exit;
}
if(isset($_GET['target'])){
    $permission = $_GET['target'];
    permission::checkPermission($permission);
}else{
 ?>
 
 <script> window.location.href='https://stockmanagement.ipsupport.in/admin/index.php?target=dashboard';</script>

<?php
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description-gambolthemes" content="">
<meta name="author-gambolthemes" content="">



<title>Admin</title>
<link href="css/styles.css" rel="stylesheet">
<link href="css/admin-style.css" rel="stylesheet">

<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">

<link rel="stylesheet" href="css/typing.css">
<link rel="stylesheet" href="css/chat.css">


<!--<link rel="stylesheet" href="cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">-->
<link rel="stylesheet" href="vendor/froala_editor_3.1.1/css/froala_editor.css">
<link rel="stylesheet" href="vendor/froala_editor_3.1.1/css/froala_style.css">
<link rel="stylesheet" href="vendor/froala_editor_3.1.1/css/plugins/code_view.css">
<link rel="stylesheet" href="vendor/froala_editor_3.1.1/css/plugins/colors.css">
<link rel="stylesheet" href="vendor/froala_editor_3.1.1/css/plugins/emoticons.css">
<link rel="stylesheet" href="vendor/froala_editor_3.1.1/css/plugins/image_manager.css">
<link rel="stylesheet" href="vendor/froala_editor_3.1.1/css/plugins/image.css">
<link rel="stylesheet" href="vendor/froala_editor_3.1.1/css/plugins/line_breaker.css">
<link rel="stylesheet" href="vendor/froala_editor_3.1.1/css/plugins/table.css">
<link rel="stylesheet" href="vendor/froala_editor_3.1.1/css/plugins/char_counter.css">
<link rel="stylesheet" href="vendor/froala_editor_3.1.1/css/plugins/video.css">
<link rel="stylesheet" href="vendor/froala_editor_3.1.1/css/plugins/fullscreen.css">
<link rel="stylesheet" href="vendor/f8oala_editor_3.1.1/css/plugins/file.css">
<!--<link rel="stylesheet" href="cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.css">-->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.mn.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<style type="text/css">
.chatbox__button button {
visibility: hidden;
}
</style>


</head>

<?php 
$admin_id=$_SESSION['a_id'];



 $usr_dtl="select * from `user` where `id`='$admin_id' and status='enable'";
$qst_usr_dtl=$db->query($usr_dtl);
$clct_usr_dtl=$qst_usr_dtl->fetch_assoc();


$emp_id=$clct_usr_dtl['id'];
$usr_nme=$clct_usr_dtl['name'];
$old_pwssd=$clct_usr_dtl['password'];
?>

<body id="body" class="sb-nav-fixed">
<nav class="sb-topnav navbar navbar-expand navbar-light bg-clr">
<a class="navbar-brand logo-brand" href="index.php"><span style="color:#00bc00">Welcome</span> <?php echo $usr_nme?></a>
<button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i onclick="myFunction()" class="fas fa-bars"></i></button>
<!--<a href="index.php" class="frnt-link"><i class="fas fa-external-link-alt"></i>Home</a>-->
<ul class="navbar-nav ml-auto mr-md-0">
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
<!-- <a class="dropdown-item admin-dropdown-item" href="edit_profile.php">Edit Profile</a> -->

<!--<a class="dropdown-item admin-dropdown-item" href="ch_pwd.php">Change Password</a>-->

  <a class="dropdown-item admin-dropdown-item" href="logout.php">Logout</a>
</div>
</li>
</ul>
</nav>

<script>
function myFunction() {
var body = document.getElementById("body");
if (body.className == "sb-nav-fixed") {
body.classList.add("sb-nav-fixed");
body.classList.add("sb-sidenav-toggled");
} else {
body.classList.remove("sb-nav-fixed");
body.classList.remove("sb-sidenav-toggled");
body.classList.add("sb-nav-fixed");
}
}
</script>

<div id="layoutSidenav">
<div id="layoutSidenav_nav">

<?php 




$usr_dtl="select * from `user` where `id`='$admin_id' and `status`='enable'";
$qst_usr_dtl=$db->query($usr_dtl);
$clct_usr_dtl=$qst_usr_dtl->fetch_assoc();

?>
<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
<div class="sb-sidenav-menu">
<div class="nav">
<a class="nav-link active" href="index.php">
<div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
Dashboard
</a>

<!--<a class="nav-link collapsed" href="bdr_otp_cnsnt.php" >-->
<!--<div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>-->
<!--Bidder Login OTP consent -->
<!--<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>-->
<!--</a>-->
<!--<div class="collapse" id="collapsseLayoutdssdfs" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
<nav class="sb-sidenav-menu-nested nav">
     <a class="nav-link sub_nav_link" href="bdr_otp_cnsnt.php">View OTP consent</a>
   
</nav>
</div>-->
<?php if(permission::hidePemission('view_role') || permission::hidePemission('view_user')){ ?>
<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayoutdssdfs" aria-expanded="false" aria-controls="collapseLayouts">
<div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
User & Permission
<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapseLayoutdssdfs" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
<nav class="sb-sidenav-menu-nested nav">
    
    
    <?php  if(permission::hidePemission('view_role')){ ?>
     <a class="nav-link sub_nav_link" href="view_role.php?target=view_role">Permissions</a>
    <?php } ?>
    
    <?php  if(permission::hidePemission('view_user')){ ?>
      <a class="nav-link sub_nav_link" href="view_users.php?target=view_user">Users</a>
     <?php } ?>
</nav>
</div>
<?php } ?>

<?php if(permission::hidePemission('view_category') ){ ?>
<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayoudsdfgdtdssdfs" aria-expanded="false" aria-controls="collapseLayouts">
<div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>
Category
<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapseLayoudsdfgdtdssdfs" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
<nav class="sb-sidenav-menu-nested nav">
  <?php  if(permission::hidePemission('view_category')){ ?>
<a class="nav-link sub_nav_link" href="add_category.php?target=view_category">Manage Category</a>
<?php } ?>

</nav>
</div>
<?php } ?>

<?php if(permission::hidePemission('view_unit') ){ ?>
<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouddtdssdfs" aria-expanded="false" aria-controls="collapseLayouts">
<div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>
Unit
<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapseLayouddtdssdfs" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
<nav class="sb-sidenav-menu-nested nav">
<?php  if(permission::hidePemission('view_unit')){ ?>
<a class="nav-link sub_nav_link" href="manage_unit.php?target=view_unit">Manage Unit</a>
<?php } ?>

</nav>
</div>
<?php } ?>


<?php if(permission::hidePemission('view_vendor') ){ ?>
<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayodddutdssdfs" aria-expanded="false" aria-controls="collapseLayouts">
<div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>
Vendor
<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapseLayodddutdssdfs" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
<nav class="sb-sidenav-menu-nested nav">
 <?php  if(permission::hidePemission('view_vendor')){ ?>
<a class="nav-link sub_nav_link" href="view_venders.php?target=view_vendor">Manage Vendor</a>
<?php } ?>
</nav>
</div>
<?php } ?>



<!--<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouddtsssdssdfs" aria-expanded="false" aria-controls="collapseLayouts">
<div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>
Blogs
<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapseLayouddtsssdssdfs" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
<nav class="sb-sidenav-menu-nested nav">
<a class="nav-link sub_nav_link" href="add_blog.php">Add Blog</a>
<a class="nav-link sub_nav_link" href="view_blog.php">View Blog</a>
</nav>
</div>
-->




<?php if(permission::hidePemission('add_product') || permission::hidePemission('view_product')){ ?>
<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouddsdfghtsssdssdfs" aria-expanded="false" aria-controls="collapseLayouts">
<div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>
Manage Product
<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapseLayouddsdfghtsssdssdfs" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
<nav class="sb-sidenav-menu-nested nav">
     <?php  if(permission::hidePemission('add_product')){ ?>
<a class="nav-link sub_nav_link" href="add_product.php?target=add_product">Add Product</a>
      <?php } ?>
      
<?php  if(permission::hidePemission('view_product')){ ?>
<a class="nav-link sub_nav_link" href="view_product.php?target=view_product">View Product</a>
<?php } ?>

</nav>
</div>
<?php } ?>


<?php if(permission::hidePemission('view_basic_price') || permission::hidePemission('add_basic_price')){ ?>
<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouddsdfghtsssssssdcccssdfs" aria-expanded="false" aria-controls="collapseLayouts">
<div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>
Manage Price
<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapseLayouddsdfghtsssssssdcccssdfs" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
<nav class="sb-sidenav-menu-nested nav">
    <?php if(permission::hidePemission('add_basic_price')){ ?>
<a class="nav-link sub_nav_link" href="add_price.php?target=add_basic_price">Add Price</a>
<?php } ?>

    <?php if(permission::hidePemission('view_basic_price')){ ?>
<a class="nav-link sub_nav_link" href="view_price.php?target=view_basic_price">View Price</a>
<?php } ?>
</nav>
</div>
<?php } ?>



<?php if(permission::hidePemission('add_quantity') || permission::hidePemission('view_quantity')){ ?>
<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouddsdfghtsssssssdssdfs" aria-expanded="false" aria-controls="collapseLayouts">
<div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>
Manage Quantity
<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapseLayouddsdfghtsssssssdssdfs" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
<nav class="sb-sidenav-menu-nested nav">
    
<?php  if(permission::hidePemission('add_quantity')){ ?>
<a class="nav-link sub_nav_link" href="add_quantity.php?target=add_quantity">Add Quantity</a>
<?php } ?>

<?php  if(permission::hidePemission('view_quantity')){ ?>
<a class="nav-link sub_nav_link" href="view_quantity.php?target=view_quantity">View Quantity</a>
<?php } ?>
</nav>
</div>
<?php } ?>

<?php if(permission::hidePemission('view_bucket') || permission::hidePemission('add_bucket') ){ ?>
<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLaayouddsdfghtsssssssdssdfs" aria-expanded="false" aria-controls="collapseLayouts">
<div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>
Manage Bucket
<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapseLaayouddsdfghtsssssssdssdfs" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
<nav class="sb-sidenav-menu-nested nav">
<?php  if(permission::hidePemission('add_bucket')){ ?>
<a class="nav-link sub_nav_link" href="add_bucket.php?target=add_bucket">Add Bucket</a>
<?php } ?>
<?php  if(permission::hidePemission('view_bucket')){ ?>
<a class="nav-link sub_nav_link" href="view_bucket.php?target=view_bucket">View Bucket</a>
<?php } ?>
</nav>
</div>
<?php } ?>

<?php if(permission::hidePemission('view_product_sale_price') || permission::hidePemission('roles_product_sale_permission') ){ ?>
<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLaayosasasuddsdfghtsssssssdssdfs" aria-expanded="false" aria-controls="collapseLayouts">
<div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>
Manage Product sale Price
<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapseLaayosasasuddsdfghtsssssssdssdfs" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
<nav class="sb-sidenav-menu-nested nav">
    
    <?php if(permission::hidePemission('roles_product_sale_permission')) { ?>
<a class="nav-link sub_nav_link" href="add_product_sale_price.php?target=roles_product_sale_permission">Assign product price</a>
<?php } ?>

 <?php if(permission::hidePemission('view_product_sale_price')) { ?>
<a class="nav-link sub_nav_link" href="view_product_sale_price.php?target=view_product_sale_price">View procuct price</a>
<?php } ?>
</nav>
</div>
<?php } ?>





<?php if(permission::hidePemission('view_assign_product') || permission::hidePemission('assign_product') ){ ?>
<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLaayoussddsdfghtsssssssdssdfs" aria-expanded="false" aria-controls="collapseLayouts">
<div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>
Manage Assign
<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapseLaayoussddsdfghtsssssssdssdfs" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
<nav class="sb-sidenav-menu-nested nav">
<?php if(permission::hidePemission('assign_product')) { ?>
<a class="nav-link sub_nav_link" href="add_assign.php?target=assign_product">Assign Product</a>
<?php } ?>

<?php if(permission::hidePemission('view_assign_product')) { ?>
<a class="nav-link sub_nav_link" href="view_assign_product.php?target=view_assign_product">View Assign</a>
<?php } ?>
</nav>
</div>
<?php } ?>


<?php if(permission::hidePemission('view_sale_product') || permission::hidePemission('sales_product') || permission::hidePemission('sales_bucket') ){ ?>
<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLaayoussddsdfghssstsssssssdssdfs" aria-expanded="false" aria-controls="collapseLayouts">
<div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>
Manage Sales
<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapseLaayoussddsdfghssstsssssssdssdfs" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
<nav class="sb-sidenav-menu-nested nav">
<?php if(permission::hidePemission('sales_product')){ ?> 
<a class="nav-link sub_nav_link" href="add_sales.php?target=sales_product">Sale Product</a>
<?php } ?>
<?php if(permission::hidePemission('sales_bucket')){ ?> 
<a class="nav-link sub_nav_link" href="add_sale_bucket.php?target=sales_bucket">Sale Bucket</a>
<?php } ?>

<?php if(permission::hidePemission('view_sale_product')){ ?>
<a class="nav-link sub_nav_link" href="view_sales.php?target=view_sale_product">View Sale</a>
<?php } ?>
</nav>
</div>
<?php } ?>


<?php if(permission::hidePemission('check_quantity')){ ?>
<a class="nav-link collapsed" href="check_quantity.php?target=check_quantity" >
<div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>
Check stock quantity
<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<?php } ?>



<!--<a class="nav-link" href="contact_us.php">
<div class="sb-nav-link-icon"><i class="fa fa-question"></i></div>
Contact us
</a>-->


</div>
</div>
</nav>
<?php 

?>


</div>