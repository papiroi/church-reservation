<?php
/*
* Start of Tarlac Cathedral Online Reservation and Scheduling
* 
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
	<title>Events Panel</title>

<?php
	
	include "includes/head_include.php";

?>

	<!-- Custome Background for Services Offered Page -->
	<link rel="stylesheet" href="../css/background-image.css" />

</head>
<body>
	<div class="container">

		<h1 class="white-text">Admin Pannel: Events Lists</h1>
		
		
		

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
			<div class="center-div">
				<h2 class="white-text">Edit Events</h2>
				
				<table class="table">
					<th>Name</th>
					<th>Code</th>
					<th>Options</th>
				<?php
					$select_events = "SELECT * FROM events ORDER BY name ASC";
					$select_events_query = $conn->query($select_events);
					
					if($select_events_query -> num_rows > 0) {
					
						while($e_row = $select_events_query -> fetch_assoc()) {
							
							echo "<tr>";
							echo "<td>" . $e_row['name'] . "</td>";
							echo "<td>" . $e_row['code'] . "</td>";
							echo "<td>";
							
							echo "<form action='e_update.php' method='post'>";
							echo "<input type='hidden' name='id' value='" . $e_row['eventID'] . "'/>";
							echo "<input type='submit' value='Edit' class='btn btn-primary'/>";
							echo "</form>";
							echo "</td>";
							
							echo "</tr>";
						
						}
					
					}
					else {
					
						echo "<h3 class='white-text'>NO Available Priest</h3>";
					
					}
				
				?>
				</table>
				
			</div>
			</div>
		</div>
	</div>


<?php

	require "includes/footer.php";

?>