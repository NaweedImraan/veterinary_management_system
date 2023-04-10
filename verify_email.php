<?php 
session_start();

include("include/connection.php");

/*if (isset($_GET['current_user'])) {
                    
    $_SESSION['current_user'] = $_GET['current_user'];
    $current_user = $_SESSION['current_user'];
}*/

if (isset($_GET['token']) && isset($_GET['current_user'])) {
	
	$token = $_GET['token'];
	
	$_SESSION['current_user'] = $_GET['current_user'];
    $current_user = $_SESSION['current_user'];

	$verify_query="SELECT verify_token,verify_status FROM ".$current_user." WHERE verify_token='$token' LIMIT 1";
	$verify_query_run=mysqli_query($connect,$verify_query);

	if (mysqli_num_rows($verify_query_run) > 0) {

		$row =mysqli_fetch_array($verify_query_run);
		

		if ($row['verify_status'] == "0") {
			
			$clicked_token = $row['verify_token'];
			$update_query = "UPDATE ".$current_user." SET verify_status='1' WHERE verify_token='$clicked_token' LIMIT 1";
			$update_query_run = mysqli_query($connect,$update_query);

			if ($update_query_run) {

				$_SESSION['status'] = "Your Account has been Verified Successfully.!.";
				$header = $current_user. "login.php";
				header("location: $header");
				exit(0);

			} else {
				$_SESSION['status'] = "Verification Failed.!.";
				
				$header = $current_user. "login.php";
				header("location: $header");
				exit(0);
			}

		} else {
			$_SESSION['status'] = "Email Already Verified. Please Login.";
			$header = $current_user. "login.php";
			header("location: $header");
			exit(0);
	

		}

	} else {
		$_SESSION['status'] = "This Token does not Exists";
		$header = $current_user. "login.php";
		header("location: $header");
		exit(0);
	}

 } else {

	$_SESSION['status'] = "Not Allowed";
	$header = $current_user. "login.php";
	header("location: $header");
	exit(0);
}

 ?>