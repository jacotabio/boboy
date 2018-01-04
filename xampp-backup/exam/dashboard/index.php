<div id="sub-navigation">
	<h3>Transaction</h3>
	<ul>
		<li><a href="index.php?mod=dashboard&sub=purchase">Purchase</a></li>
		<li><a href="index.php?mod=dashboard&sub=receive">Restock</a></li>
	</ul>
	<h3>Inventory</h3>
	<ul>
		<li><a href="index.php?mod=dashboard&sub=products">Products</a></li>
		
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
						<form id="formSearch" method="POST" action="dashboard/process.php?action=searchproduct&mode=product">
							<input type="search" class="search" name="searchvalue" placeholder="Search"/>
						</form>
					</li>
					<form id="formShowAll" method="POST" action="dashboard/process.php?action=searchproduct&mode=product&searchval=all" >
						<li onclick="formShowAll.submit();"><a href="#">Show All</a></li>
					</form>
	    			<li><a href="index.php?mod=dashboard&sub=add">+ Add Product</a></li>
	    		</ul>
			</div>
			<div id="gapper">
			</div>
			<?php
			break;
		
		case 'purchase':
			?>	
			<div id="subsub-navigation">
	    		<ul>
	    			<li>
						<form id="formSearch" method="POST" action="dashboard/process.php?action=searchproduct&mode=purchase">
							<input type="search" class="search" name="searchvalue" placeholder="Search"/><!------ADDED ONCHANGE-->
						</form>
					</li>
					<form id="formShowAll" method="POST" action="dashboard/process.php?action=searchproduct&mode=purchase&searchval=all" >
						<li onclick="formShowAll.submit();"><a href="#">Show All</a></li>
					</form>
	    		</ul>
			</div>
			<div id="gapper">
			</div>
			<?php
			break;
		
		case 'receive':
			?>	
			<div id="subsub-navigation">
	    		<ul>
	    			<li>
						<form id="formSearch" method="POST" action="dashboard/process.php?action=searchproduct&mode=receive" style="float: left;">
							<input type="search" class="search" name="searchvalue" placeholder="Search"/>
						</form>	
					</li>
					<form id="formShowAll" method="POST" action="dashboard/process.php?action=searchproduct&searchval=all&mode=receive" >
						<li onclick="formShowAll.submit();"><a href="#">Show All</a></li>
					</form>
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
			case 'purchase':
				require_once 'dashboard/purchase.php';
				break;
			case 'receive':
				require_once 'dashboard/receive.php';
				break;
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