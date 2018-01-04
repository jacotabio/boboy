<div id="subsub-navigation">
  <ul>
    <li><a href="index.php?mod=settings&sub=system&pro=settings">Settings</a></li>
	<li><a href="index.php?mod=settings&sub=system&pro=display">Display</a></li>
  </ul>
</div>
<div id="subsub-content">
  <?php
    switch($process){
		case 'settings':
			require_once 'system_settings.php';
			break;
		case 'display':
			require_once 'system_display.php';
			break;
    }
  ?>
</div>
