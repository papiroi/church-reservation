<?php
/*
* Contact Page
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

	<title>Contact - Scheduling and Reservation System for Tarlac San Sebastian Cathedral Parish</title>
	
<?php

	require_once "includes/head_include.php";

?>

	<!-- Custome Background for Services Offered Page -->
	<link rel="stylesheet" href="css/background-image.css"/>

</head>
<body>
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
	<div class="container">

<!-- Start of PHP Code for username display -->
		<span class="white-text">
		Welcome <?php echo $username; ?>!!!
			<?php require_once "includes/user_account_link.php"; ?>
		</span>

	
		<h1 class="text-center white-text">Scheduling and Reservation System for Tarlac San Sebastian Cathedral Parish</h1>
		<h2 class="white-text">Contacts:</h2>
			
			<div class="row">
				<div class="col-md-12">
					<div class="center-div">
						<h3>Mobile Number: 09xx-xxx-xxxx</h3>
						<h3>Landline: (045) xxx-xxxx</h3>
						<h3>Email: xxxxx@gmail.com</h3>
					</div>
				</div>
			
			</div>
		</div>

<?php

	require_once "includes/footer.php";

?>