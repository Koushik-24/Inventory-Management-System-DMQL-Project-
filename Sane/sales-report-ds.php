<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['username']==0)) {
  header('location:logout.php');
  } else{
if(isset($_POST['submit']))
{
$cname=$_POST['companyname'];   
$query=mysqli_query($con,"insert into tblcompany(CompanyName) values('$cname')"); 
if($query){
echo "<script>alert('Company added successfully.');</script>";   
echo "<script>window.location.href='add-company.php'</script>";
} else{
echo "<script>alert('Something went wrong. Please try again.');</script>";   
echo "<script>window.location.href='add-company.php'</script>";    
}
}

    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Sales Report</title>
    <link href="vendors/jquery-toggles/css/toggles.css" rel="stylesheet" type="text/css">
    <link href="vendors/jquery-toggles/css/themes/toggles-light.css" rel="stylesheet" type="text/css">
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
                    <h4 class="hk-pg-title" style="color:#f0f0f0;">Sales Report Date Selection</h4>
                </div>
                <div class="row">
                    <div class="col-xl-12">
<section class="hk-sec-wrapper" style="background-color:#f0f0f0;">

<div class="row">
<div class="col-sm">
<form class="needs-validation" method="post" action="sales-report-details.php" novalidate>
                                       
<div class="form-row">
<div class="col-md-6 mb-10">
<label for="validationCustom03">From Date</label>
<input class="form-control" type="date" name="fromdate" required />
<div class="invalid-feedback">Please provide a valid from date.</div>
</div>
</div>

<div class="form-row">
<div class="col-md-6 mb-10">
<label for="validationCustom03">To Date</label>
<input class="form-control" type="date" name="todate" required  />
<div class="invalid-feedback">Please provide a valid to date.</div>
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

    </div>

    <script src="dist/css/jquery.min.js"></script>
    <script src="dist/css/js/bootstrap.min.js"></script>


</body>
</html>
<?php } ?>