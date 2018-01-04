<div id="sub-navigation">
	<h3>Inventory</h3>
	<ul>
		<li><a href="index.php?mod=dashboard&sub=products">All Products</a></li>
		
	</ul>
	<h3>Monitoring</h3>
	<ul>
		<li><a href="index.php?mod=dashboard&sub=reports">Reports</a></li>
	</ul>
	<h3>Account</h3>
	<ul>
		<li><a href="index.php?mod=dashboard&sub=settings">Settings</a></li>
		<li><a href="logout.php">Logout</a></li>
	</ul>
</div>
<div id="sub-content-container">
	<?php
	switch ($sub) {
		case 'products':
			?>	
			<div id="subsub-navigation">
	    		<ul>
	    			<li>
						<form id="formSearch" method="POST" action="dashboard/process.php?action=searchproduct" style="float: left;">
							<input type="search" class="search" name="searchvalue" placeholder="Search"/><!------ADDED ONCHANGE-->
						</form>
					</li>
					<li>
						<form id="formShowAll" method="POST" action="dashboard/process.php?action=searchproduct&searchval='all'" style="float:left; margin-top: 11px; margin-left: 5px;">	
							<input type="submit" name="btnShowAll" value="Show All"/>
						</form>
					</li>
	    			<li><a href="index.php?mod=dashboard&sub=add">+ Add Product</a></li>
	    		</ul>
			</div>
			<div id="gapper">
			</div>
			<?php
			break;
	}
	?>
	<div id="sub-content">
	<?php
		switch($sub){
			case 'products':
				require_once 'dashboard/products.php';
				break;
			case 'add':
				require_once 'dashboard/add_product.php';
				break;
			case 'reports':
				require_once 'dashboard/reports.php';
				break;
			case 'settings':
				require_once 'dashboard/settings.php';
				break;
		}
	?>
	</div>
</div>
