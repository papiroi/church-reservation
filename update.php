<?php
/*
* Update User Detail Page
* 
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
?>


<!DOCTYPE html>
<html class="full" lang="en-US">
<head>
	<title>Update User Detail - Tarlac Cathedral Online Reservation and Scheduling</title>

<?php

	require_once "includes/head_include.php";

?>
	
	<!-- Custom CSS for Background Image for this page -->
	<link rel="stylesheet" href="css/background-image.css" />
	

	<script>
		$(function() {
			$("#birthday").datepicker({ maxDate: -6570, changeYear: true, changeMonth: true });
		});
	</script>

</head>
<body>
	
	<div class="container">
	
		<h1 class="text-center white-text">Tarlac Cathedral Online Reservation and Scheduling</h1>
		
<!-- Start of Navigation Bar -->
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
<!-- End of Navigation Bar -->
		
<!--
Condition: If there is no user login 
Display the right options
-->
<?php
	
	if(isset($_SESSION['username']) && !empty($_SESSION['username'])) {

		// Display the update user detail form;
		require_once "includes/display_update_user_details.php";
	
	}
	else {
	
		// Display the login first PHP script
		require_once "includes/display_login_first.php";
	
	}

?>

	</div>

<?php

	require_once "includes/footer.php";
	
?>
