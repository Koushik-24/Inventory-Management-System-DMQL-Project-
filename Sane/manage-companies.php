<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['username']==0)) {
  header('location:logout.php');
  } else{
if(isset($_GET['del'])){    
$cmpid=substr(base64_decode($_GET['del']),0,-5);
$query=mysqli_query($con,"delete from Stores where StoreID='$cmpid'");
echo "<script>alert('Store record deleted.');</script>";   
echo "<script>window.location.href='manage-companies.php'</script>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Manage Stores</title>
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
 <h4 class="hk-pg-title" style="color:#f0f0f0;">Manage Stores</h4>
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
                                                    <th>Store Id</th>
                                                    <th>ZipCode</th>
                                                    <th>Location</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
<?php
$rno=mt_rand(10000,99999);  
$query=mysqli_query($con,"select * from Stores order by Location");
$cnt=1;
while($row=mysqli_fetch_array($query))
{    
?>                                                
<tr>
<td><?php echo $row['StoreID'];?></td>
<td><?php echo $row['ZipCode'];?></td>
<td><?php echo $row['Location'];?></td>
<td>
<a style = "color:RED" href="manage-companies.php?del=<?php echo base64_encode($row['StoreID'].$rno);?>" data-toggle="tooltip" data-original-title="Delete" onclick="return confirm('Do you really want to delete?');">Delete </a>

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
    <script src="dist/css/bootstrap.min.js"></script>

</body>
</html>
<?php } ?>