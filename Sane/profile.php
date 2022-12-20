<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['username']==0)) {
  header('location:logout.php');
  } else{
if(isset($_POST['update']))
{
$adminname=$_POST['adminname'];   
$username=$_POST['username']; 

if($adminname==NULL)
{
    echo "<script>alert('Please input the valid required fields.');</script>";   
}
else{
    $query=mysqli_query($con,"update tbladmin set AdminName='$adminname' where UserName='$username'"); 
    if($query){
        echo "<script>alert('Admin details updated successfully.');</script>";   
        echo "<script>window.location.href='profile.php'</script>";
        } 
}
}

    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Admin profile</title>
    <link href="dist/css/style.css" rel="stylesheet" type="text/css">
</head>

<body style="background-color:#f0f0f0;">
    
    
	<div class="hk-wrapper hk-vertical-nav" style="border-width:58px; border-style:solid; border-color:#f0f0f0;">

<?php include_once('includes/navbar.php');
include_once('includes/sidebar.php');
?>
       


        <div id="hk_nav_backdrop" class="hk-nav-backdrop" style="background-color:#f0f0f0;"></div>
        <div class="hk-pg-wrapper" style="background-color:#f0f0f0;">

            <div class="container" style="background-color:black;">
                <div class="hk-pg-header" >
                    <h4 class="hk-pg-title" style="color:#f0f0f0;">Update Admin Profile</h4>
                </div>

                <div class="row" >
                    <div class="col-xl-12">
<section class="hk-sec-wrapper" tyle="background-color:#f0f0f0;">

<div class="row">
<div class="col-sm">
<form class="needs-validation" method="post" novalidate>
<?php 
$username=$_SESSION['username'];
$query=mysqli_query($con,"select * from tbladmin where UserName='$username'");
while($row=mysqli_fetch_array($query)){
?>   


<div class="form-row">
<div class="col-md-6 mb-10">
<label for="validationCustom03"> Name</label>
<input type="text" class="form-control" id="validationCustom03"  value="<?php echo $row['AdminName'];?>" name="adminname" required>
<div class="invalid-feedback">Please provide a valid  name.</div>
</div>
</div>

<div class="form-row">
<div class="col-md-6 mb-10">
<label for="validationCustom03"> Username</label>
<input type="text" class="form-control" id="validationCustom03" value="<?php echo $row['UserName'];?>" name="username" readonly>
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