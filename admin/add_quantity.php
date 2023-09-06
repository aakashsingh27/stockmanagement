
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

<?php include 'header.php'; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>

<div id="layoutSidenav_content">
<main>
<div class="container-fluid">

<ol class="breadcrumb mb-30 mt-2">
<li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;">Add Stock Quantity</li>
</ol>
<div class="container-fluid">


<form method="POST" action="" enctype="multipart/form-data">
<div class="row">
<div class="form-group col-md-6 col-xs-6 ">
<label class="form-label" style="font-size:16px !important;">Choose Product  <span style="color:red;">*</span> <span id='prdt_count'></span></label>
<select name="product_id"class="form-control"  onChange="get_product_qty(this.value)" style="border: 2px solid grey!important;" required>
<option value="">Choose Product</option>
<?php 
$clt_prdt_dtl="select * from `product`";
$qst_clt_prdt_dtl=$db->query($clt_prdt_dtl);
while($clct_clt_prdt_dtl=$qst_clt_prdt_dtl->fetch_assoc())
{
$prdt_neme=$clct_clt_prdt_dtl['product_name'];
$prdt_id=$clct_clt_prdt_dtl['id'];
    ?>
    <option value="<?php echo $prdt_id;?>"><?php echo $prdt_neme;?></option>
    <?php
}
?>
 </select>
</div>

<div class="form-group col-md-6 col-xs-6 ">
<label class="form-label" style="font-size:16px !important;"> Price <span style="color:red;">*</span></label>
<input type="number" name="price" class="form-control"  style="border: 2px solid grey!important;" required>
</div>


<div class="form-group col-md-6 col-xs-6 ">
<label class="form-label" style="font-size:16px !important;"> Quantity <span style="color:red;">*</span></label>
<input type="number" name="quantity" class="form-control"  style="border: 2px solid grey!important;" required>
</div>


<div class="form-group col-md-6 col-xs-6 ">
<label class="form-label" style="font-size:16px !important;">Choose Vendor<span style="color:red;">*</span></label>
<select name="vendor_id" class="form-control"  style="border: 2px solid grey!important;" required>
    <option value="">-Select Vendor-</option>
    <?php while($un=$venders->fetch_assoc()){ ?>
    <option value="<?php echo $un['id'] ?>"> <?php echo $un['name']  ?> </option>
    <?php } ?>

</select>

</div>




<div class="form-group col-md-12">

<button type='submit' name="submit" class='btn btn-primary'>Submit</button>
</div>
</div>
</form>

<?php 
if(isset($_POST['submit']))
{
// Assuming the database connection is already established and stored in the variable $db.

$product_iid = mysqli_real_escape_string($db, $_POST['product_id']);
$preece = mysqli_real_escape_string($db, $_POST['price']);
$qnnty = mysqli_real_escape_string($db, $_POST['quantity']);
$vndr_id = mysqli_real_escape_string($db, $_POST['vendor_id']);


$ad_prdt = "INSERT INTO `stock_quantity` SET
`vendor_id`='$vndr_id',
`product_id`='$product_iid',
`per_product_price`='$preece',
`add_by_user_id`='$admin_id',
`added_on_date`='$timestamp',
`quantity`='$qnnty'";

$qst_ad_prdt = $db->query($ad_prdt);

if($qst_ad_prdt)
{
echo "<script>window.alert('Product quantity added successfully');window.location='';</script>";
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



<?php
ob_flush();

?>