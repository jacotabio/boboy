

<div class="modal" id="modal_session" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog modal-sm" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title" id="myModalLabel"><?php echo $brandname?></h4>
    </div>

    <div class="modal-body">
      <p class="lead">Oops it seems that you are not yet logged in. Please login to continue.</p>
    </div>

    <div class="modal-footer">
      <button type="button" class="btn btn-dialog" data-dismiss="modal">Close</button>
    </div>
  </div><!-- modal-content -->
</div><!-- modal-dialog -->
</div><!-- modal -->



<div class="modal" id="modal_inserted" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><?php echo $brandname?></h4>
      </div>

      <div class="modal-body">
        <p class="lead">Your item has been added to your cart.</p>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-dialog" data-dismiss="modal">Close</button>
      </div>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->

<div class="modal" id="modal_updated" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><?php echo $brandname?></h4>
      </div>

      <div class="modal-body">
        <p class="lead">Your item has been added to your cart.</p>
      </div>

      <div class="modal-footer">
      <button type="button" class="btn btn-dialog" data-dismiss="modal">Ok</button>
      </div>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->

<div class="modal" id="cart_success" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><?php echo $brandname?></h4>
      </div>

      <div class="modal-body">
        <p class="lead">Your order has been successfully submitted and is now being processed. We will notify you for further details. Thank you for choosing <?php echo $brandname;?> as your coffee delivery service.</p></br>
        <span>To track the progress of your order, click </span><a id="order-status-link" href="#">here</a> or go to your profile account and orders.
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-dialog" onclick="returnIndex()" data-dismiss="modal">Close</button>
      </div>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->
