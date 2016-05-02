			<?php
			
				$fetch_diocese = "SELECT * FROM about WHERE code = 'diocese'";
				$fetch_diocese_query = $conn->query($fetch_diocese);
				
				while($d_row = $fetch_diocese_query->fetch_assoc()) {
					
					$title = $d_row['title'];
					$description = $d_row['description'];
				
				}
			
			?>
			
			<h1 class="white-text"><?php echo @$title; ?></h1>
			<p class="white-text"><?php echo nl2br($description, false); ?></p>