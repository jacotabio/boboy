<?php
include 'classes/class.chats.php';

$chat = new Chats();
?>
<div class="container-fluid no-gap">
	<div class="col-md-12 profile-dashboard">
        <div class="row">
            <h4 class="" style="margin:0;padding-left:0px;padding-top:8px;padding-bottom:0px;">Admin</h4>
            <p class="" style="font-size:12px;font-weight:500;color:rgba(0,0,0,0.54); margin-bottom:8px;">Send a message to Boboy's admin team</p>
            <div class="chat-panel-body-admin">
                <div id="chat-admin-content" class="" style="background:rgba(0,0,0,0.02);border:1px solid #ededed;">

                </div>
            </div>
            <form id="form-chat-admin" method="POST">
                    <div class="input-group">
                        <input id="chat-input-admin" name="message" autocomplete="off" type="text" class="form-control input-sm" placeholder="Enter message" autofocus/>
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-primary btn-sm" style="border-top-right-radius: 0px;" id="btn-send-chat"><span class="glyphicon glyphicon-send"></span>&nbsp;&nbsp;Send</button>
                        </span>
                    </div>
                </form>
        </div>
    </div>
</div>