<?php
	if(! isset($_SESSION['code'])) {

		exit("Direct Script Not Allowed!");

	}

/*
* include connection string 
* $conn
*/
	include "includes/connect.php";

?>
<table class="table ">
	<tr>
		<th>Sender</th>
		<th>Message</th>
		<th>Date Send</th>
		<th> </th>
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
	
	
	$select_sent = "SELECT * FROM messages WHERE receiver='$username' AND category ='Sent' ORDER BY dateSent DESC";
	
	$q_select_sent = $conn->query($select_sent);
	
	if($q_select_sent->num_rows > 0) {
		
		while($q_row = $q_select_sent->fetch_assoc()) {
		

		
			echo "<form action='reply.php' method='post'>";
		
		
			echo "<input type='hidden' name='conversation' value='" . $q_row['MessageID'] . "'";
			
			echo "<tr>";
			echo "<td>" . $q_row['sender'] . "</td>";
			echo "<td>" . mb_substr($q_row['Content'],0,15) . "...</td>";
			echo "<td>" . $q_row['dateSent'] . "</td>";
			echo "<td><input type='submit' value='View/Reply' class='btn btn-warning'</td>";
			echo "</tr>";
			echo "</form>";
		}
	}
	else {
	
		echo "<i>No Sent Message for this User.</i>";
	
	}

?>
</table>