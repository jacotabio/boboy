<div class="modal" id="chat-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="">
      <div class="container-fluid no-gap" style="padding:0;">
        <div class="row no-gap">
            <div class="col-md-12 no-gap" style="padding:0;">
                <div class="panel panel-primary" style="">
                    <div class="panel-heading">
                        <span id="chat-modal-title">Chat</span>
                        <div class="btn-group pull-right">
                            <button type="button" class="btn btn-primary btn-xs" style="background:none;border:none;outline:none;box-shadow:none;margin-left:4px;" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>Close</button>
                        </div>
                    </div>
                    <div class="chat-panel-body" style="background-color:rgba(0,0,0,0.05);">
                        <div id="chat-ajax-content">
                        </div>
                    </div>
                    <div class="panel-footer">
                      <form id="form-chat">
                        <div class="input-group">
                            <input id="chat-input-message" name="chat-input-message" autocomplete="off" type="text" class="form-control input-sm" style="border-radius:0;" placeholder="Type a message..." autofocus/>
                            <span class="input-group-btn">
                                <button type="submit" style="border-radius:0;" class="btn btn-themecolor btn-sm" id="btn-send-chat"><span class="glyphicon glyphicon-send"></span>&nbsp;&nbsp;Send</button>
                            </span>
                        </div>
                      </form>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div><!-- modal-dialog -->
</div><!-- modal -->

<div class="modal" id="modal-order-del" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><?php echo $brandname?></h4>
      </div>

      <div class="modal-body">
        <p class="">Do you want to delete this order?</p>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-themecolor" id="btn-confirm-cancel-order" data-dismiss="modal">Delete</button>
      </div>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->

<div class="modal" id="modal-customer-del" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><?php echo $brandname?></h4>
      </div>

      <div class="modal-body">
        <p class="">Do you want to delete this customer from the system?</p>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-themecolor" id="del-customer-confirm" data-dismiss="modal">Delete</button>
      </div>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->

<div class="modal" id="modal-brand-del" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><?php echo $brandname?></h4>
      </div>

      <div class="modal-body">
        <p class="">Do you want to delete this brand from the system?</p>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-themecolor" id="del-brand-confirm" data-dismiss="modal">Delete</button>
      </div>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->

<div class="modal" id="modal-error" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><?php echo $brandname?></h4>
      </div>

      <div class="modal-body">
        <p class="">Oops, something went wrong. Please try again.</p>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->

<div class="modal" id="modal-order-close" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><?php echo $brandname?></h4>
      </div>

      <div class="modal-body">
        <p class="">Closing this order means that all transactions are completed. Are you sure?</p>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-themecolor" id="btn-close-order-confirm" data-dismiss="modal">Confirm</button>
      </div>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->