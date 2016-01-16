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
		
		<span class="white-text">
		
			Welcome <?php echo $username; ?>!!!
			<?php require_once "includes/user_account_link.php"; ?>
			
		</span>
		
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
	
	<h2 class="white-text">Reservation Status</h2>
	<!-- Start of Output for Reservation Status -->
	<div class="center-div">
	<br/>
<?php

	$select_all_reserv = "SELECT * FROM reservation WHERE username = '$username'";
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

	include "includes/include_contacts.php";
	include "includes/footer.php";
	
?>