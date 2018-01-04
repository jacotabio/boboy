<div id="sub-navigation">
<ul>
    <li><a href="index.php?mod=food&sub=dishmanagement">Dish Management</a></li>
    <li><a href="index.php?mod=food&sub=foodmenusettings">Food Menu Settings</a></li>
</ul>
</div>
<div id="sub-content">
    <?php
        switch($sub){
            case 'dishmanagement':
                require_once 'dishmanagement_index.php';
                break;
            case 'foodmenusettings':
              require_once 'foodmenu_index.php';
              break;
        }
    ?>
</div>
