<?php 
session_start();
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Doctor's Dashboard</title>
</head>
<body>
	<?php 

	include("../include/header.php");
	include("../include/connection.php");

	 ?>

	 <div class="container-fluid">
	 	<div class="col-md-12">
	 		<div class="row">
	 			<div class="col-md-2" style="margin-left: -30px; margin-top: -20px;">
	 				<?php 

	 				include("sidenav.php");

	 				 ?>
	 			</div>
	 			<div class="col-md-10">
	 				<div class="container-fluid">
	 					<h4><b>Doctor's Dashboard</b></h4>
	 					<div class="col-md-12">
	 						<div class="row">
	 							<div class="col-md-3 my-2 bg-danger bg-gradient mx-2" style="height: 150px;">

	 								<div class="col-md-12">
	 									<div class="row">
	 										<div class="col-md-8">
	 											<h4 class="text-white my-4">My Profile</h4>
	 										</div>
	 										<div class="col-md-4">
	 											<a href="profile.php"><i class="fa fa-user-circle fa-3x my-4" style="color: white;"></i></a>
	 										</div>
	 									</div>
	 								</div>
	 								
	 							</div>

	 							<div class="col-md-3 my-2 bg-warning bg-gradient mx-2" style="height: 150px;">

	 								<div class="col-md-12">
	 									<div class="row">
	 										<div class="col-md-8">
	 											<?php 

												$p = mysqli_query($connect,"SELECT * FROM pet");

												$pp = mysqli_num_rows($p);

									 			?>
	 											<h4 class="text-white my-2" style="font-size: 30px;"><?php echo $pp; ?></h4>
	 											<h4 class="text-white">Total</h4>
	 											<h4 class="text-white">Pets</h4>
	 										</div>
	 										<div class="col-md-4">
	 											<a href="pet.php"><i class="fa fa-paw fa-3x my-4" style="color: white;"></i></a>
	 										</div>
	 									</div>
	 								</div>
	 								
	 							</div>


	 							<div class="col-md-3 my-2 bg-success bg-gradient mx-2" style="height: 150px;">

	 								<div class="col-md-12">
	 									<div class="row">
	 										<div class="col-md-8">
	 											<?php 

	 											$app = mysqli_query($connect,"SELECT * FROM appointment WHERE status='Booked'");

	 											$appoint = mysqli_num_rows($app);

	 											 ?>
	 											<h4 class="text-white my-2" style="font-size: 30px;"><?php echo $appoint; ?></h4>
	 											<h4 class="text-white">Total</h4>
	 											<h4 class="text-white my-4">Appointments</h4>
	 										</div>
	 										<div class="col-md-4">
	 											<a href="appointment.php"><i class="fa fa-calendar fa-3x my-4" style="color: white;"></i></a>
	 										</div>
	 									</div>
	 								</div>
	 								
	 							</div>
	 						</div>
	 					</div>
	 				</div>
	 			</div>
	 		</div>
	 	</div>
	 </div>

</body>
</html>