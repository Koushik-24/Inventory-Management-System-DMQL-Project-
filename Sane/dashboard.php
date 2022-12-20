<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['username']==0)) {
  header('location:logout.php');
  } else{ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Dashboard</title>
    <link href="dist/css/style.css" rel="stylesheet" type="text/css">
</head>
<body style="background-color:#f0f0f0;">
	<div class="hk-wrapper hk-vertical-nav" style="border-width:58px; border-style:solid; border-color:#f0f0f0; ">
<?php include_once('includes/navbar.php');
include_once('includes/sidebar.php');
?>
        <div id="hk_nav_backdrop" class="hk-nav-backdrop" style="background-color:black;"></div>
        <div class="hk-pg-wrapper">
            <div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hk-row">
<?php
$query=mysqli_query($con,"select CategoryCode from tblcategory");
$listedcat=mysqli_num_rows($query);
?>
<div class="col-lg-3 col-md-6"  >
<div class="card card-sm" >
<div class="card-body">
<div class="d-flex justify-content-between mb-5" style="background-color:black; ">
<div>
<span class="d-block font-15 font-weight-500" style="color:white;">Categories</span>
</div>
</div>
<div class="text-center">
<span class="d-block display-4 text-dark mb-5"><?php echo $listedcat;?></span>
<small class="d-block">Listed Categories</small>
</div>
</div>
</div>
</div>
<?php
$ret=mysqli_query($con,"select StoreID from Stores");
$listedcomp=mysqli_num_rows($ret);
?>
<div class="col-lg-3 col-md-6">
<div class="card card-sm">
<div class="card-body">
<div class="d-flex justify-content-between mb-5" style="background-color:black; ">
<div>
<span class="d-block font-15 font-weight-500" style="color:white;" >Stores</span>
</div>
<div>
</div>
</div>
<div class="text-center">
<span class="d-block display-4 text-dark mb-5"><span class="counter-anim"><?php echo $listedcomp;?></span></span>
<small class="d-block">Listed Stores</small>
</div>
</div>
</div>
</div>						
<?php
$sql=mysqli_query($con,"select ProductName from tblproducts");
$listedproduct=mysqli_num_rows($sql);
?>
<div class="col-lg-3 col-md-6">
<div class="card card-sm">
<div class="card-body">
<div class="d-flex justify-content-between mb-5" style="background-color:black; ">
<div>
<span class="d-block font-15 font-weight-500" style="color:white;">Products</span>
</div>
<div>
</div>
</div>
<div class="text-center">
<span class="d-block display-4 text-dark mb-5"><?php echo $listedproduct;?></span>
<small class="d-block">Listed Products</small>
</div>
</div>
</div>
</div>
<?php
$query=mysqli_query($con,"select sum(tblorders.Quantity*tblproducts.ProductPrice) as tt  from tblorders join tblproducts on tblproducts.ProductName=tblorders.ProductName ");
$row=mysqli_fetch_array($query);
?>
<div class="col-lg-3 col-md-6">
<div class="card card-sm">
<div class="card-body">
<div class="d-flex justify-content-between mb-5" style="background-color:black; ">
<div>
<span class="d-block font-15  font-weight-500" style="color:white;">Total Sales</span>
</div>
<div>
</div>
</div>
<div class="text-center">
<span class="d-block display-4 text-dark mb-5"><?php echo number_format($row['tt'],2);?></span>
<small class="d-block">Total sales till date</small>
</div>
</div>
</div>
</div>	
<?php
$qury=mysqli_query($con,"select sum(tblorders.Quantity*tblproducts.ProductPrice) as tt  from tblorders join tblproducts on tblproducts.ProductName=tblorders.ProductName where date(tblorders.InvoiceGenDate)>=(DATE(NOW()) - INTERVAL 7 DAY)");
$row=mysqli_fetch_array($qury);
?>
<div class="col-lg-3 col-md-6">
<div class="card card-sm">
<div class="card-body">
<div class="d-flex justify-content-between mb-5" style="background-color:black; ">
<div>
<span class="d-block font-15  font-weight-500" style="color:#f0f0f0; ">Last 7 Days Sales</span>
</div>
<div>
</div>
</div>
<div class="text-center">
<span class="d-block display-4 text-dark mb-5"><?php echo number_format($row['tt'],2);?></span>
<small class="d-block">Last 7 Days Total Sales</small>
</div>
</div>
</div>
</div>

<?php
$qurys=mysqli_query($con,"select sum(tblorders.Quantity*tblproducts.ProductPrice) as tt  from tblorders join tblproducts on tblproducts.ProductName=tblorders.ProductName where date(tblorders.InvoiceGenDate)=CURDATE()-1");
$rw=mysqli_fetch_array($qurys);
?>
<div class="col-lg-3 col-md-6">
<div class="card card-sm">
<div class="card-body">
<div class="d-flex justify-content-between mb-5" style="background-color:black; ">
<div>
<span class="d-block font-15 font-weight-500" style="color:#f0f0f0; ">Yesterday Sales</span>
</div>
<div>
</div>
</div>
<div class="text-center">
<span class="d-block display-4 text-dark mb-5"><?php echo number_format($rw['tt'],2);?></span>
<small class="d-block">Yesterday Total Sales</small>
</div>
</div>
</div>
</div>

<?php
$quryss=mysqli_query($con,"select sum(tblorders.Quantity*tblproducts.ProductPrice) as tt  from tblorders join tblproducts on tblproducts.ProductName=tblorders.ProductName where date(tblorders.InvoiceGenDate)=CURDATE()");
$rws=mysqli_fetch_array($quryss);
?>
<div class="col-lg-3 col-md-6">
<div class="card card-sm">
<div class="card-body">
<div class="d-flex justify-content-between mb-5" style="background-color:black; ">
<div>
<span class="d-block font-15 font-weight-500" style="color:#f0f0f0; ">Today's Sales</span>
</div>
<div>
</div>
</div>
<div class="text-center">
<span class="d-block display-4 text-dark mb-5"><?php echo number_format($rws['tt'],2);?></span>
<small class="d-block">Today's Total Sales</small>
</div>
</div>
</div>
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