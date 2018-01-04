<?php
include '../library/config.php';
include '../classes/class.order.php';
include '../classes/class.table.php';
$subid = (isset($_GET['subid']) && $_GET['subid'] != '') ? $_GET['subid'] : '';
$id = (isset($_GET['id']) && $_GET['id'] != '') ? $_GET['id'] : '';
$proid = (isset($_GET['proid']) && $_GET['proid'] != '') ? $_GET['proid'] : '';
$order = new Order();
$table = new Table();

$count_recipe = 0;
$count_avail_recipe = 0;

$first = $order->select_recipe($proid);
if($first){
	foreach($first as $r){
		$count_recipe++;
		$check = $order->check_availability($r['rec_id']);
		if($check){
			$count_avail_recipe++;
		}else{
			$message = 'FAILED: INSUFFICIENT INGREDIENTS';
			header('location: ../index.php?mod=order&sub='.$subid.'&id='.$id.'&message='.$message);
			exit;
		}
	}
	if($count_recipe == $count_avail_recipe){
		$first = $order->select_recipe($proid);
		foreach($first as $r){
			$check = $order->check_availability($r['rec_id']);
				foreach($check as $c){
					if($count_recipe == $count_avail_recipe){
						$order->deduct_ingredients($r['rec_id'],$c['ing_id'],$c['rec_qty']);
					}
				}
		}
		$table->set_status($subid,2);
		$order->set_order($subid,$proid);
	}
}else{
	$message = 'FAILED: RECIPE IS EMPTY!';
	header('location: ../index.php?mod=order&sub='.$subid.'&id='.$id.'&message='.$message);
	exit;
}
header('location: ../index.php?mod=order&sub='.$subid.'&id='.$id);
exit;