<?php
/*
* About Page
* 
*/


/*
* This part of the script will set a session varaible for security purposes
* To avoid direct scripting
*/
	session_start();
	
	$_SESSION['code'] = 1;
	

/*
* Condition to check if there's a logined user
*
*/
	if(isset($_SESSION['username']) && !empty($_SESSION['username'])) {
		
		//$username = $_SESSION['username'];
		
	}
	else {
		
		$username = 'Guest';
		header('Location: index.php');
		
	}
?>

<!DOCTYPE html>
<html class="full" lang="en-US">
<head>

	<title>Print - Scheduling and Reservation System for Tarlac San Sebastian Cathedral Parish</title>
	
<?php

	require_once "includes/head_include.php";

?>

	
	<!-- Custom CSS for Background Image for this page -->
	<link rel="stylesheet" href="css/background-image.css" />
	
	<link rel="stylesheet" href="css/print.css" media="print" />
	
	
</head>
<body onload="window.print()">

	<div class="container">
	
		<h4 class="text-center white-text">Scheduling and Reservation System for Tarlac San Sebastian Cathedral Parish</h4>
		<div class="print-div">
		<table class="table table-bordered">
			<tr>
				<th>Reservation Number</th>
				<th>Event</th>
				<th>Date</th>
				<th>Time</th>
				<th>User</th>
			</tr>
		<!-- Start of Print -->
			<?php
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
			$val = "8:30am";
		}
		else if ($val == 3) {
			$val = "9:00am";
		}
		else if ($val == 4) {
			$val = "9:30am";
		}
		else if ($val == 5) {
			$val = "10:00am";
		}
		else if ($val == 6) {
			$val = "10:30am";
		}
		else if ($val ==7) {
			$val = "11:00am";
		}
		else if ($val == 8) {
			$val = "11:30am";
		}
		else if ($val == 9) {
			$val = "12:00pm";
		}
		else if ($val == 10) {
			$val = "1:00pm";
		}
		else if ($val == 11) {
			$val = "1:30pm";
		}
		else if ($val == 12) {
			$val = "2:00pm";
		}
		else if ($val == 13) {
			$val = "2:30pm";
		}
		else if ($val == 14) {
			$val = "3:00pm";
		}
		else if ($val == 15) {
			$val = "3:30pm";
		}
		else if ($val == 16) {
			$val = "4:00pm";
		}
		else if ($val == 17) {
			$val = "4:30pm";
		}
		else if ($val == 18) {
			$val = "5:00pm";
		}
		
		return $val;
		
	}
				include "includes/connect.php";
			
				if(isset($_GET['r']) && !empty($_GET['r'])) {
					
					$reserve_n = $_GET['r'];
					
					$reserve_q = "SELECT * FROM reservation WHERE reserv_num = '$reserve_n'";
					
					$select_reserve_q = $conn->query($reserve_q);
					
					if($select_reserve_q->num_rows > 0) {
						
						while ($row = $select_reserve_q->fetch_assoc()) {
							
							echo "<tr>";
							echo "<td>" . $row['reserv_num'] . "</td>";
							echo "<td>" . $row['event_type'] . "</td>";
							echo "<td>" . dateName($row['reserv_date']) . "</td>";
							echo "<td>" . num_to_time($row['reserv_time']) . "</td>";
							echo "<td>" . $row['username'] . "</td>";
							echo "</tr>";
		
							
						}
						
					}
					
					
					
				}
				else {
					
					echo "<h1>SQL Query Error!</h1>";
					
				}
			
			?>
		<!-- End of Print -->
		</table>
		</div>
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


	include "includes/include_contacts.php";
	
	require_once "includes/footer.php";

?>