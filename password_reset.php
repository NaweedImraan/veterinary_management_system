<?php 
session_start();

if (isset($_GET['current_user'])) {
                    
    $_SESSION['current_user'] = $_GET['current_user'];
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Password Reset</title>
</head>
<body style="background-image: url(img/forgot_pass.jpg); background-repeat: no-repeat; background-size: cover;">
<?php 
include("include/header.php");

 ?>

 <div class="container-fluid">
 	<div class="col-md-12">
 		<div class="row">
 			<div class="col-md-4"></div>
 			<div class="col-md-5 my-5 jumbotron bg-warning bg-gradient">
 				<h4 class="text-center"><b>Reset Password</b></h4>

 				<?php 

 				if (isset($_SESSION['status'])) {
 					?>
 					<div class="alert alert-primary">
 						<h4><?=$_SESSION['status']; ?></h4>
 					</div>
 					<?php 
 					unset($_SESSION['status']);
 				}                

 				 ?>

 				<form method="post" action="password_reset_code.php">
 					<div class="form-group">
 						<label>Email Address</label>
 						<input type="email" name="email" class="form-control" autocomplete="off" placeholder="Enter Email Address" required>
 					</div>

 					<input type="submit" name="password_reset_link" class="btn btn-info my-3" value="Send Password Reset Link">
 					
 				</form>
 			</div>
 			<div class="col-md-6"></div>
 		</div>
 	</div>
 </div>

</body>
</html>