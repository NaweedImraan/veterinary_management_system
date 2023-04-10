<?php 
session_start();

include("include/connection.php");

if (isset($_POST['login'])) {
	
	$uname = $_POST['uname'];
	$pass = $_POST['pass'];

	if (empty($uname)) {
		echo "<script>alert('Enter Username')</script>";
	} else if (empty($pass)) {
		echo "<script>alert('Enter Password')</script>";
	} else{

		$query = "SELECT * FROM pet WHERE username = '$uname' AND password='$pass'";

		$res = mysqli_query($connect,$query);

		if (mysqli_num_rows($res) == 1) {

			$row = mysqli_fetch_array($res);

			if ($row['verify_status'] == '1') {
				
				$_SESSION['pet'] = $uname;
				header("Location: pet/index.php");
				exit(0);

				


			} else {
				$_SESSION['status'] ="Please Verify your Email Address to Login";
				header("Location: petlogin.php");
				exit(0);
			}
			
		} else {
			$_SESSION['status'] ="Invalid Username or Password";
			header("Location: petlogin.php");
			exit(0);
		}
	}
}

$pet="pet";

 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Pet Login Page</title>
</head>
<body style="background-image: url(img/petback.jpg); background-repeat: no-repeat; background-size: cover;">
<?php 
include("include/header.php");

 ?>

 <div class="container-fluid">
 	<div class="col-md-12">
 		<div class="row">
 			<div class="col-md-1"></div>
 			<div class="col-md-5 my-5 jumbotron bg-warning bg-gradient">
 				<h4 class="text-center"><b>Pet Login</b></h4>

 				<form method="post">
 					
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
 						<input type="text" name="uname" class="form-control" autocomplete="off" placeholder="Enter Username" required>
 					</div>

 					<div class="form-group">
 						<label>Password</label>
 						<input type="password" name="pass" class="form-control" autocomplete="off" placeholder="Enter Password" required>
 					</div>
 					<input type="submit" name="login" class="btn btn-info my-3" value="Login">
 					<p>I don't have an account.! <a href="account.php" style="text-decoration: none;">Click here.</a></p>
 					
 					<?php
 					$output="";
 					$output.="
 						<p>Did not receive your Verification Email? <a href='resend_email_verification.php?current_user=$pet' style='text-decoration: none;'>Resend</a></p>
 						<p>Forgot your Password.! <a href='password_reset.php?current_user=$pet' style='text-decoration: none;'>Click here.</a></p>
 					";

 					echo $output;
 					 
 					 ?>
 				</form>
 			</div>
 			<div class="col-md-6"></div>
 		</div>
 	</div>
 </div>

</body>
</html>