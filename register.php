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
	
/*
* Check if session username or name of the logged in user isset
* if not Guest User 
*/

	if(isset($_SESSION['username']) && !empty($_SESSION['username'])) {
		$username = $_SESSION['username'];;
	}
	else {
		$username = "Guest";
	}

?>


<!DOCTYPE html>
<html class="full" lang="en-US">
<head>
	<title>Registration - Scheduling and Reservation System for Tarlac San Sebastian Cathedral Parish</title>
	
<?php

	require_once "includes/head_include.php";

?>
	
	<!-- Custom CSS for Background Image for this page -->
	<link rel="stylesheet" href="css/background-image.css" />
	
</head>
<body>
	<div class="container">
		<h1 class="text-center white-text">Scheduling and Reservation System for Tarlac San Sebastian Cathedral Parish</h1>

<!-- Start of Navigation Bar -->
<?php
/*
* This will show navigation bar menu if there is signed in user or not
*
*/

	if(isset($_SESSION['username']) && !empty($_SESSION['username'])) {
		
		require_once "includes/nav_bar_signed_in.php";
	
	}
	else {
	
		require_once "includes/nav_bar_signed_out.php";
	
	}
?>
<!-- End of Navigation Bar -->

		<div class="row">
		<div class="col-md-5">
		<div class="center-div">
		<span class="error_message">
<!-- Start of PHP Code in Registration -->
<?php
	if(isset($_POST['username']) && !empty($_POST['username'])) {

		// Include Database Connection String
		require_once "includes/connect.php";
	
		// Include Validation/Sanitation Class
		require_once "core/validation.php";
		
		// Set Variable Holders and other Operations
		
		$firstname = stripslashes($_POST['firstname']);
		$lastname = stripslashes($_POST['lastname']);
		$mobile = stripslashes($_POST['mobile']);
		$email = stripslashes($_POST['email']);
		$address = stripslashes($_POST['address']);
		$bday = stripslashes($_POST['birthday']);
		$username = stripslashes($_POST['username']);
		$password = sha1(stripslashes($_POST['password']));
		
		// Include Registration Class
		require_once "core/registration.php";
		
		// Check if the user that are registering is 18 years old and beyond
		// if the user is below 18 years old he/she will not be able to create account
		// because in able for you to reserve an event you need to be 18 years old
		// This function Calculates the age of the user 
		// The DateTime::diff() works on php ver 5.3.0 and up
		/* Start of DateTime::diff() function
		function ageCalculator($dob){
			if(!empty($dob)){
				$birthdate = new DateTime($dob);
				$today   = new DateTime('today');
				$age = $birthdate->diff($today)->y;
				return $age;
			}else{
				return 0;
			}
		}
		*/ 
		// Age of the User
		//$age = ageCalculator($bday);
		
		
		// Condition if the user is 18 years old and above
		// if not the user cannot register
		//if($age > 17 ) {
			
			// Writing User Registration Information to the Database
			$reg = new Registration($conn, $firstname, $lastname, $mobile, $email, $address, $bday, $username, $password);
		
			echo $reg -> register();
			
		//}
		//else {
			
			//echo "<script>";
			//echo "alert('You are below 18 years old!')";
			//echo "</script>";
			
		//}
	}
	else {
		// Nothing to do here just run the page as is
	}

