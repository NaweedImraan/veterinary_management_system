<?php 
session_start();

include("include/connection.php");

if (isset($_POST['login'])) {
	
	$uname = $_POST['uname'];
	$password = $_POST['pass'];


	$error = array();

	$q = "SELECT * FROM doctor WHERE username='$uname' AND password='$password'";

	$qq =mysqli_query($connect,$q);

	$row = mysqli_fetch_array($qq);



	if (empty($uname)) {
		$error['login'] = "Enter Username";
	} else if (empty($password)) {
		$error['login'] = "Enter Password";
	} else if ($row['status'] == "Pending") {
		$error['login'] = "Please wait for the Admin to confirm";

		//session_start();

		if (isset($_SESSION['doctor'])) {
			unset($_SESSION['doctor']);

			header("Location:../index.php");
		}




	} else if ($row['status'] == "Rejected") {
		$error['login'] = "Try again Later";

		//session_start();

		if (isset($_SESSION['doctor'])) {
			unset($_SESSION['doctor']);

			header("Location:../index.php");
		}




	}

	if (count($error) == 0) {
		
		$query = "SELECT * FROM doctor WHERE username='$uname' AND password='$password'";

		$res = mysqli_query($connect, $query);

		if (mysqli_num_rows($res) == 1) {

			$row = mysqli_fetch_array($res);

			if ($row['verify_status'] == '1') {
				
				$_SESSION['doctor'] = $uname;
				header("Location: doctor/index.php");
				exit(0);


			} else {
				$_SESSION['status'] ="Please Verify your Email Address to Login";
				header("Location: doctorlogin.php");
				exit(0);
			}

		} else {
			$_SESSION['status'] ="Invalid Username or Password";
			header("Location: doctorlogin.php");
			exit(0);
		}
	}
}

if (isset($error['login'])) {
	$l = $error['login'];

	$show = "<h4 class='text-center alert alert-danger'>$l</h4>";
} else {
	$show ="";
}

$doctor="doctor";

 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Doctor Login Page</title>
</head>
<body style="background-image: url(img/back.jpg); background-size: cover; background-repeat: no-repeat;">

	<?php 
	include ("include/header.php");

	 ?>

	 <div class="container-fluid">
	 	<div class="col-md-12">
	 		<div class="row">
	 			<div class="col-md-3"></div>
	 			<div class="col-md-6 jumbotron bg-info bg-gradient my-3">
	 				<h3 class="text-center my-2"><b>Doctor's Login</b></h3>
	 				<div>
	 					<?php echo $show; ?>

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
	 				</div>

	 				<form method="post">

	 					<div class="form-group">
	 						<label>Username</label>
	 						<input type="text" name="uname" class="form-control" autocomplete="off" placeholder="Enter Username">
	 					</div>

	 					<div class="form-group">
	 						<label>Password</label>
	 						<input type="password" name="pass" class="form-control" autocomplete="off" placeholder="Enter Password">
	 					</div>

	 					<input type="submit" name="login" class="btn btn-success" value="Login">

	 					<br><br>
	 					<p>I don't have an account <a href="apply.php" style="text-decoration: none;color: white; " >Apply Now!!!</a></p>
	 					<?php
 						$output="";
 						$output.="
 							<p>Did not receive your Verification Email? <a href='resend_email_verification.php?current_user=$doctor' style='text-decoration: none;color: white;'>Resend</a></p>
 							<p>Forgot your Password.! <a href='password_reset.php?current_user=$doctor' style='text-decoration: none;color: white;'>Click here.</a></p>
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