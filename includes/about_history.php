			<?php
			
				$fetch_history = "SELECT * FROM about WHERE code = 'history'";
				$fetch_history_query = $conn->query($fetch_history);
				
				while($h_row = $fetch_history_query->fetch_assoc()) {
					
					$title = $h_row['title'];
					$description = $h_row['description'];
				
				}
			
			?>
			
			<h1 class="white-text"><?php echo @$title; ?></h1>
			<p class="white-text"><?php echo @$description; ?></p>