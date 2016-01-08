<?php
/*
* Start of Tarlac Cathedral Online Reservation and Scheduling
* Index Page or Home Page
*/

/*
* This part of the script will set a session varaible for security purposes
* To avoid direct scripting
*/
	session_start();
	
	$_SESSION['code'] = 1;
	
	

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
* The Connection String
*
*/

	require_once "includes/connect.php";
	
	
	
/*
* This will create the database and tables needed in the database of the website
* 
*/
	include_once "core/database.php";
	
/*
* After Including the database class
* 
*/
	$db = new Database($conn);
	
	// Create User Database and Load initial content
	$db->create_user_table();
	
	// Create Announcement
	$db->create_announcement();
	
?>


<!DOCTYPE html>
<html class="full" lang="en-US">
<head>
	<title>Scheduling and Reservation System for Tarlac San Sebastian Cathedral Parish</title>
	
<?php
/*
* This will include the commond includes in head section of every page
* 
*/
	require "includes/head_include.php";
	
?>
	
	<!-- Custom CSS for Background Image for this page -->
	<link rel="stylesheet" href="css/background-image.css" />
	

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
	
		<span class="white-text">
			Welcome <?php echo $username; ?>!!!
			<?php require_once "includes/user_account_link.php"; ?>
			
		</span>
	
		<h1 class="text-center white-text">Scheduling and Reservation System for Tarlac San Sebastian Cathedral Parish</h1>

		<div class="announcements">
			<marquee>
				<?php
					// Load The Value of the Announcement
					$select_announcement = "SELECT atext FROM announcement";
					$sa_result = $conn->query($select_announcement);
					
					$new_announcement = "";
					
					if($sa_result->num_rows > 0) {
						
						while($row_sa_result = $sa_result->fetch_assoc()) {
							$new_announcement = $row_sa_result['atext'];
						}
					
					}
					// The new announcement will display in the home page of the website
					echo $new_announcement;
					
					
				?>
			</marquee>
		</div>
		
	
	</div>

<?php
/*
* This part will include the footer script.
* Required in every pages of the website
*/
	require "includes/footer.php";

?>