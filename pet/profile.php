<?php 
session_start();
ob_start();
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Pet Profile</title>
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

 				include ("sidenav.php");

 				$pet = $_SESSION['pet'];
 				$query = "SELECT * FROM pet WHERE username='$pet'";

 				$res = mysqli_query($connect,$query);

 				$row = mysqli_fetch_array($res);


 				 ?>
 			</div>
 			<div class="col-md-10">
 				<div class="col-md-12">
 					<div class="row">
 						<div class="col-md-6">

 							<?php 

 							if (isset($_POST['upload'])) {
 								$img = $_FILES['img']['name'];

 								if (empty($img)) {
 									
 								} else{
 									$query = "UPDATE pet SET profile ='$img' WHERE username='$pet'";

 									$res = mysqli_query($connect,$query);

 									if ($res) {
 										move_uploaded_file($_FILES['img']['tmp_name'], "img/$img"); 									}
 								}
 							}

 							 ?>
 							<h4>My Profile</h4>
 							<form method="post" enctype="multipart/form-data">
 								<?php 

 								echo "<img src='img/".$row['profile']."' class='col-md-12' style='height: 350px; width: 350px;'>";

 								 ?>
 								 <input type="file" name="img" class="form-control my-3">
 								 <input type="submit" name="upload" class="btn btn-info" value="Update Profile">
 							</form>
 							<br>

 							<table class="table table-bordered">
 								<tr>
 									<th colspan="2" class="text-center">My Details</th>
 								</tr>
 								<tr>
 									<td>Pet Name</td>
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
 									<td>+ <?php echo $row['phone']; ?></td>
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
 							</table>

 							
 							
 						</div>
 						<div class="col-md-6">
 							<h4 class="text-center">Change Username</h4>
 							<?php 
 							if (isset($_POST['update'])) {
 								
 								$uname = $_POST['uname'];

                                $error = array();

                                $resultset_1= mysqli_query($connect,"SELECT * FROM pet WHERE username='".$uname."' ");
                                $count_1 = mysqli_num_rows($resultset_1);

 								if (empty($uname)) {
 									$error['er'] = "Enter New Username";
 								}else if ($count_1 != 0) {
                                    $error['er'] = "The username is already exists in our System";
                                } else{
 									$query = "UPDATE pet SET username='$uname' WHERE username='$pet'";

 									$res = mysqli_query($connect,$query);

                                    echo "<h5 class='text-center alert alert-success'>New Username Changed Successfully!</h5>";

 									if ($res) {
 										$_SESSION['pet'] = $uname;
 									}
                                    
                                    header("Location: profile.php");
                                    ob_enf_fluch();
 								}
 							}

                            if (isset($error['er'])) {
                                    $e =$error['er'];

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
 								<label>Enter Username</label>
 								<input type="text" name="uname" class="form-control" autocomplete="off" placeholder="Enter Username">
 								<input type="submit" name="update" class="btn btn-info my-3" value="Update Username">
 							</form>

 							<?php 

 							if (isset($_POST['change'])) {
 								
 								$old = $_POST['old_pass'];
 								$new = $_POST['new_pass'];
 								$con = $_POST['con_pass'];

 								$q = "SELECT * FROM pet WHERE username='$pet'";

 								$re = mysqli_query($connect,$q);

 								$row = mysqli_fetch_array($re);

 								if (empty($old)) {
 									echo "<script>alert('Enter Old Password')</script>";
 								} else if (empty($new)) {
 									echo "<script>alert('Enter New Password')</script>";
 								} else if (empty($con)) {
 									echo "<script>alert('Enter Confirm Password')</script>";
 								} else if ($new != $con) {
 									echo "<script>alert('Both Password does not match')</script>";
 									
 								} else if ($old != $row['password']) {
 									
 									echo "<script>alert('Check the password')</script>";
 								} else {
 									$query ="UPDATE pet SET password='$new' WHERE username='$pet'";

 									mysqli_query($connect,$query); 								}
 							}

 							 ?>

 							<h4 class="my-4 text-center"> Change Password</h4>

 							<form method="post">
 								<label>Old password</label>
 								<input type="password" name="old_pass" class="form-control" autocomplete="off" placeholder="Enter Old Password" >
 								<label>New password</label>
 								<input type="password" name="new_pass" class="form-control" autocomplete="off" placeholder="Enter New Password" >
 								<label>Confirm password</label>
 								<input type="password" name="con_pass" class="form-control" autocomplete="off" placeholder="Enter Confirm Password" >
 								<input type="submit" name="change" class="btn btn-info my-3" value="Change Password">
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