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
 				<h4 class="text-center my-4">Vaccination Details</h4>

                <?php 

                $pet = $_SESSION['pet'];

                $query = mysqli_query($connect,"SELECT * FROM vaccine_card WHERE pet='$pet' ORDER BY date_vaccinated ASC");

                $output = "";

                $output .= "
                <table class='table table-bordered'>
                    <tr>
                        <td class='text-center'>ID</td>
                        <td class='text-center'>Doctor</td>
                        <td class='text-center'>Pet</td>
                        <td class='text-center'>Age Category</td>
                        <td class='text-center'>Vaccine Name</td>
                        <td class='text-center'>Status</td>
                        <td class='text-center'>Date</td>
                    </tr>
                ";

                if (mysqli_num_rows($query) < 1) {
                    $output .="
                    <tr>
                        <td colspan='7' class='text-center'>Not Yet Vaccinated.</td>
                    </tr>

                    ";
                }

                while($row = mysqli_fetch_array($query)){

                    $output .="

                    <tr>
                        <td class='text-center'>".$row['id']."</td>
                        <td class='text-center'>".$row['doctor']."</td>
                        <td class='text-center'>".$row['pet']."</td>
                        <td class='text-center'>".$row['age_category']."</td>
                        <td class='text-center'>".$row['vaccine_name']."</td>
                        <td class='text-center' style='white-space: pre-line;'>".$row['status']."</td>
                        <td class='text-center' style='white-space: pre-line;'>".$row['date_vaccinated']."</td>

                    ";
                }

                $output .="
                </tr>
                </table>

                ";
                echo $output;
                
                 ?>

                 <a style="float: right;" class="text-center" href="vaccinecard.php">
                                <button class='btn btn-info text-right'>View</button>
                            </a>
 			</div>
 		</div>
 	</div>
 </div>

</body>
</html>