<?php
	if(! isset($_SESSION['code'])) {

		exit("Direct Script Not Allowed!");

	}
	
/*
* Validation Class
* This class' purpose is to validate and sanitize all input for users
* for security purposes, example: sql injections techniques
* This is server side validation
* The Values that will be validated and/or sanitized must be in parameter in intance
*/

class Validation {

	// Validation and/or Sanitation for Mobile Number
	public function mobilevs($mobile) {
	
		
	
		return $mobile;
	
	}
	
	// Validation and/or Sanitation for Email Address
	public function email($email) {
	
	
	
		return $email;
	
	}
	
	// Validation and/or Sanitation for Date
	public function datevs($date) {
	
	
	
		return $date;
	
	}
	
	// Validation and/or Sanitation Address
	public function addressvs($address) {
	
	
	
		return $address;
	
	}
	
	// Validation and/or Sanitation for Username
	public function usernamevs($username) {
	
	
	
		return $username;
	
	}
	
	// Validation and/or Sanitation for Passwords
	public function passwordvs($password,$password2) {
	
	
	
		return $password;
	
	}
	
	

}
	
	
?>