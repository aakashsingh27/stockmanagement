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
$comp_select = $db->query("SELECT * FROM `stock_quantity`");
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
<li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;">View Stock Quantity</li>
</ol>
    <?php  if(permission::hidePemission('add_quantity')){ ?>
<div class="col-md-12" ><a href="add_quantity.php?target=add_quantity" style='float:right' class='btn btn-primary'>Add Quantity</a></div>
<?php } ?>
<div class='col-md-12 table table-responsive' style="
    border: none !important;background:white;padding-top: 40px;">
    

    <table class='table' id='myTable' style="border: 2px solid black !important;">
    <thead>   
<tr>

<th style="border-bottom:2px solid black !important;">S.No</th>
<th style="border-bottom:2px solid black !important;">Product</th>
<th style="border-bottom:2px solid black !important;">Vender</th>
<th style="border-bottom:2px solid black !important;">Price</th>
<th style="border-bottom:2px solid black !important;">Quantity</th>

<th style="border-bottom:2px solid black !important;">Created By</th>
<th style="border-bottom:2px solid black !important;">Action</th>


</tr>
</thead>
   <tbody>     
<?php 
if(isset($_GET['total_assign'])){
$product_id = $_GET['total_assign'];      
$usr_lst="select * from `stock_quantity` where `product_id`='$product_id'";    
}else{
$usr_lst="select * from `stock_quantity` where `quantity` > 0 ";
}
$qst_usr_lst=$db->query($usr_lst);

$bedr_cmt=mysqli_num_rows($qst_usr_lst);

$sno=1;
    while($clct_usr_lst=$qst_usr_lst->fetch_assoc())
    {
        $product_id=$clct_usr_lst['product_id'];
        $vendor_id=$clct_usr_lst['vendor_id'];
        $per_product_price=$clct_usr_lst['per_product_price'];
        $quantity=$clct_usr_lst['quantity']; 
        $ctegy_id=$clct_usr_lst['id'];
        $created_by=$clct_usr_lst['add_by_user_id'];
       
       
       $created_by_ = "select `name` from `user` where `id`='$created_by'";
       $created_name = $db->query($created_by_);
       $created_by_name = $created_name->fetch_assoc();
     
     
       $product_exquit = $db->query("select `product_name` from `product` where `id`='$product_id'");
       $product_name = $product_exquit->fetch_assoc();
       
      
       $unit_vender = $db->query("select `company` from `venders` where `id`='$vendor_id'");
       $vender_name = $unit_vender->fetch_assoc();

  
       
    ?><tr>
        <td><?php echo $sno++;?></td>
        <td><?php echo $product_name['product_name'];?></td>
         
        <td><?php echo $vender_name['company'];?></td>
       
       <td><?php echo $per_product_price ;?></td>
       
        <td><?php echo $quantity ;?></td>
         
       
        <td><?php echo $created_by_name['name'];?></td>
        <td>
            <?php  if(permission::hidePemission('edit_quantity')){ ?>
            <a  href="edit_stock.php?id=<?php echo $ctegy_id;?>&target=edit_quantity" class='btn btn-success'><i class='fa fa-edit'></i></a>
            <?php } ?>
         <?php  if(permission::hidePemission('delete_quantity')){ ?>
        <a href="delete_user.php?id=<?php echo $ctegy_id;?>&target=delete_quantity" onclick="return confirm('Are you sure want to delete this User?')"  class='btn btn-danger'><i class='fa fa-trash'></i></a>
        <?php } ?>
        
        </td>
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