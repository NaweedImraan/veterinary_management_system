<?php 
session_start();
ob_start();
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Edit Doctor</title>
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
	 				<h3 class="text-center"><b>Edit Doctor</b></h3>


	 				<?php 

	 				if (isset($_GET['id'])) {
	 					$id = $_GET['id'];

	 					$query = "SELECT * FROM doctor WHERE id='$id'";
	 					$res = mysqli_query($connect, $query);


	 					$row = mysqli_fetch_array($res);
	 				}


	 				 ?>

	 				 <div class="row">
	 				 	<div class="col-md-8">
	 				 		<h3 class="text-center"><b>Doctor Details</b></h3>
	 				 		
	 				 		<h4 class="my-3"><b>ID : <?php echo $row['id']; ?></b></h4>
	 				 		<h4 class="my-3"><b>Firstname : <?php echo $row['firstname']; ?></b></h4>
	 				 		<h4 class="my-3"><b>Surname : <?php echo $row['surname']; ?></b></h4>
	 				 		<h4 class="my-3"><b>Username : <?php echo $row['username']; ?></b></h4>
	 				 		<h4 class="my-3"><b>Email : <?php echo $row['email']; ?></b></h4>
	 				 		<h4 class="my-3"><b>Phone : +<?php echo $row['phone']; ?></b></h4>
	 				 		<h4 class="my-3"><b>Gender : <?php echo $row['gender']; ?></b></h4>
	 				 		<h4 class="my-3"><b>Country : <?php echo $row['country']; ?></b></h4>
	 				 		<h4 class="my-3"><b>Date Registered : <?php echo $row['date_reg']; ?></b></h4>
	 				 		<h4 class="my-3"><b>Salary : <?php echo $row['salary']; ?> LKR</b></h4>
	 				 	</div>
	 				 	<div class="col-md-4">
	 				 		<h3 class="text-center"><b>Update Salary</b></h3>
	 				 		<?php 

	 				 		if (isset($_POST['update'])) {
	 				 			 
	 				 			 $salary = $_POST['salary'];

	 				 			 $q = "UPDATE doctor SET salary='$salary' WHERE id='$id'";

	 				 			 mysqli_query($connect,$q);
	 				 			 
	 				 			 header("Location: doctor.php");
                            ob_enf_fluch();
	 				 		}


	 				 		?>

	 				 		<form method="post">
	 				 			<label>Enter Doctor's Salary</label>
	 				 			<input type="number" name="salary" class="form-control" autocomplete="off" placeholder="Enter Doctor's Salary" value="<?php echo $row['salary']; ?>">
	 				 			<input type="submit" name="update" class="btn btn-info my-3" value="Update Salary">
	 				 		</form>
	 				 	</div>
	 				 </div>
	 			</div>
	 		</div>
	 	</div>
	 </div>

</body>
</html>