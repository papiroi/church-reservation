<?php
	if(! isset($_SESSION['code'])) {

		exit("Direct Script Not Allowed!");

	}

/*
* Head Include
* This file includes all common includes in head section of every 
* Page in the website
*/

?>

	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="Scheduling and Reservation System for Tarlac San Sebastian
		Cathedral Parish" />
	
	<!-- Bootstrap 3.2.0 Framework -->
	<link rel="stylesheet" href="css/bootstrap.css" />
	
	<!-- This is the Custom CSS to be use in the entire website -->
	<link rel="stylesheet"  href="css/custom.css" />
	
	<!-- LESS -->
	<link rel="stylesheet" href="css/less.css" />
	
	<!-- jQuery - Needs at the head part of the hmtl document -->
    <script src="js/jquery.js"></script>
	
	<!-- jQuery Datepicker -->
	<link rel="stylesheet" href="css/jquery-ui2.css">
	<script src="js/jquery-ui.js"></script>
	
	<!-- Up When Online CDN Server
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<link rel="stylesheet" href="/resources/demos/style.css">
	-->
	
	<!-- Register Validation JS File -->
	<script src="js/register_validation.js"></script>
	
	<!-- ShowEvent Functin in Reservation Form -->
	<script src="js/function.js"></script>
	
	<!-- Save to Draft Message -->
	<script src="js/saveToDraft.js"></script>
	
	
	<!-- Include the calendar functions -->
	<script src="js/calendarMonth.js"></script>