<?php
session_start();

include('includes/config.php');
if (strlen($_SESSION['username']==0)) {
  header('location:logout.php');
  } else{

if(isset($_POST['update']))
{
$pname=$_POST['productname'];
$catname=$_POST['category'];

$ccode=mysqli_query($con,"select CategoryCode from tblcategory where CategoryName = '$catname'");
while($max=mysqli_fetch_array($ccode)){
$newccode=$max[0];
}
$pprice=$_POST['productprice'];
 
if($pname!=NUll and $pprice!=NULL and $pprice>0)
{

    $query=mysqli_query($con,"update tblproducts set CategoryCode='$newccode',ProductPrice='$pprice' where ProductName='$pname'"); 
    echo "<script>alert('Product updated successfully.');</script>";   
    echo "<script>window.location.href='manage-products.php'</script>";

}
else{

    echo "<script>alert('Please enter valid field values');</script>";   

}


}

    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Add Product</title>
    <link href="dist/css/style.css" rel="stylesheet" type="text/css">
</head>

<body style="background-color:#f0f0f0;">
    

	<div class="hk-wrapper hk-vertical-nav" style="border-width:58px; border-style:solid; border-color:#f0f0f0; ">

<?php include_once('includes/navbar.php');
include_once('includes/sidebar.php');
?>
       


        <div id="hk_nav_backdrop" class="hk-nav-backdrop" style="background-color:#f0f0f0;"></div>

        <div class="hk-pg-wrapper" style="background-color:#f0f0f0;">

            <div class="container" style="background-color:black;">

                <div class="hk-pg-header" >
                    <h4 class="hk-pg-title" style="color:#f0f0f0;">Edit Product</h4>
                </div>

                <div class="row">
                    <div class="col-xl-12">
<section class="hk-sec-wrapper" style="background-color:#f0f0f0;">

<div class="row">
<div class="col-sm">
<form class="needs-validation" method="post" novalidate>
<?php


// echo '<script>alert("Invoice genrated successfully. Invoice number is "+"'.print_r(array_keys($_GET)).'")</script>';





$pname=base64_decode($_GET['productname']);



// echo '<script>alert("Invoice genrated successfully. Invoice number is "+"'.$pname.'")</script>'; 



$query=mysqli_query($con,"select * from tblproducts where ProductName='$pname'");
while($result=mysqli_fetch_array($query))
{    
?>                                       
<div class="form-row">
<div class="col-md-6 mb-10">
<label for="validationCustom03">Category</label>
 <select class="form-control custom-select" name="category" required>
<?php
$ret=mysqli_query($con,"select CategoryName from tblcategory");
while($row=mysqli_fetch_array($ret))
{?>

<option value="<?php echo $row['CategoryName'];?>"><?php echo $row['CategoryName'];?></option>
<?php } ?>
</select>
<div class="invalid-feedback">Please select a category.</div>
</div>
</div>

 <div class="form-row">
<div class="col-md-6 mb-10">
<label for="validationCustom03">Product Name</label>
<input type="text" class="form-control" id="validationCustom03" value="<?php echo $result['ProductName'];?>" name="productname" required>
<div class="invalid-feedback">Please provide a valid product name.</div>
</div>
</div>   

<div class="form-row">
<div class="col-md-6 mb-10">
<label for="validationCustom03">Product Price</label>
<input type="text" class="form-control" id="validationCustom03" value="<?php echo $result['ProductPrice'];?>" name="productprice" required>
<div class="invalid-feedback">Please provide a valid product price.</div>
</div>
</div>
<?php } ?>
<button class="" type="submit" name="update" style="background-color:black; color:white">Update</button>
</form>
</div>
</div>
</section>
                     
</div>
</div>
</div>



        </div>

    </div>

    <script src="dist/css/jquery.min.js"></script>
    <script src="dist/css/bootstrap.min.js"></script>

</body>
</html>
<?php } ?>