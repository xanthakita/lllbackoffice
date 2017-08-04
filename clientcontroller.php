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

// d($client);
switch ($_POST['act']) {
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
		var_dump($output);
		die;
		setcookie('errormsg', "Client ".$username." successfully created.", strtotime('+15 second'), '/');
		header('location: http://lllbackoffice.com/addVisit.php');

		break;
	case 'addVisit':
		// kint::enabled(false);
		// s('in adduser');
		// d($_POST);

 		$act = $_POST['act'];
		$VisitType = $_POST['VisitType'];
		$lashType = $_POST['lashType'];
		$curlType = $_POST['curlType'];
		$Length = $_POST['Length'];
		$Size = $_POST['Size'];
		$eyePadType = $_POST['eyePadType'];
		$glueType = $_POST['glueType'];
		$classicStyle = $_POST['classicStyle'];
		$VolumeType = $_POST['VolumeType'];
		$BottomType = $_POST['BottomType'];
		$Artist = $_POST['Artist'];

		$output = $client->Add_visit($username, $firstname, $lastname, $picture, $email, $pwd1); 
		setcookie('errormsg', "User ".$username." successfully created.", strtotime('+15 second'), '/');
		header('location: http://lllbackoffice.com/index.php');

		break;
	case 'ListUsers':
		$status = $_POST['status'];
		setcookie("ListActive", 1, time()+300);
		if ($status == '1') {
			$_SESSION['active_userlist'] = $client->User_Listing($status);
		} else {
			$_SESSION['inactive_userlist'] = $client->User_Listing($status);
		}
		header('location: http://lllbackoffice.com/administer.php');
		break;
}

/*
</body>
</html>
 */
?>