<?php
/*
* Error Location
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

?>

<!DOCTYPE html>
<html class="" lang="en-US">
<head>

	<title>Error Location</title>

<?php

	require_once "includes/head_include.php";

?>

</head>
<body>

	<div class="container">
		<h1>Tarlac Cathedral Online Reservation and Scheduling</h1>
		<h2 class="error-message">Error Location</h2>
	</div>


<?php

	require_once "includes/footer.php";

?>