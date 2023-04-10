<?php 
session_start();

include("include/connection.php");


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function sendemail_verify($uname,$email,$verify_token)
{

	$doctor="doctor";
	
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
    $mail->Subject = 'Email Verification from Veterinary Management CO. & Ltd.';
    $email_template = "

    	<h2>Hello ".$uname."!</h2>
    	<h3>You have Registered with Veterinary Management CO. & Ltd.</h3>
    	<h3>Verify your email address to Login with the below given link.</h3>
    	<br>
    	<h2><a href='http://localhost/VeterinaryManagementSystem/verify_email.php?token=$verify_token&current_user=$doctor' style='text-decoration: none;'>Click Me</a></h2>

    	<h4>Regards,</h4>
    	<h4>Veterinary Management CO. & Ltd.</h4>
    	<h4>Batticalo, Sri Lanka.</h4>

    ";

    $mail -> Body = $email_template;
    $mail->send();
    //echo "Message has been sent";

}


if (isset($_POST['apply'])) {
	$firstname = $_POST['fname'];
	$surname = $_POST['sname'];
	$username = $_POST['uname'];
	$email = $_POST['email'];
	$gender = $_POST['gender'];
	$phone = $_POST['phone'];
	$country = $_POST['country'];
	$password = $_POST['pass'];
	$confirm_password = $_POST['con_pass'];
	$verify_token = md5(rand());

	
	$resultset_1= mysqli_query($connect,"SELECT * FROM doctor WHERE username='".$username."' ");
	$count_1 = mysqli_num_rows($resultset_1);

	//Email exists or not
	$check_email_query="SELECT email FROM doctor WHERE email='$email' LIMIT 1";
	$check_email_query_run = mysqli_query($connect,$check_email_query);
	$count_2 = mysqli_num_rows($check_email_query_run);
	


	$error = array();

	if (empty($firstname)) {
		$error['apply'] = "Enter Firstname";
	} else if (empty($surname)) {
		$error['apply'] = "Enter Surname";
	} else if (empty($username)) {
		$error['apply'] = "Enter Username";
	} else if (empty($email)) {
		$error['apply'] = "Enter Email Address";
	} else if ($gender == "") {
		$error['apply'] = "Select your Gender";
	} else if (empty($phone)) {
		$error['apply'] = "Enter Phone Number";
	} else if ($country == "") {
		$error['apply'] = "Select your Country";
	} else if (empty($password)) {
		$error['apply'] = "Enter Password";
	} else if (empty($confirm_password)) {
		$error['apply'] = "Enter Confirm Password";
	} else if ($confirm_password != $password) {
		$error['apply'] = "Both Password does not match";
	} else if ($count_1 != 0) {
		$error['apply'] = "The username is already exists in our System";
	} else if ($count_2 != 0) {
		$error['apply'] = "The Email is already exists in our System";
	}


	if (count($error) == 0) {
		
		$query = "INSERT INTO doctor(firstname,surname,username,email,gender,phone,country,password,verify_token,salary,date_reg,status,profile) VALUES('$firstname', '$surname','$username','$email','$gender','$phone','$country','$password','$verify_token','0',NOW(),'Pending','doctor.jpg')";

		$result = mysqli_query($connect,$query);

		if ($result) {
			
			sendemail_verify("$username","$email","$verify_token");

			$_SESSION['status'] ="Registration Successfull.! Please check your Email to verify your Account.";

			header("Location: doctorlogin.php");
			exit(0);

		} else{

			$_SESSION['status'] ="Registration Failed";
			header("Location:apply.php");
			exit(0);

		}


	}
}

if (isset($error['apply'])) {
	$s = $error['apply'];

	$show = "<h4 class='text-center alert alert-danger'>$s</h4>";
} else {
	$show = "";
}

 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Apply Now!!!</title>
</head>
<body style="background-image: url(img/back.jpg); background-size: cover; background-repeat: no-repeat;">

	<?php 
	include("include/header.php");

	 ?>

	 <div class="container-fluid">
	 	<div class="col-md-12">
	 		<div class="row">
	 			<div class="col-md-3"></div>
	 			<div class="col-md-6 my-3 jumbotron">
	 				<h3 class="text-center"><b>Apply Now!!!</b></h3>
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
	 						<label>First Name</label>
	 						<input type="text" name="fname" class="form-control" autocomplete="off" placeholder="Enter Firstname" value="<?php if(isset($_POST['fname'])) echo $_POST['fname']; ?>">
	 					</div>
	 					<div class="form-group">
	 						<label>SurName</label>
	 						<input type="text" name="sname" class="form-control" autocomplete="off" placeholder="Enter SurName"
	 						value="<?php if(isset($_POST['sname'])) echo $_POST['sname']; ?>">
	 					</div>
	 					<div class="form-group">
	 						<label>Username</label>
	 						<input type="text" name="uname" class="form-control" autocomplete="off" placeholder="Enter Username" value="<?php if(isset($_POST['uname'])) echo $_POST['uname']; ?>">
	 					</div>
	 					<div class="form-group">
	 						<label>Email</label>
	 						<input type="email" name="email" class="form-control" autocomplete="off" placeholder="Enter Email Address" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>">
	 					</div>

	 					<div class="form-group">
	 						<label>Select Gender</label>
	 						<select name="gender" class="form-control">
	 							<option value="">Select Gender</option>
	 							<option value="Male">Male</option>
	 							<option value="Female">Female</option>
	 						</select>
	 					</div>

	 					<div class="form-group">
	 						<label>Phone Number</label>
	 						<input type="number" name="phone" class="form-control" autocomplete="off" placeholder="Enter Phone Number" value="<?php if(isset($_POST['phone'])) echo $_POST['phone']; ?>">
	 					</div>

	 					<div class="form-group">
	 						<label>Select Country</label>
	 						<select name="country" class="form-control">
	 							<option value="">Select Country</option>
	 							<option value="SriLanka">Sri Lanka</option>
	 							<option value="India">India</option>
	 							<option value="Russia">Russia</option>
	 						</select>
	 					</div>

	 					<div class="form-group">
	 						<label>Password</label>
	 						<input type="password" name="pass" class="form-control" autocomplete="off" placeholder="Enter Password">
	 					</div>
	 					<div class="form-group">
	 						<label>Confirm Password</label>
	 						<input type="password" name="con_pass" class="form-control" autocomplete="off" placeholder="Enter Confirm Password">
	 					</div>

	 					<input type="submit" name="apply" value="Apply Now" class="btn btn-success">
	 					<p>I already have an account <a href="doctorlogin.php" style="text-decoration: none;">Click here</a></p>
	 				</form>
	 			</div>
	 			<div class="col-md-3"></div>
	 		</div>
	 	</div>
	 </div>

</body>
</html>