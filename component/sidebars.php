<?php
	//selects appropriate sidebar menu according to current parent directory
	switch (get_parent_dir()) {
		case 'dashboard':
			?>
			<ul id="sidebarMenu">
				<li class="menuItem"><a href="#">Menu Item 1</a></li>
				<li class="menuItem"><a href="#">Menu Item 2</a>
					<ul>
						<li class="subItem"><a href="#">Submenu Item 1</a></li>
						<li class="subItem"><a href="#">Submenu Item 2</a></li>
					</ul>
				</li>
				<li class="menuItem"><a href="#">Menu Item 2</a></li>
			</ul>
			<?php
			break;
	}
?>