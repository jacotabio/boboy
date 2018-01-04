<div class="card-wrapper-sub w-20">
<div class="w-100">
	<div class="card-style w-100">
		<div id="products-side-navi">
			<h2>Profile</h2>
			<ul>
			<li><a href="index.php?mod=profile&view=sli">Stock Level Inventory</a></li>
			<li><a href="index.php?mod=profile&view=paylist">Payment List</a></li>
			<li><a href="index.php?mod=profile&view=history">Order History</a></li>
			</ul>
		</div>
	</div>
</div>
<div style="margin-top: 10px;" class="w-100">
	<div class="card-style w-100">
		<h2 class="material-header-small w-90" style="display: inline-block;">Profile Information</h2><img onclick="div_show()" class="profile-icon" src="img/edit.svg">
		<div id="profile-info"></div>
		<a id="change_pass" class="material-button-main w-100" onclick="div_show_change_password()">CHANGE PASSWORD</a>
	</div>
</div>
</div>
<div class="card-wrapper w-80">
	<div class="card-style w-100">
		<div id="products-right-content">
		<?php 
		$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
		switch($view){
			case 'sli':
				require_once 'profile/sli.php';
				break;
			case 'paylist':
				require_once 'profile/paylist.php';
				break;
			case 'history':
				require_once 'profile/history.php';
				break;
			}?>
		</div>
	</div>
</div>
<?php
	//include popup modal code here
	require_once 'profile/popup.php';
	require_once 'profile/popupChangePass.php';
?>
