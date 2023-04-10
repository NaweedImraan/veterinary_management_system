<?php 
session_start();

include("include/connection.php");


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function sendemail_verify($uname,$email,$verify_token)
{


	$pet="pet";

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
    	<h2><a href='http://localhost/VeterinaryManagementSystem/verify_email.php?token=$verify_token&current_user=$pet' style='text-decoration: none;'>Click Me</a></h2>

    	<h4>Regards,</h4>
    	<h4>Veterinary Management CO. & Ltd.</h4>
    	<h4>Batticalo, Sri Lanka.</h4>

    ";

    $mail -> Body = $email_template;
    $mail->send();
    //echo "Message has been sent";

}

if (isset($_POST['create'])) {
	
	$pname = $_POST['pname'];
	$oname = $_POST['oname'];
	$uname = $_POST['uname'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$gender = $_POST['gender'];
	$breed = $_POST['breed'];
	$country = $_POST['country'];
	$password = $_POST['pass'];
	$con_pass = $_POST['con_pass'];
	$verify_token = md5(rand());
	
	//Username exists or not
	$resultset_1= mysqli_query($connect,"SELECT * FROM pet WHERE username='".$uname."' ");
	$count_1 = mysqli_num_rows($resultset_1);

	//Email exists or not
	$check_email_query="SELECT email FROM pet WHERE email='$email' LIMIT 1";
	$check_email_query_run = mysqli_query($connect,$check_email_query);
	$count_2 = mysqli_num_rows($check_email_query_run);
	

	$error=array();

	if (empty($pname)) {
		$error['ac'] = "Enter Pet name";
	} else if(empty($oname)) {
		$error['ac'] = "Enter Owner's name";
	} else if(empty($uname)) {
		$error['ac'] = "Enter Username";
	} else if(empty($email)) {
		$error['ac'] = "Enter Email";
	} else if(empty($phone)) {
		$error['ac'] = "Enter Phone Number";
	} else if($gender=="") {
		$error['ac'] = "Select your Pet's Gender";
	} else if($country=="") {
		$error['ac'] = "Select your Country";
	} else if(empty($password)) {
		$error['ac'] = "Enter Password";
	} else if(empty($con_pass)) {
		$error['ac'] = "Enter Confirm Password";
	} else if(empty($password)) {
		$error['ac'] = "Enter Password";
	} else if($password != $con_pass) {
		$error['ac'] = "Both Password doest not match";
	} else if ($count_1 != 0) {
		$error['ac'] = "The username is already exists in our System";
	} else if ($count_2 != 0) {
		$error['ac'] = "The Email is already exists in our System";
	}


	if (count($error) == 0) {
		
		$query = "INSERT INTO pet(petname,ownername,username,email,phone,gender,breed,country,password,verify_token,date_reg,profile) VALUES('$pname','$oname','$uname', '$email', '$phone', '$gender','$breed','$country','$password','$verify_token',NOW(), 'pet.jpg')";

		$res = mysqli_query($connect,$query);

		if ($res) {

			sendemail_verify("$uname","$email","$verify_token");

			$_SESSION['status'] ="Registration Successfull.! Please check your Email to verify your Account.";
			
			header("Location:petlogin.php");
			exit(0);
		} else {
			
			$_SESSION['status'] ="Registration Failed";
			
			header("Location:account.php");
			exit(0);
		}
	}
}

if (isset($error['ac'])) {
	$l = $error['ac'];

	$show = "<h4 class='text-center alert alert-danger'>$l</h4>";
} else {
	$show ="";
}
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Create Account</title>
</head>
<body style="background-image: url(img/pet.jpg); background-repeat: no-repeat;background-size: cover;">
<?php 
include ("include/header.php");
 ?>

 <div class="container-fluid">
 	<div class="col-md-12">
 		<div class="row">
 			<div class="col-md-3"></div>
 			<div class="col-md-6 my-2 jumbotron">
 				<h4 class="text-center text-info my-2">Create Account</h4>
 				<br>
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
 						<label>Pet name</label>
 						<input type="text" name="pname" class="form-control" autocomplete="off" placeholder="Enter Pet name"
 						value="<?php if(isset($_POST['pname'])) echo $_POST['pname']; ?>">
 					</div>

 					<div class="form-group">
 						<label>Owner's name</label>
 						<input type="text" name="oname" class="form-control" autocomplete="off" placeholder="Enter Owner's name" value="<?php if(isset($_POST['oname'])) echo $_POST['oname']; ?>">
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
 						<label>Phone Number</label>
 						<input type="number" name="phone" class="form-control" autocomplete="off" placeholder="Enter Phone number" value="<?php if(isset($_POST['phone'])) echo $_POST['phone']; ?>">
 					</div>

 					<div class="form-group">
 						<label>Gender</label>
 						<select name="gender" class="form-control">
 							<option value="">Select Pet's Gender</option>
 							<option value="Male">Male</option>
 							<option value="Female">Female</option>
 						</select>
 					</div>
 					<div class="form-group">
 						<label>Breed</label>
 						<input type="text" name="breed" class="form-control" autocomplete="off" placeholder="Enter Breed" value="<?php if(isset($_POST['breed'])) echo $_POST['breed']; ?>"> 
 					</div>

 					<div class="form-group">
 						<label>Country</label>
 						<select name="country" class="form-control">
 							<option value="">Select Your Country</option>
 							<option value="SriLanka">SriLanka</option>
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
 					<input type="submit" name="create" value="Create Account" class="btn btn-info">
 					<br><br>
 					<p>I already have an account <a href="petlogin.php" style="text-decoration: none;">Click here.</a></p>
 					
 				</form>
 			</div>
 			<div class="col-md-3"></div>
 		</div>
 	</div>
 </div>

</body>
</html>