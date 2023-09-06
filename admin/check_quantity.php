
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
<li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;">Check Stock Quantity</li>
</ol>
<div class="container-fluid">


<form method="POST" action="" enctype="multipart/form-data">
<div class="row">
<div class="form-group col-md-12 col-xs-12 ">
<label class="form-label" style="font-size:16px !important;">Choose Product  </label>
<select name="product_id" class="form-control"  id="prd_id" onChange="get_product_qty(this.value);get_product_price(this.value);getProductReport(this.value)" style="border: 2px solid grey!important;" required>
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



</div>
</form>

<div class="vvbvbv"></div>
</div>
</div>
</main>








<?php include 'footer.php'; 
?>



<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>

<script>
function get_product_qty(txt)
{
    $('#prdt_qnty').val('');
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

$('#prece').html(data);

}
}
);

    
    
}



function get_price_quantity(txt)
{
    var prdt_id=$('#prd_id').val();

if(prdt_id!='')
{
 $.ajax
(
{
url     : 'get_product_qty_ajax.php',
type    : 'POST',
data    :{txt1:txt,txt2:prdt_id},
success : function(resp)
{
var obj=jQuery.parseJSON( resp );
if(obj.status=='1')
{
$('#prdt_qnty').val(obj.response);


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
    alert('Please select product');
}
}

function getProductReport(id){
  $.ajax
(
{
url     : 'filer_check.php',
type    : 'POST',
data    :{txt1:id},
success : function(resp)
{
console.log(resp);
$('.vvbvbv').html(resp);
   
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