<?php
	if(! isset($_SESSION['code'])) {

		exit("Direct Script Not Allowed!");

	}




/*
* Login Part
* 
*/
	require_once "core/login.php";
/*
* This part will check if the user send login request or not
*
*/
	if(isset($_POST['username']) && !empty($_POST['username'])) {
		
		// Getting the value from the user who login
		// and assigning it in variables
		
		$username = stripslashes($_POST['username']);
		$password = sha1(stripslashes($_POST['password']));
		
		// Including the lgoin class
		// The Login Class Requires 3 parameters: $conn, $username, $password respectively
		
		if($username == 'admin') {
			
			echo "<div class='error-message'>Error: Invalid Login</div>"; 
			
		}
		else {
		
			$login = new Login($conn, $username, $password);			
			
			@$login -> login();
			
			if(isset($_SESSION['username']) && !empty($_SESSION['username'])) {
				echo "<a href='index.php'>";
				echo "Click here if your browser does not redirect you to home page.";
				echo "</a>";
				exit();
			}
			else {
				
				//echo "<div class='error-message'>Error: Invalid Login Details</div>";
				
			}
			
		}
		
	}
	else {
		// Nothing to do here
	}



?>	
<div class="login_form">
	<form autocomplete="off" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
		<label for="username">Username:</label>
		<input type="text" name="username" id="username" class="form-control" 
			placeholder="Username" required title="Enter Your Username! Username is Required!" value="" autofocus/>
		<br/>
		<label for="password">Password:</label>
		<input type="password" name="password" id="password" class="form-control" 
			placeholder="Password" required title="Enter Your Password! Password is Required" value="" />
		<br/>
		<input type="submit" value="Login" class="btn btn-primary form-control"/>
	</form>
	<br/>
	<a href="recovery.php"><span class="white-text">Forgot Your Password?</span></a>
	<br/>
	<a href="register.php"><span class="white-text">Click Here to Register</span></a>
</div>