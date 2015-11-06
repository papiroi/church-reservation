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
	
	include BASE . "includes/head_include.php";

?>

</head>
<body>


<?php

	require BASE . "includes/footer.php";

?>