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
<table class="table">
<caption><span class="white-text"><i>Click on Sender to Show Details</i></span></caption>
	<tr>
		<th>Sender</th>
		<th>Message</th>
		<!--<th>Date Send</th>-->
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
		
			echo "<tr>";
			echo "<td><a class='white-text' href='javascript: void(0)'><span data-toggle='modal' data-target='#" . $q_row['MessageID'] . "'>" . $q_row['sender'] . "</span></a>";
			include "includes/show_inbox_modal.php";
			echo "</td>";
			echo "<td>" . $q_row['Content'] . "</td>";
			//echo "<td>" . $q_row['dateSent'] . "</td>";
			echo "</tr>";


		}
	}
	else {
	
		echo "<i>No Message for You.</i>";
	
	}
	
	
	
?>
</table>