<?php
	//error_reporting(0);


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
		else {
			
			$username = $_SESSION['username'];
			
		}

	}
	else {

		header ("Location: login.php");

	}


?>


<!DOCTYPE html>
<html class="full" lang="en-US">
<head>
	<title>Update Admin Details - Tarlac Cathedral Online Reservation and Scheduling</title>

<?php

	require_once "includes/head_include.php";

?>
	
	<!-- Custom CSS for Background Image for this page -->
	<link rel="stylesheet" href="../css/background-image.css" />

	<!-- jQuery UI for Date Picker -->
	<link rel="stylesheet" href="../css/jquery-ui2.css">
	<script src="../js/jquery-ui.js"></script>
	
	<script>
		$(function() {
			$("#birthday").datepicker({ maxDate: -6570, changeYear: true, changeMonth: true });
		});
	</script>
	
	

</head>
<body>
	
	<div class="container">
	
		<h1 class="white-text">Admin Panel: Update Detials</h1>
		
		<?php
			if(isset($_GET['s']) && $_GET['s'] == 'logout') {
			
			session_destroy();
			
			if($conn) {
				$conn->close();
			}
			
			header("Location: " . $_SERVER['PHP_SELF']);
			
			}
		
			// Include the nav bar for Admin
			require_once "includes/menu.php";
		
		?>
<!-- End of Navigation Bar -->
		
<!--
Condition: If there is no user login 
Display the right options
-->
<?php
	
	if(isset($_SESSION['username']) && !empty($_SESSION['username'])) {

		// Display the update user detail form;
		require_once "includes/display_update_user_details.php";
	
	}
	else {
	
		// Display the login first PHP script
		require_once "includes/display_login_first.php";
	
	}

?>

	</div>

<?php

	require_once "includes/footer.php";
	
?>
