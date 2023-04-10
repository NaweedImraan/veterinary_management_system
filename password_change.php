<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Change Password</title>
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

 				<h4 class="text-center"><b>Change Password</b></h4>

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

 						<input type="hidden" name="password_token" value="<?php if(isset($_GET['token'])){ echo $_GET['token']; } ?>">

 						<label>Email Address</label>
 						<input type="email" name="email" value="<?php if(isset($_GET['email'])){ echo $_GET['email']; } ?>" class="form-control" autocomplete="off" placeholder="Enter Email Address" required>
 					</div>

 					<div class="form-group">
 						<label>New Password</label>
 						<input type="password" name="new_password" class="form-control" autocomplete="off" placeholder="Enter New Password" required>
 					</div>

 					<div class="form-group">
 						<label>Confirm Password</label>
 						<input type="password" name="confirm_password" class="form-control" autocomplete="off" placeholder="Confirm Password" required>
 					</div>

 					<input type="submit" name="password_update" class="btn btn-primary my-3" value="Update Password">
 					
 				</form>
 			</div>
 			<div class="col-md-6"></div>
 		</div>
 	</div>
 </div>

</body>
</html>