<?php 
include 'classes/class.dashboard.php';

$dash = new Dashboard();
$load = $dash->init_dash($_SESSION['brand_id']);
foreach($load as $_l);
?>
<div class="container-fluid">
	<h4 style="margin-bottom:0;">Dashboard</h4>
	<p style="font-size:13px;color:rgba(0,0,0,0.54);">Overview of all your online transactions</p>
	<!-- row -->
	<div class="row" style="margin-top:16px;">
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                	<i class="fa fa-shopping-cart fa-5x"></i>
                                    <!--<i class="fa fa-comments fa-5x"></i>-->
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div id="dashboard-pending" class="huge"><?php echo $_l['t_pending'];?></div>
                                    <div>New Orders</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div id="dashboard-ongoing" class="huge"><?php echo $_l['t_ongoing'];?></div>
                                    <div>Ongoing Orders</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left" style="color:#45ad5d;">View Details</span>
                                <span class="pull-right" style="color:#45ad5d;"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div id="dashboard-msgs" class="huge"><?php echo $_l['admin_msg'];?></div>
                                    <div>Boboy Messages</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left" style="color:#ffb71c;">View Details</span>
                                <span class="pull-right" style="color:#ffb71c;"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
	<!-- end row -->
</div>