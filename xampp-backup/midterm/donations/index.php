<div id="sub-navigation">
<ul>
    <li><a href="index.php?mod=donations&sub=overview">Overview</a></li>
    <li><a href="index.php?mod=donations&sub=donate">Donate</a></li>
    <li><a href="index.php?mod=donations&sub=sponsors">Donors</a></li>
</ul>
</div>
<div id="sub-content">
    <?php
        switch($sub){
            case 'overview':
                require_once 'overview_index.php';
                break;
            case 'donate':
                require_once 'donate_index.php';
                break;
            case 'sponsors':
              require_once 'sponsor_index.php';
              break;
        }
    ?>
</div>