?>
<!-- End of PHP Code in Registration -->
			</span>
			<h3 class="white-text">Registration Form</h3>
			<form autocomplete="off" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
				
				<div id="firstnameclassdiv" class="form-group has-feedback">
				<label for="firstname">First Name:</label>
				<input type="text" name="firstname" id="firstname" class="form-control input-width" 
					placeholder="First Name" title="First Name Field is Required!" value="" required/>
				<span id="firstnameclassspan" class="glyphicon form-control-feedback"></span>
				</div>
				
				<br/>
				
				<div id="lastnameclassdiv" class="form-group has-feedback">
				<label for="lastname">Lastname:</label>
				<input type="text" name="lastname" id="lastname" class="form-control input-width" 
					placeholder="Last Name" title="Lastname is Required!" value="" required/>
				<span id="lastnameclassspan" class="glyphicon form-control-feedback"></span>
				</div>
				
				<br/>
				
				<div id="mobileclassdiv" class="form-group has-feedback">
				<label for="mobile">Mobile Number:</label><i> 11 Digit Number</i>
				<input type="number" name="mobile" id="mobile" class="form-control input-width" 
					placeholder="Mobile Number" title="Mobile Number is Required!" value="" required/>
				<span id="mobileclassspan" class="glyphicon form-control-feedback"></span>
				</div>
				
				<br/>
				
				<div id="emailclassdiv" class="form-group has-feedback">
				<label for="email">Email:</label>
				<input type="email" name="email" id="email" class="form-control input-width" 
					placeholder="Email Address" title="Email Address is Required!" value="" required/>
				<span id="emailclassspan" class="glyphicon form-control-feedback"></span>
				</div>
				
				<br/>
				
				<div id="addressclassdiv" class="form-group has-feedback">
				<label for="address">Address:</label>
				<input type="text" name="address" id="address" class="form-control input-width" 
					placeholder="Address" title="Address is Required" value="" required/>
				<span id="addressclassspan" class="glyphicon form-control-feedback"></span>
				</div>
				
		</div>
		</div>
		<div class="col-md-5">
			<div class="center-div">
			
			<br/><br/>
			
			<div id="bdayclassdiv" class="form-group has-feedback">
				<label for="birthday">Birthday:</label>
				<input type="text" name="birthday" id="birthday" class="form-control" required/>
				<span id="bdayclassspan" class="glyphicon form-control-feedback"></span>
				</div>
				
				<br/>
				
				<div id="usernameclassdiv" class="form-group has-feedback">
				<label for="username">Username:</label>
				<input type="text" name="username" id="username" class="form-control input-width" 
					placeholder="Username" pattern=".{4,32}" value="" required maxlength="32" min="5"
					title="It must be a minimum of 4 characters and a maximum of 32 characters!"/>
				<span id="usernameclassspan" class="glyphicon form-control-feedback"></span>
				</div>
				
				<br/>
				
				<div id="passwordclassdiv" class="form-group has-feedback">
				<label for="password">Password:</label>
				<input type="password" name="password" id="password" class="form-control input-width" 
					placeholder="Password" pattern=".{8,32}" value="" required maxlength="32" min="8"
					title="Password must not be a minimum of 8 characters and a maximum of 32!"/>
				<span id="passwordclassspan" class="glyphicon form-control-feedback"></span>
				</div>
				
				<br/>
				
				<div id="password2classdiv" class="form-group has-feedback">
				<label for="password2">Re-Enter Password:</label>
				<input type="password" name="password2" id="password2" class="form-control input-width" 
					placeholder="Re-Type Password" pattern=".{8,32}" value="" required maxlength="32"
					title="Must be the same as the first password you enter!"/>
				<span id="password2classspan" class="glyphicon form-control-feedback"></span>
				</div>
				
				<br/>
				
				<input type="submit" value="Register" class="btn btn-primary form-control input-width"/>
			
			</form>
			<br/><br/>
			<span class="white-text">Already Have an Account? Click <a href="login.php">here</a>.</span>
			<br/>
			<a href="index.php"><span class="white-text">Return to Home Page</span></a>
			
			</div>
		
		</div>
		<div class="col-md-2"></div>
	
	</div>
	</div>
	<?php
		include "includes/include_contacts.php";
	?>
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
	$("#firstname").keyup(function() {
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
	$("#lastname").keyup(function() {
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
		if($("#mobile").val().length == "" || $("#mobile").val().length < 11  || $("").val().length > 11) {
			$( "#mobileclassdiv" ).removeClass( "has-success" ).addClass( "has-error" );
			$( "#mobileclassspan" ).removeClass( "glyphicon-ok" ).addClass( "glyphicon-remove" );
		}
		else {
			$( "#mobileclassdiv" ).removeClass( "has-error" ).addClass( "has-success" );
			$( "#mobileclassspan" ).removeClass( "glyphicon-remove" ).addClass( "glyphicon-ok" );
		}
	});
	$("#mobile").keyup(function() {
		if ($("#mobile").val().length > 11 || $("#mobile").val().length == "" || $("#mobile").val().length < 11 ) {
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
	$("#email").keyup(function() {
		
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
	
	// Validation for Address
	$("#address").focusout(function() {
		if($("#address").val().length == "" || $("#address").val().length < 4 ) {
			$( "#addressclassdiv" ).removeClass( "has-success" ).addClass( "has-error" );
			$( "#addressclassspan" ).removeClass( "glyphicon-ok" ).addClass( "glyphicon-remove" );
		}
		else {
			$( "#addressclassdiv" ).removeClass( "has-error" ).addClass( "has-success" );
			$( "#addressclassspan" ).removeClass( "glyphicon-remove" ).addClass( "glyphicon-ok" );
		}
	});
	$("#address").keyup(function() {
		if($("#address").val().length == "" || $("#address").val().length < 4 ) {
			$( "#addressclassdiv" ).removeClass( "has-success" ).addClass( "has-error" );
			$( "#addressclassspan" ).removeClass( "glyphicon-ok" ).addClass( "glyphicon-remove" );
		}
		else {
			$( "#addressclassdiv" ).removeClass( "has-error" ).addClass( "has-success" );
			$( "#addressclassspan" ).removeClass( "glyphicon-remove" ).addClass( "glyphicon-ok" );
		}
	});

	// Validation for Username
	$("#username").focusout(function() {
		if($("#username").val().length == "" || $("#username").val().length < 3 || $("#username").val().length > 32) {
			$( "#usernameclassdiv" ).removeClass( "has-success" ).addClass( "has-error" );
			$( "#usernameclassspan" ).removeClass( "glyphicon-ok" ).addClass( "glyphicon-remove" );
		}
		else {
			$( "#usernameclassdiv" ).removeClass( "has-error" ).addClass( "has-success" );
			$( "#usernameclassspan" ).removeClass( "glyphicon-remove" ).addClass( "glyphicon-ok" );
		}
	});
	$("#username").keyup(function() {
		if($("#username").val().length == "" || $("#username").val().length < 3 || $("#username").val().length > 32) {
			$( "#usernameclassdiv" ).removeClass( "has-success" ).addClass( "has-error" );
			$( "#usernameclassspan" ).removeClass( "glyphicon-ok" ).addClass( "glyphicon-remove" );
		}
		else {
			$( "#usernameclassdiv" ).removeClass( "has-error" ).addClass( "has-success" );
			$( "#usernameclassspan" ).removeClass( "glyphicon-remove" ).addClass( "glyphicon-ok" );
		}
	});	
	// Validation for Password
	$("#password").focusout(function() {
		if($("#password").val().length == "" || $("#password").val().length < 8) {
			$( "#passwordclassdiv" ).removeClass( "has-success" ).addClass( "has-error" );
			$( "#passwordclassspan" ).removeClass( "glyphicon-ok" ).addClass( "glyphicon-remove" );
		}
		else {
			$( "#passwordclassdiv" ).removeClass( "has-error" ).addClass( "has-success" );
			$( "#passwordclassspan" ).removeClass( "glyphicon-remove" ).addClass( "glyphicon-ok" );
		}
	});
	
	// Validation for Password2
	$("#password2").focusout(function() {
		if($("#password2").val().length == "" || $("#password2").val().length < 8) {
			$( "#password2classdiv" ).removeClass( "has-success" ).addClass( "has-error" );
			$( "#password2classspan" ).removeClass( "glyphicon-ok" ).addClass( "glyphicon-remove" );
		}
		else {
			if($("#password2").val() == $("#password").val()) {
				$( "#password2classdiv" ).removeClass( "has-error" ).addClass( "has-success" );
				$( "#password2classspan" ).removeClass( "glyphicon-remove" ).addClass( "glyphicon-ok" );
			}
			else {
				$( "#password2classdiv" ).removeClass( "has-success" ).addClass( "has-error" );
				$( "#password2classspan" ).removeClass( "glyphicon-ok" ).addClass( "glyphicon-remove" );
			}
		}
	});

});
</script>

<?php

	require_once "includes/footer.php";

?>