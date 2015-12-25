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

?>
<!DOCTYPE html>
<html lang="en-US">
<head>
	<title>Reservation Page - Tarlac Cathedral Online Scheduling and Reservation</title>
	
	<?php
	
		// Head Include
		include_once "includes/head_include.php";

	?>
</head>
<body>
	
	<div class="container">

		<h1>Tarlac Cathedral</h1>
		
	
	</div>


<?php


	require_once "includes/footer.php";
	
	
?>