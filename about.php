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

<!-- Start of PHP Code for username display -->
		<span class="white-text">
		Welcome <?php echo $username; ?>!!!
			<?php require_once "includes/user_account_link.php"; ?>
		</span>

	
		<h1 class="text-center white-text">Scheduling and Reservation System for Tarlac San Sebastian Cathedral Parish</h1>
		<h2 class="white-text">About this website:</h2>
			
			<div class="row">
				<div class="col-md-12">
					<div class="center-div">
						<h3 class="white-text">San Sebastian Cathedral Parish</h3>
						<p class="white-text">
						Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
						Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
						when an unknown printer took a galley of type and scrambled it to make a type 
						specimen book. It has survived not only five centuries, but also the leap into 
						electronic typesetting, remaining essentially unchanged. It was popularised in 
						the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, 
						and more recently with desktop publishing software like Aldus PageMaker 
						including versions of Lorem Ipsum.
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