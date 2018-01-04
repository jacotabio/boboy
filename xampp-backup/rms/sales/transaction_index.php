<div id="subsub-navigation">
  <ul>
    <li><a href="index.php?mod=sales&sub=transaction&pro=server">Server</a></li>
	<li><a href="index.php?mod=sales&sub=transaction&pro=table">Table</a></li>
  </ul>
</div>
<div id="subsub-content">
  <?php
    switch($process){
		case 'server':
			require_once 'transaction_server.php';
			break;
		case 'table':
			require_once 'transaction_table.php';
			break;
    }
  ?>
</div>
