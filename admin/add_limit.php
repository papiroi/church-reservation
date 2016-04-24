<?php
/*
* Start of Tarlac Cathedral Online Reservation and Scheduling
* 
*/

/*
* This part of the script will set a session varaible for security purposes
* To avoid direct scripting
*/
	session_start();
	
	$_SESSION['code'] = 1;


/*
* Include the basepath file
* in the constant BASE
*/
	include "basepath.php";

	
/*
* include connection string
*/
	include "includes/connect.php";

/*
* Page redirection part to login if the admin is not logged in
* 
*/
	if(isset($_SESSION['username']) && !empty($_SESSION['username'])) {
		
		if($_SESSION['username'] != 'admin') {

			header ("Location: error_location.php");

		}	
		else {
			// Nothing to do here
		}

	}
	else {

		header ("Location: login.php");

	}

	if(isset($_POST['limit']) && !empty($_POST['limit'])) {
	
		$limit = $_POST['limit'];
		
		$add_limit = "INSERT INTO limitations (limitation, dateMod) VALUES ('$limit',NOW())";
		$add_limit_query = $conn->query($add_limit);
		
		if($add_limit_query) {
			
			$msg = "<div class='alert alert-info text-center'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				User Limitation Added!</div>";
			
		
		}
		else {
		
			$msg = "<div class='alert alert-danger text-center'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				Error in Adding to Database!</div>";
		
		}
	
	}

?>


<!DOCTYPE html>
<html class="full" lang="en-US">
<head>
	<title>User Limitation Panel</title>

<?php
	
	include "includes/head_include.php";

?>

	<!-- Custome Background for Services Offered Page -->
	<link rel="stylesheet" href="../css/background-image.css" />

</head>
<body>
	<div class="container">

		<h1 class="white-text">Admin Pannel: Add User Limitation</h1>
		
		
		

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
			
		<div class="row">
			
			<div class="col-md-6 col-md-offset-3">
			<?php echo @$msg; ?>
			<div class="center-div">
				<h2 class='white-text'>Add User Limit</h2>
				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" autocomplete="off">
				
					<label>Add User Limitation:</label>
					<textarea id="limit" name="limit" placeholder="Put User Limitation on this Box." class="form-control" rows="5"></textarea>
					<br/>
					<input type="submit" value="Add Limitation" class="btn btn-primary" />
					&nbsp;&nbsp;&nbsp;
					<input type="reset" value="Clear" class="btn btn-warning" />
					
				</form>
				
			</div>
			</div>
		</div>
	</div>


<?php

	require "includes/footer.php";

?>