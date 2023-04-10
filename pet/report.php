<?php 
session_start();
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>My Reports</title>
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
 				<h4 class="text-center my-4">My Reports</h4>

                <?php 

                $pet = $_SESSION['pet'];

                $query = "SELECT * FROM pet WHERE username='$pet'";

                $res = mysqli_query($connect,$query);

                $row = mysqli_fetch_array($res);

                $pname= $row['petname'];

                $querys = mysqli_query($connect,"SELECT * FROM test_results WHERE pet='$pname'");

                $output = "";

                $output .= "
                <table class='table table-bordered'>
                    <tr>
                        <td class='text-center'>ID</td>
                        <td class='text-center'>Doctor</td>
                        <td class='text-center'>Pet</td>
                        <td class='text-center'>Test Name</td>
                        <td class='text-center'>Test Description</td>
                        <td class='text-center'>Test Results</td>
                        <td class='text-center'>Tested Date</td>
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
                        <td class='text-center'>".$row['test_name']."</td>
                        <td style='white-space: pre-line;'>".$row['test_description']."</td>
                        <td style='white-space: pre-line;'>".$row['test_results']."</td>
                        <td style='white-space: pre-line;'>".$row['tested_date']."</td>
                        <td class='text-center'>
                            <a href='viewreport.php?id=".$row['id']."'>
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