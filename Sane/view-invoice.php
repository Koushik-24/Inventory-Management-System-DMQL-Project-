<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['username']==0)) {
  header('location:logout.php');
  } else{ 
if(isset($_GET['del'])){    
$cmpid=substr(base64_decode($_GET['del']),0,-5);
$query=mysqli_query($con,"delete from tblcategory where id='$cmpid'");
echo "<script>alert('Category record deleted.');</script>";   
echo "<script>window.location.href='manage-categories.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Manage Invoices</title>
    <link href="dist/css/style.css" rel="stylesheet" type="text/css">
</head>
<body style="background-color:#f0f0f0;">
	<div class="hk-wrapper hk-vertical-nav" style="background-color:#f0f0f0; border-width:58px; border-style:solid; border-color:#f0f0f0;">
<?php include_once('includes/navbar.php');
include_once('includes/sidebar.php');
?>
        <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
        <div class="hk-pg-wrapper">

            <div class="container" style="background-color:black;">
<div class="hk-pg-header">
 <h4 class="hk-pg-title" style="color:#f0f0f0;">View Invoice</h4>
                </div>
                <div class="row">
                    <div class="col-xl-12">
  <section class="hk-sec-wrapper hk-invoice-wrap pa-35">
                            <div class="invoice-from-wrap">
                                <div class="row">
                                    <div class="col-md-7 mb-20">
<h3 class="mb-35 font-weight-800">INSANE</h3>
<h6 class="mb-5">INSANE Inventory management system</h6>
</div>
<?php 
$inid=substr(base64_decode($_GET['invid']),0,-5);


$query=mysqli_query($con,"select distinct tblorders.InvoiceNumber,tblcustomers.CustomerName,tblcustomers.CustomerContactNo,tblorders.PaymentMode  from tblorders join tblcustomers on tblorders.CustomerID=tblcustomers.CustomerID and tblorders.InvoiceNumber='$inid'");
$cnt=1;
while($row=mysqli_fetch_array($query))
{    
?>
<div class="col-md-5 mb-20">
<h4 class="mb-35 font-weight-600">Invoice / Receipt</h4>
<span class="d-block">Date:<span class="pl-10 text-dark"><?php echo $row['InvoiceGenDate'];?></span></span>
<span class="d-block">Invoice / Receipt #<span class="pl-10 text-dark"><?php echo $row['InvoiceNumber'];?></span></span>
<span class="d-block">Customer Name #<span class="pl-10 text-dark"><?php echo $row['CustomerName'];?></span></span>
<span class="d-block">Customer Mobile No #<span class="pl-10 text-dark"><?php echo $row['CustomerContactNo'];?></span></span>
<span class="d-block">Payment Mode #<span class="pl-10 text-dark"><?php echo $row['PaymentMode'];?></span></span>
</div>
</div>
</div>
<?php } ?>
<hr class="mt-0">
<div class="row">
<div class="col-sm">
<div class="table-wrap">
<table class="table mb-0" border="1">
<thead>
<tr>
<th>S No</th>
<th >Product Name</th>
<th>Category</th>
<th width="5%">Quantity</th>
<th width="10%">Unit Price</th>
<th width="10%">Price</th>
</tr>
                                            </thead>
                                            <tbody>
<?php 
$query=mysqli_query($con,"select tblproducts.CategoryCode,tblproducts.ProductName,tblproducts.ProductPrice,tblorders.Quantity  from tblorders join tblproducts on tblproducts.ProductName=tblorders.ProductName where tblorders.InvoiceNumber='$inid' order by tblorders.InvoiceNumber");
$cnt=1;
while($row=mysqli_fetch_array($query))
{    
?>                                                
<tr>
<td><?php echo $cnt;?></td>
<td><?php echo $row['ProductName'];?></td>
<td><?php echo $row['CategoryCode'];?></td>
<td><?php echo $qty=$row['Quantity'];?></td>
<td><?php echo $ppu=$row['ProductPrice'];?></td>
<td><?php echo $subtotal=number_format($ppu*$qty,2);?></td>
</tr>
<?php
$grandtotal+=$subtotal; 
$cnt++;
} ?>
  <tr>
<th colspan="6" style="text-align:center; font-size:20px;">Total</th> 
<th style="text-align:left; font-size:20px;"><?php echo number_format($grandtotal,2);?></th>
</tr>                                              
                                            </tbody>
                                        </table>
                                    </div>
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