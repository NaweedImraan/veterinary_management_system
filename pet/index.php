<?php 
session_start();
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Pet Dashboard</title>
</head>
<body>
<?php 

include ("../include/header.php");
include ("../include/connection.php");


 ?>

 <div class="container-fluid">
 	<div class="col-md-12">
 		<div class="row">
 			<div class="col-md-2" style="margin-left: -30px; margin-top: -20px;">
 				<?php 

 				include ("sidenav.php");

 				 ?>
 			</div>
 			<div class="col-md-10">
 				<h4 class="my-3"><b>Pet Dashboard</b></h4>

 				<div class="col-md-12">
 					<div class="row">
 						<div class="col-md-3 bg-primary bg-gradient mx-2" style="height: 150px;">

 							<div class="col-md-12">
 								<div class="row">
 									<div class="col-md-8">
 										<h4 class="text-white my-4">My Profile</h4>
 									</div>
 									<div class="col-md-4">
 										<a href="profile.php">
 											<i class="fa fa-user-circle fa-3x my-4" style="color: white ;"></i>
 										</a>
 									</div>
 								</div>
 							</div>
 							
 						</div>

 						<div class="col-md-3 bg-warning bg-gradient mx-2" style="height: 150px;">
 							
 							<div class="col-md-12">
 								<div class="row">
 									<div class="col-md-8">
 										<h4 class="text-white my-4">Book Appoinment</h4>
 									</div>
 									<div class="col-md-4">
 										<a href="appointment.php">
 											<i class="fa fa-calendar fa-3x my-4" style="color: white ;"></i>
 										</a>
 									</div>
 								</div>
 							</div>

 						</div>

 						<div class="col-md-3 bg-success bg-gradient mx-2" style="height: 150px;">
 							
 							<div class="col-md-12">
 								<div class="row">
 									<div class="col-md-8">
 										<h4 class="text-white my-4">My Invoice</h4>
 									</div>
 									<div class="col-md-4">
 										<a href="invoice.php">
 											<i class="fas fa-file-invoice-dollar fa-3x my-4" style="color: white ;"></i>
 										</a>
 									</div>
 								</div>
 							</div>

 						</div>
 					</div>
 				</div>
 				<?php 

 				if (isset($_POST['send'])) {
 					
 					$title = $_POST['title'];
 					$message = $_POST['message'];

 					if (empty($title)) {
 						
 					} else if (empty($message)) {
 						
 					} else {

 						$user = $_SESSION['pet'];


 						$query ="INSERT INTO report(title,message,username,date_send) VALUES ('$title','$message','$user',NOW())";

 						$res = mysqli_query($connect,$query);

 						if ($res) {
 							echo "<script>alert('You have sent your Report')</script>";
 						}
 					}
 				}

 				 ?>

 				<div class="col-md-12">
 					<div class="row">
 						<div class="col-md-3"></div>
 						<div class="col-md-6 jumbotron bg-info my-5">
 							<h4 class="text-center my-2">Send a Feedback</h4>
 							<form method="post">
 								<label>Title</label>
 								<input type="text" name="title" autocomplete="off" class="form-control" placeholder="Enter Title of the report">

 								<label>Message</label>
 								<input type="text" name="message" autocomplete="off" class="form-control" placeholder="Enter message">

 								<input type="submit" name="send" value="Send Feedback" class="btn btn-success my-3">
 							</form>
 						</div>
 						<div class="col-md-3"></div>
 					</div>
 				</div>

 			</div>
 		</div>
 	</div>
 </div>

</body>
</html>