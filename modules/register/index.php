<div class="container" style="margin-top: 10%;">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create account</div>

                <div class="panel-body">
                    <form id="register-form" class="form-horizontal">
                        <div id="name-reg" class="form-group">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="name" class="form-control" name="name" value="" required autofocus>
                                <label id="name-reg-error" style="display:none;" class="control-label">Only letters are allowed</label>
                            </div>
                        </div>

                        <div id="email-reg" class="form-group">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="" required>
                                <label id="email-reg-error" style="display:none;" class="control-label">Email invalid</label>
                                <label id="email-reg-exists" style="display:none;" class="control-label">Email already exists</label>
                            </div>
                        </div>

                        <div id="pwd1-reg" class="form-group">
                            <label for="password" class="col-md-4 control-label">Password</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>
                            </div>
                        </div>

                        <div id="copwd-reg" class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div id="cpwd-reg" class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="co-password" required>
                                <label id="pwd-match" style="display:none;" class="control-label">Passwords do not match</label>
                                <label id="pwd-reg-error" style="display:none;" class="control-label">Alphanumeric & minimum 6-character only</label>

                            </div>
                        </div>
                        <div id="address-reg" class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Delivery Address</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="address" required>
                                <label id="address-reg-error" style="display:none;" class="control-label">Address consists of invalid characters</label>
                            </div>
                        </div>
                        <div id="phone-reg" class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Contact #</label>

                            <div class="col-md-6">
                                <input type="number" class="form-control" name="contact" required>
                                <label id="phone-reg-error" style="display:none;" class="control-label">Enter 11-digit phone number only</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" id="submit-register" name="register" class="btn btn-primary uppercase">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>