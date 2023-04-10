<?php 
session_start();

 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Admin Dashboard</title>
</head>
<body>

	<?php 

	include ("../include/header.php");

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

				<h4 class="my-2">Admin Dashboard</h4>
				
				<div class="col-md-12 my-1">
					<div class="row">
					<div class="col-md-3 bg-success bg-gradient mx-2" style="height: 130px;">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-8">
									<?php 
									$ad = mysqli_query($connect, "SELECT * FROM admin");

									$num = mysqli_num_rows($ad);

									 ?>
									<h4 class="my-2 text-white" style="font-size: 30px;"><?php echo $num; ?></h4>
									<h4 class="text-white">Total</h4>
									<h4 class="text-white">Admin</h4>
								</div>
								<div class="col-md-4">
									<a href="admin.php"><i class="fa fa-users-cog fa-3x my-4" style="color: white;"></i></a>
								</div>
							</div>
						</div>
							
					</div>

						<div class="col-md-3 bg-secondary bg-gradient mx-2" style="height: 130px;">
							<div class="col-md-12">
							<div class="row">
								<div class="col-md-8">
									<?php 

										$doctor = mysqli_query($connect, "SELECT * FROM doctor WHERE status='Approved'");

										$num2 = mysqli_num_rows($doctor);



									 ?>
									<h4 class="my-2 text-white" style="font-size: 30px;"><?php echo $num2 ?></h4>
									<h4 class="text-white">Total</h4>
									<h4 class="text-white">Doctors</h4>
								</div>
								<div class="col-md-4">
									<a href="doctor.php"><i class="fa fa-user-md fa-3x my-4" style="color: white;"></i></a>
								</div>
							</div>
						</div>
						</div>

						<div class="col-md-3 bg-warning bg-gradient mx-2" style="height: 130px;">
							<div class="col-md-12">
							<div class="row">
								<div class="col-md-8">
									<?php 

									$p = mysqli_query($connect,"SELECT * FROM pet ");

									$pp = mysqli_num_rows($p);

									 ?>
									<h4 class="my-2 text-white" style="font-size: 30px;"><?php echo  $pp; ?></h4>
									<h4 class="text-white">Total</h4>
									<h4 class="text-white">Pets</h4>
								</div>
								<div class="col-md-4">
									<a href="pet.php"><i class="fa fa-paw fa-3x my-4" style="color: white;"></i></a>
								</div>
							</div>
						</div>
						</div>

						<div class="col-md-3 bg-danger bg-gradient mx-2 my-2" style="height: 130px;">
							<div class="col-md-12">
							<div class="row">
								<div class="col-md-8">
									<?php 

									$re =mysqli_query($connect, "SELECT * FROM report");

									$rep = mysqli_num_rows($re);


									 ?>
									<h4 class="my-2 text-white" style="font-size: 30px;"><?php echo $rep; ?></h4>
									<h4 class="text-white">Total</h4>
									<h4 class="text-white">Feedbacks</h4>
								</div>
								<div class="col-md-4">
									<a href="report.php"><i class="fa fa-flag fa-3x my-4" style="color: white;"></i></a>
								</div>
							</div>
						</div>
						</div>

						<div class="col-md-3 bg-info bg-gradient mx-2 my-2" style="height: 130px;">
							<div class="col-md-12">
							<div class="row">
								<div class="col-md-8">
									<?php 

									$job = mysqli_query($connect, "SELECT * FROM doctor WHERE status='Pending' ");

									$num1 = mysqli_num_rows($job);



									 ?>
									<h4 class="my-2 text-white" style="font-size: 30px;"><?php echo $num1 ?></h4>
									<h4 class="text-white">Total</h4>
									<h4 class="text-white">Job Requests</h4>
								</div>
								<div class="col-md-4">
									<a href="job_request.php"><i class="fa fa-briefcase-medical fa-3x my-4" style="color: white;"></i></a>
								</div>
							</div>
						</div>
						</div>

						<div class="col-md-3 bg-primary bg-gradient mx-2 my-2" style="height: 130px;">
							<div class="col-md-12">
							<div class="row">
								<div class="col-md-8">
									<?php 

									$in =mysqli_query($connect,"SELECT sum(amount_paid) as profit FROM income");

									$row = mysqli_fetch_array($in);

									$inc = $row['profit'];


									 ?>
									<h4 class="my-2 text-white" style="font-size: 30px;"><?php echo "$$inc"; ?></h4>
									<h4 class="text-white">Total</h4>
									<h4 class="text-white">Income</h4>
								</div>
								<div class="col-md-4">
									<a href="income.php"><i class="fa fa-money-check-alt fa-3x my-4" style="color: white;"></i></a>
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