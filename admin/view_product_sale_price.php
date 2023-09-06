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
$comp_select = $db->query("SELECT * FROM `venders`");
$comp_fetch = $comp_select->fetch_object();
$a_company = $comp_fetch->company;
$check_a_name = $_SESSION['company'];


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
<li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;">View Product sale price</li>
</ol>
     <?php  if(permission::hidePemission('add_product_sale_price')){ ?>  
<div class="col-md-12" ><a href="add_product_sale_price.php?target=add_product_sale_price" style='float:right' class='btn btn-primary'>Add Price</a></div>
<?php } ?>
<div class='col-md-12 table table-responsive' style="
    border: none !important;background:white;padding-top: 40px;">
    

    <table class='table' id='myTable' style="border: 2px solid black !important;">
    <thead>   
<tr>

<th style="border-bottom:2px solid black !important;">S.No</th>
<th style="border-bottom:2px solid black !important;">Customer name</th>
<th style="border-bottom:2px solid black !important;">Product name</th>
<th style="border-bottom:2px solid black !important;">Product price</th>
<th style="border-bottom:2px solid black !important;">Created By</th>
<th style="border-bottom:2px solid black !important;">Action</th>


</tr>
</thead>
   <tbody>     
<?php 
$usr_lst="select * from `set_product_price` ";
$qst_usr_lst=$db->query($usr_lst);

$bedr_cmt=mysqli_num_rows($qst_usr_lst);

$sno=1;
    while($clct_usr_lst=$qst_usr_lst->fetch_assoc())
    {
    $prdt_id=$clct_usr_lst['product_id'];
    $prece=$clct_usr_lst['price'];
    $cstmr_id=$clct_usr_lst['customer_id'];
    $assn_by_id=$clct_usr_lst['assign_by_id'];
      $iid = $clct_usr_lst['id'];
      
    $prdt_dtl = "select * from `product` where `id`='$prdt_id'";
    $qst_prdt_dtl = $db->query($prdt_dtl);
    $clct_prdt_dtl = $qst_prdt_dtl->fetch_assoc();

  $prdt_neme = $clct_prdt_dtl['product_name'];
       
       
    $cstmr_dtl = "select * from `user` where `id`='$cstmr_id'";
    $qst_cstmr_dtl = $db->query($cstmr_dtl);
    $clct_cstmr_dtl = $qst_cstmr_dtl->fetch_assoc();

    $user_neme = $clct_cstmr_dtl['name']; 
    
    
    
    $clt_assg_id = "select * from `user` where `id`='$assn_by_id'";
    $qst_clt_assg_id = $db->query($clt_assg_id);
    $clct_clt_assg_id=$qst_clt_assg_id->fetch_assoc();
    
    $assgn_by_name= $clct_clt_assg_id['name'];
    ?><tr>
        <td><?php echo $sno++;?></td>

         
        <td><?php echo $user_neme;?></td>
                <td><?php echo $prdt_neme;?></td>
       
        <td><?php echo $prece;?></td>
             
        <td><?php echo $assgn_by_name;?></td>
        <td>
                   <?php  if(permission::hidePemission('edit_product_sale_price')){ ?>
            <a  href="edit_product_sale_price.php?id=<?php echo $iid;?>&target=edit_product_sale_price" class='btn btn-success'><i class='fa fa-edit'></i></a>
                  <?php } ?>
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