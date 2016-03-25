	</div>
			<h3 class="white-text">Registration Form</h3>
			<form autocomplete="off" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
				
				<div id="firstnameclassdiv" class="form-group has-feedback">
				<label for="firstname">First Name:</label>
				<input type="text" name="firstname" id="firstname" class="form-control input-width" 
					placeholder="First Name" title="First Name Field is Required!" value="<?php echo @$ret_fname; ?>"
					required autofocus />
				<span id="firstnameclassspan" class="glyphicon form-control-feedback"></span>
				</div>
				
				<br/>
				
				<div id="lastnameclassdiv" class="form-group has-feedback">
				<label for="lastname">Lastname:</label>
				<input type="text" name="lastname" id="lastname" class="form-control input-width" 
					placeholder="Last Name" title="Lastname is Required!" value="<?php echo @$ret_lname; ?>" required/>
				<span id="lastnameclassspan" class="glyphicon form-control-feedback"></span>
				</div>
				
				<br/>
				
				<div id="mobileclassdiv" class="form-group has-feedback">
				<label for="mobile">Mobile Number:</label><i> 11 Digit Number</i>
				<input type="number" name="mobile" id="mobile" class="form-control input-width" 
					placeholder="Mobile Number" title="Mobile Number is Required!" value="<?php echo @$ret_mobile; ?>" required/>
				<span id="mobileclassspan" class="glyphicon form-control-feedback"></span>
				</div>
				
				<br/>
				
				<div id="emailclassdiv" class="form-group has-feedback">
				<label for="email">Email:</label><?php echo @$email_error; ?>
				<input type="email" name="email" id="email" class="form-control input-width" 
					placeholder="Email Address" title="Email Address is Required!" value="" required/>
				<span id="emailclassspan" class="glyphicon form-control-feedback"></span>
				</div>
				
				<br/>
				
				<div id="addressclassdiv" class="form-group has-feedback">
				<label for="address">Address:</label>
				<input type="text" name="address" id="address" class="form-control input-width" 
					placeholder="Address" title="Address is Required" value="<?php echo @$ret_address; ?>" required/>
				<span id="addressclassspan" class="glyphicon form-control-feedback"></span>
				</div>
				
		</div>
		</div>
		<div class="col-md-5">
			<div class="center-div">
			
			<br/><br/>
			
			<div id="bdayclassdiv" class="form-group has-feedback">
				<label for="birthday">Birthday:</label>
				<input type="text" name="birthday" id="birthday" value="<?php echo @$ret_bday; ?>" class="form-control" required/>
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