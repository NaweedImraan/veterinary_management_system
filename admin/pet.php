<?php 
session_start();
ob_start();
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Total Pets</title>
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
 				<h4 class="text-center my-3">Total Pets</h4>

 				<?php 

 				$query = "SELECT * FROM pet";

 				$res = mysqli_query($connect,$query);



 				$output="";

 				$output .="

 				<table class='table table-bordered'>
 					<tr>
 						<td>ID</td>
 						<td>Petname</td>
 						<td>Owner's name</td>
 						<td>Username</td>
 						<td>Email</td>
 						<td>Phone</td>
 						<td>Gender</td>
                        <td>Breed</td>
 						<td>Country</td>
 						<td>Date Reg.</td>
 						<td class='text-center'>Action</td>

 					</tr>



 				";

 				if (mysqli_num_rows($res) < 1) {
 					$output .= "

 					<tr>
 					<td class='text-center' colspan='10'>No Pets Yet</td>
 					</tr>

 					";
 				}

 				while($row = mysqli_fetch_array($res)){
                    $id = $row['id'];

 					$output .= "

 					<tr>
 					<td>".$row['id']."</td>
 					<td>".$row['petname']."</td>
 					<td>".$row['ownername']."</td>
 					<td>".$row['username']."</td>
 					<td>".$row['email']."</td>
 					<td>".$row['phone']."</td>
 					<td>".$row['gender']."</td>
                    <td>".$row['breed']."</td>
 					<td>".$row['country']."</td>
 					<td>".$row['date_reg']."</td>
 					<td class='text-center'>
 						<a href='view.php?id=".$row['id']."'>
 							<button class='btn btn-info'>View</button>
 						</a>
                        <a href='pet?id=$id'>
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

                            $query = "DELETE FROM pet WHERE id='$id'";
                            mysqli_query($connect,$query);
                            header("Location: pet.php");
                            ob_enf_fluch();
                        }


 				 ?>
 			</div>
 		</div>
 	</div>
 </div>
</body>
</html>