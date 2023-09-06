
<?php
@ob_start();
//session_start();
require_once 'config/config.php';
date_default_timezone_set("Asia/Kolkata");
$cr_dt_ymd=date('Y-m-d');
$cur_dt_teme = date('Y-m-d H:i:s');
$yera = date('Y');
$mnth = date('m');
$dye = date('d');
?>


<?php include 'header.php'; ?>


<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>

<div id="layoutSidenav_content">
<main>
<div class="container-fluid">

<ol class="breadcrumb mb-30 mt-2">
<li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;">Add Bucket Sell</li>
</ol>
<div class="container-fluid">


<form method="POST" action="" enctype="multipart/form-data">
<div class="row">
<div class="form-group col-md-6 col-xs-6 ">
<label class="form-label" style="font-size:16px !important;">Role <span style="color:red;">*</span></label>
<select name="role" id="role_id" class="form-control"  onchange="get_user(this.value)" style="border: 2px solid grey!important;" required>
<option value="">Choose Role</option>

<?php 
$clt_rle = "select * from `roles_and_permission`";
$qst_clt_rle=$db->query($clt_rle);
while($clct_clt_rle=$qst_clt_rle->fetch_assoc())
{
$role_id=$clct_clt_rle['id'];
$role_name=$clct_clt_rle['roles_name'];

?>
<option value="<?php echo $role_id;?>"><?php echo $role_name;?></option>
<?php
}
?>


 </select>
</div>

<div class="form-group col-md-6 col-xs-6 ">
<label class="form-label" style="font-size:16px !important;">Users <span style="color:red;">*</span></label>
<select name="user_id" id="assgn_usr" class="form-control"  style="border: 2px solid grey!important;" required>
 <option value="">Choose User</option>
 </select>
</div>

<div class="form-group col-md-4 col-xs-4 ">
<label class="form-label" style="font-size:16px !important;">Choose Bucket <span style="color:red;">*</span></label>
<select name="bucket_id" id="prdrt_id" onChange="getPrice(this.value)" class="form-control"  style="border: 2px solid grey!important;" required>
<option value="">Choose Bucket</option>

<?php 
$clt_prdt="select * from `product_bucket`";
$qst_clt_prdt=$db->query($clt_prdt);
while($clct_clt_prdt=$qst_clt_prdt->fetch_assoc())
{
    $predt_neme = $clct_clt_prdt['bucket_name'];
     $predt_id = $clct_clt_prdt['id'];
    ?>
    
    <option value="<?php echo $predt_id;?>"><?php echo $predt_neme;?></option>
    <?php
}
?>
</select>
 
</div>

<div class="form-group col-md-4 col-xs-4 ">
<label class="form-label" style="font-size:16px !important;">Quantity. <span style="color:red;">*</span></label>
<input type='number' onKeyUp="autocount(this.value)" onChange="autocoun(this.value)"  name="qty" placeholder="Enter Quantity" class="form-control" value="1"  style="border: 2px solid grey!important;" >
 
</div>

<div class="form-group col-md-4 col-xs-4 ">
<label class="form-label" style="font-size:16px !important;">Total Price. <span style="color:red;">*</span></label>
<input type='text' id="preecc" name="price" placeholder="Total Price" class="form-control"  style="border: 2px solid grey!important;" >
 
</div>

<input type='hidden' id="rrrrr" name="price" placeholder="Total Price" class="form-control"  style="border: 2px solid grey!important;" >
 

<div class="form-group col-md-4">
<label class="form-label" style="font-size:16px !important;"><span style="color:white;">.</span></label><br>
<button type='submit' name="submit" class='btn btn-primary mt-2'>Submit</button>
</div>
</div>
</form>

