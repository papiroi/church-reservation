<?php
	if(! isset($_SESSION['code'])) {

		exit("Direct Script Not Allowed!");

	}

?>
<!--
Display Login First Page
This will display if the user try to access Change Password of Similar
-->

<div class="row">
	<div class="col-md-12">
	
		<div class="center-div">
			<h2 class="white-text">Login First to Change Your Password!!!</h2>
			<h4><a href="login.php">Click Here to Login</a></h4>
		</div>

	</div>
</div>