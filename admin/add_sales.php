
<?php
@ob_start();
//session_start();
require_once 'config/config.php';
date_default_timezone_set("Asia/Kolkata");
$cr_dt_ymd=date('Y-m-d');


$year = date('Y');
$mnth = date('m');
$dye = date('d');


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
<li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;">Sale Product</li>
</ol>
<div class="container-fluid">


<form method="POST" action="" enctype="multipart/form-data">
<div class="row">
    
<div class="form-group col-md-6 col-xs-6 ">
<label class="form-label" style="font-size:13px !important;">Choose Role <span style="color:red;">*</span></label>
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
<label class="form-label" style="font-size:13px !important;"> user <span style="color:red;">*</span></label>
<select name="assgn_user_id" id="assgn_usr" class="form-control"  style="border: 2px solid grey!important;" required>
<option value="">Choose user</option>

</select>
 
</div>

<div class="form-group col-md-6 col-xs-6 ">
<label class="form-label" style="font-size:13px !important;"> Select Product <span style="color:red;">*</span> <span id="prdt_count"></span></label>
<select name="prdst_id[]" id="prd_id" class="form-control" onChange="get_product_qty(this.value);get_product_price(this.value)"  style="border: 2px solid grey!important;" required>
    <option value="">-Select Product-</option>
    <?php 
    $assignID =$_SESSION['a_id'];
    if($assignID==1){
    $clt_prdt_dtl="select * from `product`";
    }
    
else
    {
$clt_prdt_dtl="select * from `assign_product` where `assign_user_id`='$assignID'";
         
    }
    
    $qst_clt_prdt_dtl=$db->query($clt_prdt_dtl);
    while($clct_clt_prdt_dtl=$qst_clt_prdt_dtl->fetch_assoc())
{
    
    if($assignID==1)
    {
    
    
    
    $prdt_id= $clct_clt_prdt_dtl['id'];
    $prdt_neme= $clct_clt_prdt_dtl['product_name'];
    }
    
    else
    { 
        $prdt_id= $clct_clt_prdt_dtl['product_id'];
        
        $clt_prt_dtl="select * from `product` where `id`='$prdt_id'";
        $qst_clt_prt_dtl=$db->query($clt_prt_dtl);
        $clct_clt_prt_dtl=$qst_clt_prt_dtl->fetch_assoc();
        
         $prdt_neme= $clct_clt_prt_dtl['product_name'];
        
    }
    ?>
    <option value="<?php echo $prdt_id?>"><?php echo $prdt_neme;?></option>
    <?php
}
    ?>

</select>
 
</div>




<div class="form-group col-md-2 col-xs-2 ">
<label class="form-label" style="font-size:13px !important;">  Price <span style="color:red;">*</span> </label>
<input type="number" name="sale_prsice[]" step="0.01" id="prec_id" class="form-control"  style="border: 2px solid grey!important;" required>

</div>



<div class="form-group col-md-1 col-xs-1 ">
<label class="form-label" style="font-size:13px !important;">  Quantity <span style="color:red;"></span> </label>
<input type="number" name="qntsy[]" id="qnty_id" step="0.01" onKeyUp="quantity_availabily(this.value)"  onChange="quantity_availabily(this.value)" class="form-control" min='1' style="border: 2px solid grey!important;"  required>

</div>

<div class="form-group col-md-1 col-xs-1 ">
<label class="form-label" style="font-size:13px !important;"> Discount % <span style="color:red;"></span> </label>
<input type="number" name="dscont[]" min='0' value="0" step="0.01" id="dscnt_id" onKeyUp="apply_dscnt(this.value);"  onChange="apply_dscnt(this.value);" class="form-control"  style="border: 2px solid grey!important;" required>

</div>

<div class="form-group col-md-1 col-xs-1 ">
<label class="form-label" style="font-size:13px !important;"> Subtotal <span style="color:red;"></span> </label>
<input type="number" name="sb_ttl[]"  id="sbttl_id" class="form-control" step="0.01" style="border: 2px solid grey!important;padding:0px;" required>

</div>
<div class="form-group col-md-1 col-xs-1 ">
    <label class="form-label" style="font-size:13px !important;color:white">  . </label><br>
<button type='button' class='btn btn-sm btn-primary' onclick="append_class()">+</button>

 
</div>


</div>
<div class="append_row"></div>
<div class="form-group col-md-12">

<button type='submit' name="submit" class='btn btn-primary mt-2'>Submit</button>
</div>
</form>

