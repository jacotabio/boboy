<div class="modal" id="brand-registered" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><?php echo $brandname?></h4>
      </div>

      <div class="modal-body">
        <p class="lead">Thank you for your registration! To complete the entire process, you need to click the link in the confirmation email that we have sent to you.</p>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-dialog" onclick="returnIndex()" data-dismiss="modal">Close</button>
      </div>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->

<div class="modal" id="order-removed-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><?php echo $brandname?></h4>
      </div>

      <div class="modal-body">
        <p class="lead">Order has been declined.</p>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-dialog" data-dismiss="modal">Close</button>
      </div>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->

<div class="modal" id="modal-error" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><?php echo $brandname?></h4>
      </div>

      <div class="modal-body">
        <p class="lead">Oops, something went wrong. Please try again.</p>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-dialog" data-dismiss="modal">Close</button>
      </div>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->

<div class="modal" id="cancel-order-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><?php echo $brandname?></h4>
      </div>

      <div class="modal-body">
        <p class="lead">Do you wish to cancel this order?</p>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-dialog" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-dialog" id="btn-confirm-cancel-order" data-dismiss="modal">Continue</button>
      </div>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->

<div class="modal" id="user-registered" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><?php echo $brandname?></h4>
      </div>

      <div class="modal-body">
        <p class="lead">Thank you for your registration! You can now access your account by logging in after this page has redirected.</p>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-dialog" data-dismiss="modal">Close</button>
      </div>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->

<div class="modal" id="cancel-late-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><?php echo $brandname?></h4>
      </div>

      <div class="modal-body">
        <p class="lead">Sorry, you cannot cancel this order anymore since one or more item has been approved.</p>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-dialog" data-dismiss="modal">Close</button>
      </div>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->


<div class="modal" id="item-unavailable" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><?php echo $brandname?></h4>
      </div>

      <div class="modal-body">
        <p class="lead">We're sorry but it seems that this item is no longer available.</p>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-dialog" data-dismiss="modal">Close</button>
      </div>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->

<div class="modal" id="oi-remove-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><?php echo $brandname?></h4>
      </div>

      <div class="modal-body">
        <p class="lead">Remove item from this order?</p>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-dialog" data-dismiss="modal">Cancel</button>
        <button type="button" id="oi-remove-confirm" value="" class="btn btn-dialog" data-dismiss="modal">Remove</button>
      </div>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->

<div class="modal" id="loading-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><?php echo $brandname?></h4>
      </div>

      <div class="modal-body">
        <div class="loading-div">
          <svg class="spinner" stroke="#5677fc" width="50px" height="50px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg"><circle class="circle" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle></svg>
        </div>
      </div>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->

<div class="modal" id="update-complete-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><?php echo $brandname?></h4>
      </div>

      <div class="modal-body">
        <p class="lead">Updated successfully</p>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-dialog" data-dismiss="modal">Close</button>
      </div>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->

<div class="modal" id="insert-complete-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><?php echo $brandname?></h4>
      </div>

      <div class="modal-body">
        <p class="lead">Your item has been created successfully.</p>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-dialog" data-dismiss="modal">Close</button>
      </div>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->

<div class="modal" id="delete-item-confirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><?php echo $brandname?></h4>
      </div>

      <div class="modal-body">
        <p class="lead">Are you sure you want to delete this item?</p>
      </div>

      <div class="modal-footer" style="border: none;">
        <button type="button" class="btn btn-dialog" data-dismiss="modal">Cancel</button>
        <button type="button" id="btn-delete-item-true" class="btn btn-dialog">Delete</button>
      </div>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->

<div class="modal" id="error-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><?php echo $brandname?></h4>
      </div>

      <div class="modal-body">
        <p class="lead">An error occured, please try again.</p>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-dialog" data-dismiss="modal">Close</button>
      </div>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->


<div class="modal" id="chat-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="">
      <div class="container-fluid no-gap">
        <div class="row no-gap">
            <div class="col-md-12 no-gap">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <span id="chat-modal-title">Chat</span>
                        <div class="btn-group pull-right">
                            
                            <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" style="background:none;border:none;outline:none;box-shadow:none;margin-left:4px;">
                                <span class="glyphicon glyphicon-cog"></span>
                            </button>
                            <ul class="dropdown-menu slidedown">
                                <li><a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-refresh">
                                </span>Refresh</a></li>
                                <li><a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-ok-sign">
                                </span>Available</a></li>
                            </ul>
                            <button type="button" class="btn btn-primary btn-xs" style="background:none;border:none;outline:none;box-shadow:none;margin-left:4px;" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></button>
                        </div>
                    </div>
                    <div class="chat-panel-body" style="background-color:rgba(0,0,0,0.05);">
                        <div id="chat-ajax-content">
                        </div>
                    </div>
                    <div class="panel-footer">
                      <?php 
                      if($_SESSION['usr_auth'] == 1){
                      ?>
                      <form id="form-user-chat">
                      <?php
                      }else{
                      ?>
                      <form id="form-brand-chat">
                      <?php
                      }
                      ?>
                        <div class="input-group">
                            <input id="chat-input-message" name="chat-input-message" autocomplete="off" type="text" class="form-control input-sm" placeholder="Type a message..." autofocus/>
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-primary btn-sm" id="btn-send-chat"><span class="glyphicon glyphicon-send"></span>&nbsp;&nbsp;Send</button>
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

<div class="modal" id="custom-delivery-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form id="form-delivery-address" class="form-horizontal" method="POST"  name="loginform">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel"><?php echo $brandname?></h4>
        </div>
        <div class="modal-body">
          <p class="lead" style="margin-bottom:4px;">Select delivery address:</p>
          <div id="ajax-delivery-address" class="">
            <div class="loading-div">
              <svg class="spinner" stroke="#5677fc" width="50px" height="50px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg"><circle class="circle" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle></svg>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-dialog" data-dismiss="modal">Cancel</button>
          <button type="submit" id="btn-order-confirm" value="" class="btn btn-dialog">Order</button>
        </div>
      </form>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->