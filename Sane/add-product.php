<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['username']==0)) {
  header('location:logout.php');
  } else{
if(isset($_POST['submit']))
{
$catcode=$_POST['categorycode'];
$pname=$_POST['productname'];
$pprice=$_POST['productprice'];

if ((!preg_match ("/^[0-9]*$/", $pprice)  or $pname ==NULL or $pprice ==NULL or !preg_match('/^[a-z][a-z_\-0-9]*/i', $pname))) {

}
else{
    $query=mysqli_query($con,"insert into tblproducts(CategoryCode,ProductName,ProductPrice) values('$catcode','$pname','$pprice')"); 
}

if($query){
echo "<script>alert('Product added successfully.');</script>";   
echo "<script>window.location.href='add-product.php'</script>";
} else{
echo "<script>alert('Something went wrong. Please try again.');</script>";   
echo "<script>window.location.href='add-product.php'</script>";    
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
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title" style="color:#f0f0f0;">Add Product</h4>
                </div>
                <div class="row">
                    <div class="col-xl-12">
<section class="hk-sec-wrapper" style="background-color:#f0f0f0;">

<div class="row">
<div class="col-sm">
<form class="needs-validation" method="post" novalidate>
                                       
<div class="form-row">
<div class="col-md-6 mb-10">
<label for="validationCustom03">Category Name</label>
 <select class="form-control custom-select" name="category" required>
<option value="">Select category name</option>
<?php
$ret=mysqli_query($con,"select CategoryName from tblcategory");
while($row=mysqli_fetch_array($ret))
{?>
<option value="<?php echo $row['CategoryName'];?>"><?php echo $row['CategoryName'];?></option>
<?php } ?>
</select>
<div class="invalid-feedback">Please select a category name</div>
</div>
</div>


<div class="form-row">
<div class="col-md-6 mb-10">
<label for="validationCustom03">Category Code</label>
 <select class="form-control custom-select" name="categorycode" required>
<option value="">Select category code</option>
<?php
$ret=mysqli_query($con,"select CategoryCode from tblcategory");
while($row=mysqli_fetch_array($ret))
{?>
<option value="<?php echo $row['CategoryCode'];?>"><?php echo $row['CategoryCode'];?></option>
<?php } ?>
</select>
<div class="invalid-feedback">Please select a category code</div>
</div>
</div>


 <div class="form-row">
<div class="col-md-6 mb-10">
<label for="validationCustom03">New Product Name</label>
<input type="text" class="form-control" id="validationCustom03" placeholder="Product Name" name="productname" required>
<div class="invalid-feedback">Please provide a valid product name.</div>
</div>
</div>   

<div class="form-row">
<div class="col-md-6 mb-10">
<label for="validationCustom03">Product Price</label>
<input type="text" class="form-control" id="validationCustom03" placeholder="Product Price" name="productprice" required>
<div class="invalid-feedback">Please provide a valid product price.</div>
</div>
</div>

<button class="" type="submit" name="submit" style="background-color:black; color:white">Submit</button>
</form>
</div>
</div>
</section>
                     
</div>
</div>
</div>
    </div>

    <script src="dist/css/jquery.min.js"></script>
    <script src="dist/css/bootstrap.min.js"></script>
</body>
</html>
<?php } ?>