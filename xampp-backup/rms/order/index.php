<div id="sub-navigation">
<ul>
    <li><a href="index.php?mod=order&sub=tablemanagement">Table Management</a></li>
    <li><a href="index.php?mod=order&sub=ordermanagement">Order Management</a></li>
</ul>
</div>
<div id="sub-content">
    <?php
        switch($sub){
            case 'tablemanagement':
                require_once 'tablemanagement_index.php';
                break;
            case 'ordermanagement':
              require_once 'ordermanagement_index.php';
              break;
        }
    ?>
</div>
