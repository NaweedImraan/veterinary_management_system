<?php 
session_start();

include("include/connection.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';



function resend_email_verify($name,$email,$verify_token){

	$current_user = $_SESSION['current_user'];

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
    $mail->addAddress($email);               //Name is optional
   

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Resend - Email Verification from Veterinary Management CO. & Ltd.';
    $email_template = "

    	<h2>Hello ".$name."!</h2>
    	<h3>You have Registered with Veterinary Management CO. & Ltd.</h3>
    	<h3>Verify your email address to Login with the below given link.</h3>
    	<br>
    	<h2><a href='http://localhost/VeterinaryManagementSystem/verify_email.php?token=$verify_token&current_user=$current_user' style='text-decoration: none;'>Click Me</a></h2>

    	<h4>Regards,</h4>
    	<h4>Veterinary Management CO. & Ltd.</h4>
    	<h4>Batticalo, Sri Lanka.</h4>

    ";

    $mail -> Body = $email_template;
    $mail->send();
    //echo "Message has been sent";

}


if (isset($_POST['resen_email_verify_btn'])) {

	$current_user = $_SESSION['current_user'];
	
	if (!empty(trim($_POST['email']))) {

		$email = mysqli_real_escape_string($connect,$_POST['email']);

		$check_email_query = "SELECT * FROM ".$current_user." WHERE email='$email' LIMIT 1";
		$check_email_query_run = mysqli_query($connect,$check_email_query);

		if (mysqli_num_rows($check_email_query_run) > 0) {
			
			$row = mysqli_fetch_array($check_email_query_run);

			if ($row['verify_status'] == '0') {

				$name = $row['username'];
				$email = $row['email'];
				$verify_token = $row['verify_token'];
				
				resend_email_verify($name,$email,$verify_token);

				$_SESSION['status'] = "Verification Email has been sent to your Email address.";
				
				$header = $current_user. "login.php";
				header("location: $header");

				exit(0);


			} else {
				$_SESSION['status'] = "Email already Verified. Please Login.";

				$header = $current_user. "login.php";
				header("location: $header");

				exit(0);		
			}


		} else {
			$_SESSION['status'] = "Email is not registered. Please Register now.!";
			if ($current_user=="admin") {
				header("Location: adminlogin.php");
				exit(0);
			} else if($current_user=="doctor"){
				header("Location: apply.php");
				exit(0);
			} else if ($current_user=="pet") {
				header("Location: account.php");
				exit(0);
			}
			
				

		}
		

	} else {
		$_SESSION['status'] = "Please enter the Email field";
		header("Location: resend_email_verification.php");
		exit(0);
	}
}
 ?>