<div class="container" style="margin-top: 10%;">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create account</div>

                <div class="panel-body">
                    <form id="register-form" name="register-form" class="form-horizontal" method="POST">
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="name" pattern="([A-z0-9À-ž\s]){1,}" class="form-control" name="name" value="" required autofocus>

                                    <span class="help-block">

                                        <strong></strong>
                                    </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div id="email-reg" class="col-md-6">
                                <input id="email" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" class="form-control" name="email" value="" required>

                                    <span class="help-block">
                                        Example: yourname@email.com
                                        <strong id="email-reg-help"></strong>
                                    </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div id="pwd-reg" class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div id="cpwd-reg" class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirm" required>
                                
                                <span class="help-block">
                                  <strong id="pwd-reg-help"></strong>
                                </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="auth-type" class="col-md-4 control-label">Registration Type</label>

                            <div class="col-md-6">
                                <select id="auth-type" class="form-control" name="auth-type" required>
                                <?php
                                $auth = $auth->get_auth_type();
                                foreach($auth as $a){?>
                                   <option value="<?php echo $a['auth_id'];?>"><?php echo $a['auth_name'];?></option>
                                <?php
                                }
                                ?>
                                 
                                </select>
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