<?php
	if(! isset($_SESSION['code'])) {

		exit("Direct Script Not Allowed!");

	}
	
/*
* Registration Class
* This class performs all operations when you are registering
*
*/

class Registration {

	public $conn;
	public $firstname;
	public $lastname;
	public $mobile;
	public $email;
	public $address;
	public $bday;
	public $username;
	public $password;
	
	
	public function __construct($c, $fn, $ln, $mn, $e, $add, $bday, $u, $p) {
	
		$this->conn = $c;
		$this->firstname = $fn;
		$this->lastname = $ln;
		$this->mobile = $mn;
		$this->email = $e;
		$this->address = $add;
		$this->bday = $bday;
		$this->username = $u;
		$this->password = $p;
		
	}
	
	public function check_user($user,$email) {
	
		$check_query = "SELECT * FROM users WHERE username = '$user' OR email = '$email'";
		
		$check_query_result = $this->conn->query($check_query);
		
		if($check_query_result->num_rows > 0) {
			return true;
		}
		else {
			return false;
		}
	}
	
	public function register() {
	
		if($this->check_user($this->username,$this->email) == 'true') {
			echo "<span style='color: red; font-size: 25px;'>User Already Exists!</span>";
			
			//return false;
		}
		else {
			$reg_query = "INSERT INTO users (username, password, firstname, lastname, mobile, email, address, bday, status, recovery, dateReg)
				VALUES(
					'$this->username',
					'$this->password',
					'$this->firstname',
					'$this->lastname',
					'$this->mobile',
					'$this->email',
					'$this->address',
					'$this->bday',
					'Active',
					'$this->password',
					NOW()
				)";
	
			$reg_query_result = $this->conn->query($reg_query);
		
			if($reg_query_result) {
				// Successfull Creation of User
				
				return true;
				
			}
			else {
				echo "Error in Registration! Try Again Later.";
				
				return false;
			}
		}
	}
	
	// This method Generates 8 Random Characters to server as a recovery character in case 
	// That the user will forget the password or username
	public function recoveryStringGen() {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$length = 8;
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	
	// Activation Code Generator
	// 
	// 
	public function activationGen() {
	
	
	}

}
	
?>