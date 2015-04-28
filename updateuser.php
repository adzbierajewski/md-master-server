<?php
require_once "library/User.php";

function UpdateUser() {
	$loggedIn = false;
	$username = null;
	$isPasswordUpdate = false;
	$isEmailUpdate = false;

	session_start();
	if(isset($_SESSION["username"])) {
		$username = $_SESSION["username"];
		$loggedIn = true;
	}

	$password = $_REQUEST["password"];
	$newPassword = $_REQUEST["newpassword"];
	$newPasswordAgain = $_REQUEST["newpasswordagain"];
	$email = $_REQUEST["email"];

	$user = User::getUser($username);
	if($user === null || !$user->checkPassword($password)) { //Check to see if user can be found in database and correct password.
		throw new Exception("Error: Incorrect password.");
	} else {
		if($newPassword !== null && $newPasswordAgain !== null) { //Are we changing the password?
			if($newPassword !== $newPasswordAgain) {
				throw new Exception("Error: New password does not match.");
			} else {
				$user->setPassword($newPassword);
				$isPasswordUpdate = true;
			}
		}
		if($email != null) {
			$user->setEmail($email);
			$isEmailUpdate = true;
		}

		if($isPasswordUpdate || $isEmailUpdate) {
			//Ready to update user
			User::updateUser($user);

			if($isPasswordUpdate && $isEmailUpdate) {
				return "User successfully updated.";
			} elseif($isPasswordUpdate) {
				return "Password successfully updated.";
			} else {
				return "Email address updated";
			}
		} else {
			throw new Exception("Error: No user information to update.");
			if($_GET['action']=='hard_link'){
				header('Location: index.php?action=update_user&error=1&message=' . $message);
			}
		}
	}
}

try {
	$message = UpdateUser();
	$result = "true";
} catch (Exception $e) {
	$message = $e->getMessage();
	$result = "false";
}
//JSON output
?>{
	"result":<?php echo $result; ?>,
	"message":"<?php echo $message; ?>"
}
<?php
if($_GET['action']=='hard_link'){
	header('Location: index.php?action=update_user');
}
