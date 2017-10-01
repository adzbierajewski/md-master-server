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
			<h1 class="is-center">Manic Digger Ideas</h1>
			<div class="is-center"><a href="/ideas/?new" class="pure-button bg-warning">Create New Idea</a></div>
			<div class="pure-g serverlist">
<?php
require_once "classes/Utility.php";
require_once "classes/Idea.php";
	function time_since($time)
{
	$time = strtotime($time);
    $time = time() - $time; // to get the time since that moment
    $time = ($time<1)? 1 : $time;
    $tokens = array (
        31536000 => 'years ago',
        2592000 => 'months ago',
        604800 => 'weeks ago',
        86400 => 'days ago',
        3600 => 'hours ago',
        60 => 'minutes ago',
        1 => 'seconds ago'
    );

    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits.' '.$text;
    }

}
$loggedIn = false;
$username = null;

if(isset($_SESSION['user_name'])) {
	$username = $_SESSION['user_name'];
	$loggedIn = true;
}

$ideas = Idea::getIdeaList();
$now = new DateTime();

if(!(isset($_GET['i']) || isset($_GET['new']))){
foreach($ideas as $i) {
	$heartbeat = new DateTime($i->getLastHeartbeatDate());
	$dateDiff = $now->diff($heartbeat);
	$timeDiff = $now->getTimestamp() - $heartbeat->getTimestamp();
?>
				<div class="serverlist-entry">
					<h2 class="pure-u-1">
					<img src="/img/up_vote.png" />
						<img src="/img/down_vote.png" />
<?php
	echo '<a href=/ideas?i=' . $i->getIdeaId() . '>' . htmlspecialchars($i->getName()) . '</a>';
	
?>
					</h2>
				
			
					<div class="pure-u-2-3">
						<p><?php echo time_since($i->getCreatedDate()); ?><br/>
						by <i><?php echo $i->getCreator(); ?></i><br/>
						</p>
					</div>
				</div>
				</div>
<?php } ?>
<?php }


if(isset($_GET['i'])){
	$ideas = Idea::getSingleIdea($_GET['i']);
foreach($ideas as $i) {
	$heartbeat = new DateTime($i->getLastHeartbeatDate());
	$dateDiff = $now->diff($heartbeat);
	$timeDiff = $now->getTimestamp() - $heartbeat->getTimestamp();
?>
				<div class="serverlist-entry">
					<h1 class="pure-u-1">
<?php
	echo htmlspecialchars($i->getName());
?>
					</h1>
					<div class="pure-u-2-3">

					</div>
					<div class="pure-u-1-2">
					<?php echo $i->get_Text(); ?>
					</div>
				</div>
<?php } ?>
<?php } ?>

<?php if(isset($_GET['new'])){ ?>
<div class="centerbox-container">
                <div class="centerbox pure-g">
                    <h1 class="is-center pure-u-1">Register a new account</h1>
                    <!-- register form -->
                    <form class="pure-form" method="post" action="register<?php if (!$rewrite_enabled) { echo '.php'; }?>" name="registerform">
                        <hr />
                        <fieldset>
                            <!-- the user name input field uses a HTML5 pattern check -->
                            <label class="pure-u-1 pure-u-md-1-3" for="login_input_username">Idea</label>
                            <textarea class="pure-input-1-2" id="login_input_username" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required placeholder="Username (only letters and numbers, 2 to 64 characters)"></textarea>
                        </fieldset>
                        <hr />
                        <a class="pure-button bg-warning pure-u-1 pure-u-md-1-3" href="/ideas">Cancel</a>
                        <button class="pure-button bg-success pure-u-1 pure-u-md-1-3 pull-right" type="submit" name="register" value="Submut">Submut</button>
                    </form>
                </div>
            </div>
<?php } ?>
			</div>

		</div>
