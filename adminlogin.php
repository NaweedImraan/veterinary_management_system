<?php 
session_start();
include ("include/connection.php");

if (isset($_POST['login'])) {

	$username = $_POST['uname'];
	$password = $_POST['pass'];

	$error = array();

	if (empty($username)) {
		$error['admin'] = "Enter Username";
	} elseif (empty($password)) {
		$error['admin'] = "Enter Password";
	}

	if (count($error)==0) {
		
		$query = "SELECT * FROM admin WHERE username= '$username' AND password='$password'";

		$result = mysqli_query($connect,$query);

		if (mysqli_num_rows($result) == 1) {
			
			$row = mysqli_fetch_array($result);

			if ($row['verify_status'] == '1') {
				
				$_SESSION['admin'] = $username;
				header("Location: admin/index.php");
				exit(0);

				


			} else {
				$_SESSION['status'] ="Please Verify your Email Address to Login";
				header("Location: adminlogin.php");
				exit(0);
			}
			
		} else {
			$_SESSION['status'] ="Invalid Username or Password";
			header("Location: adminlogin.php");
			exit(0);
		}

	}
}

$admin="admin";

 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Admin Login Page</title>
</head>
<body style="background-image: url(img/adminback.jpg);background-repeat: no-repeat;background-size: cover;">
 
	<?php 
	include 'include/header.php';

	 ?>

	 <div style="margin-top: 20px;"></div>

	 <div class="container">
	 	<div class="col-md-12">
	 		<div class="row">
	 			<div class="col-md-3"></div>
	 			<div class="col-md-6 jumbotron bg-info bg-gradient ">
	 				<img src="img/admin.jpg" class="col-md-12">
	 				<form method="post" class="my-2">
	 					<div style="margin-top: 200px;">
	 							<?php 
	 							if (isset($error['admin'])) {
	 								
	 								$sh = $error['admin'];
	
	 								$show = "<h4 class='alert alert-danger'>$sh</h4>";
	 							}else{
	 								$show = "";
	 							}
	 							echo $show;
	 							 ?>
	 						</div>

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

	 					<div class="form-group">
	 						<label>Username</label>
	 						<input type="text" name="uname" class="form-control" autocomplete="off" placeholder="Enter Username">
	 						</div>
	 					<div class="form-group">
	 						<label>Password</label>
	 						<input type="password" name="pass" class="form-control" placeholder="Enter Password">
	 						</div>

	 					<input type="submit" name="login" class="btn btn-success" value="Login" style="margin-bottom: 5px;">
	 					<?php
 						$output="";
 						$output.="
 							<p>Did not receive your Verification Email? <a href='resend_email_verification.php?current_user=$admin' style='text-decoration: none;color: white;'>Resend</a></p>
 							<p>Forgot your Password.! <a href='password_reset.php?current_user=$admin' style='text-decoration: none;color: white;'>Click here.</a></p>
 						";

 						echo $output;
 					 
 					 	?> 

	 						 	
	 				</form>
	 			</div>
	 			<div class="col-md-3"></div>
	 		</div>
	 	</div>
	 </div>

</body>
</html>