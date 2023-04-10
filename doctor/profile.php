<?php 
session_start();
ob_start();

 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Doctor's Profile</title>
</head>
<body>

	<?php 

	include ("../include/header.php");
	include("../include/connection.php");

	$doc= $_SESSION['doctor'];

	$query = "SELECT * FROM doctor WHERE username='$doc'";

	$res = mysqli_query($connect, $query);

	$row = mysqli_fetch_array($res);

	/*while ($row = mysqli_fetch_array($res)) {
		$username = $row['username'];
		$password = $row['password'];
		
	}*/

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
	 				 <div class="col-md-12">
	 				 	<div class="row">
	 				 		<div class="col-md-6">
	 				 			<h4>Dr.<?php echo $row['username']; ?>'s Profile</h4>

	 				 			<?php 

	 				 			

	 				 			if (isset($_POST['upload'])) {
	 				 				$img = $_FILES['img']['name'];

	 				 				if (empty($img)) {
	 				 				
	 				 				} else{
	 				 					$query = "UPDATE doctor SET profile='$img' WHERE username='$doc'";

	 				 					$res = mysqli_query($connect,$query);

	 				 					if ($res) {
	 				 						move_uploaded_file($_FILES['img']['tmp_name'], "img/$img");
	 				 					}
	 				 				}
	 				 			}

	 				 			 ?>

	 				 			 <form method="post" enctype="multipart/form-data">
	 				 			 	<?php 

	 				 			 	echo "<img src='img/".$row['profile']."' style='height: 350px; width: 350px;' class='col-md-12 my-3'>";

	 				 			 	 ?>

	 				 			 	 <input type="file" name="img" class="form-control my-1">
	 				 			 	 <br>
	 				 			 	 <input type="submit" name="upload" class="btn btn-success" value="Update Profile">
	 				 			 </form>
	 				 			 <br>

	 				 			 <div class="my-3">
	 				 			 	<table class="table table-bordered">
	 				 			 		<tr>
	 				 			 			<th colspan="2" class="text-center">Details</th>
	 				 			 		</tr>
	 				 			 		<tr>
	 				 			 			<td>Firstname</td>
	 				 			 			<td><?php echo $row['firstname']; ?></td>
	 				 			 		</tr>

	 				 			 		<tr>
	 				 			 			<td>Surname</td>
	 				 			 			<td><?php echo $row['surname']; ?></td>
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
	 				 			 			<td><?php echo "+".$row['phone'].""; ?></td>
	 				 			 		</tr>

	 				 			 		<tr>
	 				 			 			<td>Gender</td>
	 				 			 			<td><?php echo $row['gender']; ?></td>
	 				 			 		</tr>

	 				 			 		<tr>
	 				 			 			<td>Country</td>
	 				 			 			<td><?php echo $row['country']; ?></td>
	 				 			 		</tr>

	 				 			 		<tr>
	 				 			 			<td>Salary</td>
	 				 			 			<td><?php echo $row['salary']." LKR"; ?></td>
	 				 			 		</tr>

	 				 			 	</table>
	 				 			 </div>
	 				 			
	 				 		</div>
	 				 		<div class="col-md-6">
	 				 			<h4 class="text-center my-2">Change Username</h4>
	 				 			<?php 

	 				 			if (isset($_POST['change_uname'])) {
	 				 				$uname = $_POST['uname'];

	 				 				$error = array();

	 				 				$resultset_1= mysqli_query($connect,"SELECT * FROM doctor WHERE username='".$uname."' ");
									$count_1 = mysqli_num_rows($resultset_1);

	 				 				if (empty($uname)) {
	 				 					$error['un'] = "Enter New Username";
	 				 				} else if ($count_1 != 0) {
										$error['un'] = "The username is already exists in our System";
									}

									if (count($error) ==0){
	 				 					$query = "UPDATE doctor SET username='$uname' WHERE username='$doc'";

	 				 					$res = mysqli_query($connect,$query);

	 				 					echo "<h5 class='text-center alert alert-success'>New Username Changed Successfully!</h5>";

	 				 					if ($res) {
	 				 						$_SESSION['doctor'] = $uname;
	 				 					}

	 				 					header("Location: profile.php");
	 				 					ob_enf_fluch();


	 				 				}
	 				 			}

	 				 			if (isset($error['un'])) {
 									$e =$error['un'];

 									$show = "<h5 class='text-center alert alert-danger'>$e</h5>";
 								} else{
 									$show = "";
 								}


	 				 			 ?>
	 				 			<form method="post">
	 				 				<div>
 									<?php 
 									echo $show;

 									?>
 									</div>
	 				 				<label>Change Username</label>
	 				 				<input type="text" name="uname" class="form-control" autocomplete="off" placeholder="Enter Username">
	 				 				<br>
	 				 				<input type="submit" name="change_uname" class="btn btn-success" value="Change Username">
	 				 			</form>
	 				 			<br><br>

	 				 			<h4 class="text-center my-2">Change Password</h4>

	 				 			<?php 
	 				 			if (isset($_POST['change_pass'])) {
	 				 				$old = $_POST['old_pass'];
	 				 				$new = $_POST['new_pass'];
	 				 				$con = $_POST['con_pass'];

	 				 				$ol = "SELECT * FROM doctor WHERE username='$doc'";
	 				 				$ols = mysqli_query($connect, $ol);
	 				 				$row = mysqli_fetch_array($ols);

	 				 				if ($old != $row['password']) {
	 				 					
	 				 				} else if (empty($new)){

	 				 				} else if ($con != $new) {

	 				 				} else {
	 				 					$query = "UPDATE doctor SET password='$new' WHERE username='$doc'";

	 				 					mysqli_query($connect,$query);
	 				 				}

	 				 			}


	 				 			 ?>



	 				 			<form method="post">
	 				 				<div class="form-group">
	 				 					<label>Old Password</label>
	 				 					<input type="password" name="old_pass" class="form-control" autocomplete="off" placeholder="Enter Old Password">
	 				 				</div>
	 				 				<div class="form-group">
	 				 					<label>New Password</label>
	 				 					<input type="password" name="new_pass" class="form-control" autocomplete="off" placeholder="Enter New Password">
	 				 				</div>
	 				 				<div class="form-group">
	 				 					<label>Confirm Password</label>
	 				 					<input type="password" name="con_pass" class="form-control" autocomplete="off" placeholder="Enter Confirm Password">
	 				 				</div>
	 				 				<input type="submit" name="change_pass" class="btn btn-info" value="Change Passowrd">
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