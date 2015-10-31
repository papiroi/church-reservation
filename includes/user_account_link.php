<?php
	if(! isset($_SESSION['code'])) {

		exit("Direct Script Not Allowed!");

	}

	if($username != 'Guest') { 
?>

	<a href="changepass.php"><span class="link-text">Change Password</span></a>
	<a href="?s=logout" id="logout"><span class="link-text">Logout</span></a>

<?php
		if(isset($_GET['s']) && $_GET['s'] == 'logout') {
			
			session_destroy();
			
			if($conn) {
				$conn->close();
			}
			
			header("Location: " . $_SERVER['PHP_SELF']);
			
		}
	}

?>