
<?php
@ob_start();
//session_start();
require_once 'config/config.php';
date_default_timezone_set("Asia/Kolkata");
$cr_dt_ymd=date('Y-m-d');

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
<li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;">Add Role</li>
</ol>
<div class="container-fluid">


<form method="POST" action="" enctype="multipart/form-data">
<div class="row">
<div class="form-group col-md-12 col-xs-12 ">
<label class="form-label" style="font-size:16px !important;">Role name <span style="color:red;">*</span></label>
<input type='text' name="role_name" placeholder="Enter role name" class="form-control"  style="border: 2px solid grey!important;" required>
 
</div>
<div class="form-group col-md-12 col-xs-12 ">
<label class="form-label" style="font-size:16px !important;">Permission :</label>

 
</div>




<!--<div class="form-group col-md-4">
<label class="form-label" style="font-size:16px !important;"><span style="color:white;">.</span></label><br>
<button type='submit' name="submit" class='btn btn-primary mt-2'>Submit</button>
</div>-->
</div>



<div class='row'>

<div class="col-md-4 col-xs-4 ">
<label class="form-label" style="font-size:16px !important;">Roles :</label>

</div>
<div class="col-md-4 col-xs-4 ">
<label class="form-label" style="font-size:16px !important;"><input type="checkbox" onChange="selectRoles('selectAll_role' ,'roles_permission' )" id="selectAll_role" > Select all </label>

</div>

<div class="col-md-4 col-xs-4 ">
<div class='form-group'>
<label class="form-label" style="font-size:16px !important;"><input type="checkbox" id="vw_role_id" class="roles_permission" value="view_role" name="role_value[]"> View Role </label>
</div>
<div class='form-group'>
<label class="form-label" style="font-size:16px !important;"><input type="checkbox" onChange="firstvalueshow('vw_role_id' , this.checked)" class="roles_permission" name="role_value[]" value="add_role"> Add Role </label>
</div>
<div class='form-group'>
<label class="form-label" style="font-size:16px !important;"><input type="checkbox" class="roles_permission" onChange="firstvalueshow('vw_role_id' , this.checked)" name="role_value[]" value="edit_role"> Edit Role </label>
</div>

<div class='form-group'>
<label class="form-label" style="font-size:16px !important;"><input type="checkbox"class="roles_permission"  onChange="firstvalueshow('vw_role_id' , this.checked)" name="role_value[]" value="delete_role"> Delete Role </label>
</div>
</div>
</div>



<!-----------user role start------ ----->
<div class='row mt-5'>
<div class='col-md-12'>
    <hr>
</div>
<div class="col-md-4 col-xs-4 ">
<label class="form-label" style="font-size:16px !important;">Users :</label>

</div>
<div class="col-md-4 col-xs-4 ">
<label class="form-label" style="font-size:16px !important;"><input type="checkbox" onChange="selectRoles('selectAll_user_role' ,'roles_user_permission' )" id="selectAll_user_role" > Select all </label>

</div>

<div class="col-md-4 col-xs-4 ">
<div class='form-group'>
<label class="form-label" style="font-size:16px !important;"><input type="checkbox" id="vw_user_id" value="view_user" class="roles_user_permission" name="role_value[]"> View User </label>
</div>
<div class='form-group'>
<label class="form-label" style="font-size:16px !important;"><input type="checkbox" onChange="firstvalueshow('vw_user_id' , this.checked)" class="roles_user_permission" name="role_value[]" value="add_user"> Add User </label>
</div>
<div class='form-group'>
<label class="form-label" style="font-size:16px !important;"><input type="checkbox" class="roles_user_permission" onChange="firstvalueshow('vw_user_id' , this.checked)" name="role_value[]" value="edit_user"> Edit User </label>
</div>

<div class='form-group'>
<label class="form-label" style="font-size:16px !important;"><input type="checkbox"class="roles_user_permission"  onChange="firstvalueshow('vw_user_id' , this.checked)" name="role_value[]" value="delete_user"> Delete User </label>
</div>
</div>
</div>
<!-----------user role end----------------->


<!-------category role start--------->
<div class='row mt-5'>
<div class='col-md-12'>
    <hr>
</div>
<div class="col-md-4 col-xs-4 ">
<label class="form-label" style="font-size:16px !important;">Categories :</label>

</div> 
<div class="col-md-4 col-xs-4 ">
<label class="form-label" style="font-size:16px !important;"><input type="checkbox" onChange="selectRoles('selectAll_categoryrole' ,'roles_category_permission' )" id="selectAll_categoryrole" > Select all </label>

