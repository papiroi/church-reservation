<?php
	if(! isset($_SESSION['code'])) {

		exit("Direct Script Not Allowed!");

	}

/*
* include connection string
*/
	include "includes/connect.php";
	
	$unread = '0';
	
	$count_unread = "SELECT * FROM messages WHERE receiver='admin' AND status='0'";
	$q_count_unread = $conn->query($count_unread);
	
	if($q_count_unread->num_rows > 0) {
		$unread = $q_count_unread->num_rows;
	}
	
	
/*
* This is a navigation bar to in admin menu nav bar
*
*/

?>	

	<!-- Navigation -->
    <nav class="navbar navbar-default navbar-inverse" role="navigation">
        <div class="">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
				<a class="navbar-brand hidden-lg hidden-md" href="#">Menu</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">
						<!---<span class='glyphicon glyphicon-home'></span>-->
						<strong>Home</strong>
						</a>
                    </li>
					<li>
						<a href="reservations.php"><strong>Request Reservations</strong></a>
					</li>
					<li>
						<a href="confirmed_reserve.php"><strong>Confirmed Reservations</strong></a>
					</li>
                    <li>
						<a href="edit_announcement.php"><strong>Edit Announcement</strong></a>
                    </li>
                    </li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><strong>Messages
						<span class="label label-danger label-as-badge"><?php echo $unread; ?></span>
						<span class="caret"></span></strong></a>
					
						<ul class="dropdown-menu">
							<li class="menu-dropdown"><a href="compose_message.php">Compose Message</a></li>
							<li><a href="inbox.php">Inbox
							<span class="label label-danger label-as-badge"><?php echo $unread; ?></span></a></li>
							<li><a href="sent_messages.php">Sent Items</a></li>
							<li><a href="draft.php">Draft</a></li>
						</ul>
					</li>
					<li>
						<a href="?s=logout"><strong>Logout</strong></a>
					</li>
				
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
	