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
	
	
	
/*
* Include Connection String to Database Server
* 
*/

	include "includes/connect.php";

?>
<!DOCTYPE html>
<html class="full" lang="en-US">
<head>
	<title>Reservation Page - Scheduling and Reservation System</title>
	
	<?php
	
		// Head Include
		include_once "includes/head_include.php";

	?>
	

	<script>
		$(document).ready(function(){
			$("#bap-type").hide();
			
			
			$("#eventtype").click(function(){
				if(document.getElementById('eventtype').value == 'Baptism') {
					$("#bap-type").show();
				}
				else {
					$("#bap-type").hide();
					$("#timeselect").show(100);
					$("#lbltimeselect").show(100);
				}
			});
			
			
			$("#bap-type").click(function(){
				if(document.getElementById('bap-type').value == 'Ordinary') {
					$("#timeselect").hide(100);
					$("#lbltimeselect").hide(100);
				}
			});
			
			
			$("#bap-type").click(function(){
				if(document.getElementById('bap-type').value == 'Special') {
					$("#timeselect").show(100);
					$("#lbltimeselect").show(100);
				}
			});
		});
		
		$(function() {
			$( "#dateselect" ).datepicker({minDate: 3, maxDate: 60});
		});
		
	</script>
	<!-- Custom CSS for Background Image for this page -->
	<link rel="stylesheet" href="css/background-image.css" />
	
</head>
<body>
	
	<div class="container">

		<h1 class="text-center white-text">Scheduling and Reservation System for Tarlac San Sebastian Cathedral Parish</h1>
<!-- Start of Navigation -->
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
	
// End of Navigation -->

	include "includes/reservation_form.php";
?>
		
	</div>


<?php

	include "includes/include_contacts.php";
	require_once "includes/footer.php";
	
	
?>