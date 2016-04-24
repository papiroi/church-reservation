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
	if(isset($_POST['year']) && !empty($_POST['year'])) {
					
		$year = $_POST['year'];
		$month = $_POST['month'];
		
		
	}
	else {
		header('Location: report.php');
	}
	function yearMonth($year, $month) {
		
		$result = "";
		
		$convert_year = strtotime($year . "-1-1");
		$convert_month = strtotime("2016-" . $month . "-1");
		$month_c = date('F',$convert_month);
		$year_c = date('Y',$convert_year);
		
		
		$result = $month_c . " of " . $year_c;
		
		return $result;
	}
	
	
?>

<!DOCTYPE html>
<html class="full" lang="en-US">
<head>

	<title>Report Generation - Print</title>
	
<?php

	require_once "includes/head_include.php";

?>

	
	<!-- Custom CSS for Background Image for this page -->
	<link rel="stylesheet" href="../css/background-image.css" />
	
	
</head>
<body onload="window.print()">

	<div class="container">
	
		<h4 class="text-center white-text">Report Generation - <?php echo yearMonth($year, $month); ?></h4>
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
				include "includes/connect.php";
			
				if(isset($_POST['year']) && !empty($_POST['year'])) {
					
					$year = $_POST['year'];
					$month = $_POST['month'];
					$event = $_POST['event'];
					
					$record = 0;
					
					for($i = 1; $i <= 31; $i++) {
					
						$gen_date = $year . "-" . $month . "-" . $i;
						
						if($event == '*') {
							$reserve_q = "SELECT * FROM reservation WHERE reserv_date = '$gen_date' ORDER BY reserv_date, reserv_time ASC";
						}
						else {
							$reserve_q = "SELECT * FROM reservation WHERE reserv_date = '$gen_date' and event_type = '$event' ORDER BY reserv_date, reserv_time ASC";
						}
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
			
								$record = $record + 1;
							}
						

						
						}
					
						
					}
					
					echo "<h3 class='white-text'>$record Record(s) Found!</h3>";
					
				}
				else {
					
					echo "<h1 class='white-text'>No Reservaton(s)!</h1>";
					
					echo "<script>alert('No Reservations!');</script>";
					
					header('Location: report.php');
					
				}
			
			?>
		<!-- End of Print -->
		</table>
		<p><i>This is a system generated report.</i></p>
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


	require_once "includes/footer.php";

?>