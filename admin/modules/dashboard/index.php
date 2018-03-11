<?php
include 'classes/class.orders.php';
$order = new Orders();
$data = $order->dashboard_data();
if($data){
    foreach($data as $d);
?>
<div class="row">
    <!-- Column -->
    <div class="col-sm-3">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title">Pending Orders</h4>
                <div class="text-right">
                    <h2 class="font-light m-b-0"><?php echo $d['pending_orders'];?></h2>
                    <span class="text-muted"></span>
                </div>
                <span class="text-success"></span>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-sm-3">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title">Ongoing Orders</h4>
                <div class="text-right">
                    <h2 class="font-light m-b-0"><?php echo $d['ongoing_orders'];?></h2>
                    <span class="text-muted"></span>
                </div>
                <span class="text-info"></span>

            </div>
        </div>
    </div>
    <!-- Column -->
    <div class="col-sm-3">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title">Ready For Pickup</h4>
                <div class="text-right">
                    <h2 class="font-light m-b-0"><?php echo $d['pickup_orders'];?></h2>
                    <span class="text-muted"></span>
                </div>
                <span class="text-success"></span>
            </div>
        </div>
    </div>

    <div class="col-sm-3">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title">On Delivery</h4>
                <div class="text-right">
                    <h2 class="font-light m-b-0"><?php echo $d['on_delivery'];?></h2>
                    <span class="text-muted"></span>
                </div>
                <span class="text-success"></span>
            </div>
        </div>
    </div>

</div>

<!-- Row -->
<div class="row">
    <!-- Column -->
    
    <div class="col-sm-6">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title">Today's Orders</h4>
                <div class="text-right">
                    <h2 class="font-light m-b-0"><?php echo $d['orders_today'];?></h2>
                    <span class="text-muted"></span>
                </div>
                <span class="text-success"></span>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-sm-6">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title">Total Orders</h4>
                <div class="text-right">
                    <h2 class="font-light m-b-0"><?php echo $d['total_orders'];?></h2>
                    <span class="text-muted"></span>
                </div>
                <span class="text-info"></span>

            </div>
        </div>
    </div>
    <!-- Column -->
</div>
<!-- Row -->
<div class="row">
    <!-- Column -->
    <div class="col-sm-6">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title">Today's Sales</h4>
                <div class="text-right">
                    <h2 class="font-light m-b-0"><?php echo $currency.number_format($d['sales_today'],2);?></h2>
                </div>

            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-sm-6">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title">Total Sales</h4>
                <div class="text-right">
                    <h2 class="font-light m-b-0"><?php echo $currency.number_format($d['total_sales'],2);?></h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
</div>
<?php 
}
?>
<?php 
/*
?>
<!-- Row -->
<div class="row">
    <!-- column -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title">Revenue Statistics</h4>
                <div class="flot-chart">
                    <div class="flot-chart-content" id="flot-line-chart"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- column -->
</div>
<!-- Row --><?php */?>