<?php 
if(isset($_POST['submit']))
{
   
   if($admin_id==1)
   {
   
    $rand_nbr = rand(1111,99999);
    


    // Assuming the database connection is already established and stored in the variable $db.
$invc_nbr = "BJGSW".$rand_nbr.$yera.$mnth.$dye;
    $usr_iid = mysqli_real_escape_string($db, $_POST['user_id']);
    $prdt_iid = mysqli_real_escape_string($db, $_POST['bucket_id']);
    $prece = mysqli_real_escape_string($db, $_POST['qty']);
   
    $clt_dplc = "SELECT * FROM `product_bucket` WHERE `id`='$prdt_iid'";
    $qst_clt_dplc = $db->query($clt_dplc);
    $clt_clt_dplc=$qst_clt_dplc->fetch_assoc();
    
    $prdt_id = $clt_clt_dplc['product_id'];
    $prdt_qty = $clt_clt_dplc['product_qty'];


$exp_prdt_id = explode(" ,",$prdt_id);
$exp_prdt_qty = explode(" ,",$prdt_qty);

$combined_array = array_combine($exp_prdt_id , $exp_prdt_qty);

//print_r($combined_array);



//die();
$stopLopp=0;
foreach($combined_array as $prdt_iiid=>$prdt_qqnty)
{
// echo "product_id: $prdt_iiid, quantity: $prdt_qqnty";

$clt_check_avblty = "select sum(`quantity`) as `available_quantity` from `stock_quantity` where `product_id`='$prdt_iiid'";

$qst_clt_check_avblty=$db->query($clt_check_avblty);
$clct_clt_check_avblty=$qst_clt_check_avblty->fetch_assoc();

$avabl_qnty = $clct_clt_check_avblty['available_quantity'];


$ttl_assign_qty = "select sum(`qty`) as `assign_quantity` from `assign_product` where `product_id`='$prdt_iiid' and `status`=1";
$qst_ttl_assign_qty=$db->query($ttl_assign_qty);
$clct_ttl_assign_qty=$qst_ttl_assign_qty->fetch_assoc();

$asg_qty = $clct_ttl_assign_qty['assign_quantity'];


$avbl_qnty=$avabl_qnty-$asg_qty;



//echo $avbl_qnty."<br>";

if($prdt_qqnty <=  $avbl_qnty)
{
$stats= 1;
}
else
{

$get_prdt_dtl="select * from `product` where `id`='$prdt_iiid'";
$qst_get_prdt_dtl=$db->query($get_prdt_dtl);
$clct_get_prdt_dtl=$qst_get_prdt_dtl->fetch_assoc();

$prdt_neme = $clct_get_prdt_dtl['product_name'];

echo "<script>window.alert('$prdt_neme is not available');</script>";
$stopLopp =2;



 //  stop();
}

}

//echo $stopLopp;

//die();

if($stopLopp==0)
{

foreach($combined_array as $prdt_iiid=>$prdt_qqnty)
{
    
    $clt_bsic_prec = "select * from `default_price` where `product_id`='$prdt_iiid'";
    $qst_clt_bsic_prec=$db->query($clt_bsic_prec);
    $clct_clt_bsic_prec=$qst_clt_bsic_prec->fetch_assoc();
    
    $predc_prec = $clct_clt_bsic_prec['price'];
    
    
    $add_stk_qty = "insert into `stock_quantity` set
    `sale_to_id`='$usr_iid',
    `sale_by_id`='$admin_id',
    `product_id`='$prdt_iiid',
    `per_product_price`='$predc_prec',
    `added_on_date`='$cr_dt_ymd',
    `quantity`='-$prdt_qqnty'";
    
    $qst_add_stk_qty=$db->query($add_stk_qty);
    
    
    
    $sb_ttl = $prece*$predc_prec;
    
    $ad_prdt_sele = "insert into `product_sale` set
    `discount`='0',
    `sub_total`='$sb_ttl',
    `product_id`='$prdt_iiid',
    `quantity`='$prdt_qqnty',
    `sale_by_id`='$admin_id',
    `sale_to_id`='$usr_iid',
    `sale_date_time`='$cr_dt_ymd',
    `price`='$predc_prec',
    `invoice_number`='$invc_nbr' ";
    
    $qst_ad_prdt_sele=$db->query($ad_prdt_sele);
}


        $ad_prdt = "INSERT INTO `buclet_sell` SET
        `bucket_id`='$prdt_iid',
        `qty`='$prece',
        `selled_user_id`='$usr_iid',
        `created_by`='$admin_id',
        `added_on`='$timestamp'";


        $qst_ad_prdt = $db->query($ad_prdt);

        if($qst_ad_prdt)
        {
            echo "<script>window.alert('Sell Successfully');window.location='';</script>";
        }
        else
        {
            echo "<script>window.alert('Error');window.location='';</script>";
        }
}
else
{
    echo "<script>window.alert('Some product is not available in this kit please try again');</script>";
}
    // }
    // else
    // {
    //     echo "<script>window.alert('This User is already exist please try again');window.location='';</script>";
    // }
   }
   else
   {
    $rand_nbr = rand(1111,99999);
    // Assuming the database connection is already established and stored in the variable $db.
$invc_nbr = "BJGSW".$rand_nbr;
    $usr_iid = mysqli_real_escape_string($db, $_POST['user_id']);
    $prdt_iid = mysqli_real_escape_string($db, $_POST['bucket_id']);
    $prece = mysqli_real_escape_string($db, $_POST['qty']);
   
    $clt_dplc = "SELECT * FROM `product_bucket` WHERE `id`='$prdt_iid'";
    $qst_clt_dplc = $db->query($clt_dplc);
    $clt_clt_dplc=$qst_clt_dplc->fetch_assoc();
    
    $prdt_id = $clt_clt_dplc['product_id'];
    $prdt_qty = $clt_clt_dplc['product_qty'];


$exp_prdt_id = explode(" ,",$prdt_id);
$exp_prdt_qty = explode(" ,",$prdt_qty);

$combined_array = array_combine($exp_prdt_id , $exp_prdt_qty);

//print_r($combined_array);



//die();
$stopLopp=0;
foreach($combined_array as $prdt_iiid=>$prdt_qqnty)
{
// echo "product_id: $prdt_iiid, quantity: $prdt_qqnty";
/*
$clt_check_avblty = "select sum(`quantity`) as `available_quantity` from `stock_quantity` where `product_id`='$prdt_iiid'";

$qst_clt_check_avblty=$db->query($clt_check_avblty);
$clct_clt_check_avblty=$qst_clt_check_avblty->fetch_assoc();

$avabl_qnty = $clct_clt_check_avblty['available_quantity'];
*/


$ttl_assign_qty = "select sum(`qty`) as `assign_quantity` from `assign_product` where `product_id`='$prdt_iiid' and `assign_user_id`='$admin_id'";
$qst_ttl_assign_qty=$db->query($ttl_assign_qty);
$clct_ttl_assign_qty=$qst_ttl_assign_qty->fetch_assoc();

$avabl_qnty = $clct_ttl_assign_qty['assign_quantity'];




$assgn_sum = "select sum(`qty`) as `assgn_qnty` from `assign_product` where `created_by`='$admin_id' and `product_id`='$prdt_iiid' ";
$qst_assgn_sum=$db->query($assgn_sum);
$clct_assgn_sum=$qst_assgn_sum->fetch_assoc();

$asg_quantity = $clct_assgn_sum['assgn_qnty'];

$avbl_qnty = $avabl_qnty-$asg_quantity;









/*

$ttl_assign_qty = "select sum(`qty`) as `assign_quantity` from `assign_product` where `product_id`='$prdt_iiid' and `status`=1";
$qst_ttl_assign_qty=$db->query($ttl_assign_qty);
$clct_ttl_assign_qty=$qst_ttl_assign_qty->fetch_assoc();

$asg_qty = $clct_ttl_assign_qty['assign_quantity'];


$avbl_qnty=$avabl_qnty-$asg_qty;*/



//echo $avbl_qnty."<br>";

if($prdt_qqnty <=  $avbl_qnty)
{
$stats= 1;
}
else
{

$get_prdt_dtl="select * from `product` where `id`='$prdt_iiid'";
$qst_get_prdt_dtl=$db->query($get_prdt_dtl);
$clct_get_prdt_dtl=$qst_get_prdt_dtl->fetch_assoc();

$prdt_neme = $clct_get_prdt_dtl['product_name'];

echo "<script>window.alert('$prdt_neme is not available');</script>";
$stopLopp =2;



 //  stop();
}

}

//echo $stopLopp;

//die();

if($stopLopp==0)
{

foreach($combined_array as $prdt_iiid=>$prdt_qqnty)
{
    
    $clt_bsic_prec = "select * from `default_price` where `product_id`='$prdt_iiid'";
    $qst_clt_bsic_prec=$db->query($clt_bsic_prec);
    $clct_clt_bsic_prec=$qst_clt_bsic_prec->fetch_assoc();
    
    $predc_prec = $clct_clt_bsic_prec['price'];
    
    
    $add_stk_qty = "insert into `stock_quantity` set
    `sale_to_id`='$usr_iid',
    `sale_by_id`='$admin_id',
    `product_id`='$prdt_iiid',
    `per_product_price`='$predc_prec',
    `added_on_date`='$cr_dt_ymd',
    `quantity`='-$prdt_qqnty'";
    
    $qst_add_stk_qty=$db->query($add_stk_qty);
    
    
    
    $sb_ttl = $prece*$predc_prec;
    
    $ad_prdt_sele = "insert into `product_sale` set
    `discount`='0',
    `sub_total`='$sb_ttl',
    `product_id`='$prdt_iiid',
    `quantity`='$prdt_qqnty',
    `sale_by_id`='$admin_id',
    `sale_to_id`='$usr_iid',
    `sale_date_time`='$cr_dt_ymd',
    `price`='$predc_prec',
    `invoice_number`='$invc_nbr' ";
    
    $qst_ad_prdt_sele=$db->query($ad_prdt_sele);
    
    
    
    //new start
    
     $clt_prdt_dttl="select * from `assign_product` where `assign_user_id`='$admin_id' and `product_id`='$prdt_iiid'";
    $qst_clt_prdt_dttl=$db->query($clt_prdt_dttl);
    $clct_clt_prdt_dttl=$qst_clt_prdt_dttl->fetch_assoc();
    
    $crt_by =$clct_clt_prdt_dttl['created_by'];
    $prdt_prec_id =$clct_clt_prdt_dttl['price_product_id'];
    
    
$insrt_assgn_stk = "insert into `assign_product` set
`assign_user_id`='$admin_id',
`product_id`='$prdt_iiid',
`qty`='-$prdt_qqnty',
`created_by`='$crt_by',
`status`='2',
`added_on`='$cur_dt_teme',
`price_product_id`='$prdt_prec_id'";
$qst_insrt_assgn_stk=$db->query($insrt_assgn_stk);

    
    //new end
    
    
    
    
}


        $ad_prdt = "INSERT INTO `buclet_sell` SET
        `bucket_id`='$prdt_iid',
        `qty`='$prece',
        `selled_user_id`='$usr_iid',
        `created_by`='$admin_id',
        `added_on`='$timestamp'";


        $qst_ad_prdt = $db->query($ad_prdt);

        if($qst_ad_prdt)
        {
            echo "<script>window.alert('Sell Successfully');window.location='';</script>";
        }
        else
        {
            echo "<script>window.alert('Error');window.location='';</script>";
        }
}
else
{
    echo "<script>window.alert('Some product is not available in this kit please try again');</script>";
}
    // }
    // else
    // {
    //     echo "<script>window.alert('This User is already exist please try again');window.location='';</script>";
    // }
     
   }
}
?>



</div>
</div>
</main>




<?php include 'footer.php'; 
?>


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

$(document).ready(function() { 
 $("#assgn_usr , #role_id , #prdrt_id").select2();
});
</script>


<script>
CKEDITOR.replace( 'descptn' );
CKEDITOR.replace( 'short_descptn' );
</script>
<script>
function getPrice(bucket_id){
    
    //new start
    $.ajax
(
{
url     : 'getbucketprice.php',
type    : 'POST',
data    :{txt1:bucket_id},
success : function(resp)
{
var obj=jQuery.parseJSON( resp );

  
$('#preecc').val(obj.prec);

$('#rrrrr').val(obj.prec);

},
error   : function(resp)
{
}  
}
);
    //new end
    
    
}

function autocount(sno){
    var num = $('#rrrrr').val();
    let total = num * sno;
    $('#preecc').val(total);
}
function autocoun(sno){
    var num = $('#rrrrr').val();
    let total = num * sno;
    $('#preecc').val(total);
}
</script>
<?php
ob_flush();

?>