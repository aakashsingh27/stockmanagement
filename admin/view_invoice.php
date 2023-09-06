<?php
/*ini_set ('display_errors', 1);  
ini_set ('display_startup_errors', 1);  
error_reporting (E_ALL); */
@ob_start();
//session_start();
require_once 'config/config.php';
require_once 'config/helper.php';


if(isset($_GET['id']))
{
    $inv_id = $_GET['id'];
    
    $clt_invc_dtl="select * from `product_sale` where `invoice_number`='$inv_id'";
    $qst_clt_invc_dtl=$db->query($clt_invc_dtl);
    $clct_clt_invc_dtl=$qst_clt_invc_dtl->fetch_assoc();
    
    $inv_dete = $clct_clt_invc_dtl['sale_date_time'];
    
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
<style> @media print { #prnt_btrn{ display:none; } .bg-footer{ display:none; } .breadcrumb { display:none; } .ord_smry{ display:block !important; } .usrlink{ text-decoration:none !important; color:black; } } .shsp_adrs { background-color: #fbfbfb; font-size: 15px; font-weight: 600; padding: 10px 15px; margin: -1px 0 15px; border-bottom: 1px solid #ddd; border-top: 1px solid #ddd; } </style>
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
    <li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;">Order Summary</li>
    </ol>
    
    <?php

    ?>
    <div class='ord'>
    <div class="row">
        <div class="col-md-12 mb-5 ord_smry"  style="display:none"><center><h3 style="font-weight:bold;">Order Summary</h3></center></div>
    <div class="col-12 col-sm-12 col-md-12 col-lg-6">
    <div class="checkout-item-ordered">
    <h5 class="fs-6 mb-3" style="
    font-size: 16px;">Order Id : (<span style="font-weight:650"><?php echo $inv_id;?>)</span></h5>
   <p class="fs-6 mb-3" style="
    font-size: 14px;">Order date : (<span style="font-weight:650"><?php echo $inv_dete;?>)</span></p>

    
    
    
    <div class="table-content table-responsive order-table mb-4">
    <table class="table table-bordered align-middle table-hover text-center mb-0">
    <thead>
    <tr>
    <th class="fw-bold">S.No</th>
    <th class="text-start fw-600">Product Name</th>
        <th class="fw-600" style="width:100px;">Price</th>
    <th class="text-start fw-600">Quantity</th>

    <th class="text-start fw-600">Discount</th>
    <th class="fw-600" style="width: 100px;">Subtotal</th>
    </tr>
    </thead>
    <tbody>
    <?php 
    $sno=1;
  $clct_ordr_dtls="select * from `product_sale` where `invoice_number`='$inv_id'";
  
  $ttl_sb=0;
    $qst_clct_ordr_dtls=$db->query($clct_ordr_dtls);
    while($clct_clct_ordr_dtls=$qst_clct_ordr_dtls->fetch_assoc())
    {
    $prdt_iid       = $clct_clct_ordr_dtls['product_id'];
    $prdt_prece     = $clct_clct_ordr_dtls['price'];
    $prdt_qntity    = $clct_clct_ordr_dtls['quantity'];
    $prdt_dscnt     = $clct_clct_ordr_dtls['discount'];
    $sb_ttl         = $clct_clct_ordr_dtls['sub_total'];
    $usr_id         = $clct_clct_ordr_dtls['sale_to_id'];
    
    $ttl_sb += $sb_ttl;
    $clct_cstmr_dtl="select * from `user` where `id`='$usr_id'";
    $qst_clct_cstmr_dtl=$db->query($clct_cstmr_dtl);
    $clct_cstmr_dtl=$qst_clct_cstmr_dtl->fetch_assoc();
    
    $cstmr_neme = $clct_cstmr_dtl['name'];
    $cstmr_contact = $clct_cstmr_dtl['contact'];
    $cstmr_email = $clct_cstmr_dtl['username'];
    
    
$clt_prdt_dtl="select * from `product` where `id`='$prdt_iid'";
$qst_clt_prdt_dtl=$db->query($clt_prdt_dtl);
$clct_prdt_dtl=$qst_clt_prdt_dtl->fetch_assoc();

$prdt_neme = $clct_prdt_dtl['product_name'];
    ?>
    <tr>
    <td class="pro-img"><?php echo $sno++;?></td>
    <td class="pro-name text-start"><?php echo $prdt_neme;?></td>
        <td class="pro-total fw-500"><b>₹ <?php echo $prdt_prece;?></b></td>
    <td class="pro-price"> <?php echo $prdt_qntity;?></td>
   
    <td class="pro-qty"><?php echo $prdt_dscnt;?>%</td>
  
    <td class="pro-total fw-500">₹ <?php echo $sb_ttl;?></td>
     
    </tr>
    <?php 
    }
    ?>          
    </tbody>
    <tfoot>
    <tr>
    <td colspan="5" class="item subtotal text-end fw-bolder">Subtotal:</td>
    <td class="fw-500 last">₹ <?php echo $ttl_sb;?></td>
    
    </tr>
    <tr>
    <td colspan="5" class="item total text-end fw-bolder">Grand Total:</td>
    <td class="fw-500 last"><b>₹ <?php echo $ttl_sb;?></b></td>
    </tr>
    </tfoot>
    </table>
    </div>
    </div>
    </div>
    <div class="col-12 col-sm-12 col-md-12 col-lg-6" style="
    margin-top: 72px;
    ">
    <div class="ship-info-details shipping-method-details" style="
    border: 1px solid #dddddd;
">
    <div class="row g-0">
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 pr-0" >
    <div class="shipping-details mb-4 mb-sm-0 clearfix">
    <h3 class="shsp_adrs" style="font-size:18px;padding-top: 10px;font-weight: bold;padding-left: 5px;">Customer details</h3>
    <p class="pl-2 pb-0 mb-1" style="font-size: 14px;"> <b>Name :- </b><?php echo $cstmr_neme;?> </p>
    <p class="pl-2 pb-0 mb-1" style="font-size: 14px;"><b> Contact :- </b><?php echo $cstmr_contact?></p>
    
    
  
   
    </div>
    </div>
    <!--<div class="col-12 col-sm-6 col-md-6 col-lg-6 pl-0">
    <div class="shipping-details mb-4 mb-sm-0 clearfix">
    <h3 class='shsp_adrs'>Billing Address</h3>
    <p class="pl-2 pb-0 mb-1" style="font-size: 14px;"><a title="Click to view this user details" class='usrlink' href="view_user_details.php?id=<?php //echo $ussr_iid;?>"> <b><?php// echo $uuse_neme;?> , <?php //echo $uuse_mob?></b></a> </p>
   
    <p class="pl-2" style="font-size:14px;"><?php// echo $shp_adrs; ?></p>
    <p class="pl-2 mb-0" style="font-size:14px;"><?php //echo $shp_cty?>, <?php //echo $shp_pnced;?></p>
    <p class="pl-2" style="font-size:14px;"><b>landmark :- <?php //echo $shp_lndmrk;?></b></p>
    </div>
    </div>-->
    </div>
    </div>
    <div class="ship-info-details billing-payment-details">
    <div class="row g-0">
    

    
    
    
    <div class="col-md-12 mt-2">
    <button type="button" id="prnt_btrn" class="btn btn-warning" onClick="print_bill()">Print Order</button>    
    </div>
    </div>
    </div>
    
   
    </div>
    </div>
    
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
function print_bill()
{
    window.print();
} 


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