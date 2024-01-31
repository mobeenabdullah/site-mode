<div class="login no-js login-action-login wp-core-ui locale-en-us">

    <div id="login">
        <h1><a href="https://wordpress.org/" target="_blank">Powered by WordPress</a></h1>

        <form name="loginform" id="loginform">
            <p>
                <label for="user_login">Username or Email Address</label>
                <input type="text" name="log" id="user_login" class="input" value="" size="20" autocapitalize="off" />
            </p>

            <div class="user-pass-wrap">
                <label for="user_pass">Password</label>
                <div class="wp-pwd">
                    <input type="text" name="pwd" id="user_pass" class="input password-input" value="" size="20" />
                    <button type="button" class="button button-secondary wp-hide-pw hide-if-no-js" data-toggle="0" aria-label="Show password">
                        <span class="dashicons dashicons-visibility" aria-hidden="true"></span>
                    </button>
                </div>
            </div>

            <p class="forgetmenot"><input name="rememberme" type="checkbox" id="rememberme" value="forever"  /> <label for="rememberme">Remember Me</label></p>
            <p class="submit">
                <input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="Log In" />
            </p>
        </form>

        <p id="nav">
            <a href="#">Lost your password?</a>
        </p>

        <p id="backtoblog">
            <a href="#">  <?php printf( _x( '&larr; Back to %s', 'site' ), get_bloginfo( 'title', 'display' ) ); ?>	</a>
        </p>
    </div>

    <div class="clear"></div>
</div>