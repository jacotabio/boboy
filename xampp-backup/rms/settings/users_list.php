<h2>System Users</h2>
<?php
$list = $user->get_users();

foreach($list as $value){
?>
  <div class="col30">
  <?php echo $value['usr_lastname'];?>, <?php echo $value['usr_firstname'];?>
  </div>
<?php
}
?>
