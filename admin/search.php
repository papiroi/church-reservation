<?php
	//error_reporting(0);
/*
* Start of Tarlac Cathedral Online Reservation and Scheduling
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

		<h1 class="white-text">Admin Pannel: Search Reservation</h1>
		
		
		

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
			
			<div class="col-md-3">
			<div class="center-div" width="200px">
			
			<h2 class="white-text">Search Reservation</h2>
			
			<form action="" method="post" autocomplete="off">
			<label>Enter Reservation Number:</label>
			<input type="text" id="res_num" name="res_num" class="form-control" placeholder="Enter Reservation Number..." required autofocus/>
			<br/>
			<input type="submit" value="Search" class="btn btn-primary" />
			&nbsp;&nbsp;&nbsp;
			<a href="confirmed_reserve.php" class="btn btn-info">Back</a>
			</form>
			</div>
			</div>
			<div class="col-md-9">
			<div class="center-div">
<?php
			if(isset($_POST['res_num']) && !empty($_POST['res_num'])) {
				
				$rn = $_POST['res_num'];
				
				$select = "SELECT * FROM reservation WHERE reserv_num = '$rn'";
				$select_query = $conn->query($select);
				
				if($select_query -> num_rows > 0) {
					echo "<h2 class='white-text'>Matching Result: " . $select_query->num_rows . "</h2>";
					echo "<table class='table'>";
					echo "<tr>";
					echo "<th>Reservation No.</th>";
					echo "<th>Event</th>";
					echo "<th>Date</th>";
					echo "<th>Time</th>";
					echo "<th>Status</th>";
					echo "<th>Confirmation</th>";
					echo "<th>User</th>";
					echo "<th>Opt.</th>";
					echo "</tr>";
					while($r = $select_query -> fetch_assoc()) {
						
						echo "<tr>";
						echo "<td>" . $r['reserv_num'] . "</td>";
						echo "<td>" . $r['event_type'] . "</td>";
						echo "<td>" . dateName($r['reserv_date']) . "</td>";
						echo "<td>" . num_to_time($r['reserv_time']) . "</td>";
						echo "<td>" . $r['status'] . "</td>";
						echo "<td>" . $r['confirmation'] . "</td>";
						echo "<td>" . $r['username'] . "</td>";
						echo "<td>";
						echo "<form action='del_search.php' method='post'>";
						echo "<input type='hidden' name='id' value='" . $r['reserv_num'] . "' />";
						echo "<input type='submit' value='Delete' class='btn btn-danger'/>";
						echo "</form>";
						echo "</td>";
						echo "</tr>";
					}
					
					echo "</table>";
					
				}
				else {
					echo "<h2 class='white-text text-center'>No Matching Reservation Found!</h2>";
				}
				
			}
			else {
				
				echo "<h2 class='white-text'>Result Here</h2>";
				
			}
			
?>		
			</div>
			</div>
<?php
				
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


<?php

	require "includes/footer.php";

?>