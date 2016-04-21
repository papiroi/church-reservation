<?php
	if(! isset($_SESSION['code'])) {

		exit("Direct Script Not Allowed!");

	}

/*
* Update User Details Method
*
*/

class Update {

	public $conn;
	public $username;
	public $firstname;
	public $lastname;
	public $mobile;
	public $email;
	public $address;
	public $bday;

	
	public function __construct($c, $u, $fn, $ln, $mob, $email, $add, $bday) {
	
		$this->conn = $c;
		$this->username = $u;
		$this->firstname = $fn;
		$this->lastname = $ln;
		$this->mobile = $mob;
		$this->email = $email;
		$this->address = $add;
		$this->bday = $bday;
	
	}
	
	public function updateUser() {
	
	
		$update_query = "UPDATE users SET 
			firstName = '$this->firstname',
			lastName = '$this->lastname',
			mobile = '$this->mobile',
			email = '$this->email',
			address = '$this->address',
			bday = '$this->bday',
			dateLastMod = NOW()
			WHERE username = '$this->username'";
			
		$update_query_result = $this->conn->query($update_query);
		
		if($update_query_result) {
		
			echo "<div class='alert alert-success text-center'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				Successfully Updated Details!</div>";;
		
		}
		else {
		
			echo "<div class='error-message-div'><h2>Error in Updating Record!!!</h2></div>";
		
		}
	}

}