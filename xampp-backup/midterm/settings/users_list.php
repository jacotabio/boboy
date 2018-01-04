<h2>Users List</h2>
<?php
$list = $user->get_users();

foreach($list as $value){
?>
  <div class="col30">
  <?php echo $value['usr_firstname'];?> <?php echo $value['usr_lastname'];?>
  </div>
<?php
}
?>
