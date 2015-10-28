<?php
/*
* Register Page
* 
*/


/*
* This part of the script will set a session varaible for security purposes
* To avoid direct scripting
*/
	session_start();
	
	$_SESSION['code'] = 1;
	

/*
* Condition to check if there's a logined user
*
*/
	if(isset($_SESSION['username']) && !empty($_SESSION['username'])) {
		header('Location: index.php');
	}
	else {
		// Nothing to do
	}
?>


<!DOCTYPE html>
<html class="register-full" lang="en-US">
<head>
	<title>Registration - Tarlac Cathedral</title>

<?php

	require_once "includes/head_include.php";

?>
	
	<link rel="stylesheet" href="css/register-background-image.css" />
	
</head>
<body>
	<div class="container">
		<h1 class="text-center white-text">Welcome to Tarlac Cathedral Online Reservation and Scheduling User Registration</h1>
	
		<div class="row">
		<div class="col-md-5">
		<div class="center-div">
		
<!-- Start of PHP Code in Registration -->
<?php
	if(isset($_POST['username']) && !empty($_POST['username'])) {
		// Set Variable Holders and other Operations
	}
	else {
		// Nothing to do here just run the page as is
	}

?>
<!-- End of PHP Code in Registration -->
			<h3 class="white-text">Registration Form</h3>
			<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
				
				<div id="firstnameclassdiv" class="form-group has-feedback">
				<label for="firstname">First Name:</label>
				<input type="text" name="firstname" id="firstname" class="form-control input-width" placeholder="First Name" title="First Name Field is Required!" required/>
				<span id="firstnameclassspan" class="glyphicon form-control-feedback"></span>
				</div>
				
				<br/>
				
				<div id="lastnameclassdiv" class="form-group has-feedback">
				<label for="lastname">Lastname:</label>
				<input type="text" name="lastname" id="lastname" class="form-control input-width" placeholder="Last Name" required/>
				<span id="lastnameclassspan" class="glyphicon form-control-feedback"></span>
				</div>
				
				<br/>
				
				<div id="mobileclassdiv" class="form-group has-feedback">
				<label for="mobile">Mobile Number:</label><i> 11 Digit Number</i>
				<input type="number" name="mobile" id="mobile" class="form-control input-width" placeholder="Mobile Number" required/>
				<span id="mobileclassspan" class="glyphicon form-control-feedback"></span>
				</div>
				
				<br/>
				
				<div id="emailclassdiv" class="form-group has-feedback">
				<label for="email">Email:</label>
				<input type="email" name="email" id="email" class="form-control input-width" placeholder="Email Address" required/>
				<span id="emailclassspan" class="glyphicon form-control-feedback"></span>
				</div>
				
				<br/>
				
				<div id="addressclassdiv" class="form-group has-feedback">
				<label for="address">Address:</label>
				<input type="text" name="address" id="address" class="form-control input-width" placeholder="Address" required/>
				<span id="addressclassspan" class="glyphicon form-control-feedback"></span>
				</div>
				
				<br/>
				
				<div id="bdayclassdiv" class="form-group has-feedback">
				<label for="bday">Birthday:</label>
				<input type="date" name="bday" id="bday" class="form-control input-width" required/>
				<span id="bdayclassspan" class="glyphicon form-control-feedback"></span>
				</div>
				
				<br/>
				
				<div id="usernameclassdiv" class="form-group has-feedback">
				<label for="username">Username:</label>
				<input type="text" name="username" id="username" class="form-control input-width" 
					placeholder="Username" pattern=".{5,32}" required 
					title="It must be a minimum of 5 characters and a maximum of 32 characters!"/>
				<span id="usernameclassspan" class="glyphicon form-control-feedback"></span>
				</div>
				
				<br/>
				
				<div id="passwordclassdiv" class="form-group has-feedback">
				<label for="password">Password:</label>
				<input type="password" name="passwrod" id="password" class="form-control input-width" placeholder="Password" required/>
				<span id="passwordclassspan" class="glyphicon form-control-feedback"></span>
				</div>
				
				<br/>
				
				<div id="password2classdiv" class="form-group has-feedback">
				<label for="password2">Re-Enter Password:</label>
				<input type="password" name="password2" id="password2" class="form-control input-width" placeholder="Re-Type Password" required/>
				<span id="password2classspan" class="glyphicon form-control-feedback"></span>
				</div>
				
				<br/>
				
				<input type="submit" value="Register" class="btn btn-primary form-control input-width"/>
			
			</form>
			<br/>
			<span class="white-text">Already Have an Account? Click <a href="login.php">here</a>.</span>
			<br/>
			<a href="index.php"><span class="white-text">Return to Home Page</span></a>
		</div>
		</div>
		<div class="col-md-7"></div>
	
	</div>
	
