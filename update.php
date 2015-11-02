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
<html class="register-full" lang="en-US">
<head>
	<title>Update User Detail - Tarlac Cathedral Online Reservation and Scheduling</title>

<?php

	require_once "includes/head_include.php";

?>
	
	<link rel="stylesheet" href="css/register-background-image.css" />

</head>
<body>
	
	<div class="container">
	
		<h1 class="text-center white-text">Tarlac Cathedral Online Reservation and Scheduling</h1>
		<h2 class="white-text">Update User Details</h2>
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
