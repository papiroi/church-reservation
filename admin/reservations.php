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

		<h1 class="white-text">Admin Pannel: View Schedules</h1>
		
		
		<a href="?s=logout" id="logout"><span class="link-text">Logout</span></a>

		<?php
			if(isset($_GET['s']) && $_GET['s'] == 'logout') {
			
			session_destroy();
			
			if($conn) {
				$conn->close();
			}
			
			header("Location: " . $_SERVER['PHP_SELF']);
			
			}
		?>

		<div class="container">
			
<?php

	$select_all_reserv = "SELECT * FROM reservation WHERE username";
	$select_query_result = $conn->query($select_all_reserv);
	
	if($select_query_result -> num_rows > 0) {
		
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
			echo "<td>" . $row['reserv_num'] . "</td>";
			echo "<td>" . $row['event_type'] . "</td>";
			echo "<td>" . $row['reserv_date'] . "</td>";
			echo "<td>" . $row['reserv_time'] . "</td>";
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

	require "includes/footer.php";

?>