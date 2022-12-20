<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['login']))
  {
    $adminuser=$_POST['username'];
    $password=$_POST['password'];
    $query=mysqli_query($con,"select UserName from tbladmin where  UserName='$adminuser' && Password='$password' ");
    $ret=mysqli_fetch_array($query);
    if($ret>0){
      $_SESSION['username']=$ret['UserName'];
     header('location:dashboard.php');
    }
    else{
     echo "<script>alert('Invalid details. Please try again.');</script>";   
   echo "<script>window.location.href='dashboard.php'</script>";
    }
  }
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Login Page</title>
    <link href="dist/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
    
   
    <div class="hk-wrapper">

        <div class="hk-pg-wrapper hk-auth-wrapper">
            <header class="d-flex justify-content-between align-items-center">
<a class="d-flex auth-brand align-items-center" href="#">
<span  style="color:black;font-size:35px;">INSANE Inventory management system</span>
                </a>
               
            </header>
            <div class="container-fluid" style = "padding-right: 20px;padding-left: 500px">
                <div class="row">

                    <div class="col-xl-7 pa-0">
                        <div class="auth-form-wrap py-xl-0 py-50">
                            <div class="auth-form w-xxl-55 w-xl-75 w-sm-90 w-xs-100" >
                                <form method="post" >
                                    <h1 class="display-4 mb-10" style="text-align:center;">LOGIN</h1>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Username" type="text" name="username" required="true" style="border-color: black;">
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input class="form-control" placeholder="Password" type="password" name="password" required="true" style="border-color: black;">
                                            </div>
                                        </div>
                                        <button class="btn btn-block" type="submit" name="login" style="background-color: black; color: white" >Login</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>