<?php 
if(isset($_POST['submit']))
{
// Assuming the database connection is already established and stored in the variable $db.
$invc_nbr = "JGSW".rand(1111,99999).$year.$mnth.$dye;
$assgn_user_id = mysqli_real_escape_string($db, $_POST['assgn_user_id']);

$prdt_id = $_POST['prdst_id'];
$prec_id = $_POST['sale_prsice'];
$quantity =$_POST['qntsy'];
$dscnt = $_POST['dscont'];
$sbttl = $_POST['sb_ttl'];
$usr_count=count($prdt_id);

for($i=0;$i<$usr_count; $i++)
{
$ad_prdt = "INSERT INTO `product_sale` SET
`product_id`='$prdt_id[$i]',
`quantity`='$quantity[$i]',
`sale_by_id`='$admin_id',
`sale_to_id`='$assgn_user_id',
`price`='$prec_id[$i]',
`discount`='$dscnt[$i]',
`sub_total`='$sbttl[$i]',
`sale_date_time`='$current_date',
`invoice_number`='$invc_nbr'";

$qst_ad_prdt = $db->query($ad_prdt);

$stk_entry = "insert into `stock_quantity` set
`sale_to_id`='$assgn_user_id',
`sale_by_id`='$admin_id',
`product_id`='$prdt_id[$i]',
`quantity`='-$quantity[$i]',
`added_on_date`='$current_date'";
$qst_stk_entry=$db->query($stk_entry);
}
if($qst_ad_prdt)
{
echo "<script>window.alert('Sale Successfully');window.location='';</script>";
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
$('#prdt_count').html('<b>Total available Quantity <span style="color:' + obj.color + '">(' + obj.response + ') Assign quantity ('+obj.assign_qty+')</span></b>');

//  $('#qnty_id').attr('max', obj.response);


} 

},
error   : function(resp)
{
}  
}
);  
}

function getd_product_qty(txt , txt2)
{
    // alert(txt2);
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
$('#prdt_count'+txt2).html('<b>Total available Quantity <span style="color:' + obj.color + '">(' + obj.response + ')</span></b>');


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
var usre_id=$('#assgn_usr').val();
if(usre_id!='')
{
    //alert(usre_id);
 $.ajax
(
{
url     : 'get_product_sale_price_ajax.php',
type    : 'POST',
data    :{txt1:txt,txt2:usre_id},
success : function(resp)
{
var obj=jQuery.parseJSON( resp );
if(obj.status=='1')
{
$('#prec_id').val(obj.response);
} 

},
error   : function(resp)
{
}  
}
);  
}
else
{
    alert('Please Choose user.');
}
    
    
}



function gets_product_price(txt , unique_id)
{
    
var usre_id=$('#assgn_usr').val();
if(usre_id!='')
{
    //alert(usre_id);
 $.ajax
(
{
url     : 'get_product_sale_price_ajax.php',
type    : 'POST',
data    :{txt1:txt,txt2:usre_id},
success : function(resp)
{
var obj=jQuery.parseJSON( resp );
if(obj.status=='1')
{
$('#prec'+unique_id).val(obj.response);
} 

},
error   : function(resp)
{
}  
}
);  
}
else
{
    alert('Please Choose user.');
}
    
    

}
</script>

