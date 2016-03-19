<?php
/*
* Message Inbox Page
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
		header('Location: index.php');
		
	}
?>

<!DOCTYPE html>
<html class="full" lang="en-US">
<head>

	<title>Message Inbox - Scheduling and Reservation System for Tarlac San Sebastian Cathedral Parish</title>
	
<?php

	require_once "includes/head_include.php";

?>

	
	<!-- Custom CSS for Background Image for this page -->
	<link rel="stylesheet" href="../css/background-image.css" />
	
	
</head>
<body>

	<div class="container">

		<h1 class=" white-text">Admin Panel</h1>
<!-- Start of Navigation -->
		<?php
			if(isset($_GET['s']) && $_GET['s'] == 'logout') {
			
			session_destroy();
			
			if($conn) {
				$conn->close();
			}
			
			header("Location: " . $_SERVER['PHP_SELF']);
			
			}
			
			//include one connection stirng
			include_once "includes/connect.php";
			
			//update the status from 0 to 1 or from undread to read
				$update_read_status = "UPDATE messages 
					SET status='1'
					WHERE receiver='$username' AND category='Sent'";
						
				$q_update_read_status = $conn->query($update_read_status);
			
		
			// Include the nav bar for Admin
			require_once "includes/menu.php";
		
		?>	
<!--End of Navigation -->
		<div class="messages">
			<h2 class="white-text">Inbox</h2>
			<?php
		
				include "includes/show_inbox.php";

			?>
		</div>
	</div>
<?php
	
	require_once "includes/footer.php";

?>