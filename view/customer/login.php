<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <form action="<?= URL ?>customer/loginProcess" method="post" name="Login_Form" class="form-signin">
                <fieldset>
                    <div id="legend">
                        <legend class="">Login</legend>
                    </div>
                    <div class="control-group">
                        <label class="control-label"  for="username">Username</label>
                        <div class="controls">
                            <input type="text" id="username" name="username" placeholder="" class="input-xlarge">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="password">Password</label>
                        <div class="controls">
                            <input type="password" id="password" name="password" placeholder="" class="input-xlarge">
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <button class="btn btn-success">Login</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>