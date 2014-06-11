<?php
	get_header();
?>
		<div id="contentWrapper" class="tableArea">
			<div id="content" class="tableRow">
				<div id="sidebar" class="tableCell">
					<?php get_sidebar();?>
				</div>
				<div id="main" class="tableCell">
					<?php 
						$sql = '
							SELECT
								studentID,
								studentFirst as "First Name",
								studentLast as "Last Name",
								studentAddress as "Address",
								studentCity as "City",
								studentST as "ST",
								studentZIP as "ZIP",
								studentPhone1 as "Phone 1",
								studentEmail1 as "Email 1"
							FROM
								students
							ORDER BY studentLast, studentFirst;
						';
						display_table($sql,'students');
					?>
				</div>
			</div>
		</div>
<?php //markup continues on footer.php ?>