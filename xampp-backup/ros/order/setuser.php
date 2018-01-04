<?php
include '../library/config.php';
include '../classes/class.users.php';
include '../classes/class.table.php';
$subid = (isset($_GET['subid']) && $_GET['subid'] != '') ? $_GET['subid'] : '';

$user = new Users();
$table = new Table();

$response = $user->start_login($_POST['username']);
if($response){
    $table->set_status($subid,2);
    $table->set_server($subid,$user->get_user($_POST['username']));
}
header('location: ../index.php?mod=order&sub='.$subid);
exit;