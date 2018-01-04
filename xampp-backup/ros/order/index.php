<div id="sub-navigation">
<ul>
    <?php
    $list = $product->get_ptype();
    foreach($list as $value){
    ?>
    <li><a href="index.php?mod=order&sub=<?php echo $sub;?>&id=<?php echo $value['pty_id'];?>"><?php echo $value['pty_name'];?></a></li>
    <?php
    }
    ?>
</ul>
</div>
<div id="sub-product">
<?php
$server = $table->get_server($sub);
if($server != 0){
?>
<h3>&nbsp;<?php echo $product->get_ptypename($id);?></h3>
<ul>
    <?php
    if(isset($id) && $id != ''){
        $prolist = $product->get_productpertype($id);
        if($prolist != false){
            foreach($prolist as $prod){
            ?>
            <li><a onclick="setOrder(<?php echo $sub;?>,<?php echo $id;?>,<?php echo $prod['pro_id'];?>)" href="index.php?mod=order&sub=<?php echo $sub;?>&id=<?php echo $id;?>"><?php echo $prod['pro_name'];?></a></li>
            <?php
            }
        }else{
            echo '&nbsp;&nbsp;NO AVAILABLE ITEMS';
        }
    }else{
        echo '&nbsp;&nbsp;SELECT CATEGORY';
    }
    ?>
</ul>
<?php
}else{
    echo "<h3>&nbsp;</h3>";
    require_once 'service.php';
}
?>
</div>
<div id="sub-status">
<table class="status-label">
    <tr><td>TABLE</td><td>SERVER</td><td>STATUS</td></tr>
    <tr><td><?php echo $table->get_name($sub);?></td>
        <td><?php echo $users->get_username($table->get_server($sub));?></td>
        <td><?php $statid = $table->get_status($sub);
echo $table->get_statusname($statid);?></td>
    </tr>
</table>
</div>
<div id="sub-order">

    <div id="wrapper-cart">
    <table class="prodcart">
    <?php
    $count = 0;
    if(isset($sub) && $sub != ''){
        $ordlist = $order->get_orderpertable($sub);
        if($ordlist != false){
            
            foreach($ordlist as $ord){
            ?>
            <tr>
                <td><?php if($ord['ote_print'] == '1'){ echo '&#9658';}?> <?php echo $product->get_proname($ord['pro_id']);?></td><td><?php echo $ord['ord_qty'];?></td>
            </tr>
            <?php
                $count++;
            }
        }else{
            if($server == 0){
            echo '&nbsp;&nbsp;WAITING FOR LOGIN TO START';
            }else{
            echo '&nbsp;&nbsp;READY'; 
            }
        }
    }
    ?>
    </table>
    </div>
    <span class="order-label">&nbsp;&nbsp;ITEMS (<?php echo $count;?>)</span>
</div>
<div id="naviorder">
        <?php
        if($count > 0){
        ?>
        <ul>
            <li><a href="index.php">RETURN</a></li>
            <li><a onclick="cancelOrder(<?php echo $sub;?>)" href="#">CANCEL</a></li>
            <li><a href="order/print.php?sub=<?php echo $sub;?>">PRINT</a></li>
            <li><a onclick="customerName()">PAY</a></li>
        </ul>
        <?php
        }else{
        ?>
        <ul>
            <li><a href="index.php">RETURN</a></li>
            <li><a onclick="cancelOrder(<?php echo $sub;?>)" href="#">CANCEL</a></li>
            <li><a>PRINT</a></li>
            <li><a>PAY</a></li>
        </ul>
        <?php
        }
        ?>
</div>
<script>
function customerName(){
    var r = prompt("Enter Customer Name");
	window.location.assign("order/payorder.php?sub=" + <?php echo $sub;?> + "&ostid=" + <?php echo $statid;?> + "&user=" + <?php echo $table->get_server($sub);?> + "&name=" + r + "&count=" + <?php echo $count;?>);
}
</script>
<?php
$previous = $_SERVER['HTTP_REFERER'];
if(isset($_GET['message'])) {
    echo '<script type="text/javascript">alert("' . $_GET['message'] . '"); window.location="'.$previous.'";</script>';
}
?>