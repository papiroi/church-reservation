<?php
/*
* Services Offered Page
* 
*/


/*
* This part of the script will set a session varaible for security purposes
* To avoid direct scripting
*/
	session_start();
	
	$_SESSION['code'] = 1;
	

	require_once "includes/connect.php";
/*
* Condition to check if there's a logined user
*
*/
	if(isset($_SESSION['username']) && !empty($_SESSION['username'])) {
		
		$username = $_SESSION['username'];

		if($username == 'admin') {

			header('Location: admin/index.php');

		}
		
	}
	else {
		
		$username = 'Guest';
		
	}
?>

<!DOCTYPE html>
<html class="full" lang="en-US">
<head>

	<title>Services - Scheduling and Reservation System for Tarlac San Sebastian Cathedral Parish</title>
	
<?php

	require_once "includes/head_include.php";

?>
	
	<!-- Custom CSS for Background Image for this page -->
	<link rel="stylesheet" href="css/background-image.css" />

</head>
<body>


	<div class="container">

		<h1 class="text-center white-text">Scheduling and Reservation System for Tarlac San Sebastian Cathedral Parish</h1>

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
<!-- End of Navigation -->

		<div class="row">
			<div class="col-md-12">
			
				<!-- Form Goes Here
				<div class="center-div">
				
				
				</div>
				-->
			
				<div class="center-div">
					<?php
						/*
						* Shows the right Services clicke on the user menu
						*
						*/
						$services = $_GET['services'];
						if($services == 'baptism') {
							
							include "includes/baptism_services.php";
							
						}
						else if($services == 'confirmation') {
							
							include "includes/confirmation_services.php";
							
						}
						else if($services == 'funeral') {
							
							include "includes/funeral_services.php";
							
						}
						else if($services == 'forconfirmation') {
							
							include "includes/forconfirmation_services.php";
							
						}
						else if($services == 'forwedding') {
							
							include "includes/forwedding_services.php";
							
						}
						else if($services == 'wedding') {
							
							include "includes/wedding_services.php";
							
						}
						else {
							
							$cat = $_GET['services'];
							$select_event = "SELECT * FROM events WHERE eventID = '$cat'";
							$select_event_query = $conn->query($select_event);
							
							while($e_row = $select_event_query->fetch_assoc()) {
								
								echo "<h1 class='white-text'>" . $e_row['name'] . "</h1>";
								echo "<div class='row'>";
								echo "<div class='col-md-6'>";
								echo "<div class='boxed'>";
								echo "<p class='white-text'>" . $e_row['description'] . "</p>";
								echo "</div>";
								echo "</div>";
								echo "<div class='col-md-6'>";
								echo "<div class='boxed'>";
								echo "<p class='white-text'>" . $e_row['reminder'] . "</p>";
								echo "</div>";
								echo "</div>";
								echo "</div>";
								
							}
							
							
						}
					
					?>
				</div>

			</div>
		</div>
	</div>

<?php

	include "includes/include_contacts.php";


	require_once "includes/footer.php";

?>