<script>
$(document).ready(function() {
	// Validation for Firstname
	$("#firstname").focusout(function() {
		if($("#firstname").val().length == "") {
			$( "#firstnameclassdiv" ).removeClass( "has-success" ).addClass( "has-error" );
			$( "#firstnameclassspan" ).removeClass( "glyphicon-ok" ).addClass( "glyphicon-remove" );
		}
		else {
			$( "#firstnameclassdiv" ).removeClass( "has-error" ).addClass( "has-success" );
			$( "#firstnameclassspan" ).removeClass( "glyphicon-remove" ).addClass( "glyphicon-ok" );
		}
	});
	
	// Validation for Lastname
	$("#lastname").focusout(function() {
		if($("#lastname").val().length == "") {
			$( "#lastnameclassdiv" ).removeClass( "has-success" ).addClass( "has-error" );
			$( "#lastnameclassspan" ).removeClass( "glyphicon-ok" ).addClass( "glyphicon-remove" );
		}
		else {
			$( "#lastnameclassdiv" ).removeClass( "has-error" ).addClass( "has-success" );
			$( "#lastnameclassspan" ).removeClass( "glyphicon-remove" ).addClass( "glyphicon-ok" );
		}
	});
	
	// Validation for Mobile Number
	$("#mobile").focusout(function() {
		if($("#mobile").val().length == "" || $("#mobile").val().length < 11) {
			$( "#mobileclassdiv" ).removeClass( "has-success" ).addClass( "has-error" );
			$( "#mobileclassspan" ).removeClass( "glyphicon-ok" ).addClass( "glyphicon-remove" );
		}
		else {
			$( "#mobileclassdiv" ).removeClass( "has-error" ).addClass( "has-success" );
			$( "#mobileclassspan" ).removeClass( "glyphicon-remove" ).addClass( "glyphicon-ok" );
		}
	});
	
	
	// Email Validation
	$("#email").focusout(function() {
		
		var email = $("#email").val();
		
		if($("#email").val().length == "") {
			$( "#emailclassdiv" ).removeClass( "has-success" ).addClass( "has-error" );
			$( "#emailclassspan" ).removeClass( "glyphicon-ok" ).addClass( "glyphicon-remove" );
		}
		else {
			if(validateEmail(email)) {
				$( "#emailclassdiv" ).removeClass( "has-error" ).addClass( "has-success" );
				$( "#emailclassspan" ).removeClass( "glyphicon-remove" ).addClass( "glyphicon-ok" );
			}
			else {
				$( "#emailclassdiv" ).removeClass( "has-success" ).addClass( "has-error" );
				$( "#emailclassspan" ).removeClass( "glyphicon-ok" ).addClass( "glyphicon-remove" );
			}
		}
	});
	
	
	// Validation for Username
	$("#username").focusout(function() {
		if($("#username").val().length == "" || $("#username").val().length < 5 || $("#username").val().length > 32) {
			$( "#usernameclassdiv" ).removeClass( "has-success" ).addClass( "has-error" );
			$( "#usernameclassspan" ).removeClass( "glyphicon-ok" ).addClass( "glyphicon-remove" );
		}
		else {
			$( "#usernameclassdiv" ).removeClass( "has-error" ).addClass( "has-success" );
			$( "#usernameclassspan" ).removeClass( "glyphicon-remove" ).addClass( "glyphicon-ok" );
		}
	});

});
</script>

<?php

	require_once "includes/footer.php";

?>