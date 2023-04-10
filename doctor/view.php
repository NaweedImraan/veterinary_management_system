<?php 
session_start();

 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>View Pet Details</title>
</head>
<body>

	<?php 
	include("../include/header.php");
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
	 				<h4 class="text-center my-5">View Pet Details</h4>

	 <?php 
	 $row=null;
	 if (isset($_GET['id'])) {
	 	$id = $_GET['id'];

	 	$query = "SELECT * FROM pet WHERE id='$id'";

	 	$res =mysqli_query($connect,$query);

	 	$row = mysqli_fetch_array($res);

	 					
	 }

	if (isset($_POST['update'])) {
	
	$doctor = $_SESSION['doctor'];
	$pet = $row['username'];
	$age_category = $_POST['age_category'];
	$vaccine_name = $_POST['vaccine_name'];
	$status = "Vaccinated";


	$error=array();

	if($age_category=="") {
		$error['ac'] = "Select Age Category";
	} else if($vaccine_name=="") {
		$error['ac'] = "Select the name of the vaccine";
	} 


	if (count($error) == 0) {
		
		$query = "INSERT INTO vaccine_card(doctor,pet,age_category,vaccine_name,status,date_vaccinated) VALUES('$doctor','$pet','$age_category', '$vaccine_name', '$status',NOW())";

		$res = mysqli_query($connect,$query);

		if ($res) {

			$_SESSION['status'] ="Successfully Vaccinated.!";
			
			header("Location:view.php?id=$id");
			exit(0);
		} else {
			
			$_SESSION['status'] ="Vaccination failed";
			
			header("Location:view.php?id=$id");
			exit(0);
		}
	}
}
$test="";
if (isset($_POST['generate'])) {
	
	

	$doctor = $_SESSION['doctor'];
	$pet = $row['username'];
	
	if (isset($_SESSION['test_name'])){
		$test = $_SESSION['test_name'];
	}


	$recds = mysqli_query($connect, "SELECT * From tests WHERE test_name='$test'");  // Use select 	query here 
							
 	$rec = mysqli_fetch_array($recds);

 	$test_description= $rec['test_description'];
 	$test_results=$_POST['test_results'];


	$error=array();

	if($test=="") {
		$error['ac'] = "Select a Test";
	}


	if (count($error) == 0) {
		
		$query = "INSERT INTO test_results(doctor,pet,test_name,test_description,test_results,tested_date) VALUES('$doctor','$pet','$test', '$test_description', '$test_results',NOW())";

		$res = mysqli_query($connect,$query);

		if ($res) {

			echo "Successfully Uploaded Test results.!";
			
			header("Location:view.php?id=$id");
			exit(0);
		} else {
			
			echo "Uploading failed";
			
			header("Location:view.php?id=$id");
			exit(0);
		}
	}
}

 ?>

	 				 <div class="col-md-12">
	 				 	<div class="row">
	 				 		<div class="col-md-5">
	 				 			<?php 

	 				 			echo "<img src='../pet/img/".$row['profile']."' class='col-md-12 my-2' style='height: 350px; height: 350px;'>";

	 				 			 ?>
	 				 		</div>
	 				 		<div class="col-md-6">
	 				 			

	 				 			<table class="table table-bordered">
	 				 				<tr>
	 				 					<th class="text-center" colspan="2">Details</th>
	 				 				</tr>
	 				 				<tr>
	 				 					<td>Pet Name</td>
	 				 					<td><?php echo $row['petname']; ?></td>
	 				 				</tr>
	 				 				<tr>
	 				 					<td>Owner's Name</td>
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
	 				 					<td><?php echo $row['phone']; ?></td>
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
	 				 					<td>Date Registered</td>
	 				 					<td><?php echo $row['date_reg']; ?></td>
	 				 				</tr>

	 				 			</table>
	 				 		</div>
	 				 		<div class="col-md-5 jumbotron bg-warning bg-gradient " style="margin-top: 30px;">
	 				 			<h4 class="text-center"><b>Vaccine</b></h4 >
							<form method="post">

							<div>
	 				
	 							<?php 
			
 								if (isset($_SESSION['status'])) {
 									?>
 									<div class="alert alert-primary">
 										<h4><?=$_SESSION['status']; ?></h4>
 									</div>
 									<?php 
 									unset($_SESSION['status']);
 								}
			
 								 ?>
	 						</div>

							<div class="form-group">
  								<label>Age Category:</label>
  								<select name="age_category" class="form-control">
  						  			<option disabled selected>-- Select Age Category --</option>
  						  			<?php
  						      			$records = mysqli_query($connect, "SELECT age_category From vaccines");  // Use select 	query here 
							
  						      			while($data = mysqli_fetch_array($records))
  						      			{
  						      			    echo "<option value='". $data['age_category'] ."'>" .$data['age_category'] ."</option>";	  // displaying data 						in option menu
  						      			}	
  						  			?>  
  								</select>
  							</div>

  							<div class="form-group">

								<label>Name of the Vaccine:</label>
  								<select name="vaccine_name" class="form-control">
    								<option disabled selected>-- Select the Name of the Vaccine --</option>
    								<?php
        								$records = mysqli_query($connect, "SELECT vaccine_name From vaccines");  // Use select query here 

        								while($data = mysqli_fetch_array($records))
        								{
        							    echo "<option value='". $data['vaccine_name'] ."'>" .$data['vaccine_name'] ."</option>";  // displaying data in option menu
        								}	
   							 	?>  
  								</select>
  							</div>

  							<input type="submit" name="update" value="Update" class="btn btn-info">

							</form>
							</div>
	 	

	 				 		<div class="col-md-6" style="margin-top: 30px;">
	 				 			

							<table class="table table-bordered">
							   <tr>
							     <td colspan="5" class="text-center"><b>Immunization Details</b></td>
							   </tr>
							  <tr>
							    <td><b>Age Category</b></td>
							    <td><b>Vaccine Name</b></td>
							    <td><b>Status</b></td>
							    <td><b>Date</b></td>
							  </tr>
							
							<?php
							$username = $row['username'];
							
							$records = mysqli_query($connect,"SELECT * FROM vaccine_card WHERE pet='$username' ORDER BY date_vaccinated ASC");
													
							if (mysqli_num_rows($records) < 1) {
							     $output = "
							
							     <tr>
							         <td class='text-center' colspan='5'>No Vaccines Registered Yet.</td>
							
							     </tr>
							
							     ";
							     echo $output;
							 }
							
							while($data = mysqli_fetch_array($records))
							{
							?>
							  <tr>
							    <td><?php echo $data['age_category']; ?></td>
							    <td><?php echo $data['vaccine_name']; ?></td>
							    <td><?php echo $data['status']; ?></td> 
							    <td><?php echo $data['date_vaccinated']; ?></td>    
							    
							     
							  </tr>	
							<?php
							}
							?>
							</table>

	 				 		</div>

	 				 		<div class="col-md-5 jumbotron bg-secondary bg-gradient " style="margin-top: 30px;">
							<form method="post">
							<div>
	 				
	 							<?php 
			
 								if (isset($_SESSION['status'])) {
 									?>
 									<div class="alert alert-primary">
 										<h4><?=$_SESSION['status']; ?></h4>
 									</div>
 									<?php 
 									unset($_SESSION['status']);
 								}
			
 								 ?>
	 						</div>

							<div class="form-group">
								<h4 class="text-center"><b>Test</b></h4 >
								<?php 
								$test_name="";
								if (isset($_POST['test_name'])) {
							 		$test_name=$_POST['test_name'];
							 		$_SESSION['test_name'] = $test_name;
							 	} 

							 	$test_desc = mysqli_query($connect, "SELECT * From tests WHERE test_name='$test_name'");

								 ?>
  								<label>Test Name:</label>
  								<select id="selected_option" onchange="this.form.submit();" name="test_name" class="form-control">
  						  			<option disabled selected><?php 
  						  			if(!empty($test_name)) {
  						  				echo $test_name;
  						  			} else {
  						  				echo "-- Select Test Name --";
  						  			}

  						  			 ?></option>
  						  			<?php
  						      			$records = mysqli_query($connect, "SELECT test_name From tests");  // Use select 	query here 
							
  						      			while($data = mysqli_fetch_array($records))
  						      			{
  						      			    echo "<option value='". $data['test_name'] ."'>" .$data['test_name'] ."</option>";	  // displaying data in option menu
  						      			}	
  						  			?>  
  								</select>
  								

  								<br>

  								<label>Test Interpretation:</label>
                                <textarea id="text_results" class="form-control" style="white-space: pre-line;" name="test_results" rows="10" autocomplete="off">




