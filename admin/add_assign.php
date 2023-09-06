
<?php
@ob_start();
//session_start();
require_once 'config/config.php';
date_default_timezone_set("Asia/Kolkata");
$cr_dt_ymd=date('Y-m-d');

$query ="select * from `category`";
$category = $db->query($query);

$query1 ="select * from `unit`";
$unit = $db->query($query1);

$query2 ="select * from `venders`";
$venders = $db->query($query2);

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php include 'header.php'; ?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>

<div id="layoutSidenav_content">
<main>
<div class="container-fluid">

<ol class="breadcrumb mb-30 mt-2">
<li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;">Assign Product / Sale</li>
</ol>
<div class="container-fluid">


<form method="POST" action="" enctype="multipart/form-data">
<div class="row">
    
<div class="form-group col-md-6 col-xs-6 ">
<label class="form-label" style="font-size:16px !important;">Choose Role <span style="color:red;">*</span></label>
<select name="assgn_role" id="role_idd" onChange="get_user(this.value)" class="form-control"  style="border: 2px solid grey!important;" required>
<option value="">Choose Role</option>

<?php 
$clt_role="select * from `roles_and_permission`";
$qst_clt_role=$db->query($clt_role);
while($clct_clt_role=$qst_clt_role->fetch_assoc())
{

$iid=$clct_clt_role['id'];
$rol_neme=$clct_clt_role['roles_name'];
    ?>

<option value="<?php echo $iid;?>"><?php echo $rol_neme;?></option>
<?php
    
}


?>
</select>
 
</div>
    
<div class="form-group col-md-6 col-xs-6 ">
<label class="form-label" style="font-size:16px !important;">Assign user <span style="color:red;">*</span></label>
<select name="assgn_user_id" id="assgn_usr" class="form-control"  style="border: 2px solid grey!important;" required>
<option value="">Choose user</option>

</select>
 
</div>

<div class="form-group col-md-6 col-xs-6 ">
<label class="form-label" style="font-size:16px !important;"> Select Product <span style="color:red;">*</span> <span id="prdt_count"></span></label>
<select name="prdt_id" id="prd_id" class="form-control" onChange="get_product_qty(this.value);get_product_price(this.value)"  style="border: 2px solid grey!important;" required>
    <option value="">-Select Product-</option>
    <?php 
    $clt_prdt_dtl="select * from `product`";
    $qst_clt_prdt_dtl=$db->query($clt_prdt_dtl);
    while($clct_clt_prdt_dtl=$qst_clt_prdt_dtl->fetch_assoc())
{
    $prdt_id= $clct_clt_prdt_dtl['id'];
    $prdt_neme= $clct_clt_prdt_dtl['product_name'];
    ?>
    <option value="<?php echo $prdt_id?>"><?php echo $prdt_neme;?></option>
    <?php
}
    ?>

</select>
 
</div>




<div class="form-group col-md-6 col-xs-6 ">
<label class="form-label" style="font-size:16px !important;"> Select Price <span style="color:red;">*</span> <span id="prdt_count"></span></label>
<select name="prec_id" id="prec_id" class="form-control"  style="border: 2px solid grey!important;" required>
    <option value="">-Select Price-</option>


</select>
 
</div>


<div class="form-group col-md-6 col-xs-6 ">
<label class="form-label" style="font-size:16px !important;">Quantity<span style="color:red;">*</span></label>
<input type="number" name="quantity" class="form-control"  style="border: 2px solid grey!important;" required>


</div>

<div class="form-group col-md-4">
<label class="form-label" style="font-size:16px !important;"><span style="color:white;">.</span></label><br>
<button type='submit' name="submit" class='btn btn-primary mt-2'>Submit</button>
</div>
</div>
</form>

<?php 
if(isset($_POST['submit']))
{
    // Assuming the database connection is already established and stored in the variable $db.

    $assgn_role = mysqli_real_escape_string($db, $_POST['assgn_role']);
    $assgn_user_id = mysqli_real_escape_string($db, $_POST['assgn_user_id']);
    $prdt_id = mysqli_real_escape_string($db, $_POST['prdt_id']);
    $prec_id = mysqli_real_escape_string($db, $_POST['prec_id']);
     $quantity = mysqli_real_escape_string($db, $_POST['quantity']);

        $ad_prdt = "INSERT INTO `assign_product` SET
            `assign_user_id`='$assgn_user_id',
            `product_id`='$prdt_id',
            `qty`='$quantity',
            `status`=1,
            `created_by`='$admin_id',
            `added_on`='$timestamp',
            `price_product_id`='$prec_id'";

        $qst_ad_prdt = $db->query($ad_prdt);

        if($qst_ad_prdt)
        {
            echo "<script>window.alert('Assign Added Successfully');window.location='';</script>";
        }
        else
        {
            echo "<script>window.alert('Error');window.location='';</script>";
        }
   
}
?>



</div>
</div>
</main>




<?php include 'footer.php'; 
?>


<script>
$(document).ready(function() { 
 $("#assgn_usr , #prd_id , #role_idd").select2();
});



</script>



<script>
function get_product_qty(txt)
{
   // alert(txt);
 $.ajax
(
{
url     : 'get_product_qty_avbl_ajax.php',
type    : 'POST',
data    :{txt1:txt},
success : function(resp)
{
var obj=jQuery.parseJSON( resp );
if(obj.status=='1')
{
$('#prdt_count').html('<b>Total available Quantity <span style="color:' + obj.color + '">(' + obj.response + ')</span></b>');


} 

},
error   : function(resp)
{
}  
}
);  
}
</script>

<script>

function get_user(txt)
{
  $.ajax
(
{
url: "user_data_ajax.php",
type: "POST",
data    : {txt1:txt},
cache: false,
success: function(data)
{

$('#assgn_usr').html(data);

}
}
);
}



function get_product_price(txt)
{
$.ajax
(
{
url: "get_product_price_ajax.php",
type: "POST",
data    : {txt1:txt},
cache: false,
success: function(data)
{

$('#prec_id').html(data);

}
}
);

    
    
}
</script>




<script>
CKEDITOR.replace( 'descptn' );
CKEDITOR.replace( 'short_descptn' );
</script>

<?php
ob_flush();

?>