<?php

if(!isset($_GET['id'])){
?>
<div class="row">
    <!-- column -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title">Customers</h4>
                <h6 class="card-subtitle">A list of all registered customers</h6>
                <div class="table-responsive">
                <table id="table-customers" class="table table-hover pointer" cellspacing="0" width="100%" style="margin:0;padding:0;">
                    <thead>
                        <tr>
                            <th style="text-align:left;">Full Name</th>
                            <th style="text-align:left;">Email</th>
                            <th style="text-align:left;">Address</th>
                            <th style="text-align:right;">Contact #</th>
                            <th style="text-align:right;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}else{
    $u = $user->get_user_details($_GET['id']);
    print_r($u);
?>
<div class="row">
    <!-- column -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title"><?php ?></h4>
                <h6 class="card-subtitle">A list of all registered customers</h6>
                <div class="table-responsive">
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}