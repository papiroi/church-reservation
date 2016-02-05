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
	
	<!-- Register Validation JS File -->
	<script src="js/register_validation.js"></script>

	
	<!-- Date Picker jQuery 
		Start of Zebra Date Picker -->
	<link rel="stylesheet" href="css/datepicker/metallic.css" />
	
	<script src="js/datepicker/zebra_datepicker.js"></script>
	
	<script>
		$(document).ready(function(){
			$("input#bday").Zebra_DatePicker({
				direction: - [false,'1940-01-01']
			});
			$("input#bday").Zebra_DatePicker({
				view: 'years'
			});
		});
	</script>
	<!-- End of Zebra Date Picker -->