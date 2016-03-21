<?php
/*
* Start of Tarlac Cathedral Online Reservation and Scheduling
* Index for Admin Page
*/

/*
* This part of the script will set a session varaible for security purposes
* To avoid direct scripting
*/
	session_start();
	
	$_SESSION['code'] = 1;


/*
* Include the basepath file
* in the constant BASE
*/
	include "basepath.php";


/*
* Page redirection part to login if the admin is not logged in
* 
*/
	if(isset($_SESSION['username']) && !empty($_SESSION['username'])) {
		
		if($_SESSION['username'] != 'admin') {

			header ("Location: error_location.php");

		}	
		else {
			// Nothing to do here
		}

	}
	else {

		header ("Location: login.php");

	}


?>


<!DOCTYPE html>
<html class="full" lang="en-US">
<head>
	<title>Admin Panel</title>

<?php
	
	include "includes/head_include.php";

?>

	<!-- Custome Background for Services Offered Page -->
	<link rel="stylesheet" href="../css/background-image.css" />

</head>
<body>
	<div class="container">

		<h1 class="white-text">Admin Pannel: Report</h1>

		<?php
			if(isset($_GET['s']) && $_GET['s'] == 'logout') {
			
			session_destroy();
			
			if($conn) {
				$conn->close();
			}
			
			header("Location: " . $_SERVER['PHP_SELF']);
			
			}
		
			// Include the nav bar for Admin
			require_once "includes/menu.php";
		
		?>
		<div class="row">
			
			<div class="col-md-12">
			<div class="center-div">
				<div style="width: 50%; margin: 0px auto;">
				<form action="report_gen.php" method="post" target="_blank">
				<h2>Select Year and Month</h2>
				
				<select id="month" name="month" class="form-control" required>
					<option value="">Select Month</option>
					<option value="1">January</option>
					<option value="2">February</option>
					<option value="3">March</option>
					<option value="4">April</option>
					<option value="5">May</option>
					<option value="6">June</option>
					<option value="7">July</option>
					<option value="8">August</option>
					<option value="9">September</option>
					<option value="10">October</option>
					<option value="11">November</option>
					<option value="12">December</option>
				</select>
				<br/>
				<select id="year" name="year" class="form-control" required>
					<option value="">Select Year</option>
					<?php
						$year_now = date('Y');
						$year_end = '2015';
						
						for($i = $year_now; $i >= $year_end; $i--) {
							
							echo "<option value='$i'>$i</option>";
						
						}
						
						
					?>
				</select>
				<br/>
				<input type="submit" value="Generate Report" class="btn btn-primary"/>
				</form>
				</div>
				<?php
				
				
				
				// Function that converts php date to word
				function dateName($date) {
					
					$result = "";
					
					$convert_date = strtotime($date);
					$month = date('F',$convert_date);
					$year = date('Y',$convert_date);
					$name_day = date('l',$convert_date);
					$day = date('j',$convert_date);
					
					
					$result = $month . " " . $day . ", " . $year . " - " . $name_day;
					
					return $result;
				}
				
				/*
* Function to convert Number values of Time to Time Slots
* Calling this function to convert certain values to time value
* num_to_time()
*/
	
	function num_to_time($val) {
		
		if($val == 1) {
			$val = "8:00am";
		}
		else if ($val == 2) {
			$val = "9:00am";
		}
		else if ($val == 3) {
			$val = "10:00am";
		}
		else if ($val == 4) {
			$val = "11:00am";
		}
		else if ($val == 5) {
			$val = "12:00pm";
		}
		else if ($val == 6) {
			$val = "1:00pm";
		}
		else if ($val ==7) {
			$val = "2:00pm";
		}
		else if ($val == 8) {
			$val = "3:00pm";
		}
		else if ($val == 9) {
			$val = "4:00pm";
		}
		else if ($val == 10) {
			$val = "5:00pm";
		}
		
		return $val;
		
	}
				?>
			
			</div>
			</div>
		</div>
	</div>


<?php

	require "includes/footer.php";

?>