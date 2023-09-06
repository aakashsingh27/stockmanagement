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
$comp_select = $db->query("SELECT * FROM `user`");
$comp_fetch = $comp_select->fetch_object();
$a_company = $comp_fetch->name;
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

<ol class="breadcrumb mb-30">
<li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;">Manage Unit</li>
</ol>
    

    
<?php  if(permission::hidePemission('add_unit')){ ?>
    <form method="POST" action="" enctype="multipart/form-data">
<div class="row">
<div class="form-group col-md-10 col-xs-10 ">
<label class="form-label" style="font-size:16px !important;">Unit name <span style="color:red;">*</span></label>
<input type='text' name="ctgy_neme" placeholder="Enter Unit name" class="form-control"  style="border: 2px solid grey!important;" required>
</div>


<div class="form-group col-md-2">
<br>
<button type='submit' name="submit" class='btn btn-primary mt-2' style="
    width: 100%;
">Submit</button>
</div>
</div>
</form>
<?php } ?>


<?php 
if(isset($_POST['submit']))
{

$categ_neme=mysqli_real_escape_string($db , $_POST['ctgy_neme']);



$clt_dplc="select * from `unit` where `name`='$categ_neme'";
$qst_clt_dplc=$db->query($clt_dplc);
$ctgy_count=mysqli_num_rows($qst_clt_dplc);

if($ctgy_count==0)
{
$ad_prdt="insert into `unit` set
`name`='$categ_neme',
`created_by_id`='$admin_id',
`created_by_name`='$usr_nme',
`date_time`='$timestamp'";

$qst_ad_prdt=$db->query($ad_prdt);

if($qst_ad_prdt)
{
echo "<script>window.alert('Unit Added Successfully');window.location='';</script>";

}
else
{
    echo "<script>window.alert('Error');window.location='';</script>";
}
}
else
{
echo "<script>window.alert('This Unit is already exist please try again');window.location='';</script>";
}


}
?>

    
    

<div class='col-md-12 table table-responsive' style="
    border: none !important;background:white;padding-top: 40px;">
    

    <table class='table' id='myTable' style="border: 2px solid black !important;">
    <thead>   
<tr>

<th style="border-bottom:2px solid black !important;">S.No</th>
<th style="border-bottom:2px solid black !important;">Unit Name</th>
<th style="border-bottom:2px solid black !important;">Created by</th>
<th style="border-bottom:2px solid black !important;">Created date</th>
<th style="border-bottom:2px solid black !important;">Action</th>


</tr>
</thead>
   <tbody>     
<?php 
$usr_lst="select * from `unit`";
$qst_usr_lst=$db->query($usr_lst);

$bedr_cmt=mysqli_num_rows($qst_usr_lst);

$sno=1;
    while($clct_usr_lst=$qst_usr_lst->fetch_assoc())
    {
        $catg_neme=$clct_usr_lst['name'];
        $catg_ad_by_id=$clct_usr_lst['created_by_id'];
        $date_time=$clct_usr_lst['date_time'];
        $ctegy_id=$clct_usr_lst['id'];
       
  
  $adm_dtl="select * from `user` where `id`='$catg_ad_by_id'";
  $qst_adm_dtl=$db->query($adm_dtl);
  $clct_adm_dtl=$qst_adm_dtl->fetch_assoc();
  
  $adm_neme = $clct_adm_dtl['name'];
       
    ?><tr>
        <td><?php echo $sno++;?></td>
        <td><?php echo $catg_neme;?></td>
         
        <td><?php echo $adm_neme;?></td>
       
        <td><?php echo $date_time;?></td>
        <td>
            <?php  if(permission::hidePemission('edit_unit')){ ?>
            <a  href="edit_unit.php?id=<?php echo $ctegy_id;?>&target=edit_unit" class='btn btn-success'><i class='fa fa-edit'></i></a> 
            <?php } ?>
            <?php if(permission::hidePemission('delete_unit')){  ?>
            <a href="delete_unit.php?id=<?php echo $ctegy_id;?>" class='btn btn-danger'><i class='fa fa-trash'></i></a>
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