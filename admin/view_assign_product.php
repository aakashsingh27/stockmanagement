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
<li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;">View Assign</li>
</ol>
    
<!--<div class="col-md-12" ><a href="add_user.php" style='float:right' class='btn btn-primary'>Add Product</a></div>-->
<div class='col-md-12 table table-responsive' style="
    border: none !important;background:white;padding-top: 40px;">
    

    <table class='table' id='myTable' style="border: 2px solid black !important;">
    <thead>   
<tr>

<th style="border-bottom:2px solid black !important;">S.No</th>
<th style="border-bottom:2px solid black !important;">User</th>
<th style="border-bottom:2px solid black !important;">Product</th>
<th style="border-bottom:2px solid black !important;">Quantity</th>
<!--<th style="border-bottom:2px solid black !important;">price</th>-->

<th style="border-bottom:2px solid black !important;">Assign By</th>
<th style="border-bottom:2px solid black !important;">Action</th>


</tr>
</thead>
   <tbody>     
<?php 

if(isset($_GET['total_assign'])){
$product_id = $_GET['total_assign'];      
$usr_lst="select * from `assign_product` where `product_id`='$product_id' and `status`=1";    
}
else{
 if($_SESSION['a_id'] == 1) {  
$usr_lst="select * from `assign_product` where `status`=1";
}else{
    $assignID =$_SESSION['a_id'];
   $usr_lst="select * from `assign_product` where  `created_by`='$assignID' and `status`=1";  
}
}
$qst_usr_lst=$db->query($usr_lst);

$bedr_cmt=mysqli_num_rows($qst_usr_lst);

$sno=1;
    while($clct_usr_lst=$qst_usr_lst->fetch_assoc())
    {
        $assign_user_id=$clct_usr_lst['assign_user_id'];
        $product_id=$clct_usr_lst['product_id'];
        $qty=$clct_usr_lst['qty'];
        $created_by=$clct_usr_lst['created_by']; 
        $iid=$clct_usr_lst['id'];
        $price_product_id=$clct_usr_lst['price_product_id'];
       
       
       $created_by_ = "select `name` from `user` where `id`='$assign_user_id'";
       $created_name = $db->query($created_by_);
       $created_by_name = $created_name->fetch_assoc();
     
     
       $product_exquit = $db->query("select `product_name` from `product` where `id`='$product_id'");
       $product_name = $product_exquit->fetch_assoc();
     
$QKJK ="select `per_product_price` from `stock_quantity` where `product_id`='$price_product_id'";
        
       $quantit = $db->query($QKJK);

          
       $qty_name = $quantit->fetch_assoc();
      
      
       $created_b= $db->query("select `name` from `user` where `id`='$created_by'");
       
       
       if(!$quantit)
       {
           die("query fail : " . $db->error);
       }
       $created= $created_b->fetch_assoc();

  
       
    ?><tr>
        <td><?php echo $sno++;?></td>
        <td><?php echo $created_by_name['name'];?></td>
         
        <td><?php echo $product_name['product_name'];?></td>
       
       <td><?php echo $qty ;?></td>
       
        <!--<td><?php //echo $price_product_id ;?></td>-->
         
       
        <td><?php echo $created['name'];?></td>
        <td>
            <?php if(permission::hidePemission('unassign_product')) { ?>
             <a href="unassign_user.php?id=<?php echo $iid;?>&target=unassign_product" onclick="return confirm('Are you sure want to unassign this User?')"  class='btn btn-danger'>Un-assign</a>
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