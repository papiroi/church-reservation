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

		if($username == 'admin') {

			header('Location: admin/index.php');

		}
		
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
	
	
	if(isset($_POST['event']) && !empty($_POST['event'])) {
		
		$event = $_POST['event'];
		$edate = $_POST['edate'];
		$priest = $_POST['priest'];
		$etime = $_POST['etime'];
		
	}

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
			//alert('ok');
			$("#bap-type").hide();
			$("#dateselect2").hide();
			$("#dateselect3").hide();
			$("#timeselect2").hide();
			$("#dateselect4").hide();
			
			
			$("#eventtype").click(function(){
				if(document.getElementById('eventtype').value == 'Baptism') {
					$("#bap-type").show();
				}
				else {
					$("#bap-type").hide();
					$("#timeselect").show(100);
					$("#lbltimeselect").show(100);
					$("#lblpriest").show(100);
					$("#priest").show(100);
					$("#dateselect4").hide();
				}
				
				if(document.getElementById('eventtype').value == 'Confirmation') {
				
					$("#dateselect2").show();
					$("#dateselect3").hide();
					$("#dateselect4").hide();
					$("#dateselect").hide();
					$("#lblpriest").hide();
					$("#priest").hide();
					$("#lbltimeselect").hide();
					$("#timeselect").hide(1);
					$("#timeselect2").hide();
					
				}
				else if(document.getElementById('eventtype').value == 'For Confirmation') {
				
					$("#dateselect2").hide();
					$("#dateselect3").show();
					$("#dateselect4").hide();
					$("#dateselect").hide();
					$("#lblpriest").hide();
					$("#priest").hide();
			
				}
				else if(document.getElementById('eventtype').value == 'For Wedding') {
				
					$("#dateselect2").hide();
					$("#dateselect3").show();
					$("#dateselect4").hide();
					$("#dateselect").hide();
					$("#lblpriest").hide();
					$("#priest").hide();
			
				}
				else if(document.getElementById('eventtype').value == 'Wedding') {

					$("#dateselect2").hide();
					$("#dateselect3").hide();
					$("#dateselect4").show();
					$("#dateselect").hide();

				}
				else {
				
					$("#dateselect2").hide();
					$("#dateselect3").hide();
					$("#dateselect").show();
				
				}
				
				if(document.getElementById('eventtype').value == 'Wedding') {
				
					$("#timeselect2").show();
					$("#timeselect").hide()
				}
				else {
				
					$("#timeselect2").hide();
					$("#timeselect").show()
				
				}
				
				if(document.getElementById('eventtype').value == 'For Wedding') {
				
					$("#timeselect2").hide();
					$("#timeselect").hide()
					$("#lbltimeselect").hide()
				}

				
				if(document.getElementById('eventtype').value == 'For Confirmation') {
				
					$("#timeselect2").hide();
					$("#timeselect").hide()
					$("#lbltimeselect").hide()
				}

				
			});
			
			
			$("#bap-type").click(function(){
				if(document.getElementById('bap-type').value == 'Ordinary') {
					$("#timeselect").hide(100);
					$("#lbltimeselect").hide(100);
					$("#lblpriest").hide(100);
					$("#priest").hide(100);
					$("#dateselect4").hide();
				}
			});
			
			
			$("#bap-type").click(function(){
				if(document.getElementById('bap-type').value == 'Special') {
					$("#timeselect").show(100);
					$("#lbltimeselect").show(100);
					$("#lblpriest").show(100);
					$("#priest").show(100);
				}
			});
		
			$(function() {
				$("#dateselect" ).datepicker({minDate: 3, maxDate: 60});
			});

			$(function() {
				$("#dateselect4" ).datepicker({minDate: 60});
			});
		
		
		});
		
		// condition to select only thursday in selecting confirmation
	
			$(function() {
				$("#dateselect2").datepicker({minDate: 3, maxDate: 60, beforeShowDay:DisableThursday});
			});
		
			
		// condition to select only saturdays in selecting seminars
		$(function() {
				$("#dateselect3").datepicker({minDate: 3, maxDate: 60, beforeShowDay:DisableSaturday});
		});
		
		
		
		function DisableThursday(date) {
		
			var day = date.getDay();
			// If day == 1 then it is MOnday
			if (day == 4) {
			 
				return [true] ; 
			 
			}
			else { 
			 
				return [false] ;
			
			}
		}
		
		
		function DisableSaturday(date) {
		
			var day = date.getDay();
			// If day == 1 then it is MOnday
			if (day == 6) {
			 
				return [true] ; 
			 
			}
			else { 
			 
				return [false] ;
			
			}
		}
		
		  
		/*
		 $(function() {
			$( "#datepicker" ).datepicker({
				beforeShowDay: DisableMonday
			});
		 });
		 */
		 
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