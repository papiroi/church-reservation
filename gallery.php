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
* The Connection String
*
*/

	require_once "includes/connect.php";

?>
<!doctype html>
<html class="full" lang="en-US">
<head>
	<title>Gallery - Scheduling and Reservation for Tarlac San Sebastian Cathedral Parish</title>

</head>
<body>

	<div class="">
		
		<h1>Gallery Under Construction.</h1>
	
	</div>

<?php

	include "includes/footer.php";
	
?>