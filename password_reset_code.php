<?php 
session_start();
include("include/connection.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';


$current_user = $_SESSION['current_user'];


function send_password_reset($get_name,$get_email,$token){

	//Create an instance; passing `true` enables exceptions
	$mail = new PHPMailer(true);

    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'vetmediclinic0@gmail.com';                     //SMTP username
    $mail->Password   = 'abcdlmnop';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('vetmediclinic0@gmail.com', "VMS Co. Ltd.");
    $mail->addAddress($get_email);               //Name is optional
   

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Reset Password Notification from Veterinary Management CO. & Ltd.';
    $email_template = "

    	<h2>Hello ".$get_name."!</h2>
    	<h3>You are receiving this email because we received a password reset request for your account.</h3>
    	<h3>Click below link to Reset your password.</h3>
    	<br>
    	<h2><a href='http://localhost/VeterinaryManagementSystem/password_change.php?token=$token&email=$get_email' style='text-decoration: none;'>Click Me</a></h2>

    	<h4>Regards,</h4>
    	<h4>Veterinary Management CO. & Ltd.</h4>
    	<h4>Batticalo, Sri Lanka.</h4>

    ";

    $mail -> Body = $email_template;
    $mail->send();
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

}


if (isset($_POST['password_reset_link'])) {

	$email = mysqli_real_escape_string($connect, $_POST['email']);
	$token = md5(rand());

	$check_email = "SELECT * FROM ".$current_user." WHERE email='$email' LIMIT 1";
	$check_email_run = mysqli_query($connect,$check_email);

	if (mysqli_num_rows($check_email_run) > 0) {
		
		$row = mysqli_fetch_array($check_email_run);
		$get_name = $row['username'];
		$get_email = $row['email'];

		$update_token = "UPDATE ".$current_user." SET verify_token = '$token' WHERE email='$get_email' LIMIT 1";
		$update_token_run = mysqli_query($connect, $update_token);

		if ($update_token_run) {

			send_password_reset($get_name,$get_email,$token);
			$_SESSION['status'] = "We emailed you a password link";
			header("Location: password_reset.php");
			exit(0);
			

		} else {

			$_SESSION['status'] = "Something went wrong. #1";
			header("Location: password_reset.php");
			exit(0);

		}


	} else {

		$_SESSION['status'] = "No Email Found";
		header("Location: password_reset.php");
		exit(0);
	}

}


if (isset($_POST['password_update'])) {
	
	$email = mysqli_real_escape_string($connect,$_POST['email']);
	$new_password = mysqli_real_escape_string($connect,$_POST['new_password']);
	$confirm_password = mysqli_real_escape_string($connect,$_POST['confirm_password']);

	$token = mysqli_real_escape_string($connect,$_POST['password_token']);

	if (!empty($token)) {
		
		if (!empty($email) && !empty($new_password) && !empty($confirm_password)) {

			//Checking token is valid or not
			$check_token = "SELECT verify_token FROM ".$current_user." WHERE verify_token='$token' LIMIT 1";
			$check_token_run = mysqli_query($connect,$check_token);

			if (mysqli_num_rows($check_token_run) > 0) {
				
				if ($new_password == $confirm_password) {
					
					$update_password = "UPDATE ".$current_user." SET password='$new_password' WHERE verify_token='$token' LIMIT 1";
					$update_password_run = mysqli_query($connect, $update_password);

					if ($update_password_run) {

						$new_token= md5(rand())."funda";
						$update_to_new_token = "UPDATE ".$current_user." SET verify_token='$new_token' WHERE verify_token='$token' LIMIT 1";
						$update_to_new_token_run = mysqli_query($connect, $update_to_new_token);


						$_SESSION['status'] = "New Password Successfully Updated.!";

						$header = $current_user. "login.php";

						header("location: $header");
						unset($_SESSION[$current_user]);
						exit(0);
						
					} else {
						$_SESSION['status'] = "Did not update password. Something went wrong.!";
						header("Location: password_change.php?token=$token&email=$email");
						exit(0);

					}

				} else {
					$_SESSION['status'] = "Password and Confirm Password does not match";
					header("Location: password_change.php?token=$token&email=$email");
					exit(0);

				}

			} else {

				$_SESSION['status'] = "Invalid token";
				header("Location: password_change.php?token=$token&email=$email");
				exit(0);

			}
			
		} else {
			$_SESSION['status'] = "All Fields are Mandatory";
			header("Location: password_change.php?token=$token&email=$email");
			exit(0);
		}


	} else {

		$_SESSION['status'] = "No Token Available";
		header("Location: password_change.php");
		exit(0);
	}
}

 ?>