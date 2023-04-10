<?php 
session_start();
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Total Income</title>
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
	 				<h4 class="text-center my-4">Total Income</h4>
	 				<?php 

	 				$query = "SELECT * FROM income";

	 				$res = mysqli_query($connect,$query);

	 				$output = "";

	 				$output .="

	 					<table class='table table-bordered'>
	 						<tr>
	 							<td>ID</td>
	 							<td>Doctor</td>
	 							<td>Pet</td>
	 							<td>Date Discharged</td>
	 							<td>Amount Paid</td>
	 							
	 						</tr>

	 				";

	 				if (mysqli_num_rows($res) < 1) {
	 					
	 					$output .= "

	 						<tr>
	 							<td class='text-center' colspan='5'>No Pets Discharge Yet.</td>
	 						</tr>

	 					";
	 				}

	 				while($row =mysqli_fetch_array(($res))){

	 					$output .= "

	 					<tr>
	 						<td>".$row['id']."</td>
	 						<td>".$row['doctor']."</td>
	 						<td>".$row['pet']."</td>
	 						<td>".$row['date_discharge']."</td>
	 						<td>".$row['amount_paid']." LKR</td>

	 					";

	 				}

	 				$output .= "

	 				</tr>
	 				</table>;

	 				";

	 				echo $output;


	 				 ?>
	 			</div>
	 		</div>
	 	</div>
	 </div>

</body>
</html>