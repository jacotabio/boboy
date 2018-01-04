<div id="subsub-navigation">
  <ul>
    <li><a href="index.php?mod=food&sub=dishmanagement&pro=newdish">New Dish</a></li>
	<li><a href="index.php?mod=food&sub=dishmanagement&pro=foodlistings">Food Listings</a></li>
  </ul>
</div>
<div id="subsub-content">
  <?php
    switch($process){
		case 'newdish':
			require_once 'dishmanagement_new.php';
			break;
		case 'foodlistings':
			require_once 'dishmanagement_listings.php';
			break;
		case 'profile':
			require_once 'food_profile.php';
			break;
    }
  ?>
</div>
