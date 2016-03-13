<?php
/*
* Reservation Page
*/

/*
* This part of the script will set a session varaible for security purposes
* To avoid direct scripting
*/
	session_start();
	
	$_SESSION['code'] = 1;
	
	//Include the connection String
	include "includes/connect.php";
	
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


	$day = $_GET['day'];
	
	$current_month = $_GET['month'];
	$current_year = date("Y");
	
	$date_today = getdate(mktime(0,0,0,$current_month,1,$current_year)); //Returns array of date info for 1st day of this month
	$month_name = $date_today["month"]; //Example: "September" - to label the Calendar
	
	$date_reserved = $current_year . "-" . $current_month . "-" . $day;
	
	$select_date = "SELECT * FROM reservation WHERE reserv_date = '$date_reserved' ORDER BY reserv_time ASC";
	
	$q_select_date = $conn->query($select_date);
	
	echo "<table class='table table-bordered'>";
	echo "<caption class='white-text'><strong>" . $month_name . " " . $day . "," . $current_year . "</strong></caption>";
	echo "<tr>";
	echo "<th>Time</th>";
	echo "<th>Event</th>";
	echo "</tr>";
	if($q_select_date->num_rows > 0) {
		
		while($row = $q_select_date->fetch_assoc()) {
			echo "<tr>";
			echo "<td>" . num_to_time($row['reserv_time']) . "</td>";
			echo "<td>" . $row['event_type'] . "</td>";
			echo "</tr>";
			
			
		}
	}
	else {
		
		echo "No Reservation for this Date.";
		
	}
	echo "</table>";
?>
<br/>
<a href="javascript: void(0)" onclick="window.location.reload()" class="btn btn-primary">Show Calendar</a>
