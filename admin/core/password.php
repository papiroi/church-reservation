<?php
	if(! isset($_SESSION['code'])) {

		exit("Direct Script Not Allowed!");

	}

/*
* Changin password Functions
*
*/

class Password {
	
	public $conn;
	public $username;
	public $old_password;
	public $new_password;
	
	
	public function __construct($c, $u, $op, $np) {
	
		$this->conn = $c;
		$this->username = $u;
		$this->old_password = sha1($op);
		$this->new_password = sha1($np);
	
	}
	
	
	public function changePassword() {
	
		$user_query = "SELECT * FROM users WHERE username = '$this->username' LIMIT 1";
		
		$change_query = "UPDATE users SET password = '$this->new_password', recovery = '$this->new_password', dateLastMod = NOW() WHERE username = '$this->username'";
		
		$user_query_result = $this->conn->query($user_query);
		
		
		if($user_query_result) {
			
			while($user_row = $user_query_result->fetch_assoc()) {
			
				$password = $user_row['password'];
			
			}
			
			if($this->old_password === $password) {
				$change_query_result = $this->conn->query($change_query);
				
				if($change_query_result) {
					// Change Password Successful
					echo "<span class='ok-message'>Password Change Successful!</span>";

				}
				else {
					echo "<span class='error-message'>Password Not Change! Try Again Later</span>";
				}
			}
			else {
				
				echo "<span class='error-message'>You entered wrong password!</span>";
				
			}
			
		}
		else {
			// Nothing to do here\
			echo "<span class='error-message'>User Query Error!</span>";
		}
		
		
	}


}