<?php
	if(! isset($_SESSION['code'])) {

		exit("Direct Script Not Allowed!");

	}

?>
<table class="table">
	<tr>
		<th>Receipient</th>
		<th>Message</th>
		<th>Date Send</th>
		<th>Status</th>
		<th class="text-center">Operation</th>
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
			echo "<td><a class='white-text' href='javascript: void(0)'><span data-toggle='modal' data-target='#" . $q_row['receiver'] . "'>" . $q_row['receiver'] . "</span></a>";
			include "includes/show_sent_modal.php";
			echo "</td>";
			echo "<td>" . mb_substr($q_row['Content'],0,25) . "...</td>";
			echo "<td>" . $q_row['dateSent'] . "</td>";
			echo "<td>" . readUnread($q_row['status']) . "</td>";
			echo "<td class='text-center'>";
			echo "<form action='delete_msg.php' method='post'>";
			echo "<input type='hidden' name='conv' value='" . $q_row['convID'] . "'/>";
			echo "<input type='submit' value='Delete' class='btn btn-danger' />";
			echo "</form>";
			echo "</td>";
			echo "</tr>";
			
			
		}
	}
	else {
	
		echo "<i>No Sent Message for this User.</i>";
	
	}

?>
</table>