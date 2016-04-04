<?php
	if(! isset($_SESSION['code'])) {

		exit("Direct Script Not Allowed!");

	}

	
?>

<div class="">

	<h3>User Limitations</h3>
	
<?php
	
	$limit = "SELECT * FROM limitations";
	$limit_query = $conn->query($limit);
	
	if($limit_query->num_rows > 0 ) {
		
		//echo "Found Limitations.";
		while($lrow = $limit_query->fetch_assoc()) {
			
			echo "<li>" . $lrow['limitation'] . "</li>";
			
		}
		
	}
	else {
		
		echo "User Limitations Data Not Found!<br/>";
		echo "Please contact your administrator.";
		
	}

?>
</div>