</div>

<div class="col-md-4 col-xs-4 ">
<div class='form-group'>
<label class="form-label" style="font-size:16px !important;"><input type="checkbox" id="vw_ctegory_id" class="roles_category_permission" name="role_value[]" value="view_category"> View Category </label>
</div>
<div class='form-group'>
<label class="form-label" style="font-size:16px !important;"><input type="checkbox" onChange="firstvalueshow('vw_ctegory_id' , this.checked)" class="roles_category_permission" name="role_value[]" value="add_category"> Add Category </label>
</div>
<div class='form-group'>
<label class="form-label" style="font-size:16px !important;"><input type="checkbox" class="roles_category_permission" onChange="firstvalueshow('vw_ctegory_id' , this.checked)" name="role_value[]" value="edit_category"> Edit Category </label>
</div>

<div class='form-group'>
<label class="form-label" style="font-size:16px !important;"><input type="checkbox"class="roles_category_permission"  onChange="firstvalueshow('vw_ctegory_id' , this.checked)" name="role_value[]" value="delete_category"> Delete Category </label>
</div>
</div>
</div>
<!-------category role end------------->

<!------unit role start------------------>
<div class='row mt-5'>
<div class='col-md-12'>
    <hr>
</div>
<div class="col-md-4 col-xs-4 ">
<label class="form-label" style="font-size:16px !important;">Unit :</label>

</div> 
<div class="col-md-4 col-xs-4 ">
<label class="form-label" style="font-size:16px !important;"><input type="checkbox" onChange="selectRoles('selectAll_unitrole' ,'roles_unit_permission' )" id="selectAll_unitrole" > Select all </label>

</div>

<div class="col-md-4 col-xs-4 ">
<div class='form-group'>
<label class="form-label" style="font-size:16px !important;"><input type="checkbox" id="vw_unit_id" class="roles_unit_permission" value="view_unit" name="role_value[]"> View Unit </label>
</div>
<div class='form-group'>
<label class="form-label" style="font-size:16px !important;"><input type="checkbox" onChange="firstvalueshow('vw_unit_id' , this.checked)" class="roles_unit_permission" name="role_value[]"  value="add_unit"> Add Unit </label>
</div>
<div class='form-group'>
<label class="form-label" style="font-size:16px !important;"><input type="checkbox" class="roles_unit_permission" onChange="firstvalueshow('vw_unit_id' , this.checked)" name="role_value[]"  value="edit_unit"> Edit Unit </label>
</div>

<div class='form-group'>
<label class="form-label" style="font-size:16px !important;"><input type="checkbox"class="roles_unit_permission"  onChange="firstvalueshow('vw_unit_id' , this.checked)" name="role_value[]"  value="delete_unit"> Delete Unit </label>
</div>
</div>
</div>
<!------unit role end---------------------->




<!-----Vendor role start----------------------->
<div class='row mt-5'>
<div class='col-md-12'>
    <hr>
</div>
<div class="col-md-4 col-xs-4 ">
<label class="form-label" style="font-size:16px !important;">Vendor :</label>

</div> 
<div class="col-md-4 col-xs-4 ">
<label class="form-label" style="font-size:16px !important;"><input type="checkbox" onChange="selectRoles('selectAll_vendorrole' ,'roles_vendor_permission' )" id="selectAll_vendorrole" > Select all </label>

</div>

<div class="col-md-4 col-xs-4 ">
<div class='form-group'>
<label class="form-label" style="font-size:16px !important;"><input type="checkbox" id="vw_vendor_id" class="roles_vendor_permission" name="role_value[]" value="view_vendor"> View Vendor </label>
</div>
<div class='form-group'>
<label class="form-label" style="font-size:16px !important;"><input type="checkbox" onChange="firstvalueshow('vw_vendor_id' , this.checked)" class="roles_vendor_permission" name="role_value[]" value="add_vendor">  Add Vendor </label>
</div>
<div class='form-group'>
<label class="form-label" style="font-size:16px !important;"><input type="checkbox" class="roles_vendor_permission" onChange="firstvalueshow('vw_vendor_id' , this.checked)" name="role_value[]" value="edit_vendor"> Edit Vendor </label>
</div>

<div class='form-group'>
<label class="form-label" style="font-size:16px !important;"><input type="checkbox"class="roles_vendor_permission"  onChange="firstvalueshow('vw_vendor_id' , this.checked)" name="role_value[]" value="delete_vendor"> Delete Vendor </label>
</div>
</div>
</div>
<!-----Vendor role end-------------------->

