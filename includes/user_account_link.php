 <?php
	if(! isset($_SESSION['code'])) {

		exit("Direct Script Not Allowed!");

	}

	if($username != 'Guest') { 

		if(isset($_GET['s']) && $_GET['s'] == 'logout') {
			
			session_destroy();
			
			if($conn) {
				$conn->close();
			}
			
			//header("Location: " . $_SERVER['PHP_SELF']);
			
		}
	}

?>