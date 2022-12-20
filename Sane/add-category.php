
<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['username']==0)) {
  header('location:logout.php');
  } else{
if(isset($_POST['submit']))
{
$catname=$_POST['category']; 
$catcode=$_POST['categorycode'];



if ((!preg_match ("/^[a-zA-z]*$/", $catname) or $catname==NULL or $catcode==NULL or !preg_match ("/^[a-zA-z0-9]*$/", $catcode))) {  

}
else{
    $query=mysqli_query($con,"insert into tblcategory(CategoryName,CategoryCode) values('$catname','$catcode')"); 
} 




if($query){

echo "<script>alert('Category added successfully.');</script>";   
echo "<script>window.location.href='add-category.php'</script>";
} else{
echo "<script>alert('Invalid field names. Please enter the valid field names');</script>";   
echo "<script>window.location.href='add-category.php'</script>";    
}
}

    ?>
<?php
   
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Add Category</title>
    <link href="dist/css/style.css" rel="stylesheet" type="text/css">
</head>

<body style="background-color:#f0f0f0;">
	<div class="hk-wrapper hk-vertical-nav" style="border-width:58px; border-style:solid; border-color:#f0f0f0; " >
<?php include_once('includes/navbar.php');
include_once('includes/sidebar.php');
?>

        <div id="hk_nav_backdrop" class="hk-nav-backdrop" style="background-color:#f0f0f0;"></div>
        <div class="hk-pg-wrapper" style="background-color:#f0f0f0;">
            <div class="container" style="background-color:black;" >
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title" style="color:#f0f0f0;">Add Category</h4>
                </div>
                <div class="row">
                    <div class="col-xl-12">
<section class="hk-sec-wrapper" style="background-color:#f0f0f0;">

<div class="row" style="background-color:#f0f0f0;">
<div class="col-sm">
<form class="needs-validation" method="post" novalidate>
                                       
<div class="form-row">
<div class="col-md-6 mb-10">
<label for="validationCustom03">Category</label>
<input type="text" class="form-control" id="validationCustom03" placeholder="Category" name="category" pattern= [A-Za-Z] required>
<div class="invalid-feedback">Please provide a valid category name.</div>
</div>
</div>

<div class="form-row" >
<div class="col-md-6 mb-10" >
<label for="validationCustom03" >New Category Code</label>
<input type="text" class="form-control" id="validationCustom03" placeholder="Category Code" name="categorycode" pattern= [A-Za-Z0-9]{6} required>
<div class="invalid-feedback">Please provide a valid category code.</div>
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
    <script src="dist/css/jquery.min.js"></script>
    <script src="dist/css/bootstrap.min.js"></script>
</body>
</html>
<?php } ?>