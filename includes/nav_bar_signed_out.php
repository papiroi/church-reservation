<?php
	if(! isset($_SESSION['code'])) {

		exit("Direct Script Not Allowed!");

	}

/*
* This is a navigation bar to display if,
* it has no user logged in on website
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
				<a class="navbar-brand hidden-lg hidden-md hidden-sm" href="javascript: void(0)">Menu</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">
						<span class="glyphicon glyphicon-home"></span> 
						<strong>Home</strong>
						</a>
                    </li>
                   <li class="dropdown">
                        <a href="javascript: void(0)" class="dropdown-toggle" data-toggle="dropdown"><strong>Services<span class="caret"></span></strong></a>
						
						<ul class="dropdown-menu">
						
							<li class="menu-dropdown"><a href="services.php?services=baptism">Baptism</a></li>
							
							<li><a href="services.php?services=confirmation">Confirmation</a></li>
							
							<li><a href="services.php?services=funeral">Funeral</a></li>
							
							<!-- Start Submenu -->
							
							<li>
							
								<a href="javascript: void(0)">Seminars</a>
								<ul>
									<li class="sub-menu1"><a href="services.php?services=forconfirmation">For Confirmation</a></li>
									
									<li class="sub-menu1"><a href="services.php?services=forwedding">For Wedding</a></li>
								</ul>
								
							</li>
							
							<!-- End of Submenu -->
							
							<li><a href="services.php?services=wedding">Wedding</a></li>
							
							<?php
								$select_event = "SELECT * FROM events";
								$select_event_query = $conn->query($select_event);
								
								$separator = 0;
								
								while($e = $select_event_query->fetch_assoc()) {
									
									if($e['code'] == 'Baptism' || $e['code'] == 'Confirmation' || $e['code'] == 'Funeral' || 
									$e['code'] == 'For Confirmation' || $e['code'] == 'For Wedding' || $e['code'] == 'Wedding') {
										
										// Nothing to do here
										
									}
									else {
										
										if($separator == 0) {
											echo "<li class='divider'></li>";
											$separator = 1;
										}
										
										echo "<li><a href='services.php?services=" . $e['code'] . "'>" . $e['name'] . "</a></li>";
										
									}
									
								}
							
							?>
							
						</ul>
                    </li>
                     <li class="dropdown">
                        <a href="javascript: void(0)" class="dropdown-toggle" data-toggle="dropdown"><strong>About<span class="caret"></span></strong></a>
						
						<ul class="dropdown-menu">
						
							<!--
							<li class=""><a href="about.php?about=history">History of Cathedral</a></li>
							
							<li><a href="about.php?about=diocese">Diocese of Tarlac</a></li>
							
							<li><a href="about.php?about=orgchart">Organizational Chart</a></li>
							
							<li><a href="about.php?about=masssched">Mass Schedule</a></li>
							
							<li><a href="about.php?about=priestsched">Priest Schedule</a></li>
							-->
							<?php
							
								$select_about = "SELECT * FROM about ORDER BY title ASC";
								$select_about_query = $conn->query($select_about);
								
								while ($a_row = $select_about_query->fetch_assoc()) {
								
									echo "<li><a href='about.php?about=" . $a_row['code'] . "'>" . $a_row['title'] . "</a></li>";
								
								}
							
							?>
							
							<li class="divider"></li>
							<li><a href="about.php?about=priests">Priests Informaiton</a></li>
						</ul>
                    </li>
					
					<li id="user-position"><a href="#">
						Welcome Guest!!!
					</a></li>
					
					
				
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>