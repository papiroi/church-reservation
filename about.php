<?php
/*
* About Page
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

	<title>About - Scheduling and Reservation System for Tarlac San Sebastian Cathedral Parish</title>
	
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
<!--End of Navigation -->
			<h2 class="white-text">About</h2>
			
			<div class="row">
				<div class="col-md-12">
					<div class="center-div">
						
						<?php
							
							$about = $_GET['about'];
							if($about == 'history') {
							
								include_once "includes/about_history.php";
							
							}
							else if ($about == 'diocese') {
							
								include_once "includes/about_diocese.php";
							
							}
							else if($about == 'orgchart') {
							
								include_once "includes/about_org.php";
							
							}
							else if($about == 'masssched') {
							
								include_once "includes/about_masssched.php";
							
							}
							else if($about == 'priestsched') {
							
								include_once "includes/about_priest.php";
							
							}
						
						?>
						
					</div>
				</div>
			</div>
			
			

			
	</div>
		<?php
			include "includes/include_contacts.php";
		?>
<?php

	require_once "includes/footer.php";

?>