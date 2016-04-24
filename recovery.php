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


/*
* Start of Sending Recovery Password Script
*/

	if(isset($_POST['username']) && !empty($_POST['username'])) {

		$username = $_POST['username'];

		$select_user = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
		$select_user_query = $conn->query($select_user);

		if($select_user_query-> num_rows > 0) {

			while($r = $select_user_query->fetch_assoc()) {

				$email = $r['email'];
				$link = "www.tarlaccathedral.cf/passrecovery.php?code=" . $r['recovery'];

			}

			@mail($email, "Recovery Link", $link);

			$msg = "<div class='alert alert-success text-center'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				Success send recovery link to your email. Check your email's Inbox or Spam Folder.</div>";
		}
		else {


			$msg = "<div class='alert alert-danger text-center'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				Invalid Username. Check your username.</div>";

		}

	}

/*
* End of Sending Recovery Password Script
*/

	
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
		<h1 class="text-center white-text">Password Recovery</h1>

		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">

			<?php echo @$msg; ?>

				<div class="center-div">

				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" autocomplete="off">
					<h3>Username:</h3>
					<input type="text" id="username" name="username" class="form-control" placeholder="Enter your username" required autofocus/>
					<br/>
					<div class="text-center">
					<input type="submit" value="Recover Password" class="btn btn-primary" />
					</div>

				</form>
				<br/>
				<br/>
				<div class="white-text text-center">
				<strong>Note: </strong>A link will send to your registered email address corresponding to the valid
				and registered username to recover your password.</div>
				
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