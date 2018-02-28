<?php
include 'classes/class.orders.php';
$order = new Orders();
$data = $order->dashboard_data();
if($data){
    foreach($data as $d);
?>
<div class="row">
    <!-- Column -->
    <div class="col-sm-6">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title">Today's Sales</h4>
                <div class="text-right">
                    <h2 class="font-light m-b-0"><i class="ti-arrow-up text-success"></i> <?php echo $currency.number_format($d['sales_today'],2);?></h2>
                    <span class="text-muted">Todays Income</span>
                </div>
                <span class="text-success"></span>
                <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 80%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
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
                    <h2 class="font-light m-b-0"><i class="ti-arrow-up text-info"></i> <?php echo $currency.number_format($d['total_sales'],2);?></h2>
                    <span class="text-muted">Todays Income</span>
                </div>
                <span class="text-info"></span>
                <div class="progress">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 30%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
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