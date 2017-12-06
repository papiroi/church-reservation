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


?>


<!DOCTYPE html>
<html class="full" lang="en-US">
<head>
	<title>Vouchers</title>

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
			
			<div class="col-md-12">
			<div class="center-div">
                <div class="accounting-title">
                    <h2 class="white-text">Voucher Info</h2>
                    <a href="add_account.php" class='btn btn-success' role="button"/>Add New Voucher</a>
                </div>
				
				<table class="table">
					<th>Voucher No.</th>
                                        <th>Description</th>
                                        <th>Date</th>
					<th>Status</th>
                                        <th>Option</th>
				<?php
					$select_accounts = "SELECT * FROM vouchers";
					$select_accounts_query = $conn->query($select_accounts);
					
					if($select_accounts_query->num_rows > 0) {
					
						while($p_row = $select_accounts_query -> fetch_assoc()) {
							
							echo "<tr>";
							echo "<td>" . $p_row['voucherid'] . "</td>";
                                                        echo "<td>" . $p_row['voucher_description'] . "</td>";
							echo "<td>" . $p_row['voucher_date'] . "</td>";
                                                        echo "<td>" . $p_row['account_status'] . "</td>";
							echo "<td>";
							
							echo "<form action='acc_update.php' method='post'>";
							echo "<input type='hidden' name='id' value='" . $p_row['voucherid'] . "'/>";
							echo "<input type='submit' value='View Details' class='btn btn-primary'/>";
							echo "</form>";
							echo "</td>";
							echo "</tr>";
						
						}
					
					}
					else {
					
						echo "<h3 class='white-text'>NO Available Vouchers</h3>";
					
					}
				
				?>
				</table>
				
			</div>
			</div>
		</div>
	</div>


<?php

	require "includes/footer.php";

?>