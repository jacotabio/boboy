<?php
include 'classes/class.chats.php';

$chat = new Chats();
?>
<div class="container-fluid no-gap">
	<div class="col-md-12 profile-dashboard">
        <div class="row">
            <h4 class="" style="margin:0;padding-left:0px;padding-top:8px;padding-bottom:0px;">Admin</h4>
            <p class="" style="font-size:12px;font-weight:500;color:rgba(0,0,0,0.54); margin-bottom:8px;">Send a message to Boboy's admin team</p>
            <div id="chat-admin-wrapper" class="col-lg-12 col-md-12 no-gap" style="">
                <div class="" style="background:rgba(0,0,0,0.02);border:1px solid #ededed;">
                    <ul class="chat" style="margin:0;padding:8px 16px;min-height:300px;max-height: 300px;overflow-y: auto;">
                        <div style="text-align: center;padding-top:100px;">
                            <svg class="spinner" stroke="#5677fc" width="35px" height="35px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg"><circle class="circle" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle></svg>
                            <span style="padding-left:16px;font-size:12px;font-weight: 500;">Loading conversation..</span>
                        </div>
                    </ul>
                </div>
            </div>
            <form id="form-chat-admin" method="POST">
                    <div class="input-group">
                        <input name="message" autocomplete="off" type="text" class="form-control input-sm" placeholder="Enter message" autofocus/>
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-primary btn-sm" style="border-top-right-radius: 0px;" id="btn-send-chat"><span class="glyphicon glyphicon-send"></span>&nbsp;&nbsp;Send</button>
                        </span>
                    </div>
                </form>
        </div>
    </div>
</div>