<?php
/*
* Start of St. Augustine Parish Church Online Reservation and Scheduling
* TODO: change variable name according to attribute
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
	
		$id = $_POST['accountid'];
		$name = $_POST['account-name'];
		$sched = $_POST['account-type'];
		$info = $_POST['account-status'];
		
		$update_priest = "UPDATE accounts SET account_name = '$name', account_type = '$sched', account_status = '$info' WHERE accountid = '$id'";
		$update_priest_query = $conn->query($update_priest);
		
		if($update_priest_query) {
		
			$update_msg = "<div class='alert alert-info text-center'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				Account Info Updated!</div>";
				
				$select_priest = "SELECT * FROM accounts WHERE accountid = '$id'";
				$select_priest_query = $conn->query($select_priest);
				
				while($p_row = $select_priest_query -> fetch_assoc()) {
				
					$priest_id = $p_row['accountid'];
					$priest_name = $p_row['account_name'];
					$priest_sched = $p_row['account_type'];
					$priest_info = $p_row['account_status'];
				
				}
		
		}
		else {
		
			$update_msg = "<div class='alert alert-danger text-center'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				Failed to Update Record!</div>";
		
		}
	
	
	}
	
	if(isset($_POST['id']) && !empty($_POST['id'])) {
	
		$id = $_POST['id'];
		
		$select_priest = "SELECT * FROM accounts WHERE accountid = '$id'";
		$select_priest_query = $conn->query($select_priest);
		
		while($p_row = $select_priest_query -> fetch_assoc()) {
		
			$priest_id = $p_row['accountid'];
			$priest_name = $p_row['account_name'];
			$priest_sched = $p_row['account_type'];
			$priest_info = $p_row['account_status'];
		
		}
	
	
	}

?>


<!DOCTYPE html>
<html class="full" lang="en-US">
<head>
	<title>Accounts Panel</title>

<?php
	
	include "includes/head_include.php";

?>

	<!-- Custome Background for Services Offered Page -->
	<link rel="stylesheet" href="../css/background-image.css" />

</head>
<body>
	<div class="container">

		<h1 class="white-text">Admin Pannel</h1>
		
		
		

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
			<?php echo @$update_msg; ?>
			<div class="center-div">
				<h2 class='white-text'>Update Account Info</h2>
				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" autocomplete="off">
					<label>Name:</label>
					<input type="hidden" name="accountid" value="<?php echo @$priest_id; ?>" />
                                        <input type="text" readonly value="<?php echo @$priest_name; ?>" class="form-control" id="name" name="account-name"
						required autofocus placeholder="Name of Account"/>
					<br/>
					<label>Account Type:</label>
                                        <input type="text" readonly="" value="<?php echo @$priest_sched; ?>" class="form-control" id="name" name="account-type"
						required autofocus placeholder="Account Type"/>
					<br/>
					<label>Account Status:</label>
					<select name="account-status">
                                            <option value="active" selected>Active</option>
                                            <option value="inactive" <?php if(@$priest_info === 'inactive') echo 'selected'; ?>>Inactive</option>
                                        </select>
					<br/>
					<input type="submit" class="btn btn-primary" value="Update" />
					&nbsp;&nbsp;
					<input type="reset" class="btn btn-danger" value="Revert" />
				</form>
				
			</div>
			</div>
		</div>
	</div>


<?php

	require "includes/footer.php";

?>