<?php
    //selects appropriate sidebar menu according to current parent directory
    switch (get_parent_dir()) {
        case 'students':
        ?>
            <ul id="sidebarMenu">
                <li class="menuItem"><a href="index.php">Student List</a></li>
                <li class="menuItem"><a href="editStudent.php?context=add&return=1">Add New Student</a></li>
            </ul>
        <?php
            break;
        default:
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
    }
?>