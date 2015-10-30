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
<html class="about-full" lang="en-US">
<head>

	<title>About - Tarlac Cathedral Online Reservation and Scheduling</title>
	
<?php

	require_once "includes/head_include.php";

?>

	<!-- Custome Background for Services Offered Page -->
	<link rel="stylesheet" href="css/about-background-image.css" />
	
	
</head>
<body>
	<div class="container">

<!-- Start of PHP Code for username display -->
		<span class="white-text">
		Welcome <?php echo $username; ?>!!!
			<?php require_once "includes/user_account_link.php"; ?>
		</span>

	
		<h1 class="text-center white-text">Tarlac Cathedral Online Reservation and Scheduling</h1>
		<h2 class="white-text">About this website:</h2>
			
			<div class="row">
				<div class="col-md-12">
					<div class="center-div">
						<h3 class="white-text">Tarlac Cathedral Online Reservation and Scheduling.</h3>
						<p class="white-text">
						An online system for Reservation and Scheduling of Events on the Cathedral.
						Including events like Wedding etc...
						</p>
					</div>
				</div>
			</div>
		</div>
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



<?php

	require_once "includes/footer.php";

?>