<?php
	//error_reporting(0);
/*
* Start of St. Augustine Parish Church Online Reservation and Scheduling
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

		<h1 class="white-text">Admin Pannel</h1>
		
		
		

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
			<div class="messages">
			
				<?php
				
				$this_day = date('Y-m-d');
				
				
				// This part displays the inconmming reservation for the current month
				$select_all_reserve = "SELECT * FROM reservation WHERE reserv_date > '$this_day' AND confirmation = 'Confirmed' ORDER BY reserv_date, reserv_time ASC";
				$select_all_reserve_query = $conn->query($select_all_reserve);
				
				echo "<h1 class='white-text'>Incomming Reservations</h1>";
				
				if($select_all_reserve_query->num_rows > 0) {
					
					echo "<table class='table'>";
					echo "<tr>";
					echo "<th>Reservation No.</th>";
					echo "<th>Reserve Event</th>";
					echo "<th>Date</th>";
					echo "<th>Time</th>";
					echo "<th>Status</th>";
					echo "<th>User</th>";
					echo "</tr>";
					while($row_d = $select_all_reserve_query->fetch_assoc()) {
						
						
						// This script will use to select Current Date Event
						/*if(extractDate($row_d['date_reserved']) == $this_day) {
							echo "<tr>";
							echo "<td>" . $row_d['reserv_num'] . "</td>";
							echo "<td>" . $row_d['event_type'] . "</td>";
							echo "<td>" . dateName($row_d['reserv_date']) . "</td>";
							echo "<td>" . num_to_time($row_d['reserv_time']) . "</td>";
							echo "<td>" . $row_d['status'] . "</td>";
							echo "<td>" . $row_d['username'] . "</td>";
							echo "</tr>";
							
						}*/
						
						
						echo "<tr>";
						echo "<td>" . $row_d['reserv_num'] . "</td>";
						echo "<td>" . $row_d['event_type'] . "</td>";
						echo "<td>" . dateName($row_d['reserv_date']) . "</td>";
						echo "<td>" . num_to_time($row_d['reserv_time']) . "</td>";
						echo "<td>" . $row_d['status'] . "</td>";
						echo "<td>" . $row_d['username'] . "</td>";
						echo "</tr>";
						
					}
					
					echo "</table>";
					
				}
				else {
					
					echo "<div class='info-message'>There are no Incomming Reservation .</div>";
					
				}
				
				//function to extract date in datetime format
				function extractDate($datetime) {
					
					$date = date("Y-m-d",strtotime($datetime));
					
					return $date;
					
				}
				
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

	// Change the status of the event that is done
	$change_status = "UPDATE reservation SET status = 'DONE' WHERE reserv_date < CURDATE()";
	$change_status_query = $conn->query($change_status);
	
	// Delete the reservation that is not confirmed in 3 days
	$delete_unconfirmed_reservation = "DELETE FROM reservation WHERE date_reserved < UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL 3 DAY))";
	$dur_query = $conn->query($delete_unconfirmed_reservation);
	
	
	require "includes/footer.php";

?>