<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['username']==0)) {
  header('location:logout.php');
  } else{
if(isset($_POST['submit']))
{
$adminid=$_SESSION['username'];


// echo '<script>alert("Invoice genrated successfully. Invoice number is "+"'.$_SESSION['username'].'")</script>'; 


$cpassword=$_POST['currentpassword'];

// echo '<script>alert("Invoice genrated successfully. Invoice number is "+"'.$adminid.'")</script>'; 



$newpassword=$_POST['newpassword'];





$query=mysqli_query($con,"select AdminName from tbladmin where UserName='$adminid' and   Password='$cpassword'");
$row=mysqli_fetch_array($query);

if($cpassword!=NULL and $newpassword!=NULL and $row>0 and preg_match ("/^[a-zA-z0-9\@ \-]*$/", $newpassword))
{
$ret=mysqli_query($con,"update tbladmin set Password='$newpassword' where UserName='$adminid'");
echo "<script>alert('Password changed successfully.');</script>";   
echo "<script>window.location.href='change-password.php'</script>";
}   

else
{
echo "<script>alert('Please enter valid details');</script>";   
echo "<script>window.location.href='change-password.php'</script>";
}



}

    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Change Password</title>
    <link href="dist/css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
function checkpass()
{
if(document.changepassword.newpassword.value!=document.changepassword.confirmpassword.value)
{
alert('New Password and Confirm Password field does not match');
document.changepassword.confirmpassword.focus();
return false;
}
return true;
}   
</script>    
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
                    <h4 class="hk-pg-title" style="color:#f0f0f0;">Admin Change Password</h4>
                </div>

                <div class="row" >
                    <div class="col-xl-12">
<section class="hk-sec-wrapper" style="background-color:#f0f0f0;">

<div class="row">
<div class="col-sm">
<form class="needs-validation" method="post" name="changepassword" novalidate onsubmit="return checkpass();">
                                       
<div class="form-row">
<div class="col-md-6 mb-10">
<label for="validationCustom03">Current Password</label>
<input type="password" class="form-control" id="currentpassword" placeholder="Current Passsword" name="currentpassword" required>
<div class="invalid-feedback">Please provide  current password.</div>
</div>
</div>

<div class="form-row">
<div class="col-md-6 mb-10">
<label for="validationCustom03">New Password</label>
<input type="password" class="form-control" id="newpassword" placeholder="New Passsword" name="newpassword" required>
<div class="invalid-feedback">Please provide  new password.</div>
</div>
</div>

<div class="form-row">
<div class="col-md-6 mb-10">
<label for="validationCustom03">Confirm Password</label>
<input type="password" class="form-control" id="confirmpassword" placeholder="Confirm Passsword" name="confirmpassword" required>
<div class="invalid-feedback">Please provide  confirm password.</div>
</div>
</div>
                                 
<button class="" type="submit" name="submit" style="background-color:black; color:white">Change</button>
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