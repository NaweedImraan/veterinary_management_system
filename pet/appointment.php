<?php 
session_start();
ob_start();
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Book Appointment</title>
</head>
<body>

<?php 

include ("../include/header.php");
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
 				
 				<h4 class="text-center my-5"><b>Book Appointment</b></h4>

 				<?php 

 				$pet = $_SESSION['pet'];
 				$sel = mysqli_query($connect,"SELECT * FROM pet WHERE username ='$pet'");

 				$row = mysqli_fetch_array($sel);

 				$petname = $row['petname'];
 				$ownername = $row['ownername'];
 				$gender = $row['gender'];
 				$phone = $row['phone'];
 				

 				if (isset($_POST['book'])) {
 					
 					$date = $_POST['date'];
 					$sym = $_POST['sym'];

 					if (empty($date)) {

 						echo "<script>alert('Enter Date')</script>";
 						
 					} else if (empty($sym)) {

 						echo "<script>alert('Enter the symptoms of your Pet!')</script>";

 					} else {

 						$query ="INSERT INTO appointment(petname, ownername,gender,phone,appointment_date,symptoms,status,date_booked) VALUES('$petname','$ownername','$gender','$phone','$date','$sym','Booked',NOW()); ";

 						$res =mysqli_query($connect,$query);

 						if ($res) {
 							echo "<script>alert('You have booked an appoinment.')</script>";
 						}

 					}
 				}


 				 ?>

 				<div class="col-md-12">
 					<div class="row">
 						<div class="col-md-3"></div>
 						<div class="col-md-6 jumbotron bg-warning">
 							<form method="post">
 								<label>Appointment Date</label>
 								<input type="date" min="<?php echo date("Y-m-d"); ?>" name="date" class="form-control">

 								<label>Reasons</label>
 								<input type="text" name="sym" class="form-control" autocomplete="off" placeholder="Eg: For Vaccination, Vomiting, Diarrhea, Weight loss and etc.">
 								<input type="submit" name="book" class="btn btn-info my-3" value="Book Appointment">
 							</form>
 						</div>
 						<div class="col-md-3"></div>
 					</div>
 				</div>

                <div class="col-md-12">
                <h4 class="text-center my-4"><b>My Appointments</b></h4>

                <?php 

                $query = "SELECT * FROM appointment WHERE petname='$petname' ORDER BY appointment_date";

                $res = mysqli_query($connect,$query);

                $output = "";

                $output .= "

                <table class='table table-bordered'>
                    <tr>
                    <td>ID</td>
                    <td>Pet Name</td>
                    <td>Gender</td>
                    <td>Phone</td>
                    <td>Appointment Date</td>
                    <td>Appointment Day</td>
                    <td>Reasons</td>
                    <td>Date Booked</td>
                    <td>Status</td>
                    <td class='text-center'>Action</td>
                    </tr>

                ";

                if (mysqli_num_rows($res) < 1) {
                    $output .= "

                    <tr>
                        <td class='text-center' colspan='9'>No Appointments Yet.</td>

                    </tr>

                    ";
                }

                



                while($row =mysqli_fetch_array($res)){
                    $id = $row['id'];
                    $date = $row['appointment_date'];
                    $day = date('l', strtotime($date));

                    $classbtndis= "";   
                    if($row['status'] == "Discharged") {
                        $classbtndis = "disabled";
                    }

                    $output .= "

                    <tr>
                        <td>".$row['id']."</td>
                        <td>".$row['petname']."</td>
                        <td>".$row['gender']."</td>
                        <td>".$row['phone']."</td>
                        <td>".$row['appointment_date']."</td>
                        <td>".$day."</td>
                        <td>".$row['symptoms']."</td>
                        <td>".$row['date_booked']."</td>
                        <td>".$row['status']."</td>
                        <td class='text-center'>

                            <a href='appointment?id=$id' class='btn $classbtndis'>
                             <button id='$id' class='btn btn-danger remove' >Cancel</button>
                             </a>

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

                     $query = "DELETE FROM appointment WHERE id='$id'";
                    mysqli_query($connect,$query);
                    header("Location: appointment.php");
                    ob_enf_fluch();
                }

                 ?>
            </div>
 			</div>


 		</div>
 	</div>
 </div>

</body>
</html>