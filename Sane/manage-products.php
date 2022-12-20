<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['username']==0)) {
  header('location:logout.php');
  } else{

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Manage Products</title>
    <link href="vendors/datatables.net-dt/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="vendors/datatables.net-responsive-dt/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="vendors/jquery-toggles/css/toggles.css" rel="stylesheet" type="text/css">
    <link href="vendors/jquery-toggles/css/themes/toggles-light.css" rel="stylesheet" type="text/css">
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
 <h4 class="hk-pg-title" style="color:#f0f0f0;">Manage Products</h4>
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
                                                    <th>Category</th>
                                                    <th>Product</th>
                                                    <th>Pricing (in USD)</th>
                                                    <th>Posting Date</th>
                                                    <th>Action</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
<?php
$rno=mt_rand(10000,99999);  
$query=mysqli_query($con,"select * from tblproducts order by ProductPrice");
$cnt=1;
while($row=mysqli_fetch_array($query))
{    
?>                                                
<tr>
<td><?php echo $row['CategoryCode'];?></td>
<td><?php echo $row['ProductName'];?></td>
<td><?php echo $row['ProductPrice'];?></td>
<td><?php echo $row['PostingDate'];?></td>
<td>
<a style = "color:GREEN" href="edit-product.php?productname=<?php echo base64_encode($row['ProductName']);?>" class="mr-25" data-toggle="tooltip" data-original-title="Edit">Edit</a>
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