<!-- Make sure to include the jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
function generateUniqueId() {
  const timestamp = Date.now().toString(36); // Convert current timestamp to base36 string
  const randomNum = Math.random().toString(36).substr(2, 5); // Generate a random base36 string (5 characters)
  return timestamp + randomNum;
}
function append_class() {
     const uniqueId = generateUniqueId();

  // Use a backtick (`) for multi-line strings
  $('.append_row').append(`
    <div class='row' id="dvid${uniqueId}">
    <div class="form-group col-md-6 col-xs-6">
      <label class="form-label" style="font-size:13px !important;">Select Product <span style="color:red;">*</span> <span id="prdt_count${uniqueId}"></span></label>
      <select name="prdst_id[]" id="prdt${uniqueId}"class="form-control" onChange="getd_product_qty(this.value , '${uniqueId}');gets_product_price(this.value , '${uniqueId}')" style="border: 2px solid grey!important;" required>
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

    <div class="form-group col-md-2 col-xs-2">
      <label class="form-label" style="font-size:13px !important;">Price <span style="color:red;">*</span></label>
      <input type="number" id="prec${uniqueId}"  step="0.01" name="sale_prsice[]" class="form-control" style="border: 2px solid grey!important;" required>
    </div>

    <div class="form-group col-md-1 col-xs-1">
      <label class="form-label" style="font-size:13px !important;">Quantity <span style="color:red;">*</span></label>
      <input type="number" id="qnty_id${uniqueId}" step="0.01" onKeyUp="quantitys_availabily(this.value , '${uniqueId}')" onChange="quantitys_availabily(this.value , '${uniqueId}')" name="qntsy[]" min='1' class="form-control" style="border: 2px solid grey!important;" required>
    </div>
    
    
    
    
    <div class="form-group col-md-1 col-xs-1">
      <label class="form-label" style="font-size:13px !important;">Discount % <span style="color:red;"></span></label>
      <input type="number" id="dscnt_id${uniqueId}" step="0.01" onKeyUp="applyd_dscnt(this.value , '${uniqueId}');"  onChange="applyd_dscnt(this.value , '${uniqueId}');" name="dscont[]" class="form-control" style="border: 2px solid grey!important;" required>
    </div>
    
        <div class="form-group col-md-1 col-xs-1 ">
        <label class="form-label" style="font-size:13px !important;"> Subtotal <span style="color:red;"></span> </label>
        <input type="number" name="sb_ttl[]" step="0.01" id="sbttl_id${uniqueId}" class="form-control" style="border: 2px solid grey!important;padding:0px; text-align:center;"  required="">
        
        </div>
    
    

    <div class="form-group col-md-1 col-xs-1">
      <label class="form-label" style="font-size:13px !important;color:white">. <span id=""></span></label><br>
      <button type="button" class="btn btn-sm btn-danger" onClick="remove_dv('${uniqueId}')">-</button>
    </div>
    </div>
  `);
}

function remove_dv(txt)
{
    $(`#dvid${txt}`).remove();
}

function apply_dscnt(txt)
{
    
 
 var prec = $('#prec_id').val();
  var qnty_id = $('#qnty_id').val();
 var sb_ttl = prec*qnty_id;
 
 var aftr_dscnt = sb_ttl*txt/100;
 
 var deduct_dscnt = sb_ttl-aftr_dscnt;
 
    $('#sbttl_id').val(deduct_dscnt);
    
    
}


function applyd_dscnt(txt , unique_id)
{
 var prec = $('#prec'+unique_id).val();
  var qnty_id = $('#qnty_id'+unique_id).val();
 var sb_ttl = prec*qnty_id;
 
 var aftr_dscnt = sb_ttl*txt/100;
 
 var deduct_dscnt = sb_ttl-aftr_dscnt;
 
    $('#sbttl_id'+unique_id).val(deduct_dscnt);
    
    
}




function quantity_availabily(txt)
{
    var prdt_id = $('#prd_id').val();
    
    var prd_perec = $('#prec_id').val();
    
if(prdt_id!='')
{
$.ajax
(
{
url     : 'quantity_avbl_check_ajax.php',
type    : 'POST',
data    :{txt1:txt , txt2:prdt_id},
success : function(resp)
{
var obj=jQuery.parseJSON( resp );
if(obj.status=='1')
{


var sb_tl_amnt = prd_perec*txt;
$('#sbttl_id').val(sb_tl_amnt);



}
else
{ 
    alert('available quantity limit exceed');
    $('#qnty_id').val('');
    $('#sbttl_id').val('');
}

},
error   : function(resp)
{
}  
}
);  
}
else
{
    alert('please choose product .');
    $('#qnty_id').val('');
}
}


function quantitys_availabily(txt , unque_id)
{
    var prdt_id = $('#prdt'+unque_id).val();
    
    var prd_perec = $('#prec'+unque_id).val();
    
if(prdt_id!='')
{
$.ajax
(
{
url     : 'quantity_avbl_check_ajax.php',
type    : 'POST',
data    :{txt1:txt , txt2:prdt_id},
success : function(resp)
{
var obj=jQuery.parseJSON( resp );
if(obj.status=='1')
{
var sb_tl_amnt = prd_perec*txt;
$('#sbttl_id'+unque_id).val(sb_tl_amnt);
//alert(prd_perec);
}
else
{ 
    alert('available quantity limit exceed');
    $('#qnty_id'+unque_id).val('');
    $('#dscnt_id'+unque_id).val('');
}

},
error   : function(resp)
{
}  
}
);  
}
else
{
    alert('please choose product .');
    $('#qnty_id'+unque_id).val('');
}
}
</script>

<?php
ob_flush();

?>