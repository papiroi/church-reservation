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

	<title>New Password - Scheduling and Reservation System for Tarlac San Sebastian Cathedral Parish</title>
	
<!-- Head Include -->
<?php

	require_once "includes/head_include.php";

?>

	
	<!-- Custom CSS for Background Image for this page -->
	<link rel="stylesheet" href="css/background-image.css" />
	
</head>
<body>
	<div class="container">
		<h1 class="text-center white-text">Password Recovery</h1>

	
	</div>

<?php

	require_once "includes/footer.php";

?>