<?php 
session_start();

 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Admin Profile</title>
</head>
<body>
<?php 

include ("../include/header.php");
include ("../include/connection.php");

$ad = $_SESSION['admin'];

$query = "SELECT * FROM admin WHERE username='$ad'";

$res = mysqli_query($connect, $query);

while ($row = mysqli_fetch_array($res)) {
	$username = $row['username'];
	$profiles = $row['profile'];
}

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
 							<h4><?php echo $username; ?>'s Profile</h4>

 							<?php 

 							if (isset($_POST['update'])) {
 								
 								$profile = $_FILES['profile']['name'];

 								$error = array();

 								if (empty($profile)) {
 									$error['a'] = "Enter New Profile";
 								} else {
 									$query = "UPDATE admin SET profile='$profile' WHERE username='$ad'";

 									$result = mysqli_query($connect, $query);

 									echo "<h5 class='text-center alert alert-success'>New Profile Updated Successfully!</h5>";


 									if ($result) {
 										move_uploaded_file($_FILES['profile']['tmp_name'], "img/$profile");
 										header("Location: profile.php");
 									}
 								}
 							}

 							if (isset($error['a'])) {
 									$e =$error['a'];

 									$show = "<h5 class='text-center alert alert-danger'>$e</h5>";
 								} else{
 									$show = "";
 								}

 							 ?>

 							<div>
 								<?php 
 								echo $show;

 								?>
 								</div>

 							<form method="post" enctype="multipart/form-data">
 							<?php
 							 echo "<img src='img/$profiles' class='col-md-12' style='height: 350px; width: 350px;'>"
 							  ?>
 							  <br><br><br><br><br><br>
 							  <br><br><br><br><br><br>
 							  <br><br><br><br><br><br>
 							  <div class="form-group">
 							  	<label>UPDATE PROFILE</label>
 							  	<input type="file" name="profile" class="form-control">
 							  </div>
 							  <br>
 							  <input type="submit" name="update" value="UPDATE" class="btn btn-success">
 							</form>
 						</div>
 						<div class="col-md-6">
 							<?php 

 							

 							if (isset($_POST['change'])) {
 								$uname = $_POST['uname'];

 								$error = array();

 								$resultset_1= mysqli_query($connect,"SELECT * FROM admin WHERE username='".$uname."' ");
								$count_1 = mysqli_num_rows($resultset_1);

 								if (empty($uname)) {
 									$error['u'] = "Enter New Username";
 								} else if ($count_1 != 0) {
									$error['u'] = "The username is already exists in our System";
								}

 								if (count($error) ==0) {
 									$query = "UPDATE admin SET username='$uname' WHERE username='$ad'";

 									$res= mysqli_query($connect, $query);

 									echo "<h5 class='text-center alert alert-success'>New Username Changed Successfully!</h5>";


 									if ($res) {
 										
 										$_SESSION['admin'] = $uname;

 										
 									}
 									header("Location: profile.php");
 								}

 							}

 							if (isset($error['u'])) {
 									$e =$error['u'];

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
 								<input type="text" name="uname" class="form-control" autocomplete="off"><br> 
 								<input type="submit" name="change" class="btn btn-success" value="Change"> 
 							</form>


 							<br><br>

 							<?php 

 							if (isset($_POST['update_pass'])) {
 								$old_pass = $_POST['old_pass'];
 								$new_pass = $_POST['new_pass'];
 								$con_pass = $_POST['con_pass'];

 								$error = array();

 								$old = mysqli_query($connect, "SELECT * FROM admin WHERE username='$ad'");
 								$row = mysqli_fetch_array($old);
 								$pass = $row['password'];

 								if (empty($old_pass)) {
 									$error['p'] = "Enter Old Password";
 								} else if(empty($new_pass)) {
 									$error['p'] = "Enter New Password";
 								} else if(empty($con_pass)) {
 									$error['p'] = "Confirm Password";
 								} else if($old_pass != $pass) {
 									$error['p'] = "Invalid Old Password";
 								} else if($new_pass != $con_pass) {
 									$error['p'] = "Both Password does not match";
 								}

 								if (count($error) ==0) {
 									$query = "UPDATE admin SET password='$new_pass' WHERE username='$ad'";
 									mysqli_query($connect,$query);

 									echo "<h5 class='text-center alert alert-success'>New Password Updated Successfully!</h5>";
 								}

 								
 							}

 							if (isset($error['p'])) {
 									$e =$error['p'];

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
 								<h4 class="text-center my-4">Change Password</h4>
 								<div class="form-group">
 									<label>Old Password</label>
 									<input type="password" name="old_pass" class="form-control">
 								</div>
 								<div class="form-group">
 									<label>New Password</label>
 									<input type="password" name="new_pass" class="form-control">
 								</div>
 								<div class="form-group">
 									<label>Confirm Password</label>
 									<input type="password" name="con_pass" class="form-control">
 								</div>

 								<input type="submit" name="update_pass" value="Update Password" class="btn btn-info">
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