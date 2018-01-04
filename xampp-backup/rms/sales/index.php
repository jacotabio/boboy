<div id="sub-navigation">
<ul>
    <li><a href="index.php?mod=sales&sub=monitor">Sales Monitoring</a></li>
	<li><a href="index.php?mod=sales&sub=transaction">Sales Transaction</a></li>
</ul>
</div>
<div id="sub-content">
    <?php
        switch($sub){
            case 'monitor':
                require_once 'monitor_index.php';
                break;
			case 'transaction':
				require_once 'transaction_index.php';
				break;
        }
    ?>
</div>
