<form action="reply_sent.php" method="post">

	<input type="hidden" name="sender_reply" value="<?php echo $sender;?>"/> 
	<input type="hidden" name="id" value="<?php echo $messageID; ?>" />
	<textarea name="reply_message" rows="5" class="form-control"></textarea>
	<br/>
	<input type="submit" value="Send" class="btn btn-primary"/>
	&nbsp;&nbsp;
	<input type="reset" value="clear" class="btn btn-danger"/>
</form>