<?php
include '../library/config.php';
include '../classes/class.order.php';
include '../classes/class.product.php';
include '../classes/class.table.php';
include '../classes/class.users.php';
$sub = (isset($_GET['sub']) && $_GET['sub'] != '') ? $_GET['sub'] : '';
$order = new Order();
$product = new Product();
$table = new Table();
$users = new Users();
?>
<div id="datacart">
		<!-- Replace dataheader content with proper title e.x. New Product -->
		<div id="dataheader">Printing Transaction...</div>
		<div id="datacontentcart">
		<?php
			$printer = "\\\\localhost\\EPSONTMT81";
			
			// Open connection to the thermal printer
			//$fp = fopen($printer, "w");
			$fp = fopen('../receipt/order'.$sub.'_'.date('MdY').'_'.date('Hia').'.txt', 'w');
			if (!$fp){
			  die('no connection');
			}

			$data = PHP_EOL . PHP_EOL . 
			str_pad('KAPEHAN',45," ",STR_PAD_BOTH) . PHP_EOL . 
			str_pad('DATE: '.date('M d, Y').'   Time: '.date('H:ia'),45," ",STR_PAD_BOTH). PHP_EOL . PHP_EOL .
			'SERVER: '.$users->get_username($table->get_server($sub)). PHP_EOL . PHP_EOL;
			$data .= 'TABLE: '.$table->get_name($sub). PHP_EOL;
			$data .= '---------------------------------------------'. PHP_EOL;
			$data .= 'Description                            QTY'. PHP_EOL;
			$data .= '---------------------------------------------'. PHP_EOL;
			$count = 0;
			$total = 0;
			$ordlist = $order->get_orderpertableforprint($sub);
			if($ordlist != false){
			foreach($ordlist as $ord){
				$val = $product->get_proname($ord['pro_id']);
				$len = strlen($val);
                
				$data .= $product->get_proname($ord['pro_id']) .
							str_pad($ord['ord_qty'] ,(45-$len)," ", STR_PAD_LEFT). PHP_EOL;
                
                $order->set_printed($ord['ote_id']);
				
				$count++;
				}
			}
			$data .= '---------------------------------------------'. PHP_EOL .
					'Total Items: '. $count. PHP_EOL;
			$data .= '---------------------------------------------'. PHP_EOL ;
			
			$data .= PHP_EOL . PHP_EOL .
			str_pad('COOKING INSTRUCTIONS',45," ",STR_PAD_BOTH) . PHP_EOL .
			str_pad('HERE HERE',45," ",STR_PAD_BOTH) . PHP_EOL .
			PHP_EOL . PHP_EOL . PHP_EOL . PHP_EOL . PHP_EOL . PHP_EOL ;

			// Cut Paper
			$data .= "\x00\x1Bi\x00";

			if(!fwrite($fp,$data)){
				die('writing failed');
			}
			
			fclose($fp);
			
            //set printing flag

            //set redirect to same location
			header("location: ../index.php?mod=order&sub=".$sub);
			//exit;
			?>
		<!-- Data goes here -->
			<div id="printable">
			<?php
			echo $data;
			?>
			</div>
			
			
		<!-- Data ends here -->
		</div>
</div> 