Reference Values------------------------------------------------

<?php 
                                

                                if (mysqli_num_rows($test_desc) > 0) {
                                $resultt = mysqli_fetch_array($test_desc);
                                	echo $resultt['reference_values'];
                                
                            } else if(mysqli_num_rows($test_desc) < 1) {
                            	echo "PLEASE SELECT A TEST";
                            }

							 	?></textarea>
                            

  							</div>

  							<input type="submit" name="generate" value="Generate" class="btn btn-success">

							</form>

							</div>

							<div class="col-md-7" style="margin-top: 30px;">
	 				 			

							<table class="table table-bordered">
							   <tr>
							     <td colspan="3" class="text-center"><b>Test Report Details</b></td>
							   </tr>
							  <tr>
							    <td><b>Test Name</b></td>
							    <td><b>Test Results</b></td>
							    <td><b>Date</b></td>
							  </tr>
							
							<?php
							$username = $row['username'];
							
							$records = mysqli_query($connect,"SELECT * FROM test_results WHERE pet='$username' ORDER BY tested_date ASC");
													
							if (mysqli_num_rows($records) < 1) {
							     $output = "
							
							     <tr>
							         <td class='text-center' colspan='3'>No Vaccines Registered Yet.</td>
							
							     </tr>
							
							     ";
							     echo $output;
							 }
							
							while($data = mysqli_fetch_array($records))
							{
							?>
							  <tr>
							    <td><?php echo $data['test_name']; ?></td>
							    <td style="white-space: pre-line;"><?php echo $data['test_results']; ?></td>
							    <td><?php echo $data['tested_date']; ?></td>    
							    
							     
							  </tr>	
							<?php
							}
							?>
							</table>

	 				 		</div>
	 				 	</div>
	 				 </div>

	 			</div>
	 		</div>
	 	</div>
	 </div>

</body>
</html>