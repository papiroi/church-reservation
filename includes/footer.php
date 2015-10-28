<?php
 	if(! isset($_SESSION['code'])) {

		exit("Direct Script Not Allowed!");

	}
 
 /*
 * Footer
 * This file is included in every pages to prevent executing another php script at the end of every 
 * php files. Using the exit() or die() functions.
 * 
 */
 
 ?>
	
	<!-- Includes at the end of every files -->

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>

<?php
	
	// This is for security purposes
	// To avoid direct scripting
	unset($_SESSION['code']);
	
	// This will prevent executing additional script at the 
	// end of every pages
	exit();

?>