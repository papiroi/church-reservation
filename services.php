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
<html class="services-full" lang="en-US">
<head>

	<title>Services - Tarlac Cathedral Online Reservation and Scheduling</title>
	
<?php

	require_once "includes/head_include.php";

?>

	<!-- Custome Background for Services Offered Page -->
	<link rel="stylesheet" href="css/services-background-image.css" />

</head>
<body>
	<div class="container">

<!-- Start of PHP Code for username display -->
		<span class="white-text">
		Welcome <?php echo $username; ?>!!!
			<?php 
			
				if($username != 'Guest') { 
					echo "<a href='?s=logout' id='logout'>Logout</a>"; 

					if(isset($_GET['s']) && $_GET['s'] == 'logout') {

						session_destroy();
						
						header("Location: services.php");
						
					}
				}
			?>
		</span>

	
	
	
		<h1 class="text-center white-text">Tarlac Cathedral Online Reservation and Scheduling</h1>
		<h2 class="white-text">Services Offered:</h2>
		
		<div class="row">
			<div class="col-md-12">
				<div class="center-div">
					<h3>Scheduling</h3>
					<h3>Rervations</h3>
					<h3>Event Setup</h3>
					<h3>Sunday Mass</h3>
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