<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['username']==0)) {
  header('location:logout.php');
  } else{
if(isset($_POST['submit']))
{
$storeid=mt_rand(1000,9999999); 
$zip=$_POST['zipcode'];
$location=$_POST['location']; 

if ((!preg_match ("/^[0-9]{5}/", $zip) or $storeid==NULL or $zip ==NULL or $location==NULL or !preg_match ("/^[a-zA-z0-9\s]*$/", $location))) {

}
else{
    $query=mysqli_query($con,"insert into stores(StoreID,ZipCode,Location) values('$storeid','$zip','$location')"); 
} 

if($query){
echo "<script>alert('Store added successfully.');</script>";   
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
    <title>Add Store</title>
    <link href="dist/css/style.css" rel="stylesheet" type="text/css">
</head>

<body style="background-color:#f0f0f0;">
    
    
	<div class="hk-wrapper hk-vertical-nav" style="border-width:58px; border-style:solid; border-color:#f0f0f0; " >

<?php include_once('includes/navbar.php');
include_once('includes/sidebar.php');
?>
       


        <div id="hk_nav_backdrop" class="hk-nav-backdrop" style="color:#f0f0f0;"></div>
        <div class="hk-pg-wrapper" style="background-color:#f0f0f0;">
        <div class="container" style="background-color:black;" >
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title" style="color:#f0f0f0;">Add Store</h4>
                </div>
                <div class="row">
                    <div class="col-xl-12">
<section class="hk-sec-wrapper" style="background-color:#f0f0f0;">

<div class="row" style="background-color:#f0f0f0;">
<div class="col-sm">
<form class="needs-validation" method="post" novalidate>
                                     
<div class="form-row">
<div class="col-md-6 mb-10">
<label for="validationCustom03">ZipCode</label>
<input type="text" class="form-control" id="validationCustom03" placeholder="Zip Code" name="zipcode" pattern="[0-9]{5}" required>
<div class="invalid-feedback">Please provide a valid ZipCode.</div>
</div>
</div>

<div class="form-row">
<div class="col-md-6 mb-10">
<label for="validationCustom03">Location</label>
<input type="text" class="form-control" id="validationCustom03" placeholder="Street Name" name="location" required>
<div class="invalid-feedback">Please provide a City and address.</div>
</div>
</div>

<div class="form-row">
<div class="col-md-6 mb-10">
<button class="" type="submit" name="submit" style="background-color:black; color:white">Submit</button>
</div>
</div>
</div>
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