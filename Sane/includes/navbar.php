     <nav class="navbar navbar-expand-xl navbar-light fixed-top hk-navbar">
            <a class="navbar-brand" href="dashboard.php" style="color:#ea6a47;">INSANE</a>
<a class="nav-link" href="search-product.php">
<span style="color:#ea6a47;">Search Product</span>
</a>
            <ul class="navbar-nav hk-navbar-content">

                <li class="nav-item dropdown dropdown-authentication">
                    <a class="nav-link dropdown-toggle no-caret" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="media"style=" position: relative;right: 30px;">
                            <div class="media-img-wrap" style=" position: relative;right: 30px;">
                                <div class="avatar">
                                    <img src="dist/img/user.png" alt="user">
                                </div>
                            </div>
                            
<?php 
$username=$_SESSION['username'];
$query=mysqli_query($con,"select AdminName from tbladmin where UserName='$username'");
$row=mysqli_fetch_array($query);
?>                            

                            <div>
                                <span style="color:black;  position: relative;right: 30px;"><?php echo $row['AdminName'];?></span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu">
                        <ul >
                        <li><a href="profile.php"><span style = "color:#EA6A47;">Profile</span></a></li>
                        <li><a href="change-password.php"><span style = "color:#EA6A47;">Change Password</span></a></li>
                        <li><a href="logout.php"><span style = "color:#EA6A47;">Log out</span></a></li></ul>
                    </div>
                </li>
            </ul>
        </nav>