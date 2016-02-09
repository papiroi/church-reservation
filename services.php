<?php
/*
* Services Offered Page
* 
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
		
		$username = 'Guest';
		
	}
?>

<!DOCTYPE html>
<html class="full" lang="en-US">
<head>

	<title>Services - Scheduling and Reservation System for Tarlac San Sebastian Cathedral Parish</title>
	
<?php

	require_once "includes/head_include.php";

?>
	
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
?>
<!-- End of Navigation -->
		<h2 class="white-text">Services</h2>
		<div class="row">
			<div class="col-md-12">
			
				<!-- Form Goes Here
				<div class="center-div">
				
				
				</div>
				-->
			
				<div class="center-div">
					<a name="baptism"></a>
					<h3>Baptism</h3>
					<p></p>
					<a name="confirmation"></a>
					<h3>Confirmation</h3>
					<p></p>
					<a name="funeral"></a>
					<h3>Funeral</h3>
					<a name="seminars"></a>
					<h3>Seminars</h3>
					<a name="forconfirmation"></a>
					<p>For Confirmation</p>
					<a name="forwedding"></a>
					<p>For Wedding</p>
					<a name="wedding"></a>
					<h3>Wedding</h3>
					<p></p>
				</div>

			</div>
		</div>
	</div>

<?php

	include "includes/include_contacts.php";


	require_once "includes/footer.php";

?>