<?php 
session_start();

if (isset($_SESSION['pet'])) {
	unset($_SESSION['pet']);

	header("Location:../index.php");
}



 ?>