<?php
/*
* Login Page
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
		$username = $_SESSION['username'];;
	}
	else {
		$username = "Guest";
	}

	
/*
* Calling the connection string for the database server
* the $conn variable contains connection string in the database server
*/
	require_once "includes/connect.php";
	require_once "core/login.php";
	
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
	<div class="container">
		<br/>
		<h1 class="text-center white-text">Scheduling and Reservation System for Tarlac San Sebastian Cathedral Parish</h1>

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
		<div class="col-md-4"></div>
		<div class="col-md-4">
			<div class="center-div">
<!-- Start of PHP Code in Login -->
<?php
			
/*
* Login Part
* 
*/

/*
* This part will check if the user send login request or not
*
*/
	if(isset($_POST['username']) && !empty($_POST['username'])) {
		
		// Getting the value from the user who login
		// and assigning it in variables
		
		$username = stripslashes($_POST['username']);
		$password = sha1(stripslashes($_POST['password']));
		
		// Including the lgoin class
		// The Login Class Requires 3 parameters: $conn, $username, $password respectively
		
		if($username == 'admin') {
			echo "<div class='error-message'>Error: Invalid Login Details</div>";
			
		}
		else {
		
			$login = new Login($conn, $username, $password);			
			
			@$login -> login();
			
			if(isset($_SESSION['username']) && !empty($_SESSION['username'])) {
				echo "<a href='index.php'>";
				echo "Click here if your browser does not redirect you to home page.";
				echo "</a>";
				exit();
			}
			
		}
		
	}
	else {
		// Nothing to do here
		
	}
	
?>
<!-- End of Code in Login -->
			
				<h3 class="white-text">Login Form</h3>
				<form autocomplete="off" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
					<label for="username">Username:</label>
					<input type="text" name="username" id="username" class="form-control" 
						placeholder="Username" required title="Enter Your Username! Username is Required!" value="" autofocus/>
					<br/>
					<label for="password">Password:</label>
					<input type="password" name="password" id="password" class="form-control" 
						placeholder="Password" required title="Enter Your Password! Password is Required" value="" />
					<br/>
					<input type="submit" value="Login" class="btn btn-primary form-control"/>
				
				</form>

				<br/>
				<span class="white-text">Doesn't Have an Account? Click <a href="register.php">here</a>.</span>
				<br/>
				<a href="index.php"><span class="white-text">Return to Home Page</span></a>
			</div>
		</div>
		<div class="col-md-4"></div>
		</div>
	
	

		
	</div>

	<?php
		include "includes/include_contacts.php";
	?>
	
<?php
/*
* This part will include the footer script.
* Required in every pages of the website
*/
	require "includes/footer.php";

?>