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
		// Nothing to do
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
	<title>Gallery - Scheduling and Reservation for Tarlac San Sebastian Cathedral Parish</title>
	
	<?php
		include "includes/head_include.php";
	?>

	<!-- Custom CSS for Background Image for this page -->
	<link rel="stylesheet" href="css/background-image.css" />
</head>
<body>

	<div class="container">
		
		<h1 class="white-text text-center">Gallery Under Construction</h1>
		<a href="index.php" class="white-text">Click Here to go to Home</a>
	
	</div>

<?php

	include "includes/footer.php";
	
?>