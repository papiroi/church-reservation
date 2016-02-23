<?php

/*
* This part of the script will set a session varaible for security purposes
* To avoid direct scripting
*/
	session_start();
	
	$_SESSION['code'] = 1;
	
	

/*
* Check if session username or name of the logged in user isset
* if not Guest User 
*/

	if(isset($_SESSION['username']) && !empty($_SESSION['username'])) {
		$username = $_SESSION['username'];;
	}
	else {
		$username = "Guest";
	}
/*
* Condition to check if there's a logined user
*
*/
	if(isset($_SESSION['username']) && !empty($_SESSION['username'])) {
		// Nothing to do here
	}
	else {
		header('Location: index.php');
	}

/*
* The Connection String
*
*/

	require_once "includes/connect.php";

?>
<!doctype html>
<html class="full" lang="en-US">
<head>
	<title>Reservation Status - Scheduling and Reservation for Tarlac San Sebastian Cathedral Parish</title>
	
	<?php
	
		require "includes/head_include.php";
	?>
	<!-- Custom CSS for Background Image for this page -->
	<link rel="stylesheet" href="css/background-image.css" />
</head>
<body>

	<div class="container">

		
		<h1 class="white-text text-center">Scheduling and Reservation for Tarlac San Sebastian Parish Cathedral</h1>
<!-- Start of Navigation -->
<?php
/*
* This will show navigation bar menu if there is signed in user or not
*
*/

	if(isset($_SESSION['username']) && !empty($_SESSION['username'])) {
		
		require_once "includes/nav_bar_signed_in.php";
	
	}
	else {
	
		require_once "includes/nav_bar_signed_out.php";
	
	}
?>		
<!--End of Navigation -->
	

	<!-- Start of Output for Reservation Status -->
	<div class="center-div">
	<h2 class="white-text">Reservations</h2>
	<button class="btn btn-primary" onclick="goBack();">Back</button>
	<br/>
	<span class="white-text"><i>Click on Reservation Number to Print</i></span>
	<br/>
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

	$select_all_reserv = "SELECT * FROM reservation WHERE username = '$username' ORDER BY reserv_date ASC";
	$select_query_result = $conn->query($select_all_reserv);
	
	if(@$select_query_result -> num_rows > 0) {
		
		//echo "There is a reservation.";
		echo "<table class='table table-bordered'>";
		echo "<tr>";
		echo "<th>Reservation No.</th>";
		echo "<th>Reserve Event</th>";
		echo "<th>Date</th>";
		echo "<th>Time</th>";
		echo "<th>Status</th>";
		echo "<th>User</th>";
		echo "</tr>";
		while($row = $select_query_result->fetch_assoc()) {
			
			echo "<tr>";
			echo "<td><a href='print.php?r=" .  $row['reserv_num']. "' target='_blank'>" . $row['reserv_num'] . "</a></td>";
			echo "<td>" . $row['event_type'] . "</td>";
			echo "<td>" . $row['reserv_date'] . "</td>";
			echo "<td>" . num_to_time($row['reserv_time']) . "</td>";
			echo "<td>" . $row['status'] . "</td>";
			echo "<td>" . $row['username'] . "</td>";
			echo "</tr>";
		
		} 
		echo "</table>";
		
	}
	else {
		
		echo "<h3 class=''>No Reservations Found</h3>";
		
	}
	
?>	
	</div>
	</div>

<?php

	include "includes/include_contacts.php";
	include "includes/footer.php";
	
?>