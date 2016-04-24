<?php
/*
* Start of Tarlac Cathedral Online Reservation and Scheduling
* View Schedules and Reservations 
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
*  
*/

	include "includes/connect.php";

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
	<title>View Schedules and Reservation</title>

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

		<div class="center-div">
		<h2 class="white-text">Confirmed Reservations</h2>
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
	$select_all_reserv = "SELECT * FROM reservation WHERE confirmation = 'Confirmed' AND reserv_date >= CURRENT_DATE() ORDER BY reserv_date, reserv_time ASC";
	$select_query_result = $conn->query($select_all_reserv);
	
	if($select_query_result -> num_rows > 0) {
		
		//echo "There is a reservation.";
		echo "<table class='table'>";
		echo "<tr>";
		echo "<th>Reservation No.</th>";
		echo "<th>Reserve Event</th>";
		echo "<th>Date</th>";
		echo "<th>Time</th>";
		echo "<th>Status</th>";
		echo "<th>User</th>";
		echo "<th class=''>Operation</th>";
		echo "</tr>";
		while($row = $select_query_result->fetch_assoc()) {
			echo "<tr>";
			echo "<td>" . $row['reserv_num'] . "<input type='hidden' name='reserv_num' value='" . $row['reserv_num'] . "'/></td>";
			echo "<td>" . $row['event_type'] . "</td>";
			echo "<td>" . dateName($row['reserv_date']) . "</td>";
			echo "<td>" . num_to_time($row['reserv_time']) . "</td>";
			echo "<td>" . $row['status'] . "</td>";
			echo "<td>" . $row['username'] . "</td>";
			echo "<td>";
			echo "<form action='del_reserv.php' method='post'>";
			echo "<input type='hidden' name='id' value='" . $row['reserv_num'] . "' />";
			echo "<input type='submit' value='Delete Reservation' class='btn btn-danger'/>";
			echo "</form>";
			echo "</td>";
			
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

	require "includes/footer.php";

?>