<?php
include 'library/config.php';
include 'classes/class.graph.php';

$graph = new Graph();


if(isset($_POST['get_client_data'])){
	$result = $graph->get_json_clients();
	echo json_encode($result);
}
?>