<!-----Product role start------------------------>
<div class='row mt-5'>
<div class='col-md-12'>
    <hr>
</div>
<div class="col-md-4 col-xs-4 ">
<label class="form-label" style="font-size:16px !important;">Product :</label>

</div> 
<div class="col-md-4 col-xs-4 ">
<label class="form-label" style="font-size:16px !important;"><input type="checkbox" onChange="selectRoles('selectAll_productrole' ,'roles_product_permission' )" id="selectAll_productrole" > Select all </label>

</div>

<div class="col-md-4 col-xs-4 ">
<div class='form-group'>
<label class="form-label" style="font-size:16px !important;"><input type="checkbox" id="vw_product_id" class="roles_product_permission" name="role_value[]" value="view_product"> View Product </label>
</div>
<div class='form-group'>
<label class="form-label" style="font-size:16px !important;"><input type="checkbox" onChange="firstvalueshow('vw_product_id' , this.checked)" class="roles_product_permission" name="role_value[]" value="add_product"> Add Product </label>
</div>
<div class='form-group'>
<label class="form-label" style="font-size:16px !important;"><input type="checkbox" class="roles_product_permission" onChange="firstvalueshow('vw_product_id' , this.checked)" name="role_value[]" value="edit_product"> Edit Product </label>
</div>

<div class='form-group'>
<label class="form-label" style="font-size:16px !important;"><input type="checkbox"class="roles_product_permission"  onChange="firstvalueshow('vw_product_id' , this.checked)" name="role_value[]" value="delete_product"> Delete Product </label>
</div>
</div>
</div>
<!-----Product role end ------------------------->



<!-----Quantity role start------------------------>
<div class='row mt-5'>
<div class='col-md-12'>
    <hr>
</div>
<div class="col-md-4 col-xs-4 ">
<label class="form-label" style="font-size:16px !important;">Quantity :</label>

</div> 
<div class="col-md-4 col-xs-4 ">
<label class="form-label" style="font-size:16px !important;"><input type="checkbox" onChange="selectRoles('selectAll_quantityrole' ,'roles_quantity_permission' )" id="selectAll_quantityrole" > Select all </label>

</div>

<div class="col-md-4 col-xs-4 ">
<div class='form-group'>
<label class="form-label" style="font-size:16px !important;"><input type="checkbox" id="vw_quantity_id" class="roles_quantity_permission" name="role_value[]" value="view_quantity"> View Quantity </label>
</div>
<div class='form-group'>
<label class="form-label" style="font-size:16px !important;"><input type="checkbox" onChange="firstvalueshow('vw_quantity_id' , this.checked)" class="roles_quantity_permission" name="role_value[]" value="add_quantity"> Add Quantity </label>
</div>
<div class='form-group'>
<label class="form-label" style="font-size:16px !important;"><input type="checkbox" class="roles_quantity_permission" onChange="firstvalueshow('vw_quantity_id' , this.checked)" name="role_value[]" value="edit_quantity"> Edit Quantity </label>
</div>

<div class='form-group'>
<label class="form-label" style="font-size:16px !important;"><input type="checkbox"class="roles_quantity_permission"  onChange="firstvalueshow('vw_quantity_id' , this.checked)" name="role_value[]" value="delete_quantity"> Delete Quantity </label>
</div>
</div>
</div>
<!-----Quantity role end------------------------------->

<!----Manage bucket role start-------------------------------------->

<div class='row mt-5'>
<div class='col-md-12'>
    <hr>
</div>
<div class="col-md-4 col-xs-4 ">
<label class="form-label" style="font-size:16px !important;">Manage Bucket :</label>

</div> 
<div class="col-md-4 col-xs-4 ">
<label class="form-label" style="font-size:16px !important;"><input type="checkbox" onChange="selectRoles('selectAll_bucketrole' ,'roles_bucket_permission' )" id="selectAll_bucketrole"> Select all </label>

</div>

<div class="col-md-4 col-xs-4 ">
<div class='form-group'>
<label class="form-label" style="font-size:16px !important;"><input type="checkbox" id="vw_bucket_id" class="roles_bucket_permission" name="role_value[]" value="view_bucket"> View Bucket </label>
</div>
<div class='form-group'>
<label class="form-label" style="font-size:16px !important;"><input type="checkbox" onChange="firstvalueshow('vw_bucket_id' , this.checked)" class="roles_bucket_permission" name="role_value[]" value="add_bucket"> Add Bucket </label>
</div>
<div class='form-group'>
<label class="form-label" style="font-size:16px !important;"><input type="checkbox" class="roles_bucket_permission" onChange="firstvalueshow('vw_bucket_id' , this.checked)" name="role_value[]" value="edit_bucket"> Edit Bucket </label>
</div>

