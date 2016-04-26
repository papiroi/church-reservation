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
		$username = $_SESSION['username'];
		if($username == 'admin') {

			header('Location: admin/index.php');

		}
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
	<h2 class="white-text">Archive</h2>
	<!--<button class="btn btn-primary" onclick="goBack();">Back</button>-->
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
	
	echo "<em>Past Reservations</em>";
	$select_all_reserv = "SELECT * FROM reservation WHERE username = '$username' AND reserv_date < CURRENT_DATE() ORDER BY reserv_date, reserv_time ASC";
	$select_query_result = $conn->query($select_all_reserv);
	
	if(@$select_query_result -> num_rows > 0) {
		
		//echo "There is a reservation.";
		echo "<table class='table'>";
		echo "<tr>";
		echo "<th>Reservation No.</th>";
		echo "<th>Reserve Event</th>";
		echo "<th>Date</th>";
		echo "<th>Time</th>";
		echo "<th>Status</th>";
		echo "<th>Confirmation</th>";
		echo "</tr>";
		while($row = $select_query_result->fetch_assoc()) {
			
			echo "<tr>";
			if($row['confirmation'] == 'Confirmed')
				echo "<td><a href='print.php?r=" .  $row['reserv_num']. "' target='_blank'>" . $row['reserv_num'] . "</a></td>";
			else 
				echo "<td>" . $row['reserv_num'] . "</td>";
			echo "<td>" . $row['event_type'] . "</td>";
			echo "<td>" . dateName($row['reserv_date']) . "</td>";
			echo "<td>" . num_to_time($row['reserv_time']) . "</td>";
			//set static status as done
			echo "<td>DONE</td>";
			echo "<td>" . $row['confirmation'] . "</td>";
			echo "</tr>";
		
		} 
		echo "</table>";
		
	}
	else {
		
		echo "<h3 class=''>No Reservations Found</h3>";
		
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
	
	
?>	
	</div>
	</div>

<?php

	include "includes/include_contacts.php";
	include "includes/footer.php";
	
?>