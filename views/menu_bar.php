		<div class="header">
			<div class="home-menu pure-menu pure-menu-horizontal pure-menu-fixed">
<?php
//if (!$view_location=="index") {
	if (isset($_SESSION['user_name'])) {
		// user logged in
?>
				<div class="header-login pure-menu-heading">
					Logged in as: <b><?php echo $_SESSION['user_name']; ?></b>
					<a href="<?php if (!$rewrite_enabled) { echo 'index.php?location=servers&amp;'; } else { echo 'servers?'; } ?>logout" class="pure-button bg-warning">Logout</a>
					<a href="<?php if (!$rewrite_enabled) { echo 'index.php?location=skin'; } else { echo 'skin'; } ?>" class="pure-button bg-warning">Change Skin</a>

				</div>
<?php
	} else {
		// user not logged in
?>
				<div class="header-login">
					<form id="login" action="<?php if (!$rewrite_enabled) { echo 'index.php?location='; } ?>servers" class="pure-form" method="post">
						<fieldset>
							<input class="pure-input-1-5" name="user_name" type="text" placeholder="Username" />
							<input class="pure-input-1-5" name="user_password" type="password" placeholder="Password" />
							<button type="submit" name="login" class="pure-button bg-success">Sign in</button>
							<a href="./register<?php if (!$rewrite_enabled) { echo '.php'; }?>" class="pure-button">Register</a>
							<!-- <label for="rememberme">
								<input name="rememberme" type="checkbox" /> Remember me
							</label> -->
						</fieldset>
					</form>
				</div>
<?php
	}
//}
?>
				<ul class="pure-menu-list">
					<li class="pure-menu-item<?php if ($view_location == 'index') {echo ' pure-menu-selected';} ?>"><a href="/" class="pure-menu-link">Home</a></li>
					<li class="pure-menu-item"><a href="//forum.manicdigger.io/" class="pure-menu-link">Forum</a></li>
					<li class="pure-menu-item"><a href="//wiki.manicdigger.io/" class="pure-menu-link">Wiki</a></li>
					<!--<li class="pure-menu-item"><a href="http://mdgallery.strangebutfunny.net/" class="pure-menu-link">Gallery</a></li>-->
					<li class="pure-menu-item<?php if ($view_location == 'servers') {echo ' pure-menu-selected';} ?>"><a href="/<?php if (!$rewrite_enabled) { echo 'index.php?location='; } ?>servers" class="pure-menu-link">Serverlist</a></li>
				</ul>
			</div>
		</div>
