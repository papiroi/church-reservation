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
	<title>Delete Recovery Question</title>

<?php
	
	include "includes/head_include.php";

?>

	<!-- Custome Background for Services Offered Page -->
	<link rel="stylesheet" href="../css/background-image.css" />

</head>
<body>
	<div class="container">

		<h1 class="white-text">Delete Recovery Question</h1>
		
		
		

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
				<h2 class="white-text">Delete Form</h2>
				<table class="table">
					<tr>
					<th>Question</th>
					<th>Operation</th>
					</tr>
				<?php
					$select = "SELECT * FROM recovery";
					$select_query = $conn->query($select);
					
					if($select_query -> num_rows > 0) {
						echo "<tr>";
						while($row = $select_query -> fetch_assoc()) {

							echo "<td>" . $row['question'] . "</td>";
							echo "<td>";
							echo "<form action='delreco.php' method='post'>";
							echo "<input type='hidden' name='id' value='" . $row['qID'] . "'/>";
							echo "<input type='submit' value='Delete' class='btn btn-danger' />";
							echo "</form>";
							echo "</td>";

						}
						echo "</tr>";
					}
					else {
						echo "<h3 class='white-text'>No Recovery Question Found. You must add at least 1.</h3>";
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
?>