<div class='form-group'>
<label class="form-label" style="font-size:16px !important;"><input type="checkbox"class="roles_bucket_permission"  onChange="firstvalueshow('vw_bucket_id' , this.checked)" name="role_value[]" value="delete_bucket"> Delete Bucket </label>
</div>
</div>
</div>

<!----Manage bucket role end-------------------------------------->

<!----Manage product sale price start-------------------------------->

<div class='row mt-5'>
<div class='col-md-12'>
    <hr>
</div>
<div class="col-md-4 col-xs-4 ">
<label class="form-label" style="font-size:16px !important;">Manage Product sale price :</label>

</div> 
<div class="col-md-4 col-xs-4 ">
<label class="form-label" style="font-size:16px !important;">
    <input type="checkbox" onChange="selectRoles('selectAll_product_salerole' ,'roles_product_sale_permission' )" id="selectAll_product_salerole"> select all </label>

</div>

<div class="col-md-4 col-xs-4 ">
<div class='form-group'>
<label class="form-label" style="font-size:16px !important;"><input type="checkbox" id="vw_prdt_sale_price_id" class="roles_product_sale_permission" name="role_value[]" value="view_product_sale_price"> View product sale price </label>
</div>
<div class='form-group'>
<label class="form-label" style="font-size:16px !important;"><input type="checkbox" onChange="firstvalueshow('vw_prdt_sale_price_id' , this.checked)" class="roles_product_sale_permission" name="role_value[]" value="add_product_sale_price"> Add product sale price </label>
</div>
<div class='form-group'>
<label class="form-label" style="font-size:16px !important;"><input type="checkbox" class="roles_product_sale_permission" onChange="firstvalueshow('vw_prdt_sale_price_id' , this.checked)" name="role_value[]" value="edit_product_sale_price"> Edit product sale price  </label>
</div>

<!--<div class='form-group'>
<label class="form-label" style="font-size:16px !important;"><input type="checkbox"class="roles_bucket_permission"  onChange="firstvalueshow('vw_bucket_id' , this.checked)" name="role_value[]" value="delete_quantity"> Delete Bucket </label>
</div>-->
</div>
</div>

<!----Manage product sale price end-------------------------------->



<!--MANAGE ASSIGN PRODUCT START-->

<div class='row mt-5'>
<div class='col-md-12'>
    <hr>
</div>
<div class="col-md-4 col-xs-4 ">
<label class="form-label" style="font-size:16px !important;">Manage Assign product :</label>

</div> 
<div class="col-md-4 col-xs-4 ">
<label class="form-label" style="font-size:16px !important;">
    <input type="checkbox" onChange="selectRoles('selectAll_assign_product' ,'roles_assign_product_permission' )" id="selectAll_assign_product"> select all </label>

</div>

<div class="col-md-4 col-xs-4 ">
<div class='form-group'>
<label class="form-label" style="font-size:16px !important;"><input type="checkbox" id="vw_unassgn_pr_id" class="roles_assign_product_permission" name="role_value[]" value="view_assign_product"> View Assign product </label>
</div>
<div class='form-group'>
<label class="form-label" style="font-size:16px !important;"><input type="checkbox" onChange="firstvalueshow('vw_unassgn_pr_id' , this.checked)" class="roles_assign_product_permission" name="role_value[]" value="assign_product"> Assign product </label>
</div>
<div class='form-group'>
<label class="form-label" style="font-size:16px !important;"><input type="checkbox" class="roles_assign_product_permission" onChange="firstvalueshow('vw_unassgn_pr_id' , this.checked)" name="role_value[]" value="unassign_product"> Unassign product  </label>
</div>


</div>
</div>



<!--MANAGE ASSIGN PRODUCT END-->



<!---MANAGE SALES START----->


<div class='row mt-5'>
<div class='col-md-12'>
    <hr>
</div>
<div class="col-md-4 col-xs-4 ">
<label class="form-label" style="font-size:16px !important;">Manage Sale :</label>

</div> 
<div class="col-md-4 col-xs-4 ">
<label class="form-label" style="font-size:16px !important;">
    <input type="checkbox" onChange="selectRoles('selectAll_sales' ,'manage_sale_product_permission' )" id="selectAll_sales"> select all </label>

</div>

