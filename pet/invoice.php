<?php 
session_start();
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>My Invoice</title>
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

 				 ?>
 			</div>
 			<div class="col-md-10">
 				<h4 class="text-center my-4">My Invoice</h4>

                <?php 

                $pet = $_SESSION['pet'];

                $query = "SELECT * FROM pet WHERE username='$pet'";

                $res = mysqli_query($connect,$query);

                $row = mysqli_fetch_array($res);

                $pname= $row['petname'];

                $querys = mysqli_query($connect,"SELECT * FROM income WHERE pet='$pname'");

                $output = "";

                $output .= "
                <table class='table table-bordered'>
                    <tr>
                        <td class='text-center'>ID</td>
                        <td class='text-center'>Doctor</td>
                        <td class='text-center'>Pet</td>
                        <td class='text-center'>Date Discharged</td>
                        <td class='text-center'>Amount Paid</td>
                        <td class='text-center'>Prescription</td>
                        <td class='text-center'>Action</td>
                    </tr>
                ";

                if (mysqli_num_rows($querys) < 1) {
                    $output .="
                    <tr>
                        <td colspan='7' class='text-center'>No Invoice Yet.</td>
                    </tr>

                    ";
                }

                while($row = mysqli_fetch_array($querys)){

                    $output .="

                    <tr>
                        <td class='text-center'>".$row['id']."</td>
                        <td class='text-center'>".$row['doctor']."</td>
                        <td class='text-center'>".$row['pet']."</td>
                        <td class='text-center'>".$row['date_discharge']."</td>
                        <td class='text-center'>".$row['amount_paid']." LKR</td>
                        <td style='white-space: pre-line;'>".$row['description']."</td>
                        <td class='text-center'>
                            <a href='view.php?id=".$row['id']."'>
                                <button class='btn btn-info align-self-center'>View</button>
                            </a>
                        </td>


                    ";
                }

                $output .="
                </tr>
                </table>

                ";

                echo $output;


                 ?>
 			</div>
 		</div>
 	</div>
 </div>

</body>
</html>