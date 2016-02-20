
<div class="modal fade" id="<?php echo $q_row['convID']; ?>" role="dialog">
	<div class="modal-dialog">
    
		<!-- Modal content-->
		<div class="modal-content modal-text">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Message ID: <?php echo $q_row['convID']; ?></h4>
			</div>
			<div class="modal-body">
			  <p><b>From:</b> <?php echo $q_row['sender']; ?></p>
			  <p><b>Message:</b> <?php echo $q_row['Content']; ?></p>
			  <p><b>Date and Time:</b> <?php echo $q_row['dateSent']; ?></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
      
	</div>
</div>