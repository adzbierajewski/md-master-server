		<div class="serverlist-wrapper">
<?php
// show potential errors / feedback (from login object)
if (isset($login)) {
?>
			<div class="pure-g serverlist-messages is-center">
<?php
	if ($login->errors) {
		foreach ($login->errors as $error) {
			echo '<div class="pure-u-1 bg-error">' . $error . '</div>';
		}
	}
	if ($login->messages) {
		foreach ($login->messages as $message) {
			echo '<div class="pure-u-1 bg-success">' . $message . '</div>';
		}
	}
?>
			</div>
<?php
}
?>
			<h1 class="is-center">Manic Digger Online Servers</h1>
			<div class="pure-g serverlist">
<?php
require_once "classes/Utility.php";
require_once "classes/Server.php";

$loggedIn = false;
$username = null;

if(isset($_SESSION["user_name"])) {
	$username = $_SESSION["user_name"];
	$loggedIn = true;
}

$servers = Server::getServerList();
$now = new DateTime();

foreach($servers as $s) {
	$link = "md://" . htmlspecialchars($s->getAddress()) . ":" . htmlspecialchars($s->getPort()) . "/?";
	if($loggedIn) { $link .= "user=" . urlencode($username) . "&auth=" . urlencode(md5($s->getPrivateKey() . $username)) . "&"; }
	$link .= "serverPassword=" . $s->getPasswordProtected();
	$heartbeat = new DateTime($s->getLastHeartbeatDate());
	$dateDiff = $now->diff($heartbeat);
	$timeDiff = $now->getTimestamp() - $heartbeat->getTimestamp();
	$offline = false;
	if($timeDiff > 300) { $offline = true; }
?>
				<div class="serverlist-entry">
					<h2 class="pure-u-1">
<?php
	echo '<a href="' . $link . '"';
	if($offline) {
		echo ' class="offline-link"';
	}
	echo '>';
	if(strtoupper($s->getPasswordProtected()) === 'TRUE') {
		echo '<img src="img/lock.png" alt="Server requires password." title="Server requires password."/>';
	}
	echo '[' . htmlspecialchars($s->getGameMode()) . '] ' . htmlspecialchars($s->getName()) .
	'<small> (' . htmlspecialchars($s->getUserCount() . '/' . $s->getMaxClients()) . ')</small></a>';
?>
					</h2>
					<a class="pure-u-1-6" href="http://mdgallery.strangebutfunny.net/browse.php?serverhash=<?php echo $s->getPublicKey(); ?>">
						<img class="pure-img serverlist-image" src="http://mdgallery.strangebutfunny.net/serverimage.php?server=<?php echo $s->getPublicKey(); ?>" onerror="this.style.display='none'"/>
					</a>
					<div class="pure-u-2-3">
						<p><?php echo htmlspecialchars($s->getMotd()); ?><br/>
						Address: <strong><?php echo htmlspecialchars($s->getAddress()); ?></strong><br/>
						Players: <strong><?php echo htmlspecialchars($s->getUserList()); ?></strong><br/>
						Version: <strong><?php echo htmlspecialchars($s->getVersion()); ?></strong><br/>
						Last Ping: <strong><?php echo Utility::formatDateDiff($dateDiff); ?> ago</strong></p>
					</div>
					<div class="pure-u-1-6">
						<a <?php echo 'href="' . $link . '" '; if($offline) { ?>class="pure-button bg-error">Offline<?php } else { ?>class="pure-button bg-success">Online<?php } ?></a>
					</div>
				</div>
<?php } ?>
<?php if(!$servers) { echo '<div class="pure-u-1"><center>There is nothing here... :(</center></div>'; } ?>
			</div>
			<div class="footer l-box is-center">
				Brought to you with lots of love by <a href="https://github.com/manicdigger/manicdigger/graphs/contributors">those guys</a>.<br/>
				<small>Website design by Anthony &amp; croxxx. Using some icons made by <a href="http://martz90.deviantart.com/art/Hex-Icons-Pack-389706981">Martz90</a>.</small>
			</div>
		</div>
