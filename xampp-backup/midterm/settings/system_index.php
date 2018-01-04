<div id="subsub-navigation">
  <ul>
    <li><a href="index.php?mod=settings&sub=system&pro=about">About</a></li>
  </ul>
</div>
<div id="subsub-content">
<div class="wrapper">
  <?php
    switch($process){
		case 'about':
			require_once 'system_about.php';
			break;
    }
  ?>
</div>
</div>
