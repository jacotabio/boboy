<div id="subsub-navigation">
    <ul>
        <li><a href="index.php?mod=settings&sub=users&pro=new">New User</a></li>
        <li><a href="index.php?mod=settings&sub=users&pro=list">System Users</a></li>
    </ul>
</div>
<div id="subsub-content">
    <?php
        switch($process){
            case 'new';
              require_once 'users_new.php';
              break;
            case 'list';
              require_once 'users_list.php';
              break;
        }
    ?>
</div>
