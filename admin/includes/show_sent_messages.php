<?php
	if(! isset($_SESSION['code'])) {

		exit("Direct Script Not Allowed!");

	}

?>
<table class="table table-bordered">
	<tr>
		<th>MessageID</th>
		<th>Message</th>
		<th>Date Send</th>
		<th>Receipient</th>
		<th>Status</th>
	</tr>
<?php
	/*
	* Function Read and Unread
	*/
	function readUnread($status) {
		if($status == '0') {
			return 'Unread';
		}
		if($status == '1') {
			return 'Read';
		}
	}
	
	
	$select_sent = "SELECT * FROM messages WHERE sender='$username' AND category ='Sent' ORDER BY dateSent DESC";
	
	$q_select_sent = $conn->query($select_sent);
	
	if($q_select_sent->num_rows > 0) {
		
		while($q_row = $q_select_sent->fetch_assoc()) {
		
			echo "<tr>";
			echo "<td><span data-toggle='modal' data-target='#" . $q_row['convID'] . "'>" . $q_row['convID'];
			include "includes/show_sent_modal.php";
			echo "</td>";
			echo "<td>" . $q_row['Content'] . "</td>";
			echo "<td>" . $q_row['dateSent'] . "</td>";
			echo "<td>" . $q_row['receiver'] . "</td>";
			echo "<td>" . readUnread($q_row['status']) . "</td>";
			echo "</tr>";
			
			
		}
	}
	else {
	
		echo "<i>No Sent Message for this User.</i>";
	
	}

?>
</table>