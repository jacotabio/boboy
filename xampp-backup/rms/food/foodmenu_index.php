<div id="subsub-navigation">
  <ul>
    <li><a href="index.php?mod=food&sub=foodmenusettings&pro=newdish">New Food Type</a></li>
	<li><a href="index.php?mod=food&sub=foodmenusettings&pro=foodtypelistings">Food Type Listings</a></li>
  </ul>
</div>
<div id="subsub-content">
  <?php
    switch($process){
		case 'newdish':
			require_once 'foodmenu_new.php';
			break;
		case 'foodtypelistings':
			require_once 'foodmenu_listings.php';
			break;
    }
  ?>
</div>
