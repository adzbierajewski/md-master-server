        <div class="serverlist-wrapper">
<?php
// show potential errors / feedback (from registration object)
if (isset($registration)) {
?>
            <div class="pure-g serverlist-messages is-center">
<?php
    if ($registration->errors) {
        foreach ($registration->errors as $error) {
            echo '<div class="pure-u-1 bg-error">' . $error . '</div>';
        }
    }
    if ($registration->messages) {
        foreach ($registration->messages as $message) {
            echo '<div class="pure-u-1 bg-success">' . $message . '</div>';
        }
    }
?>
            </div>
<?php
}
?>

<?php if($_GET['import']=='true') { ?>
            <div class="centerbox-container">
                <div class="centerbox pure-g">
                    <h1 class="is-center pure-u-1">Please Change Your Password</h1>
                    <!-- register form -->
                    <form class="pure-form" method="post" action="register<?php if (!$rewrite_enabled) { echo '.php'; }?>" name="registerform">
                        <hr />
                        <fieldset>
                            <!-- the user name input field uses a HTML5 pattern check -->
                            <input class="pure-u-1 pure-u-md-2-3" id="login_input_username" type="hidden" value="<?php echo $_GET['username']; ?>" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required placeholder="Username (only letters and numbers, 2 to 64 characters)" />
                        </fieldset>
                        <fieldset>
                            <label class="pure-u-1 pure-u-md-1-3" for="login_input_password_new">Password</label>
                            <input class="pure-u-1 pure-u-md-2-3" id="login_input_password_new" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" placeholder="Password (min. 6 characters)" />
                        </fieldset>
                        <fieldset>
                            <label class="pure-u-1 pure-u-md-1-3" for="login_input_password_repeat">Repeat password</label>
                            <input class="pure-u-1 pure-u-md-2-3" id="login_input_password_repeat" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" placeholder="Type the password again" />
                        </fieldset>
                        <hr />
                        <button class="pure-button bg-success pure-u-1 pure-u-md-1-3 pull-right" type="submit" name="register" value="Register">Register</button>
                    </form>
                </div>
            </div>
            <?php } else { ?>
            <div class="centerbox-container">
                <div class="centerbox pure-g">
                    <h1 class="is-center pure-u-1">Register a new account</h1>
                    <!-- register form -->
                    <form class="pure-form" method="post" action="register<?php if (!$rewrite_enabled) { echo '.php'; }?>" name="registerform">
                        <hr />
                        <fieldset>
                            <!-- the user name input field uses a HTML5 pattern check -->
                            <label class="pure-u-1 pure-u-md-1-3" for="login_input_username">Username</label>
                            <input class="pure-u-1 pure-u-md-2-3" id="login_input_username" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required placeholder="Username (only letters and numbers, 2 to 64 characters)" />
                        </fieldset>
                        <fieldset>
                            <label class="pure-u-1 pure-u-md-1-3" for="login_input_password_new">Password</label>
                            <input class="pure-u-1 pure-u-md-2-3" id="login_input_password_new" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" placeholder="Password (min. 6 characters)" />
                        </fieldset>
                        <fieldset>
                            <label class="pure-u-1 pure-u-md-1-3" for="login_input_password_repeat">Repeat password</label>
                            <input class="pure-u-1 pure-u-md-2-3" id="login_input_password_repeat" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" placeholder="Type the password again" />
                        </fieldset>
                        <hr />
                        <a class="pure-button bg-warning pure-u-1 pure-u-md-1-3" href="/">Cancel</a>
                        <button class="pure-button bg-success pure-u-1 pure-u-md-1-3 pull-right" type="submit" name="register" value="Register">Register</button>
                    </form>
                </div>
            </div>
            <?php } ?>

        </div>