<div class="col-md-4 col-xs-4 ">
<div class='form-group'>
<label class="form-label" style="font-size:16px !important;"><input type="checkbox" id="vw_sales_pr_id" class="manage_sale_product_permission" name="role_value[]" value="view_sale_product"> View Sale product </label>
</div>
<div class='form-group'>
<label class="form-label" style="font-size:16px !important;"><input type="checkbox" onChange="firstvalueshow('vw_sales_pr_id' , this.checked)" class="manage_sale_product_permission" name="role_value[]" value="sales_product"> Add sale product </label>
</div>
<div class='form-group'>
<label class="form-label" style="font-size:16px !important;"><input type="checkbox" class="manage_sale_product_permission" onChange="firstvalueshow('vw_sales_pr_id' , this.checked)" name="role_value[]" value="sales_bucket"> sale Bucket  </label>
</div>


</div>
</div>


<!---MANAGE SALE END--->


<!----------Manage basic price start----------------->
<div class='row mt-5'>
<div class='col-md-12'>
    <hr>
</div>
<div class="col-md-4 col-xs-4 ">
<label class="form-label" style="font-size:16px !important;">Manage Basic Price :</label>

</div> 
<div class="col-md-4 col-xs-4 ">
<label class="form-label" style="font-size:16px !important;">
    <input type="checkbox" onChange="selectRoles('selectAll_basic_price' ,'manage_basic_price' )" id="selectAll_basic_price"> select all </label>

</div>

<div class="col-md-4 col-xs-4 ">
<div class='form-group'>
<label class="form-label" style="font-size:16px !important;"><input type="checkbox" id="vw_sales_bsc_id" class="manage_basic_price" name="role_value[]" value="view_basic_price"> View Basic price </label>
</div>
<div class='form-group'>
<label class="form-label" style="font-size:16px !important;"><input type="checkbox" onChange="firstvalueshow('vw_sales_bsc_id' , this.checked)" class="manage_basic_price" name="role_value[]" value="add_basic_price"> Add basic price </label>
</div>
<div class='form-group'>
<label class="form-label" style="font-size:16px !important;"><input type="checkbox" class="manage_basic_price" onChange="firstvalueshow('vw_sales_bsc_id' , this.checked)" name="role_value[]" value="edit_basic_price">edit basic price  </label>
</div>


</div>
</div>
<!----------Manage basic price end------------------->

<!-----Check stock quantity start----------------->

<div class='row mt-5'>
<div class='col-md-12'>
    <hr>
</div>
<div class="col-md-4 col-xs-4 ">
<label class="form-label" style="font-size:16px !important;">Check Stock Quantity :</label>

</div> 
<div class="col-md-4 col-xs-4 ">
<label class="form-label" style="font-size:16px !important;"><input type="checkbox" onChange="selectRoles('selectAll_stockquantityrole' ,'roles_stockquantity_permission' )" id="selectAll_stockquantityrole" > Select all </label>

</div>

<div class="col-md-4 col-xs-4 ">
<div class='form-group'>
<label class="form-label" style="font-size:16px !important;"><input type="checkbox" id="vw_squantity_id" class="roles_stockquantity_permission" name="role_value[]" value="check_quantity"> Check Quantity </label>
</div>

</div>
</div>


<!-----check stock quantity end--------------------->

<div class='row'>
<div class='col-md-12 mt-5'>
<button type="submit" name="sbmt"class='btn btn-primary'>Submit</button>
</div>
</div>
</form>


<?php 
if(isset($_POST['sbmt']))
{
    $role = $_POST['role_name'];
   $permission = $_POST['role_value'];
   $impld_aarr = implode(" ,",$permission);

$clt_dplc="select * from `roles_and_permission` where `roles_name`='$role'";
$qst_clt_dplc=$db->query($clt_dplc);

$clt_nbr = mysqli_num_rows($qst_clt_dplc);
if($clt_nbr==0)
{
$add_role="insert into `roles_and_permission` set
`roles_name`='$role',
`permissions`='$impld_aarr',
`added_by`='$admin_id',
`created_date_time`='$timestamp'

";
$qst_add_role=$db->query($add_role);
 if($qst_add_role)
 {
echo "<script>window.alert('Role and permission added successfully');window.location='';</script>";
 }
}
else
{
    echo "<script>window.alert('This role is already added please try again .');window.location='';</script>";
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

     function firstvalueshow(id,value){
      var checked = $('#'+id).prop('checked')
      
      if(value){
         if(!checked){
         $('#'+id).prop('checked',true);
         }
      }else{
         $('#'+id).prop('checked',false);
      }
     }
   </script>
</script>

<?php
ob_flush();

?>