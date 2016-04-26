<?php
/*
* Change Password Page
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

	<title>Change Password - Scheduling and Reservation System for Tarlac San Sebastian Cathedral Parish</title>
	
<!-- Head Include -->
<?php

	require_once "includes/head_include.php";

?>

	
	<!-- Custom CSS for Background Image for this page -->
	<link rel="stylesheet" href="css/background-image.css" />
	
</head>
<body>
	<div class="container">
		<h1 class="text-center white-text">Scheduling and Reservation System for Tarlac San Sebastian Cathedral Parish</h1>
<!--
Condition: If there is no user login 
Display the right options
-->
<?php
	
	if(isset($_SESSION['username']) && !empty($_SESSION['username'])) {

		// Display the change password PHP script
		require_once "includes/display_change_password.php";
	
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