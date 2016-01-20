<?php
/*
* Start of Tarlac Cathedral Online Reservation and Scheduling
* Index for Admin Page
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

		<h1 class="white-text">Admin Pannel</h1>
		
		
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

		<div class="admin-menu">
			
			<ul class="no-bullet">
				<li><a href="reservations.php"><h3 class="white-text">View Schedules and Reservations</h3></a></li>
				<li><a href="chat.php"><h3 class="white-text">Chat</h3></a></li>
				<li><a href="edit_announcement.php"><h3 class="white-text">Edit Announcement</h3></a></li>

			</ul>


		</div>

	</div>


<?php

	require "includes/footer.php";

?>