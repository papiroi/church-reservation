<?php
/*
* Reservation Page
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
		
		$username = $_SESSION['username'];
		
	}
	else {
		header('Location: index.php');
	}
	
	
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

?>
<!DOCTYPE html>
<html class="full" lang="en-US">
<head>
	<title>Reservation Page - Scheduling and Reservation System</title>
	
	<?php
	
		// Head Include
		include_once "includes/head_include.php";

	?>
	
	
	<!-- Custom CSS for Background Image for this page -->
	<link rel="stylesheet" href="css/background-image.css" />
	
</head>
<body>
	
	<div class="container">

		<h1 class="text-center white-text">Scheduling and Reservation System for Tarlac San Sebastian Cathedral Parish</h1>
		
		
		<?php
			
			include "includes/reservation_form.php";
			
		?>
		
	</div>


<?php


	require_once "includes/footer.php";
	
	
?>