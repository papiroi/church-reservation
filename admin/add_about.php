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

	if(isset($_POST['title']) && !empty($_POST['title'])) {
	
		$title = $_POST['title'];
		$code = $_POST['code'];
		$desc = $_POST['desc'];
		
		$insert = "INSERT INTO about (title, code, description, dateMod)
			VALUES (
			'$title',
			'$code',
			'$desc',
			NOW()
			)";
			
		$insert_query = $conn->query($insert);
		
		if($insert_query) {
			
			$msg = "<div class='alert alert-info text-center'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				About Added!</div>";
			
		
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
	<title>About Panel</title>

<?php
	
	include "includes/head_include.php";

?>

	<!-- Custome Background for Services Offered Page -->
	<link rel="stylesheet" href="../css/background-image.css" />

</head>
<body>
	<div class="container">

		<h1 class="white-text">Admin Pannel: Add About</h1>
		
		
		

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
			
			<div class="col-md-7">
			<?php echo @$msg; ?>
			<div class="center-div">
				<h2 class='white-text'>Add About</h2>
				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" autocomplete="off">
					<label>Title:</label>
					<input type="text" id="title" name="title" class="form-control" placeholder="Title" required autofocus/>
					<br/>
					
					<label>Code:</label>
					<input type="text" id="code" name="code" class="form-control" placeholder="Unique Code" required/>
					<br/>
					
					<label>Description:</label>
					<textarea id="desc" name="desc" class="form-control" placeholder="Decription Here..." required></textarea>
					<br/>
					
					<input type="submit" value="Add to About" class="btn btn-primary" />
					
				</form>
				
			</div>
			</div>
		</div>
	</div>


<?php

	require "includes/footer.php";

?>