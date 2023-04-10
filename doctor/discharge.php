<?php 
session_start();
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Check Patient Appointment</title>
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
 				<h4 class="text-center my-4">Appointment Details</h4>

 				<?php 

 				if (isset($_GET['id'])) {
 					$id = $_GET['id'];

 					$query = "SELECT * FROM appointment WHERE id='$id'";

 					$res = mysqli_query($connect, $query);

 					$row = mysqli_fetch_array($res);

 				}


 				 ?>

 				<div class="col-md-12">
 					<div class="row">
 						<div class="col-md-6"  style="margin-top: 30px;">
 							<table class="table table-bordered">
 								<tr>
 									<td colspan="2" class="text-center"><b>Appointment Details</b></td>
 								</tr>

 								<tr>
 									<td>Owner's name</td>
 									<td><?php echo $row['ownername']; ?></td>
 								</tr>
 								<tr>
 									<td>Pet Name</td>
 									<td><?php echo $row['petname']; ?></td>
 								</tr>
 								<tr>
 									<td>Gender</td>
 									<td><?php echo $row['gender']; ?></td>
 								</tr>
 								<tr>
 									<td>Phone</td>
 									<td><?php echo $row['phone']; ?></td>
 								</tr>
 								<tr>
 									<td>Appointment Date</td>
 									<td><?php echo $row['appointment_date']; ?></td>
 								</tr>
 								<tr>
 									<td>Reasons</td>
 									<td><?php echo $row['symptoms']; ?></td>
 								</tr>

 							</table>
 						</div>

 						<div class="col-md-6" style="margin-top: 20px;">
 							<h4 class="text-center my-1"><b>Invoice</b></h4>

 							<?php 

 							if (isset($_POST['send'])) {
 								
 								$doc = $_SESSION['doctor'];
 								$petname = $row['petname'];
 								$fee = $_POST['fee'];
 								$des = $_POST['des'];
 								

 								if (empty($fee)) {

                                    echo "<script>alert('Enter Fee amount')</script>";
 								
 								} else if (empty($des)) {

                                    echo "<script>alert('Enter Prescription')</script>";
 									
 								} else{


 									$query = "INSERT INTO income(doctor,pet,date_discharge,amount_paid,description) VALUES('$doc','$petname',NOW(),'$fee','$des')";

 									$res = mysqli_query($connect,$query);

 									if ($res) {
 										
 										echo "<script>alert('You have sent Invoice')</script>";

 										mysqli_query($connect,"UPDATE appointment SET status='Discharged' WHERE id=$id");
 									}
 								}
 							}

 							 ?>

 							<form method="post">
 								<label>Fee</label>
 								<input type="number" name="fee" class="form-control" autocomplete="off" placeholder="Enter pet's fee">

 								<label>Prescription</label>
                                <textarea class="form-control " style="white-space: pre-line;" name="des" rows="10" autocomplete="off" placeholder="Panadol 250mg nocte&#10;Zin 10mg mane&#10;Vitamin C 20mg TDS..."></textarea>

 								<input type="submit" name="send" class="btn btn-info my-2" value="Send">
 							</form>
 						</div>

 					</div>
 				</div>
 			</div>
 		</div>
 	</div>
 </div>
</body>
</html>