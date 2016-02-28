<?php
/*
* Admin Login Page
*/

/*
* This part of the script will set a session varaible for security purposes
* To avoid direct scripting
*/
	session_start();
	
	$_SESSION['code'] = 1;


/*
* Check if admin is already logged in
*
*/

	if(isset($_SESSION['username']) && !empty($_SESSION['username'])) {

		if($_SESSION['username'] == 'admin') {
			header("Location: index.php");
		}
		
	}


/*
* Include the basepath file
* in the constant BASE
*/
	include "basepath.php";

?>

<!DOCTYPE html>
<html class="full" lang="en-US">
<head>

	<title>Admin Login - Scheduling and Reservation System for Tarlac San Sebastian Cathedral Parish</title>

<?php

	require_once "includes/head_include.php";

?>

	<!-- Custome Background for Services Offered Page -->
	<link rel="stylesheet" href="../css/background-image.css" />

</head>
<body>

	<div class="container">
		<h1 class="text-center white-text">Scheduling and Reservation System for Tarlac San Sebastian Cathedral Parish</h1>

		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
			<div class="center-div">
<?php
/*
* Admin Login Part
*
*/


	// Include the connect.php that containts the conection string to our database
	// $conn variable contains the connection string
	include "includes/connect.php";


	// Include the Login class contains method in logging in admin
	// Login Class
	include "core/login.php";

	if(isset($_POST['username']) && !empty($_POST['username'])) {

		// Assign Values Needed to Variables
		$username = stripcslashes($_POST['username']);
		$password = sha1($_POST['password']);


		if($_POST['username'] === 'admin') {
			$login = new Login($conn, $username, $password);

			echo $login -> login();
		}
		else {
			echo "<div class='error-message'>You're Not Valid Here!</div>";
		}

	}


?>

				<h2>Admin Login</h2>

				<form autocomplete="off" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
					<label for="username">Username</label>
					<input type="text" name="username" id="username" class="form-control" value="" required autofocus/>

					<br/>

					<label for="password">Password</label>
					<input type="password" name="password" id="password" class="form-control" value="" required />

					<br/>

					<input type="submit" value="Login" class="btn btn-primary form-control" />

				</form>

				<br/>

				<a href="<?php echo BASE . 'index.php'?>"><span class="white-text"><< Back to Main Page</span></a>

			</div>
			</div>
			<div class="col-md-4"></div>
		</div>
	</div>


<?php

	require_once "includes/footer.php";

?>