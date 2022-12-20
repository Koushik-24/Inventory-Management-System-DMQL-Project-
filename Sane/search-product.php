<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['username']==0)) {
  header('location:logout.php');
  } else{
if(!empty($_GET["action"])) {
switch($_GET["action"]) {

    case "add":
        if(!empty($_POST["quantity"])) {
            $pname=$_GET["productname"];
            $result=mysqli_query($con,"SELECT * FROM tblproducts WHERE ProductName='$pname'");
              while($productByCode=mysqli_fetch_array($result)){
            $itemArray = array($productByCode["ProductName"]=>array('catname'=>$productByCode["CategoryCode"],'quantity'=>$_POST["quantity"], 'pname'=>$productByCode["ProductName"], 'price'=>$productByCode["ProductPrice"]));
            if(!empty($_SESSION["cart_item"])) {
                if(in_array($productByCode["ProductName"],array_keys($_SESSION["cart_item"]))) {
                    foreach($_SESSION["cart_item"] as $k => $v) {
                            if($productByCode["ProductName"] == $k) {
                                if(empty($_SESSION["cart_item"][$k]["quantity"])) {
                                    $_SESSION["cart_item"][$k]["quantity"] = 0;
                                }
                                $_SESSION["cart_item"][$k]["quantity"] = $_SESSION["cart_item"][$k]["quantity"]+(int)$_POST["quantity"];
                            }
                    }
                } else {
                    $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
                }
            }  else {
                $_SESSION["cart_item"] = $itemArray;
            }
        }
    }
    break;

    case "remove":
        if(!empty($_SESSION["cart_item"])) {
            foreach($_SESSION["cart_item"] as $k => $v) {
                    if($_GET["code"] == $k)
                        unset($_SESSION["cart_item"][$k]);              
                    if(empty($_SESSION["cart_item"]))
                        unset($_SESSION["cart_item"]);
            }
        }
    break;
    case "empty":
        unset($_SESSION["cart_item"]);
    break;  
}
}

if(isset($_POST['checkout'])){
$invoiceno= mt_rand(100000000, 999999999);
$quantity=$_POST['quantity'];
$cname=$_POST['customername'];
$cmobileno=$_POST['mobileno'];
$pmode=$_POST['paymentmode'];
$cadd=$_POST['customeraddress'];
$pname=$_GET["productname"];
$value=array_combine(explode('$',$pname),$quantity);
$oid=mt_rand(100000000, 999999999999);


$cid=mysqli_query($con,"select max(CustomerID) from tblcustomers");
// $max=mysqli_fetch_array($cid);
while($max=mysqli_fetch_array($cid)){
$newcid=$max[0];
$newcid=$newcid+1;
}


if($cname!=NULL or $cmobileno!=NULL or $cadd!=NULL or $pmode!=NULL){
    foreach($value as $pdid=> $qty){
        $query1=mysqli_query($con,"insert into tblcustomers(CustomerID,CustomerName, CustomerAddress, CustomerContactNo) values('$newcid','$cname','$cadd','$cmobileno')");
        $query=mysqli_query($con,"insert into tblorders(id,ProductName,Quantity,InvoiceNumber,CustomerID,PaymentMode) values('$oid','$pdid','$qty','$invoiceno','$newcid','$pmode')") ;
    
    }
    echo '<script>alert("Invoice genrated successfully. Invoice number is "+"'.$invoiceno.'")</script>';  
     unset($_SESSION["cart_item"]);
     $_SESSION['invoice']=$invoiceno;
     echo "<script>window.location.href='invoice.php'</script>";
}
else{


    echo '<script>alert("Please enter the Required Details")</script>';

}






}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Search Product</title>
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
                    <h4 class="hk-pg-title" style="color:#f0f0f0;">Search Product</h4>
                </div>
                <div class="row">
                    <div class="col-xl-12">
<section class="hk-sec-wrapper">
<div class="row">
<div class="col-sm">
<form class="needs-validation" method="post" novalidate>                                      
<div class="form-row">
<div class="col-md-6 mb-10">
<label for="validationCustom03">Product Name</label>
<input type="text" class="form-control" id="validationCustom03" placeholder="Product Name" name="productname" required>
<div class="invalid-feedback">Please provide a valid product name.</div>
</div>
</div>                                 
<button class="" type="submit" name="search" style="background-color:black; color:white">search</button>
<!-- <button class="" type="submit" name="submit" style="background-color:black; color:white">Submit</button> -->

</form>
</div>
</div>
</section>
<?php if(isset($_POST['search'])){?>
 <section class="hk-sec-wrapper">
                            <div class="row">
                                <div class="col-sm">
                                    <div class="table-wrap">
                                        <table id="datable_1" class="table table-hover w-100 display pb-30">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Category code</th>
                                                    <th>Product</th>
                                                    <th>Pricing</th>
                                                    <th>Quantity</th>
                                                    <th>Action</th>                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
<?php
$pname=$_POST['productname'];
if($pname!=Null){

    $query=mysqli_query($con,"select * from tblproducts where ProductName like '%$pname%'");
}
else{
    echo '<script>alert("Please enter the Product name.")</script>'; 
}
$cnt=1;
while($row=mysqli_fetch_array($query))
{    
?>
<form method="post" action="search-product.php?action=add&productname=<?php echo $row["ProductName"]; ?>">   
                                            
<tr>
<td><?php echo $cnt;?></td>
<td><?php echo $row['CategoryCode'];?></td>
<td><?php echo $row['ProductName'];?></td>
<td><?php echo $row['ProductPrice'];?></td>
<td><input type="text" class="product-quantity" name="quantity" value="1" size="2" /></td>
<td>
<input type="submit" value="Add to Cart" class="btnAddAction" />
</td>
</tr>
</form>
<?php 
$cnt++;
} ?>                            
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
</section>
<?php } ?>                        
<form class="needs-validation" method="post" novalidate>
<section class="hk-sec-wrapper">
     
                            <div class="row">
                                <div class="col-sm">
                                    <div class="table-wrap">
<h4>Shopping Cart</h4>
<hr />

<a id="btnEmpty" href="search-product.php?action=empty" style=" background-color: #ffffff;
    border: #d00000 1px solid;
    padding: 5px 10px;
    color: #d00000;
    float: right;
    text-decoration: none;
    border-radius: 3px;
    margin: 10px 0px;">Empty Cart</a>
<?php
if(isset($_SESSION["cart_item"])){
    $total_quantity = 0;
    $total_price = 0;
?>  
  <table id="datable_1" class="table table-hover w-100 display pb-30" border="1">
<tbody>
<tr>
<th >Product Name</th>
<th>Category</th>
<th width="5%">Quantity</th>
<th width="10%">Unit Price</th>
<th width="10%">Price</th>
<th width="5%">Remove</th>
</tr>   
<?php 
 $productname=array();      
    foreach ($_SESSION["cart_item"] as $item){
        $item_price = (int)$item["quantity"]*(int)$item["price"];
        array_push($productname,$item['pname']);
        ?>
           <input type="hidden" value="<?php echo $item['quantity']; ?>" name="quantity[<?php echo $item['pname']; ?>]">
                <tr>
                <td><?php echo $item["pname"]; ?></td>
                <td><?php echo $item["catname"]; ?></td>
                <td><?php echo (int)$item["quantity"]; ?></td>
                <td><?php echo $item["price"]; ?></td>
                <td><?php echo number_format($item_price,2); ?></td>
                <td><a href="search-product.php?action=remove&code=<?php echo $item["pname"]; ?>" class="btnRemoveAction"><img src="dist/img/icon-delete.png" width = "50" alt="Remove Item" /></a></td>
                </tr>
                <?php
                (int)$total_quantity += (int)$item["quantity"];
                $total_price += ((int)$item["price"]*(int)$item["quantity"]);
        }
        $_SESSION['ProductName']=$productname;
        ?>
<tr>
<td colspan="3" align="right">Total:</td>
<td colspan="2"><?php echo $total_quantity; ?></td>
<td colspan=><strong><?php echo number_format($total_price, 2); ?></strong></td>
<td></td>
</tr>
</tbody>
</table>  

<div class="form-row">
<div class="col-md-6 mb-10">
<label for="validationCustom03">Customer Name</label>
<input type="text" class="form-control" id="validationCustom03" placeholder="Customer Name" name="customername" required>
<div class="invalid-feedback">Please provide a valid customer name.</div>
</div>
<div class="col-md-6 mb-10">
<label for="validationCustom03">Customer Mobile Number</label>
<input type="text" class="form-control" id="validationCustom03" placeholder="Mobile Number" name="mobileno" required>
<div class="invalid-feedback">Please provide a valid mobile number.</div>
</div>
</div>
<div class="form-row">
<div class="col-md-6 mb-10">
<label for="validationCustom03">Customer Address</label>
<input type="text" class="form-control" id="validationCustom03" placeholder="Customer Address" name="customeraddress" required>
<div class="invalid-feedback">Please provide a valid customer Address</div>
</div>
<div class="form-row">
<div class="col-md-6 mb-10">
<label for="validationCustom03">Store Address</label>
<select class="form-control custom-select" name="sadd" required>
<option value="Store Address">Store Address</option>
<?php
$ret=mysqli_query($con,"select Location from stores");
while($row=mysqli_fetch_array($ret))
{?>
<option value="<?php echo $row['Location'];?>"><?php echo $row['Location'];?></option>
<?php } ?>
</select>
<div class="invalid-feedback">Please select a Store.</div>
</div>
</div>
<div class="form-row">
<div class="col-md-6 mb-10">
    <label for="validationCustom03">Payment Mode</label>
<div class="custom-control custom-radio mb-10">
<input type="radio" class="custom-control-input" id="customControlValidation2" name="paymentmode" value="cash" required>
<label class="custom-control-label" for="customControlValidation2">Cash</label>
</div>
<div class="custom-control custom-radio mb-10">
<input type="radio" class="custom-control-input" id="customControlValidation3" name="paymentmode" value="card" required>
<label class="custom-control-label" for="customControlValidation3">Card</label>
</div>
</div>
<div class="col-md-6 mb-10">
<button class="" type="submit" name="checkout" style="background-color:black; color:white">Checkout</button>

</div>
</div>
</form>

  <?php
} else {
?>
<div style="color:red" align="center">Your Cart is Empty</div>
<?php 
}
?>
</div>
</div></div></section>
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