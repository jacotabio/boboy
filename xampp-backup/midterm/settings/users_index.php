
<div id="subsub-navigation">
    <ul>
        <li><a href="index.php?mod=settings&sub=users&pro=new">Add User</a></li>
        <li><a href="index.php?mod=settings&sub=users&pro=list">Users list</a></li>
    </ul>
</div>
<div id="subsub-content">
<div class="wrapper">
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
</div>
