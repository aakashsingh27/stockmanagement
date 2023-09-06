
<?php
@ob_start();
//session_start();
require_once 'config/config.php';
date_default_timezone_set("Asia/Kolkata");
$cr_dt_ymd=date('Y-m-d');



if(isset($_GET['id']))
{
    $buckt_id= $_GET['id'];
    
    $clt_bckt_dtl="select * from `product_bucket` where `id`='$buckt_id'";
    $qst_clt_bckt_dtl=$db->query($clt_bckt_dtl);
    $cct_clt_bckt_dtl=$qst_clt_bckt_dtl->fetch_assoc();
    
    $buc_nme = $cct_clt_bckt_dtl['bucket_name'];
    
        $prdt_id = $cct_clt_bckt_dtl['product_id'];
            $prdt_qty = $cct_clt_bckt_dtl['product_qty'];
            
            $explode_prdt = explode(' ,',$prdt_id);
            $explode_tyq = explode(' ,',$prdt_qty);
            
             $data_all = array_combine($explode_prdt,$explode_tyq);
             
             
}
  
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
<li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;">Add Bucket</li>
</ol>
<div class="container-fluid">


<form method="POST" action="" enctype="multipart/form-data">
<div class="row">
<div class="form-group col-md-12 col-xs-12 ">
<label class="form-label" style="font-size:16px !important;">Bucket name <span style="color:red;">*</span></label>
<input type='text' name="bucket_name" value="<?php echo $buc_nme;?>" placeholder="Enter role name" class="form-control"  style="border: 2px solid grey!important;" required>
 
</div>
<div class="form-group col-md-12 col-xs-12 ">
<label class="form-label" style="font-size:16px !important;"></label>

 
</div>




<!--<div class="form-group col-md-4">
<label class="form-label" style="font-size:16px !important;"><span style="color:white;">.</span></label><br>
<button type='submit' name="submit" class='btn btn-primary mt-2'>Submit</button>
</div>-->
</div>



<div class='row'>

<div class="col-md-2 col-xs-2 ">
<label class="form-label" style="font-size:16px !important;">Products :</label>

</div>


<div class="col-md-4 col-xs-4">
    <?php
    $clt_prdt_details="select * from `product`";
    $qst_clt_prdt_details=$db->query($clt_prdt_details);
    while($clct_prdt_details=$qst_clt_prdt_details->fetch_assoc())
    {
        $prdt_neme = $clct_prdt_details['product_name'];
          $prdt_id = $clct_prdt_details['id'];
    ?>
<div class='form-group'>
    
<label class="form-label" on style="font-size:16px !important;"><input onChange="firstvalueshow('product_<?php echo $prdt_id ?>' , this.checked, this.value)"  type="checkbox" id="vw_role_id"  class="roles_permission" value="<?php echo $prdt_id;?>" <?php if (in_array($prdt_id, $explode_prdt)) { echo "checked";} ?> name="product_id[]"> <?php echo $prdt_neme;?> </label>

</div>
<?php 
}
?>
</div>

<div class="col-md-4 col-xs-4">
    <?php
    $clt_prdt_details="select * from `product`";
    $qst_clt_prdt_details=$db->query($clt_prdt_details);
    while($clct_prdt_details=$qst_clt_prdt_details->fetch_assoc())
    {
        $prdt_neme = $clct_prdt_details['product_name'];
          $prdt_id = $clct_prdt_details['id'];
          
           $clt_prds_prec = "select * from `default_price` where `product_id`='$prdt_id'";
          $qst_clt_prds_prec=$db->query($clt_prds_prec);
          $clct_clt_prds_prec=$qst_clt_prds_prec->fetch_assoc();
          
          $prddt_pdrec = $clct_clt_prds_prec['price'];
          
    ?>
<div class='form-group'>
    
<input type='number' onChange="calculte_price(this.value , <?php echo $prdt_id;?> , <?php echo $prddt_pdrec;?>)" onKeyup="calculte_price(this.value , <?php echo $prdt_id ?> , <?php echo $prddt_pdrec;?>)" min="1"

<?php
if(isset($data_all[$prdt_id]))
{ 
?> 

value="<?php echo  $data_all[$prdt_id] ?>"

<?php }
else
{ ?> 
 
style="visibility:hidden"
disabled
value="1"
<?php } ?>

 id="product_<?php echo $prdt_id ?>" name="prdt_qty[]"  >

</div>
<?php 
}
?>
</div>



