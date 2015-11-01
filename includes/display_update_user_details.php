<?php
	if(! isset($_SESSION['code'])) {

		exit("Direct Script Not Allowed!");

	}
 
?>
<!--
Update User Details Form
-->
<div class="row">
	<div class="col-md-5">
		<!--
		<div class="center-div">
		</div>
		-->
		
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
		<div class="center-div">
			<h3 class="white-text">Update Form</h3>
		<!-- Start of Fields -->
			<div id="firstnameclassdiv" class="form-group has-feedback">
			<label for="firstname">First Name:</label>
			<input type="text" name="firstname" id="firstname" class="form-control input-width" 
				placeholder="First Name" title="First Name Field is Required!" required/>
			<span id="firstnameclassspan" class="glyphicon form-control-feedback"></span>
			</div>
			
			<br/>
			
			<div id="lastnameclassdiv" class="form-group has-feedback">
			<label for="lastname">Lastname:</label>
			<input type="text" name="lastname" id="lastname" class="form-control input-width" 
				placeholder="Last Name" title="Lastname is Required!" required/>
			<span id="lastnameclassspan" class="glyphicon form-control-feedback"></span>
			</div>
			
			<br/>
			
			<div id="mobileclassdiv" class="form-group has-feedback">
			<label for="mobile">Mobile Number:</label><i> 11 Digit Number</i>
			<input type="number" name="mobile" id="mobile" class="form-control input-width" 
				placeholder="Mobile Number" title="Mobile Number is Required!" required/>
			<span id="mobileclassspan" class="glyphicon form-control-feedback"></span>
			</div>
			
			<br/>
			
			<div id="emailclassdiv" class="form-group has-feedback">
			<label for="email">Email:</label>
			<input type="email" name="email" id="email" class="form-control input-width" 
				placeholder="Email Address" title="Email Address is Required!" required/>
			<span id="emailclassspan" class="glyphicon form-control-feedback"></span>
			</div>
			
			<br/>
			
			<div id="addressclassdiv" class="form-group has-feedback">
			<label for="address">Address:</label>
			<input type="text" name="address" id="address" class="form-control input-width" 
				placeholder="Address" title="Address is Required" required/>
			<span id="addressclassspan" class="glyphicon form-control-feedback"></span>
			</div>
			
			<br/>
			
			<div id="bdayclassdiv" class="form-group has-feedback">
			<label for="bday">Birthday:</label>
			<input type="date" name="bday" id="bday" class="form-control input-width" 
				placeholder="YYYY-MM-DD" required/>
			<span id="bdayclassspan" class="glyphicon form-control-feedback"></span>
			</div>
			
			<br/>
			
			<div id="usernameclassdiv" class="form-group has-feedback">
			<label for="username">Username:</label>
			<input type="text" name="username" id="username" class="form-control input-width" 
				placeholder="Username" pattern=".{4,32}" required maxlength="32" min="5"
				title="It must be a minimum of 4 characters and a maximum of 32 characters!"/>
			<span id="usernameclassspan" class="glyphicon form-control-feedback"></span>
			</div>
				
			<br/>
				
		
		</div>
	
		<!--
		<div class="center-div">
		</div>
		-->
		
		</form>
	</div>
	
	<div class="col-md-7"></div>

</div>


<script>
$(document).ready(function() {
	alert("adam");
	/*
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
	*/
});
</script>