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
	<meta name="description" content="Tarlac Cathedral Online Reservation and Scheduling System" />
	
	<!-- Bootstrap 3.2.0 Framework -->
	<link rel="stylesheet" href="css/bootstrap.css" />
	
	<!-- This is the Custom CSS to be use in the entire website -->
	<link rel="stylesheet"  href="css/custom-admin.css" />
	
	<!-- LESS -->
	<link rel="stylesheet" href="css/less.css" />
	
	<!-- jQuery - Needs at the head part of the hmtl document -->
    <script src="js/jquery.js"></script>
	
	<!-- Save to Draft Message and Clear message-->
	<script src="js/saveToDraft.js"></script>
	