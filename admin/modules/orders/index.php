<?php
if(isset($_GET['action']) && $_GET['action'] == "new"){?>
<div class="row">
    <!-- column -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title">Create Order</h4>
                <h6 class="card-subtitle"></h6>
                <div class="">
                    <form class="form-horizontal">
                        <div id="name-input" class="form-group">
                            <label class="col-md-4 control-label">Customer Name</label>
                            <div class="col-lg-7 col-md-12">
                                <input name="fullname" type="text" value="" placeholder="Customer Name" class="form-control input-sm" required>
                                <label id="name-input-error" style="display:none;" class="control-label text-error">No special characters allowed</label>
                            </div>
                        </div>
                        <div id="name-input" class="form-group">
                            <label class="col-md-4 control-label">Delivery Address</label>
                            <div class="col-lg-7 col-md-12">
                                <input name="address" type="text" value="" placeholder="Delivery Address" class="form-control input-sm" required>
                                <label id="address-input-error" style="display:none;" class="control-label text-error">No special characters allowed</label>
                            </div>
                        </div>
                        <div id="name-input" class="form-group">
                            <label class="col-md-4 control-label">Phone #</label>
                            <div class="col-lg-7 col-md-12">
                                <input name="phone" type="text" value="" placeholder="Phone #" class="form-control input-sm" required>
                                <label id="phone-input-error" style="display:none;" class="control-label text-error">No special characters allowed</label>
                            </div>
                        </div>
                        <div id="name-input" class="form-group">
                            <label class="col-md-4 control-label">Phone #</label>
                            <div class="col-lg-7 col-md-12">
                                <select id="retrieve-item-list" class="form-control input-sm">

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}else{
?>
<div class="row">
    <!-- column -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title">Ongoing Orders</h4>
                <h6 class="card-subtitle">Display all pending orders of customers</h6>
                <div class="table-responsive">
                <table id="table-pending-orders" class="table table-hover pointer" cellspacing="0" width="100%" style="margin:0;padding:0;">
                    <thead>
                        <tr>
                            <th style="text-align:left;">Order #</th>
                            <th style="text-align:left;">Date/Time Ordered</th>
                            <th style="text-align:left;">Customer</th>
                            <th style="text-align:right;">Total Price</th>
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
}
?>