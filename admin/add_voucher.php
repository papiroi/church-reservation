<?php
/*
* Start of St. Augustine Parish Church Online Reservation and Scheduling
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

	if(isset($_POST['account-name']) && !empty($_POST['account-name'])) {
	
		$name = $_POST['account-name'];
		$accountType = $_POST['account-type'];
                $accountStatus = 'active';
		
		$add_event = "INSERT INTO accounts (account_name,  account_type, account_status)
			VALUES ('$name','$accountType','$accountStatus')";
			
		$add_event_query = $conn->query($add_event);
		
		if($add_event_query) {
		
			$p_msg = "<div class='alert alert-info text-center'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				Account Added!</div>";
			
		}
		else {
		
			$p_msg = "<div class='alert alert-danger text-center'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				Error in Adding Account!</div>";
		
		}
	
	}

?>


<!DOCTYPE html>
<html class="full" lang="en-US">
<head>
	<title>Account Panel</title>

<?php
	
	include "includes/head_include.php";
?>

	<!-- Custome Background for Services Offered Page -->
	<link rel="stylesheet" href="../css/background-image.css" />
        <script>
		$(function() {
			$("#voucher-date").datepicker({ maxDate: 90, changeYear: true, changeMonth: true });
		});
	</script>

</head>
<body>
	<div class="container">

		<h1 class="white-text">Admin Pannel: Add Account</h1>
		
		
		

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
			<?php echo @$p_msg; ?>
			<div class="center-div">
				<h2 class='white-text'>Add New Voucher</h2>
				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" autocomplete="off">
					<label>Voucher Description</label>
                                        <textarea rows="3" class="form-control" id="voucher-description" name="voucher-description"
                                                  required autofocus placeholder="Enter description here"></textarea>
					<br/>
					<!-- <label>Code:</label>
					<input type="text" class="form-control" id="code" name="code" placeholder="Unique Code for the Event" required /> -->
					<label>Date:</label>
                                        <input type="text" name="voucher-date" id="voucher-date" value="" class="form-control" required/>
					<br/>
					<br/>
					<input type="submit" class="btn btn-primary" value="Save" />
					&nbsp;&nbsp;
					<input type="reset" class="btn btn-danger" value="Clear" />
				</form>
				
			</div>
			</div>
		</div>
	</div>


<?php

	require "includes/footer.php";

?>