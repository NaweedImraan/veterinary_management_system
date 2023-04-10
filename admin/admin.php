<?php 
session_start();

 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Admin</title>
</head>
<body>
<?php 
include ("../include/header.php");
 ?>
<div class="container-fluid">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-2" style="margin-left: -30px; margin-top: -20px;">
				<?php 
				include ("sidenav.php");
				include ("../include/connection.php");

				 ?>
			</div>
			<div class="col-md-10">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-6">
						<h4 class="text-center">All Admins</h4>

						<?php 

						$ad = $_SESSION['admin'];
						$query = "SELECT * FROM admin WHERE username != '$ad'";
						$res = mysqli_query($connect, $query);

						$output = "<table class='table table-bordered'>
						<tr>
							<th>ID</th>
							<th>Username</th>
							<th style='width: 10%;'>Action</th>
							<tr>

						";
						if (mysqli_num_rows($res) < 1) {
							$output .= "<tr><td colspan='3' class='text-center'>No New Admin</td></tr>";
						}

						while($row= mysqli_fetch_array($res)) {
							$id = $row['id'];
							$username = $row['username'];

							$output .= "
							<tr>
								<td>$id</td>
								<td>$username</td>
								<td>
									<a href='admin?id=$id'><button id='$id' class='btn btn-danger remove'>Remove</button></a>
								</td>

							";

						}

						$output .="
							</tr>
						</table>

						";

						echo $output;


						if (isset($_GET['id'])) {
							$id = $_GET['id'];

							$query = "DELETE FROM admin WHERE id='$id'";
							mysqli_query($connect,$query);
							header("Location: admin.php");
						}

						 ?>
							



					</div>
					<div class="col-md-6">
						<?php 

						if (isset($_POST['add'])) {
							
							$uname = $_POST['uname'];
							$email = $_POST['email'];
							$pass = $_POST['pass'];
							$image = $_FILES['img']['name'];
							$verify_token = md5(rand());

							$error = array();

							$resultset_1= mysqli_query($connect,"SELECT * FROM admin WHERE username='".$uname."' ");
							$count_1 = mysqli_num_rows($resultset_1);

							//Email exists or not
							$check_email_query="SELECT email FROM admin WHERE email='$email' LIMIT 1";
							$check_email_query_run = mysqli_query($connect,$check_email_query);
							$count_2 = mysqli_num_rows($check_email_query_run);

							if (empty($uname)) {
								$error['u'] = "Enter Admin Username";
							} else if (empty($email)) {
								$error['u'] = "Enter Email Address";
							} else if (empty($pass)) {
								$error['u'] = "Enter Admin Password";
							} else if (empty($image)) {
								$error['u'] = "Add Admin Picture";
							} else if ($count_1 != 0) {
								$error['u'] = "The username is already exists in our System";
							} else if ($count_2 != 0) {
								$error['u'] = "The Email is already exists in our System";
							}

							if (count($error) ==0) {

								$query = "INSERT INTO admin(username,email,password,verify_token,profile) VALUES('$uname','$email','$pass','$verify_token','$image')";

								$result = mysqli_query($connect, $query);

								if ($result) {
									move_uploaded_file($_FILES['img']['tmp_name'], "img/$image"); 
									header("Location: admin.php");
								} else {

								}

								echo "<h4 class='text-center alert alert-success'>Successfully Added!</h4>";
							}
						}


						if (isset($error['u'])) {
							$er = $error['u'];

							$show = "<h4 class='text-center alert alert-danger'>$er</h4>";
						} else {
							$show ="";
						}


						 ?>
						<h4 class="text-center">Add Admin</h4>
						<form method="post" enctype="multipart/form-data">
							<div>
								<?php echo $show; ?>
							</div>
							<div class="from-group">
								<label>Username</label>
								<input type="text" name="uname" class="form-control" autocomplete="off">
							</div>
							<div class="from-group">
								<label>Email</label>
								<input type="email" name="email" class="form-control" autocomplete="off">
							</div>
							<div class="from-group">
								<label>Password</label>
								<input type="password" name="pass" class="form-control">
							</div>

							<div class="from-group">
								<label>Add Admin Picture</label>
								<input type="file" name="img" class="form-control">
							</div><br> 
							<input type="submit" name="add" value="Add New Admin" class="btn btn-success">
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