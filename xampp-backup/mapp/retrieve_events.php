<?php
include 'library/config.php';
include 'classes/class.users.php';

$user = new Users();

$id = $_GET['id'];

$asd = $user->retrieve_records($id);

echo "{\"budgetlist\": " . json_encode($asd) . "}";
//echo $asd;