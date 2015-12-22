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
<html class="" lang="en-US">
<head>
	<title>Admin Panel</title>

<?php
	
	include "includes/head_include.php";

?>

</head>
<body>
	<div class="container">

		<h1>Admin Pannel</h1>

		<div class="admin-menu">
			
			<ul>
				<li><a href="#">Reservations</a></li>
				<li><a href="#">Schedules</a></li>
				<li><a href="#">Users Chat</a></li>
				<li><a href="edit_announcement.php">Edit Announcement - OK</a></li>
				<li><a href="#">Password Request</a></li>

			</ul>


		</div>

	</div>


<?php

	require "includes/footer.php";

?>