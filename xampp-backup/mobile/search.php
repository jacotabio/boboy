<?php
include 'library/config.php';
include 'classes/class.stocklevel.php';

$stock = new StockLevel();

//Search value
$q = $_POST['q'];
//Current display page
$page = $_POST['page'];
//Limit value for display
$limit = 100;
//Count total items in DB
$total = $stock->count_products();
//We can go atmost to page number total/limit
$page_limit = $total/$limit; 
//If the page number is more than the limit we cannot show anything 
if($page<=$page_limit){

//Formula for pagination
$start = ($page - 1) * $limit;
//Retrieve products in DB
$result = $stock->search_stocks($q,$start,$limit);

$response = array();

	if($result==false){
		$code = "retrieve_failed";
		$message = "No results found";
		array_push($response, array("code"=>$code,"message"=>$message,"name"=>"null","userid"=>"null"));
		echo json_encode($response);
	}else{
		$code = "retrieve_success";
		$message = "Retrieve success";

		foreach($result as $value){
			array_push($response, array("code"=>$code,"message"=>$message,"pro_id"=>$value['pro_id'],"pro_brand"=>$value['pro_brand'],"pro_generic"=>$value['pro_generic'],"pro_desc"=>$value['pro_formulation'],"pro_qty"=>$value['pro_total_qty']));
		}
		echo json_encode($response);
	}
}
?>