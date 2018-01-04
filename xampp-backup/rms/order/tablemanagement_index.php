<div id="subsub-navigation">
  <ul>
    <li><a href="index.php?mod=order&sub=tablemanagement&pro=newtable">New Table</a></li>
  </ul>
</div>
<div id="subsub-content">
  <?php
    switch($process){
		case 'newtable':
			require_once 'tablemanagement_new.php';
			break;
    }
  ?>
</div>
