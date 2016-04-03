<?php 
	$select_ = "SELECT * FROM events WHERE code = 'Confirmation'";
	$select_query = $conn->query($select_);
	
	if($select_query->num_rows > 0) {
		
		while($row = $select_query->fetch_assoc()) {
			$name = $row['name'];
			$description = $row['description'];
			$reminder = $row['reminder'];
		}
		
	}
	else {
		
		echo "Error Fetching Data From The Server!";
		
	}
?>

			<h1 class="white-text"><?php echo @$name; ?></h1>
			<div class="row">
			<div class="col-md-6">
			<div class="boxed">
				<p class="white-text"><?php echo @$description; ?></p>
			</div>
			</div>
			<div class="col-md-6">
			<div class="boxed">
				<p><?php echo @$reminder; ?></p>
			</div>
			</div>
			</div>