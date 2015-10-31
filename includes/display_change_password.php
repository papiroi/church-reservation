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
	<div class="col-md-4"></div>
	<div class="col-md-4">
	
		<div class="center-div">

		
<?php	
/*
* This is the PHP Script to change the password
* 
*/
	if(isset($_POST['old_password']) && !empty($_POST['old_password'])) {
	
		// $username variable is already initialized and was declared a value
		// Variable Assignments
		$old_password = stripslashes($_POST['old_password']);
		$new_password = stripslashes($_POST['new_password']);
		$new_password2 = stripslashes($_POST['new_password2']);
		
		// Includes Connection String to Database Server
		// $conn variable is included
		require_once "includes/connect.php";
	
		// Include Password Changing Class
		require_once "core/password.php";
		
		if($new_password == $new_password2 && strlen($new_password) > 7) {
		
			$password_instance = new Password($conn, $username, $old_password, $new_password);
			
			$password_instance->changePassword();
			
		
		}
		else {
		
			echo "<span class='error-message'>New Password Not Matched or You have entered less than 8 characters!</span>";
		
		}
	}
	
	
/*
* Change Password Script End Here
*/
?>


			<h2 class="white-text">Change Password</h2>
			<form action="" method="post">
				
				<label for="old_password">Enter Old Password:</label>
				<input type="password" name="old_password" id="old_password" required autofocus class="form-control"/>
				<br/>
				
				<div id="newpasswordclassdiv" class="form-group has-feedback">
				<label for="new_password">Enter New Password:</label>
				<input type="password" name="new_password" id="new_password" required class="form-control"/>
				<span id="newpasswordclassspan" class="glyphicon form-control-feedback"></span>
				</div>
				
				<div id="newpassword2classdiv" class="form-group has-feedback">
				<label for="new_password2">Re-Enter New Password:</label>
				<input type="password" name="new_password2" id="new_password2" required class="form-control" />
				<span id="newpassword2classspan" class="glyphicon form-control-feedback"></span>
				</div>
				
				<br/>
				<br/>
				<input type="submit" value="Change Password" class="btn btn-primary form-control" />
			
			</form>
			<br/>
			<a href="index.php"><span class="white-text glyphicon glyphicon-home"> <strong>Home</strong></span></a>
		</div>

	</div>
	<div class="col-md-4"></div>
</div>


<script>
$(document).ready(function() {

	// Validation for New Password
	$("#new_password").keyup(function() {
	if($("#new_password").val().length == "" || $("#new_password").val().length < 8) {
			$( "#newpasswordclassdiv" ).removeClass( "has-success" ).addClass( "has-error" );
			$( "#newpasswordclassspan" ).removeClass( "glyphicon-ok" ).addClass( "glyphicon-remove" );
		}
		else {
			$( "#newpasswordclassdiv" ).removeClass( "has-error" ).addClass( "has-success" );
			$( "#newpasswordclassspan" ).removeClass( "glyphicon-remove" ).addClass( "glyphicon-ok" );
		}
	});
	
	// Validation for New Password2
	$("#new_password2").keyup(function() {
		if($("#new_password2").val().length == "" || $("#new_password2").val().length < 8) {
			$( "#newpassword2classdiv" ).removeClass( "has-success" ).addClass( "has-error" );
			$( "#newpassword2classspan" ).removeClass( "glyphicon-ok" ).addClass( "glyphicon-remove" );
		}
		else {
			if($("#new_password2").val() == $("#new_password").val()) {
				$( "#newpassword2classdiv" ).removeClass( "has-error" ).addClass( "has-success" );
				$( "#newpassword2classspan" ).removeClass( "glyphicon-remove" ).addClass( "glyphicon-ok" );
			}
			else {
				$( "#newpassword2classdiv" ).removeClass( "has-success" ).addClass( "has-error" );
				$( "#newpassword2classspan" ).removeClass( "glyphicon-ok" ).addClass( "glyphicon-remove" );
			}
		}
	});

});
</script>