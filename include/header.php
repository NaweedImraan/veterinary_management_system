<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css">

	<script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	 <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css">

	 <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">


	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>

	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>
<body>

	<nav class="navbar navbar-expand-lg navbar-primary bg-primary">
		<h3 class="text-white"><b>Veterinary Management System</b></h3>

		<div class="ms-auto"></div>

		<ul class="navbar-nav">
			<?php 

			if (isset($_SESSION['admin'])) {
				
				$user = $_SESSION['admin'];
				echo '
			<li class="nav-item"><a href="#" class="nav-link text-white" style="text-decoration: none;"><h4><b>| ADMIN -  '.$user.' |</b></h4></a></li>
			<li class="nav-item"><a href="logout.php" class="nav-link text-white" style="text-decoration: none;"><h4><b> Logout |</b></h4></a></li>';


			} else if (isset($_SESSION['doctor'])) {

				$user = $_SESSION['doctor'];
				echo '
			<li class="nav-item"><a href="#" class="nav-link text-white" style="text-decoration: none;"><h4><b>| DOCTOR - '.$user.' |</b></h4></a></li>
			<li class="nav-item"><a href="logout.php" class="nav-link text-white" style="text-decoration: none;"><h4><b> Logout |</b></h4></a></li>';

			} else if (isset($_SESSION['pet'])) {
				
				$user = $_SESSION['pet'];
				echo '
			<li class="nav-item"><a href="#" class="nav-link text-white" style="text-decoration: none;"><h4><b>| PET -  '.$user.' |</b></h4></a></li>
			<li class="nav-item"><a href="logout.php" class="nav-link text-white" style="text-decoration: none;"><h4><b> Logout |</b></h4></a></li>';

			} else {
				echo '
				<li class="nav-item"><a href="index.php" class="nav-link text-white" style="text-decoration: none;"><h4><b>| Home |</b></h4></a></li>
				<li class="nav-item"><a href="adminlogin.php" class="nav-link text-white" style="text-decoration: none;"><h4><b>Admin |</b></h4></a></li>
				<li class="nav-item"><a href="doctorlogin.php" class="nav-link text-white" style="text-decoration: none;"><h4><b>Doctor |</b></h4></a></li>
				<li class="nav-item"><a href="petlogin.php" class="nav-link text-white" style="text-decoration: none;"><h4><b>Pet |</b></h4></a></li>';
			}

			 ?>
		</ul>
		

	</nav>

</body>
</html>