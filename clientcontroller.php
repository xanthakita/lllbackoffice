<?php
ini_set("allow_url_include", true);
require_once ('/var/www/html/Classes/kint.php');
require_once ('Classes/include.php');
require_once('mystring.class.php');
require_once ('user.class.php');
require_once ('client.class.php');
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



// d($_POST);
//controlls the login process
if (isset($_POST['username'])) {$username   = $_POST['username'];} else { $username   = $adminuser->username;}
if (isset($_POST['password'])) {$password   = $_POST['password'];}
if (isset($_POST['newpassword'])) {$newpass = $_POST['newpassword'];}

$client = new Client($username);

// d($user);
switch ($_POST['act']) {
	case 'login':
		// create an instance of user in the session array
		$_SESSION['thisUser'] = new User($username);
		// $output = $user->login($username, $password);
		$output = $user->login($username, urlencode($password));
		// d($output);
		// var_dump($output);

		if ($output) {

			 // d($thisUser);
			if (isset($_COOKIE['CallingPage'])) {
				header('Location: '.$_COOKIE['CallingPage']);
			} else {
				setcookie('userid',$username, strtotime('+8 hour'), '/');
				header('Location: http://lllbackoffice.com/index.php');
			}
		} else {
			echo "<div class='container center-text'><div class='well'><h1>Invalid Login</h1>";
			echo "Please <a href='http://lllbackoffice.com/login.php'>Try again</a><br>";
			echo "or <a href'userpwdreset.php'>Reset Password</a><br>";
			echo "</div></div>";
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
	case 'addclient':
		// kint::enabled(false);
		// s('in adduser');
		// d($_POST);

 		$act = $_POST['act'];
 		$firstName = $_POST['firstName'];
 		$lastName = $_POST['lastName']; 
 		$firstVisit = $_POST['firstVisit'];
 		$phone = $_POST['phone'];
 		$email = $_POST['email'];
 		$city = $_POST['city'];
 		$state = $_POST['state'];
 		$birthmonth = $_POST['birthmonth'];
 		$birthday = $_POST['birthday'];
		$heardAbout = $_POST['heardAbout'];
		$referal = $_POST['referal'];
		$tempname=$_FILES['clientimage']['tmp_name'];
		$picture=$_FILES['clientimage']['name'];
		// images

		$target_dir = "images/clients/";
		$target_file = $target_dir . $username. substr($picture, -4);
		$uploadOk = 1;
		passthru("mv " . $tempname . " " . $target_file . " && chmod 755 " . $target_file);

		// d($username, $firstname, $lastname, $email, $userdept);

		$output = $client->Add_Client($firstName, $lastName, $firstVisit, $phone, $email, $city, $state, $birthmonth, $birthday, $heardAbout, $referal, $picture); 

		setcookie('errormsg', "Client ".$username." successfully created.", strtotime('+15 second'), '/');
		header('location: http://lllbackoffice.com/addvisit.php');

		break;
	case 'addvisit':
		// kint::enabled(false);
		// s('in adduser');
		// d($_POST);

 		$act = $_POST['act'];
 		$firstName = $_POST['firstName'];
 		$lastName = $_POST['lastName'];
 		$firstVisit = $_POST['firstVisit'];
 		$phone = $_POST['phone'];
 		$email = $_POST['email'];
 		$city = $_POST['city'];
 		$state = $_POST['state'];
 		$birthmonth = $_POST['birthmonth'];
 		$birthday = $_POST['birthday'];
		$heardAbout = $_POST['heardAbout'];
		$referal = $_POST['referal'];
		$tempname=$_FILES['clientimage']['tmp_name'];
		$picture=$_FILES['clientimage']['name'];
		// images

		$target_dir = "images/clients/";
		$target_file = $target_dir . $username. substr($picture, -4);
		$uploadOk = 1;
		passthru("mv " . $tempname . " " . $target_file . " && chmod 755 " . $target_file);

		// d($username, $firstname, $lastname, $email, $userdept);

		$output = $user->Add_User($username, $firstname, $lastname, $picture, $email, $pwd1); //, $userdept, $userpriv);
		setcookie('errormsg', "User ".$username." successfully created.", strtotime('+15 second'), '/');
		header('location: http://lllbackoffice.com/index.php');

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
		$tempname=$_FILES['artistimage']['tmp_name'];
		$picture=$_FILES['artistimage']['name'];
		// images

		$target_dir = "images/artists/";
		$target_file = $target_dir . $username. substr($picture, -4);
		$uploadOk = 1;
		passthru("mv " . $tempname . " " . $target_file . " && chmod 755 " . $target_file);

		// d($username, $firstname, $lastname, $email, $userdept);
		if ($pwd1 === $pwd2) {
		$output = $user->Add_User($username, $firstname, $lastname, $picture, $email, $pwd1); //, $userdept, $userpriv);
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
			header('Location: http://lllbackoffice.com/login.php');
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
		header('location: http://lllbackoffice.com/index.php');
		break;
	case 'ListUsers':
		$status = $_POST['status'];
		setcookie("ListActive", 1, time()+300);
		if ($status == '1') {
			$_SESSION['active_userlist'] = $user->User_Listing($status);
		} else {
			$_SESSION['inactive_userlist'] = $user->User_Listing($status);
		}
		header('location: http://lllbackoffice.com/administer.php');
		break;
	case 'UserDeactivate':
		setcookie("ListInActive", 0, time()+300);
		$user->User_Deactivate($_POST['username']);
		$_SESSION['active_userlist'] = $user->User_Listing(1);
		header('location: http://lllbackoffice.com/administer.php');
		break;
	case 'UserActivate':
		setcookie("ListActive", 1, time()+300);
		$user->User_Activate($_POST['username']);
		$_SESSION['inactive_userlist'] = $user->User_Listing(0);
		header('location: http://lllbackoffice.com/administer.php');
		break;
	case 'UpdatePriv':
		setcookie("ListActive", 1, time()+300);
		$user->User_ChangePriv($_POST['username'], $_POST['user_priv']);
		$_SESSION['active_userlist'] = $user->User_Listing(1);
		header('location: http://lllbackoffice.com/administer.php');
		break;
}

/*
</body>
</html>
 */
?>