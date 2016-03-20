<?php
	if(! isset($_SESSION['code'])) {

		exit("Direct Script Not Allowed!");

	}

?>
<table class="table">
	<tr>
		<th>Message</th>
		<th>Date Modified</th>
		<th colspan='2' class='text-center'>Operation</th>
	</tr>
<?php

	
	
	$select_draft = "SELECT * FROM messages WHERE sender='$username' AND category ='Draft' ORDER BY dateSent DESC";
	
	$q_select_draft = $conn->query($select_draft);
	
	if($q_select_draft->num_rows > 0) {
		
		while($q_row = $q_select_draft->fetch_assoc()) {
		
			echo "<tr>";
			echo "<td>" . $q_row['Content'] . "</td>";
			echo "<td>" . $q_row['dateSent'] . "</td>";
			
			echo "<td>";
			echo "<form action='rewrite_draft.php' method='post'>";
			echo "<input type='hidden' name='id' value='" . $q_row['convID'] . "' />";
			echo "<input type='submit' value='Use Draft' class='btn btn-primary' />";
			echo "</form>";
			echo "</td>";
			echo "<td>";
			echo "<form action='delete_draft.php' method='post'>";
			echo "<input type='hidden' name='conv' value='" . $q_row['convID'] . "' />";
			echo "<input type='submit' value='Delete' class='btn btn-danger' />";
			echo "</form>";	
			echo "</td>";
			
			echo "</tr>";
		}
	}
	else {
	
		echo "<i>No Draft Message</i>";
	
	}

?>
</table>