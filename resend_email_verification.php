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
	<title>Resend Email Verification</title>
</head>
<body style="background-image: url(img/forgot_pass.jpg); background-repeat: no-repeat; background-size: cover;">
<?php 
include("include/header.php");

 ?>

 <div class="container-fluid">
 	<div class="col-md-12">
 		<div class="row">
 			<div class="col-md-4"></div>
 			<div class="col-md-5 my-5 jumbotron bg-secondary bg-gradient">
 				<h4 class="text-center" style="color: white;"><b>Resend Email Verification</b></h4>

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

 				<form method="post" action="resend_code.php">
 					<div class="form-group">
 						<label >Email Address</label>
 						<input type="email" name="email" class="form-control" autocomplete="off" placeholder="Enter Email Address">
 					</div>

 					<input type="submit" name="resen_email_verify_btn" class="btn btn-info my-3" value="Submit">
 					
 				</form>
 			</div>
 			<div class="col-md-6"></div>
 		</div>
 	</div>
 </div>

</body>
</html>