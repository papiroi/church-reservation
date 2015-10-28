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
?>


<!DOCTYPE html>
<html class="register-full" lang="en-US">
<head>
	<title>Registration - Tarlac Cathedral</title>

<?php

	require_once "includes/head_include.php";

?>
	
	<link rel="stylesheet" href="css/register-background-image.css" />
	
</head>
<body>
	<div class="container">
		<h1 class="text-center white-text">Welcome to Tarlac Cathedral Online Reservation and Scheduling User Registration</h1>
	
		<div class="row">
		<div class="col-md-5">
		<div class="center-div">
		
<!-- Start of PHP Code in Registration -->


<!-- End of PHP Code in Registration -->
			<h3 class="white-text">Registration Form</h3>
			<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
				<label for="firstname">First Name:</label>
				<input type="text" name="firstname" id="firstname" class="form-control input-width" placeholder="First Name" title="First Name Field is Required!" required/>
				<br/>
				<label for="lastname">Lastname:</label>
				<input type="text" name="lastname" id="lastname" class="form-control input-width" placeholder="Last Name" required/>
				<br/>
				<label for="mobile">Mobile Number:</label><i> 11 Digit Number</i>
				<input type="number" name="mobile" id="mobile" class="form-control input-width" placeholder="Mobile Number" required/>
				<br/>
				<label for="email">Email:</label>
				<input type="email" name="email" id="email" class="form-control input-width" placeholder="Email Address" required/>
				<br/>
				<label for="address">Address:</label>
				<input type="text" name="address" id="address" class="form-control input-width" placeholder="Address" required/>
				<br/>
				<label for="bday">Birthday:</label>
				<input type="date" name="bday" id="bday" class="form-control input-width" required/>
				<br/>
				<label for="username">Username:</label>
				<input type="text" name="username" id="username" class="form-control input-width" placeholder="Username" required/>
				<br/>
				<label for="password">Password:</label>
				<input type="password" name="passwrod" id="password" class="form-control input-width" placeholder="Password" required/>
				<br/>
				<label for="password2">Re-Enter Password:</label>
				<input type="password" name="password2" id="password2" class="form-control input-width" placeholder="Re-Type Password" required/>
				<br/>
				<input type="submit" value="Register" class="btn btn-primary form-control input-width"/>
			
			</form>
			<br/>
			<span class="white-text">Already Have an Account? Click <a href="login.php">here</a>.</span>
			<br/>
			<a href="index.php"><span class="white-text">Return to Home Page</span></a>
		</div>
		</div>
		<div class="col-md-7"></div>
	
	</div>

<?php

	require_once "includes/footer.php";

?>