<div id="subsub-navigation">
  <ul>
    <li><a href="index.php?mod=sales&sub=monitor&pro=daily">Daily Sales</a></li>
  </ul>
</div>
<div id="subsub-content">
  <?php
    switch($process){
		case 'daily':
			require_once 'monitor_daily.php';
			break;
    }
  ?>
</div>
