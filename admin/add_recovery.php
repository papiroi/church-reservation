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

	if(isset($_POST['question']) && !empty($_POST['question'])) {
	
		$question = $_POST['question'];
		$answer = $_POST['answer'];
		
		$insert = "INSERT INTO recovery (question, answer, dateMod)
			VALUES (
			'$question',
			'$answer',
			NOW()
			)";
			
		$insert_query = $conn->query($insert);
		
		if($insert_query) {
			
			$msg = "<div class='alert alert-info text-center'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				Recovery Question Added!</div>";
			
		
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
	<title>Add Recovery Question</title>

<?php
	
	include "includes/head_include.php";

?>

	<!-- Custome Background for Services Offered Page -->
	<link rel="stylesheet" href="../css/background-image.css" />

</head>
<body>
	<div class="container">

		<h1 class="white-text">Add Recovery Question</h1>
		
		
		

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
				<h2 class='white-text'>Add Recovery Question</h2>
				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" autocomplete="off">
				<label>Question:</label>
				<input type="text" name="question" class="form-control" placeholder="Input Secret Question" required autofocus/>
				<br/>
				<label>Answer:</label>
				<input type="password" name="answer" class="form-control" required placeholder="Enter Secret Answer"/>
				<br/>
				<input type="submit" value="Add Recovery Question" class="btn btn-success" />
				</form>
			</div>
			</div>
		</div>
	</div>


<?php

	require "includes/footer.php";

?>