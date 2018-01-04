<?php
if(!$user->get_access()){
    header("location: index.php");
}
?>
<div id="sub-navigation">
<ul>
    <li><a href="index.php?mod=settings&sub=users">User Settings</a></li>
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
