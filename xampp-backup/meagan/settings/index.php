<div id="sub-navigation">
<ul>
    <li><a href="index.php?mod=settings&sub=users">User Management</a></li>
    <li><a href="index.php?mod=settings&sub=system">System Management</a></li>
</ul>
</div>
<div id="sub-content">
    <?php
        switch($sub){
            case 'users':
                require_once 'users_index.php';
            break;
        }
    ?>
</div>