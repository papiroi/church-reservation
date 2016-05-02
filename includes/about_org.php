			<?php
			
				$fetch_org = "SELECT * FROM about WHERE code = 'orgchart'";
				$fetch_org_query = $conn->query($fetch_org);
				
				while($o_row = $fetch_org_query->fetch_assoc()) {
					
					$title = $o_row['title'];
					$description = $o_row['description'];
				
				}
			
			?>
			
			<h1 class="white-text"><?php echo @$title; ?></h1>
			<p class="white-text"><?php echo nl2br($description, false); ?></p>