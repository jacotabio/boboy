<div id="subsub-navigation">
    <ul>
        <li><a href="index.php?mod=settings&sub=users&pro=new">New User</a></li>
        <li><a href="index.php?mod=settings&sub=users&pro=system">System Users</a></li>
    </ul>
</div>
<div id="subsub-content">
    <?php
        switch($process){
            case 'new';
                require_once 'users_new.php';
            break;
			case 'system';
				require_once 'users_system.php';
			break;
        }
    ?>
</div>