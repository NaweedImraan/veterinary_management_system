<?php 
session_start();

 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>View Pet Details</title>
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
	 				<h4 class="text-center my-3">View Pet Details</h4>

	 				<?php 
	 				if (isset($_GET['id'])) {
	 					$id = $_GET['id'];

	 					$query = "SELECT * FROM pet WHERE id='$id'";

	 					$res =mysqli_query($connect,$query);

	 					$row = mysqli_fetch_array($res);
	 				}

	 				 ?>

	 				 <div class="col-md-12">
	 				 	<div class="row">
	 				 		<div class="col-md-3">
	 				 			
	 				 		</div>
	 				 		<div class="col-md-6">
	 				 			<?php 

	 				 			echo "<img src='../pet/img/".$row['profile']."' class='col-md-12 my-2' style='height: 350px; height: 350px;'>";

	 				 			 ?>

	 				 			<table class="table table-bordered">
	 				 				<tr>
	 				 					<th colspan="text-center" colspan="2">Details</th>
	 				 				</tr>
	 				 				<tr>
	 				 					<td>Pet name</td>
	 				 					<td><?php echo $row['petname']; ?></td>
	 				 				</tr>
	 				 				<tr>
	 				 					<td>Owner's name</td>
	 				 					<td><?php echo $row['ownername']; ?></td>
	 				 				</tr>
	 				 				<tr>
	 				 					<td>Username</td>
	 				 					<td><?php echo $row['username']; ?></td>
	 				 				</tr>
	 				 				<tr>
	 				 					<td>Email</td>
	 				 					<td><?php echo $row['email']; ?></td>
	 				 				</tr>
	 				 				<tr>
	 				 					<td>Phone Number</td>
	 				 					<td><?php echo $row['phone']; ?></td>
	 				 				</tr>
	 				 				<tr>
	 				 					<td>Gender</td>
	 				 					<td><?php echo $row['gender']; ?></td>
	 				 				</tr>
	 				 				<tr>
	 				 					<td>Breed</td>
	 				 					<td><?php echo $row['breed']; ?></td>
	 				 				</tr>
	 				 				<tr>
	 				 					<td>Country</td>
	 				 					<td><?php echo $row['country']; ?></td>
	 				 				</tr>
	 				 				<tr>
	 				 					<td>Date Registered</td>
	 				 					<td><?php echo $row['date_reg']; ?></td>
	 				 				</tr>

	 				 			</table>
	 				 		</div>
	 				 	</div>
	 				 </div>

	 			</div>
	 		</div>
	 	</div>
	 </div>

</body>
</html>