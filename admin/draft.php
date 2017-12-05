<?php
/*
* Message Draft Page
* 
*/


/*
* This part of the script will set a session varaible for security purposes
* To avoid direct scripting
*/
	session_start();
	
	$_SESSION['code'] = 1;
	
/*
* include connection string
*/
	include "includes/connect.php";

/*
* Condition to check if there's a logined user
*
*/
	if(isset($_SESSION['username']) && !empty($_SESSION['username'])) {
		
		$username = $_SESSION['username'];
		
	}
	else {
		
		$username = 'Guest';
		header('Location: index.php');
		
	}
?>

<!DOCTYPE html>
<html class="full" lang="en-US">
<head>

	<title>Draft - St. Augustine Parish Church</title>
	
<?php

	require_once "includes/head_include.php";

?>

	
	<!-- Custom CSS for Background Image for this page -->
	<link rel="stylesheet" href="../css/background-image.css" />
	
	
</head>
<body>

	<div class="container">

		<h1 class="white-text">Admin Panel</h1>
<!-- Start of Navigation -->
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
<!--End of Navigation -->

		<div class="messages">
			<h2 class="white-text">Draft Messages</h2>
			<?php
			
				include "includes/show_draft.php";

			?>
		</div>
			
	</div>
<?php


	require_once "includes/footer.php";

?>