<?php
@ob_start();
//session_start();
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
$comp_select = $db->query("SELECT * FROM `assign_product`");
$comp_fetch = $comp_select->fetch_object();

$check_a_name = $_SESSION['a_name'];


?>

<?php include 'header.php'; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" />
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

<div id="layoutSidenav_content">
<main>
<div class="container-fluid">
<!--<h2 class="mt-30 page-title">All Bidders</h2>-->
<ol class="breadcrumb mb-30">
<li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;">View Sales</li>
</ol>
    
<!--<div class="col-md-12" ><a href="add_user.php" style='float:right' class='btn btn-primary'>Add Product</a></div>-->
<div class='col-md-12 table table-responsive' style="
    border: none !important;background:white;padding-top: 40px;">
    

    <table class='table' id='myTable' style="border: 2px solid black !important;">
    <thead>   
<tr>

<th style="border-bottom:2px solid black !important;">S.No</th>
<th style="border-bottom:2px solid black !important;">Date</th>
<th style="border-bottom:2px solid black !important;">Product name</th>
<th style="border-bottom:2px solid black !important;">Quantity</th>
<th style="border-bottom:2px solid black !important;">price</th>
<th style="border-bottom:2px solid black !important;">Discount</th>
<th style="border-bottom:2px solid black !important;">Subtotal</th>
<th style="border-bottom:2px solid black !important;">Invoice number</th>
<th style="border-bottom:2px solid black !important;">Sale by</th>
<th style="border-bottom:2px solid black !important;">Sale to</th>

<th style="border-bottom:2px solid black !important;">Action</th>

</tr>
</thead>
   <tbody>     
<?php

if($_SESSION['a_id'] == 1){
if(isset($_GET['total_assign'])){
$user_id = $_SESSION['a_id'];    
$product_id = $_GET['total_assign'];      
$usr_lst="select * from `product_sale` where `product_id`='$product_id' order by `id` desc";    
}else{
$usr_lst="select * from `product_sale` order by `id` desc";
}

}else{
$user_id = $_SESSION['a_id'];    
  if(isset($_GET['total_assign'])){
$product_id = $_GET['total_assign'];      
$usr_lst="select * from `product_sale` where `product_id`='$product_id' and `sale_by_id`='$user_id'";    
}else{
$usr_lst="select * from `product_sale` where `sale_by_id`= '$user_id' order by `id` desc";
}
 
}



$qst_usr_lst=$db->query($usr_lst);

$bedr_cmt=mysqli_num_rows($qst_usr_lst);

$sno=1;
    while($clct_usr_lst=$qst_usr_lst->fetch_assoc())
    {
    $prdt_id=$clct_usr_lst['product_id'];
    $qnty=$clct_usr_lst['quantity'];

    $sale_date=$clct_usr_lst['sale_date_time'];
    $preec=$clct_usr_lst['price'];
    $inv_nbr=$clct_usr_lst['invoice_number'];
    $sale_by_iid=$clct_usr_lst['sale_by_id'];
    $sale_to_iid=$clct_usr_lst['sale_to_id']; 
    $sb_ttl=$clct_usr_lst['sub_total']; 
      $dscnt=$clct_usr_lst['discount']; 
       
       
      $clt_prdt_dtl="select * from `product` where `id`='$prdt_id'";
      $qst_clt_prdt_dtl=$db->query($clt_prdt_dtl);
      $clct_clt_prdt_dtl=$qst_clt_prdt_dtl->fetch_assoc();
      
      $prdt_neme = $clct_clt_prdt_dtl['product_name'];
     
  
        $clt_adm_dtl="select * from `user` where `id`='$sale_by_iid'";
        $qst_clt_adm_dtl=$db->query($clt_adm_dtl);
        $clct_clt_adm_dtl=$qst_clt_adm_dtl->fetch_assoc();
        
        $usrneme= $clct_clt_adm_dtl['name'];
        
        
        $clt_cstm_dtl = "select * from `user` where `id`='$sale_to_iid'";
        $qst_clt_cstm_dtl=$db->query($clt_cstm_dtl);
        $clct_clt_cstm_dtl=$qst_clt_cstm_dtl->fetch_assoc();
        
        $uesr_neme =$clct_clt_cstm_dtl['name'];
        
        
    ?><tr>
        <td><?php echo $sno++;?></td>
        <td><?php echo $sale_date;?></td>
        <td><?php echo $prdt_neme;?></td>
         
        <td><?php echo $qnty?></td>
       
       <td><?php echo $preec ;?></td>
       <td><?php echo $dscnt;?></td>
      <td><?php echo $sb_ttl;?></td>
        <td><?php echo $inv_nbr;?></td>
         
       
        <td><?php echo $usrneme;?></td>
        
        <td><?php echo $uesr_neme;?></td>
        <td>
           <a href='view_invoice.php?id=<?php echo $inv_nbr;?>&target=view_sale_product' class='btn btn-success'>View invoice</a></td>
        </tr>
        <?php
    }
    ?>
        </tbody>
        
    </table>
    </div>


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
           lengthMenu: [[10, 50, 100, 500, -1], [10, 50, 100, 500, "All"]],
    } );
} );
    </script>

<?php include 'footer.php'; 

ob_flush();

?>