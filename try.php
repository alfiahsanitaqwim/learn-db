<?php
session_start();
error_reporting(0);
include("config.php");
if(isset($_POST['submit']))
{
$uname=$_POST['username'];
$upassword=$_POST['password'];

$ret=mysqli_query($con,"SELECT * FROM admin WHERE username='$uname' and password='$upassword'");
$num=mysqli_fetch_array($ret);
if($num>0)
{
$_SESSION['login']=$_POST['username'];
$_SESSION['id']=$num['id'];
header("location:manage-buku.php");

}
else
{
$_SESSION['errmsg']="Invalid username or password";

}
}
?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Admin-Login</title>
		<link rel="stylesheet" href="bootstrap.min.css">
	</head>
	<body class="login">
		<div class="container">
			<div class="row text-center">
					<h2>Admin Login</h2>
					<form method="post" style="justify-content:center; display: flex;">
							<fieldset>
								<legend>
									Sign in to your account
								</legend>
								<p>
									Please enter your name and password to log in.<br />
									<span style="color:red;"><?php echo htmlentities($_SESSION['errmsg']); ?><?php echo htmlentities($_SESSION['errmsg']="");?></span>
								</p>
								
									<input style="margin-bottom:10px;" type="text" class="form-control" name="username" placeholder="Username">
								
								
									<input style="margin-bottom:10px;" type="password" class="form-control" name="password" placeholder="Password">
								
								
									<button type="submit" class="btn btn-primary" name="submit">
									Login
									</button>
								
							</fieldset>
						</form>
						
			</div>
		</div>
	</body>
</html>