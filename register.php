<?php
/*
* Register Page
* 
*/


/*
* This part of the script will set a session varaible for security purposes
* To avoid direct scripting
*/
	session_start();
	
	$_SESSION['code'] = 1;
	
	
	require_once "includes/connect.php";

/*
* Condition to check if there's a logined user
*
*/
	if(isset($_SESSION['username']) && !empty($_SESSION['username'])) {
		header('Location: index.php');
	}
	else {
		// Nothing to do
	}
	
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

?>


<!DOCTYPE html>
<html class="full" lang="en-US">
<head>
	<title>Registration - St. Augustine Parish Church</title>
	
<?php

	require_once "includes/head_include.php";

?>
	
	<!-- Custom CSS for Background Image for this page -->
	<link rel="stylesheet" href="css/background-image.css" />
	
	
	<script>
		$(function() {
			$("#birthday").datepicker({ maxDate: -6570, changeYear: true, changeMonth: true });
		});
	</script>
	
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

		
		
<!-- Start of PHP Code in Registration -->
<?php
	if(isset($_POST['username']) && !empty($_POST['username'])) {

		// Include Database Connection String
		require_once "includes/connect.php";
	
		// Include Validation/Sanitation Class
		require_once "core/validation.php";
		
		// Set Variable Holders and other Operations
		
		$firstname = stripslashes($_POST['firstname']);
		$lastname = stripslashes($_POST['lastname']);
		$mobile = stripslashes($_POST['mobile']);
		$email = stripslashes($_POST['email']);
		$address = stripslashes($_POST['address']);
		$bday = date('y-m-d', strtotime($_POST['birthday']));
		$username = stripslashes($_POST['username']);
		$password = sha1(stripslashes($_POST['password']));
		
		// Include Registration Class
		require_once "core/registration.php";
		
		// Check if the user that are registering is 18 years old and beyond
		// if the user is below 18 years old he/she will not be able to create account
		// because in able for you to reserve an event you need to be 18 years old
		// This function Calculates the age of the user 
		// The DateTime::diff() works on php ver 5.3.0 and up
		/* Start of DateTime::diff() function
		function ageCalculator($dob){
			if(!empty($dob)){
				$birthdate = new DateTime($dob);
				$today   = new DateTime('today');
				$age = $birthdate->diff($today)->y;
				return $age;
			}else{
				return 0;
			}
		}
		*/ 
		// Age of the User
		//$age = ageCalculator($bday);
		
		
		// Condition if the user is 18 years old and above
		// if not the user cannot register
		//if($age > 17 ) {
			
			// Writing User Registration Information to the Database
			$reg = new Registration($conn, $firstname, $lastname, $mobile, $email, $address, $bday, $username, $password);
		
			
			// select email if there is registered in the database
			$select_email = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
			$select_email_query = $conn->query($select_email);
			
			if($select_email_query->num_rows > 0 ) {
				
				echo "<div class='alert alert-danger text-center'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				This Email is already in used by another user.</div>";
				
				$email_error = "<span style='color:red; font-size: 25px;'>*</span>";
				
				$ret_fname = $firstname;
				$ret_lname = $lastname;
				$ret_mobile = $mobile;
				$ret_address = $address;
				$ret_bday = $bday;
				
				include_once "includes/register_inc.php";
			}
			else {
				
				if($reg -> register() == true) {
					
					
					//$reg -> register();
					include_once "includes/goto_login.php";
					
					
				}
				else {
					
					// the value inputed will be there
					// but the username and email is empty
					$ret_fname = $firstname;
					$ret_lname = $lastname;
					$ret_mobile = $mobile;
					$ret_address = $address;
					$ret_bday = $bday;
					
					include_once "includes/register_inc.php";
				}
			}
		//}
		//else {
			
			//echo "<script>";
			//echo "alert('You are below 18 years old!')";
			//echo "</script>";
			
		//}
	}
	else {
		
		include_once "includes/register_inc.php";
		
	}
	
	require_once "includes/footer.php";

?>