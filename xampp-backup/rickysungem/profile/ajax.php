<?php
include '../library/config.php';
include '../classes/class.users.php';

$users = new Users();

if(isset($_POST['indicator'])){

$name = $_POST['name'];
$address = $_POST['address'];
$contact = $_POST['contact'];
$email = $_POST['email'];
$usr_id = $_POST['usr_id'];
$id = $_POST['usr_id'];


//mysql_query("UPDATE tbl_client SET client_name = '{$name}' where usr_id = '{$usr_id}'");-->
//mysql_query("INSERT INTO tbl_client(client_name) VALUES('{$name}')");

$result = $users->edit_prof($name, $address, $contact, $email, $usr_id);

$list = $users->get_profile_info($_SESSION['c_userid']);
foreach($list as $value){
?>
	<label class="fw-500 w-100" style="margin-bottom: 10px; margin-top: 5px;">Name</br><?php echo $value['client_name']?></label>
	<label class="fw-500 w-100" style="margin-bottom: 10px;">LTO Number</br><?php echo $value['lto_no']?></label>
	<label class="fw-500 w-100" style="margin-bottom: 10px;">Address</br><?php echo $value['address']?></label>
	<label class="fw-500 w-100" style="margin-bottom: 10px;">Contact Number</br><?php echo $value['contact_no']?></label>
	<label class="fw-500 w-100" style="margin-bottom: 5px;">Email</br>
	<?php 
if($value['email'] == ""){
echo 'No Email Address';}
else{
echo $value['email'];}?>	
</div>
</div>
<?php
}?></label><?php
exit();
}


if(isset($_POST['indicator-pass']) ){
$users = new Users();
$usr_id = $_POST['usr_id'];
$current_pass = $_POST['current-pass'];
$new_pass = $_POST['new-pass'];
$confirm = $_POST['confirm-new-pass'];

$list = $users->get_password($usr_id);
if($list){
	foreach($list as $value){
		if($value['usr_password'] == md5($current_pass)){
				$new_confirmed_pass = md5($new_pass);
				$results = $users -> new_pssword($new_confirmed_pass, $usr_id);

		}else{
			echo "wrong";
		}
	}
}
exit();
}

if(isset($_POST['history_click'])){
	$result = $users->get_order_details($_POST['or_id']);
	if($result){
	?>
	<table id="ohistory-table">
		<tr>
			<th style="padding: 0px 0px 10px 0px;">Product Name</th>
			<th style="padding: 0px 0px 10px 0px;">Formulation</th>
			<th style="padding: 0px 0px 10px 0px;">Packaging</th>
			<th style="padding: 0px 0px 10px 0px;" class="ta-right">Quantity</th>
		</tr>
		<?php
		foreach($result as $values){
		?>
		<tr style="border-bottom: 1px solid #dddddd;">
			<td style="padding: 8px 0px 8px 0px;"><?php echo $values['pro_brand'];?></br><?php echo $values['pro_generic'];?></td>
			<td><?php echo $values['pro_formulation'];?></td>
			<td><?php echo $values['pro_packaging'];?></td>
			<td class="ta-right"><?php echo $values['qty_total'];?></td>
		</tr>
		<?php
		}
	}
		?>
	</table>
	<?php
}
