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
		
	}
	else {
		
		$username = 'Guest';
		
	}
?>

<!DOCTYPE html>
<html class="full-login" lang="en-US">
<head>

	<title>Change Password</title>
	
<!-- Head Include -->
<?php

	require_once "includes/head_include.php";

?>

	<!-- Background CSS for This Page -->
	<link rel="stylesheet" href="css/login-background-image.css" />
	
</head>
<body>
	<div class="container">
		<h1 class="text-center white-text">Tarlac Cathedral Online Reservation and Scheduling</h1>
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