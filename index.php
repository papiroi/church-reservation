<?php
/*
* Start of St. Augustine Parish Church Online Reservation and Scheduling
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
		$username = $_SESSION['username'];
		if($username == 'admin') {

			header('Location: admin/index.php');

		}
	}
	else {
		$username = "Guest";
	}


/*
* The Connection String
*
*/

	require_once "includes/connect.php";
	
	
	
	function nl2br2($text){
		return preg_replace("/\r\n|\n|\r/", "<br>", $text);
	}
	
	
	
	
	
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
	
	// Create Announcement TAble
	$db->create_announcement();
	
	//Create Reservation Table
	$db->reservation();
	
	//Create Messages Table
	$db->Messages();
	
	//Create Cached_msg table
	$db->Messages2();
	
	//Create priests table
	$db->priests();
	
	//Create event table
	$db->events();
	
	// Create about table
	$db->about();
	
	//create mass table4
	$db->mass();
	
	//create docs table
	$db->docs();
	
	// create limations table
	$db->usr_limitations();
	
	// create calendar label table
	$db->cal_label();

	// Create recovery table
	$db->recovery();
        
        // Create accounts table
        $db->accounts();
        
        // Create vouchers table
        $db->vouchers();
        
        // Create voucher-accounts table
        $db->voucherAccounts();
?>


<!DOCTYPE html>
<html class="full" lang="en-US">
<head>
	<title>St. Augustine Parish Church</title>
	
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




	<div class="container">
	

	
		<h1 class="text-center white-text">St. Augustine Parish Church</h1>
<!-- Start of Navigation Bar -->
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
<!-- End of Navigation Bar -->
		
		
		<div class="row">
			
			<!-- This is where to place the announcement -->
			<div class="col-md-8">
				<div class="announcements">
					<marquee direction="up">
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
							echo nl2br2($new_announcement, false);
							
							
						?>
					</marquee>
				</div>
			</div>
			<!-- Login Page if no user logged -->
			<!-- Mass schedule if a user logged -->
			<div class="col-md-4">
			
				<div class="login-div">
				
<?php
/*
* This part of index or home page will show login form and/or registration form
* if there is no user logged in, other wise the schedule of mass will appear
*/

	if($username == 'Guest') {
		
		include "includes/login_form.php";
		
	}
	else {
		
		//echo "user Limitations";
		
		include "includes/user_limit.php";
		
	}
?>
				
				</div>
			
			</div>
			
			
		</div>
		
	</div>
		
<?php
	include "includes/include_contacts.php";

/*
* This part will include the footer script.
* Required in every pages of the website
*/
	require "includes/footer.php";

?>