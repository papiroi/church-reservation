<?php
	if(! isset($_SESSION['code'])) {

		exit("Direct Script Not Allowed!");

	}

?>
<table class="table table-bordered">
	<tr>
		<th>MessageID</th>
		<th>Message</th>
		<th>Date Modified</th>
	</tr>
<?php

	
	
	$select_draft = "SELECT * FROM messages WHERE sender='$username' AND category ='Draft'";
	
	$q_select_draft = $conn->query($select_draft);
	
	if($q_select_draft->num_rows > 0) {
		
		while($q_row = $q_select_draft->fetch_assoc()) {
		
			echo "<tr>";
			echo "<td>" . $q_row['convID'] . "</td>";
			echo "<td>" . $q_row['Content'] . "</td>";
			echo "<td>" . $q_row['dateSent'] . "</td>";
			echo "</tr>";
		}
	}
	else {
	
		echo "<i>No Draft Message for this User.</i>";
	
	}

?>
</table>