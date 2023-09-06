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
<!--<h2 class="mt-30 page-title">All Bidders</h2>-->
<ol class="breadcrumb mb-30">
<li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;">View Users</li>
</ol>
 <?php  if(permission::hidePemission('view_user')){ ?>
<div class="col-md-12" ><a href="add_user.php?target=view_user" style='float:right' class='btn btn-primary'>Add User</a></div>
<?php } ?>
<div class='col-md-12 table table-responsive' style="
    border: none !important;background:white;padding-top: 40px;">
    

    <table class='table' id='myTable' style="border: 2px solid black !important;">
    <thead>   
<tr>

<th style="border-bottom:2px solid black !important;">S.No</th>
<th style="border-bottom:2px solid black !important;">Name</th>
<th style="border-bottom:2px solid black !important;">Username</th>
<th style="border-bottom:2px solid black !important;">Assign Role</th>
<th style="border-bottom:2px solid black !important;">Created By</th>
<th style="border-bottom:2px solid black !important;">Action</th>


</tr>
</thead>
   <tbody>     
<?php 
$usr_lst="select * from `user` ";
$qst_usr_lst=$db->query($usr_lst);

$bedr_cmt=mysqli_num_rows($qst_usr_lst);

$sno=1;
    while($clct_usr_lst=$qst_usr_lst->fetch_assoc())
    {
        $catg_neme=$clct_usr_lst['name'];
        $catg_username=$clct_usr_lst['username'];
        $role_id=$clct_usr_lst['role_id'];
        $catg_type=$clct_usr_lst['password'];
        $ctegy_id=$clct_usr_lst['id'];
        $created_by=$clct_usr_lst['created_by'];
       
       
       $created_by_ = "select `name` from `user` where `id`='$created_by'";
       $created_name = $db->query($created_by_);
       $created_by_name = $created_name->fetch_assoc();

      $role_name = $db->query("select `roles_name` from `roles_and_permission` where `id`='$role_id'");
       $roleName = $role_name->fetch_assoc();
       
       $iiid = $created_by_name['id'];
    ?><tr>
        <td><?php echo $sno++;?></td>
        <td><?php echo $catg_neme;?></td>
         
        <td><?php echo $catg_username;?></td>
       
        <td><?php echo $roleName['roles_name'] ;?></td>
        <td><?php echo $created_by_name['name'];?></td>
        <td><?php if($ctegy_id!=1) {?>
          
           
             <?php  if(permission::hidePemission('edit_user')){ ?>
            <a  href="edit_user.php?id=<?php echo $ctegy_id;?>&target=edit_user" class='btn btn-success'><i class='fa fa-edit'></i></a>
            <?php } ?>
            
            <?php  if(permission::hidePemission('delete_user')){ ?>
            <a href="delete_user.php?id=<?php echo $ctegy_id;?>&target=delete_user" onclick="return confirm('Are you sure want to delete this User?')"  class='btn btn-danger'><i class='fa fa-trash'></i></a>
            <?php 
                
            }
            }
            
            ?>
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