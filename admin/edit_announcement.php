<?php
/*
* Tarlac Cathedral Online Reservation and Scheduling
* Edit Announcement
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
	<title>Edit Announcement - Admin Panel</title>

<?php
	
	include "includes/head_include.php";

?>

</head>
<body>
	<div class="container">

		<h1>Admin Pannel</h1>

		<h2>Edit Announcement Message</h2>
		
		<a href="index.php" title="Admin Home">Home</a>
		
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
		
			<textarea cols="40" rows="5" placeholder="Enter Announcement Here"><?php 
					// Any Value From the Current Announcement
					
					echo @$announcement;
					
			?></textarea>
			
			<br/>
			
			<input type="submit" value="Save" />
			
			<input type="reset" value="Reset" />
		
		</form>

	</div>


<?php

	require "includes/footer.php";

?>