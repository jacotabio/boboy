<div id="subsub-navigation">
  <ul>
    <li><a href="index.php?mod=inventory&sub=ingredients&pro=new">New Ingredient</a></li>
    <li><a href="index.php?mod=inventory&sub=ingredients&pro=unit">Units</a></li>
    <li><a href="index.php?mod=inventory&sub=ingredients&pro=list">Listing</a></li>
  </ul>
</div>
<div id="subsub-content">
  <?php
    switch($process){
		case 'new':
      require_once 'ingredients_new.php';
      break;
    case 'unit':
      require_once 'ingredients_unit.php';
      break;
    case 'list':
      require_once 'ingredients_list.php';
      break;
    }
  ?>
</div>
