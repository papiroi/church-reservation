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
	$db->create_user_table();
	
?>


<!DOCTYPE html>
<html class="full" lang="en-US">
<head>
	<title>Tarlac Cathedral Online Reservation and Scheduling</title>
	
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


	<div class="container-fluid">
	
		<span class="white-text">
			Welcome <?php echo $username; ?>!!!
			<?php require_once "includes/user_account_link.php"; ?>
			
		</span>
	
		<h1 class="text-center white-text">Tarlac Cathedral Online Reservation and Scheduling</h1>
		
	
	</div>

<?php
/*
* This part will include the footer script.
* Required in every pages of the website
*/
	require "includes/footer.php";

?>