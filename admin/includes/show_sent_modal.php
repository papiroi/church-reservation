
<div class="modal fade" id="<?php echo $q_row['convID']; ?>" role="dialog">
	<div class="modal-dialog">
    
		<!-- Modal content-->
		<div class="modal-content modal-text">
			<div class="modal-header">
			  <h4 class="modal-title">Message ID: <?php echo $q_row['convID']; ?></h4>
			</div>
			<div class="modal-body">
			  <p><b>Receipient:</b> <?php echo $q_row['receiver']; ?></p>
			  <p><b>Message:</b> <?php echo $q_row['Content']; ?></p>
			</div>
			<div class="modal-footer">
				<p>Click to Close</p>
			</div>
		</div>
      
	</div>
</div>