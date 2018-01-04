<?php
include '../library/config.php';
include '../classes/class.topic.php';

$tabid = (isset($_GET['sub']) && $_GET['sub'] != '') ? $_GET['sub'] : '';

$topic = new Topic();
$user = new Users();

header('location: ../index.php');
exit;