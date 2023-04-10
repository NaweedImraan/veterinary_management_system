<?php 
session_start();
ob_start();

 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Total Doctors</title>
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

	 				include("sidenav.php");

	 				 ?>
	 				
	 			</div>
	 			<div class="col-md-10">
	 				<h3 class="text-center"><b>Total Doctors</b></h3>

	 				<?php 

	 				$query = "SELECT * FROM doctor WHERE status='Approved' ORDER BY date_reg ASC ";

	 				$res = mysqli_query($connect, $query);

	 				$output = "";


$output .= "

	<table class='table table-bordered'>
		<tr>
			<th>ID</th>
			<th>Firstname</th>
			<th>Surname</th>
			<th>Username</th>
			<th>Gender</th>
			<th>Phone</th>
			<th>Country</th>
			<th>Salary</th>
			<th>Date Registered</th>
			<th class='text-center'>Action</th>

		</tr>

";

if (mysqli_num_rows($res) < 1)  {
	
	$output .= "

			<tr>
			<td colspan='10' class='text-center'>No Job Requests Yet.</td>

			</tr>
	";
}

while ($row = mysqli_fetch_array($res)) {

	 $id = $row['id'];

	$output .="

		<tr>
			<td>".$row['id']."</td>
			<td>".$row['firstname']."</td>
			<td>".$row['surname']."</td>
			<td>".$row['username']."</td>
			<td>".$row['gender']."</td>
			<td>".$row['phone']."</td>
			<td>".$row['country']."</td>
			<td>".$row['salary']." LKR</td>
			<td>".$row['date_reg']."</td>
			<td class='text-center'>
			  <a href='edit.php?id=".$row['id']."'>
			  	  <button class='btn btn-info'>Edit</button>
			  </a>
			  <a href='doctor?id=$id'>
               	<button id='$id' class='btn btn-danger remove'>Remove</button>
               </a>

			</td>





	";
}

$output .= "
		</tr>
		</table>


";

echo $output;

						if (isset($_GET['id'])) {
                            $id = $_GET['id'];

                            $query = "DELETE FROM doctor WHERE id='$id'";
                            mysqli_query($connect,$query);
                            header("Location: doctor.php");
                            ob_enf_fluch();
                        }


	 				 ?>
	 				
	 			</div>
	 		</div>
	 	</div>
	 </div>

</body>
</html>