<div class='col-md-2 col-xs-2'>
    <div class="form-group">
   <?php
    $clt_prsdt_details="select * from `product`";
    $qst_clt_sprdt_details=$db->query($clt_prsdt_details);
    while($clct_sprdt_details=$qst_clt_sprdt_details->fetch_assoc())
    {
        //$prdt_neme = $clct_sprdt_details['product_name'];
        
        
          $prdta_id = $clct_sprdt_details['id'];
          
          $clt_prd_prec = "select * from `default_price` where `product_id`='$prdta_id'";
          $qst_clt_prd_prec=$db->query($clt_prd_prec);
          $clct_clt_prd_prec=$qst_clt_prd_prec->fetch_assoc();
          
          $prdt_pdrec = $clct_clt_prd_prec['price'];
    ?>
    <div class='form-group'>
    
<input type='number' value="<?php if(isset($data_all[$prdta_id])) { echo $prdt_pdrec*$data_all[$prdta_id]; } else { echo $prdt_pdrec;}?>" id="prec_<?php echo $prdta_id;?>" <?php
if(isset($data_all[$prdta_id]))
{ 
?> class="inp_prcec"  style="visibility: visible;" <?php } else { ?>style="visibility: hidden;" <?php } ?>disabled >

</div>

<?php 
}
?>
</div>
</div>
</div>




<div class='row'>
<div class='col-md-12 mt-5'>
    <p id="totalResult" style="float:right;font-weight:bold"></p>
<button type="submit"  name="sbmt"class='btn btn-primary'>Submit</button>
</div>
</div>
</form>


<?php 
if(isset($_POST['sbmt']))
{
    $product_id = implode(' ,',$_POST['product_id']);
     $product_qty = implode(' ,',$_POST['prdt_qty']);
      $bucket_name = $_POST['bucket_name'];
  
       

 $add_role="update `product_bucket` set
`bucket_name`='$bucket_name',
`product_qty`='$product_qty',
`product_id`='$product_id' where `id`='$buckt_id'";


$qst_add_role=$db->query($add_role);
 if($qst_add_role)
 {
echo "<script>window.alert('Bucket updated successfully');window.location='';</script>";
 }

}
?>


</div>
</div>
</main>




<?php include 'footer.php'; 
?>


<script>

   function selectRoles(id,clss){
          var checked = $('#'+id).prop('checked')
           if(checked){
                  $('.'+clss).prop('checked',true);
           }else{
                  $('.'+clss).prop('checked',false);
           }
     }

     function firstvalueshow(id,value ,iid){
   
      
         
      if(value){
    
         $('#'+id).prop('disabled',false);
         $('#'+id).css('visibility', 'visible');
          //alert(iid);
         $('#prec_'+iid).addClass('inp_prcec');
         
          $('#prec_'+iid).css('visibility', 'visible');
         
         //new code start
       var total = 0;
                $('.inp_prcec').each(function() {
                    var inputValue = parseFloat($(this).val()) || 0;
                    total += inputValue;
                });
                $('#totalResult').text('Total: ' + total);
       //new code end
         
         
      }else{
         $('#'+id).prop('disabled',true);
               $('#'+id).css('visibility', 'hidden');
                    $('#prec_'+iid).css('visibility', 'hidden');
               $('#prec_'+iid).removeClass('inp_prcec');
               
               
               //new code start
       var total = 0;
                $('.inp_prcec').each(function() {
                    var inputValue = parseFloat($(this).val()) || 0;
                    total += inputValue;
                });
                $('#totalResult').text('Total: ' + total);
       //new code end
               
               
      }
     }
     
       function calculte_price(quantity ,product_id , price)
     {
         if(quantity > 0)
         {
       var sb_price = price*quantity;
       $('#prec_'+product_id).val(sb_price);
       
       
       
       
       //new code start
       var total = 0;
                $('.inp_prcec').each(function() {
                    var inputValue = parseFloat($(this).val()) || 0;
                    total += inputValue;
                });
                $('#totalResult').text('Total: ' + total);
       //new code end

         }
         else
         {
             alert('Enter valid quantity');
           $('#product_'+product_id).val(1);
         }
      
     }
     
     window.onload = function() {
  onLod();
};
     
     function onLod()
     {
          //new code start
       var total = 0;
                $('.inp_prcec').each(function() {
                    var inputValue = parseFloat($(this).val()) || 0;
                    total += inputValue;
                });
                $('#totalResult').text('Total: ' + total);
       //new code end
     }
   </script>
</script>

<?php
ob_flush();

?>