<div id="subsub-navigation">
    <ul>
        <li><a href="index.php?mod=donations&sub=sponsors&pro=newsponsor">Add Donor</a></li>
    </ul>
</div>
<div id="subsub-content">
    <div class="wrapper">
    <?php
        switch($process){
            case 'newsponsor':
                require_once 'sponsor_new.php';
                break;
            case 'profile':
                require_once 'sponsor_profile.php';
                break;
            default:
                require_once 'sponsor_list.php';
                break;
        }
    ?>
    </div>
</div>