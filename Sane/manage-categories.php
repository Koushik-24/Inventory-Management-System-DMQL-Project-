<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['username']==0)) {
  header('location:logout.php');
  } else{   
if(isset($_GET['del'])){    
$catcode=substr(base64_decode($_GET['del']),0,-5);
$query=mysqli_query($con,"delete from tblcategory where CategoryCode='$catcode'");
echo "<script>alert('Category record deleted.');</script>";   
echo "<script>window.location.href='manage-categories.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Manage Categories</title>
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
 <h4 class="hk-pg-title" style="color:#f0f0f0;">Manage Categories</h4>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <section class="hk-sec-wrapper">
                            <div class="row">
                                <div class="col-sm">
                                    <div class="table-wrap">
                                        <table id="datable_1" class="table table-hover w-100 display pb-30">
                                            <thead>
                                                <tr>
                                                    <th>S No</th>
                                                    <th>Category</th>
                                                    <th>Category Code</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
<?php
$rno=mt_rand(10000,99999);  
$query=mysqli_query($con,"select * from tblcategory CategoryName");
$cnt=1;
while($row=mysqli_fetch_array($query))
{    
?>                                                
<tr>
<td><?php echo $cnt;?></td>
<td><?php echo $row['CategoryName'];?></td>
<td><?php echo $row['CategoryCode'];?></td>
<td>

</td>
</tr>
<?php 
$cnt++;
} ?>
                                                
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
    <script src="dist/css/js/bootstrap.min.js"></script>
</body>
</html>
<?php } ?>