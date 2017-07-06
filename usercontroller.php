<?php
ini_set("allow_url_include", true);
// require_once ('/var/www/html/Classes/kint/Kint.class.php');
//require_once ('include.php');
require_once('mystring.class.php');
require_once ('user.class.php');
session_name("lllbackoffice");
session_start();
/* ?>

<!DOCTYPE html>
<html>
<head>
<title>Logged in</title>
</head>
<body>


<?php
 */


if (isset($_COOKIE['uid'])) {$adminuser = json_decode($_COOKIE['uid']);} else { $adminuser = 'not set';}

// kint::enabled(false);
// kint::enabled(true);

// d($_POST);
//controlls the login process
if (isset($_POST['username'])) {$username   = $_POST['username'];} else { $username   = $adminuser->username;}
if (isset($_POST['password'])) {$password   = $_POST['password'];}
if (isset($_POST['newpassword'])) {$newpass = $_POST['newpassword'];}

$user = new User($username);

// d($user);
switch ($_POST['act']) {
	case 'login':
		// create an instance of user in the session array
		//$_SESSION['thisUser'] = new User($username);
		// $output = $user->login($username, $password);
		$output = $user->login($username, urlencode($password));
		// d($output);
		var_dump($output);

		if ($output) {

			// d($_SESSION);
			if (isset($_COOKIE['CallingPage'])) {
				header('Location: '.$_COOKIE['CallingPage']);
			} else {
				header('Location: http://lllbackoffice.com/index.php');
			}
		} else {
			echo "<h1>Invalid Login</h1>";
			echo "Please <a href='http://lllbackoffice.com/login.php'>Try again</a><br>";
			echo "or <a href'userpwdreset.php'>Reset Password</a><br>";
		}
		break;
	case 'reset':
		$output = $user->User_Change_Password($username, $password, $newpass);
		if ($output) {

		} else {
			echo "Failed to change password retry.";
		}
		break;
	case 'forgot':
		$seed   = new MyString;
		$code   = $seed->RandomString();
		$output = $user->User_Forgot_Password($username, $code);
		if ($output) {
			header('Location: forgot_password.php');
		} else {
			echo "Failed to enter code.";
		}
		break;
	case 'forgotreset':
		$username = $_POST['username'];
		$code     = $_POST['code'];
		$newpass  = $_POST['newpassword'];
		$output   = $user->User_Change_Forgotten_Password($username, $code, $newpass);
		if ($output) {
			header('Location: index.php');
		} else {
			echo "Failed to change password retry.";
		}
		break;
	case 'adduser':
		// kint::enabled(false);
		// s('in adduser');
		// d($_POST);
		$username = $_POST['username'];
		$pwd1 = $_POST['pwd1'];
		$pwd2 = $_POST['pwd2'];
		$firstname = $_POST['firstname'];
		$lastname  = $_POST['lastname'];
		$email     = $_POST['email'];
		// $userdept  = $_POST['dept'];
		// $userpriv  = $_POST['user_priv'];
		if (isset($_POST['linenum'])) {
			$linenum = $_POST['linenum'];
			//delete line from file usernotinsystem.log
			$newusers = file('./usernotinsystem.log', FILE_SKIP_EMPTY_LINES);
			$output   = $user->userAdminActivity($newusers[$linenum], $adminuser->id);
			// d($output);
			// d($newusers, $linenum);
			array_splice($newusers, $linenum, 1);
			// d($newusers);

			file_put_contents('./usernotinsystem.log', '');
			$fp = fopen('./usernotinsystem.log', 'w');
			foreach ($newusers as $x) {
				fwrite($fp, $x);
			}
			fclose($fp);
		}

		// d($username, $firstname, $lastname, $email, $userdept);
		if ($pwd1 === $pwd2) {
		$output = $user->Add_User($username, $firstname, $lastname, $email, $pwd1); //, $userdept, $userpriv);
		setcookie('errormsg', "User ".$username." successfully created.", strtotime('+15 second'), '/');
		header('location: http://lllbackoffice.com/index.php');
		} else {
	$_SESSION['errormsg']= "Passwords do not match!";
	header('location: newuser.php');
	} 
		break;
	case 'signup':
		if (isset($_POST['username'])) {$_SESSION['username'] = $_POST['username'];	}
		if (isset($_POST['code'])) {$_SESSION['code']         = $_POST['code'];	}
		header('Location: newuser.php');
		break;
	case 'logout':

		$output = $user->logout($username);
		if ($output) {
			header('Location: http://voiptools.windstream.com/cms/login.php');
		} else {
			echo "Failed to log out.";
		}
		break;
	case 'adminPswdChange':
		// d($_POST);
		$username    = $_POST['username'];
		$newpassword = $_POST['newpass'];
		// d($username, $newpassword);
		$output = $user->User_Admin_Change_Password($username, $newpassword);
		setcookie('errormsg', "Passwords reset!", strtotime('15 seconds'), '/');
		header('location: http://voiptools.windstream.com/index.php');
		break;
	case 'ListUsers':
		$status = $_POST['status'];
		setcookie("ListActive", 1, time()+300);
		if ($status == '1') {
			$_SESSION['active_userlist'] = $user->User_Listing($status);
		} else {
			$_SESSION['inactive_userlist'] = $user->User_Listing($status);
		}
		header('location: http://voiptools.windstream.com/cms/administer.php');
		break;
	case 'UserDeactivate':
		setcookie("ListInActive", 0, time()+300);
		$user->User_Deactivate($_POST['username']);
		$_SESSION['active_userlist'] = $user->User_Listing(1);
		header('location: http://voiptools.windstream.com/cms/administer.php');
		break;
	case 'UserActivate':
		setcookie("ListActive", 1, time()+300);
		$user->User_Activate($_POST['username']);
		$_SESSION['inactive_userlist'] = $user->User_Listing(0);
		header('location: http://voiptools.windstream.com/cms/administer.php');
		break;
	case 'UpdatePriv':
		setcookie("ListActive", 1, time()+300);
		$user->User_ChangePriv($_POST['username'], $_POST['user_priv']);
		$_SESSION['active_userlist'] = $user->User_Listing(1);
		header('location: http://voiptools.windstream.com/cms/administer.php');
		break;
}

/*
</body>
</html>
 */
?>