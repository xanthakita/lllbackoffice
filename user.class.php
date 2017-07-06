<?php
ini_set("allow_url_include", true);
// include_once('/var/www/html/Classes/kint/Kint.class.php');  //debug functions
//require_once("include.php");

$users = '';


// kint::enabled(false);



Class User {
	// The User class is where all the work is done which involves users There are two tables accessed:
	// lllbackoffice.user and lllbackoffice.userpriv
	// Each method is named to be clear as to what it's purpose is. adding comments for each one.

	public function __construct($username) {
		// basic constructor for user it establishes a connection to the database which is used in each of the methods

		GLOBAL $users;
		GLOBAL $thisuser;
		$thisuser = $username;
		// print "In BaseClass constructor\n";
		require('/var/www/html/Classes/mydbi.php');
		require_once('/var/www/html/Classes/mydbconnect.class.php');
		$dbname = 'lllbackoffice';
		$link=mysqli_connect($mysqlserver, $mysqlusername, $mysqlpassword, $dbname) or die ("Error connecting to mysql server: ".mysql_error());
		//s($link, $mysqlserver, $mysqlusername, $mysqlpassword, $dbname);
		// mysql_select_db($dbname, $link) or die ("Error selecting specified database on mysql server: ".mysql_error());
		$users = new mydbconnect;
	}


	public function login($uid, $pwd){
			GLOBAL $thisuser;
			// kint::enabled(false); d($uid);
			var_dump($pwd);
			$authorized = $this->Check_User_Auth($uid,$pwd);
			var_dump($authorized);
		// Logs a user in and starts a session for the logged in user.
		if ($this->Check_User_Exists($uid)) {
			if ($authorized != FALSE) {
				$session = htmlentities(var_export($_SESSION, true));
				setcookie('uid',$uid, strtotime('+1 day'), '/');

				// d($_SESSION);
				if (isset($authorized)){
					// build session variable for user
					setcookie('uid',$authorized, strtotime('+8 hour'), '/');
					//$_SESSION['thisUser'] = $authorized;
					//session_name("nocdms");
					//session_start();
				}
				return(TRUE);
			}
		} else {
			if ($authorized != FALSE) {
				$session = htmlentities(var_export($_SESSION, true));
				setcookie('uid',$uid, strtotime('+1 day'), '/');

				// d($_SESSION);
				if (isset($authorized)){
					// build session variable for user
					setcookie('uid',$authorized, strtotime('+8 hour'), '/');
					//$_SESSION['thisUser'] = $authorized;
					//session_name("nocdms");
					//session_start();
				}
				return(TRUE);
			} else {
				setcookie('uid',$uid, strtotime('-1 minute'), '/');
				setcookie('errormsg','Incorrect Login!', strtotime('+15 second'), '/');
			 	return FALSE;
			}
		}
	}

	public function logout($uid){
		// clears users vars and clears the Session var
		$_SESSION = null;
		setcookie('uid',$uid, strtotime('-1 minute'), '/');
		session_destroy();
		echo "Logging $uid out.\n";
		return(TRUE);
	}

	public function Check_User_Active($uid){
			GLOBAL $users;
			// kint::enabled(true);
			$sql="SELECT active from lllbackoffice.user where (username = '$uid');";
			$getuser=$users->querydb($sql);
			// dd($getuser);
		
	}

	public function Check_User_Auth($uid,$pwd){
		// is called by $this->login in order to verify the correct password was passed to the login method.
			GLOBAL $users;
			$sql="SELECT username, firstname, lastname, userEmail, password, id from lllbackoffice.user where (username = '$uid');";
			// d($sql);
			$getuser=$users->querydb($sql);
			var_dump(hash('sha256',$pwd));
			var_dump($getuser]);
			if (hash('sha256',$pwd) == $getuser[1]['password']) {
					// d($getuser);
				$userArray = array(
					"username" => $getuser[0]['username'],
					"firstname" => $getuser[0]['firstname'],
					"lastname" => $getuser[0]['lastname'],
					"userEmail" => $getuser[0]['userEmail'],
					"id" => $getuser[0]['id']
					);
					// d($userArray);
				$userJson=json_encode($userArray);
				return($userJson);
			} else { return(FALSE); }
	}


	public function Check_User_Exists($uid){
		// called by $this->login first to verify that the user attempting to log in exists
			GLOBAL $users;
			$getuser='';
			$sql="SELECT * from lllbackoffice.user where (username = '$uid' and active = 1);";
			$checkuser=$users->querydb($sql);
			// s($checkuser);
			if (isset($checkuser[0]['id'])) {$lines=1;} else { $lines=0;}
			if ( $lines > 0) {	return(TRUE); } else { return(FALSE);}
	}

	public function User_Listing($status){
		// called by $this->login first to verify that the user attempting to log in exists
			GLOBAL $users;
			$getuser='';
			$sql="SELECT * from lllbackoffice.user where active='$status';";
			$checkuser=$users->querydb($sql);
			// s($checkuser);
			if (isset($checkuser[0]['id'])) {$lines=1;} else { $lines=0;}
			if ( $lines > 0) {	return($checkuser); } else { return(FALSE);}
	}

	public function User_Deactivate($username){
		GLOBAL $users;
		// kint::enabled(false);
		// d($username);
		$getuser='';
		$sql="update lllbackoffice.user set active=0 where username='$username';";
		$checkuser=$users->querydb($sql);
		// d($checkuser);
		if (isset($checkuser[0]['id'])) {$lines=1;} else { $lines=0;}
		if ( $lines > 0) {	return($checkuser); } else { return(FALSE);}
	}

	public function User_Activate($username){
		GLOBAL $users;
		// kint::enabled(false);
		// d($username);
		$getuser='';
		$sql="update lllbackoffice.user set active=1 where username='$username';";
		$checkuser=$users->querydb($sql);
		// d($checkuser);
		if (isset($checkuser[0]['id'])) {$lines=1;} else { $lines=0;}
		if ( $lines > 0) {	return($checkuser); } else { return(FALSE);}
	}

	public function User_ChangePriv($username, $user_priv){
		GLOBAL $users;
		// kint::enabled(false);
		// d($username);
		$getuser='';
		$sql="update lllbackoffice.user set userpriv='$user_priv' where username='$username';";
		$checkuser=$users->querydb($sql);
		// d($checkuser);
		if (isset($checkuser[0]['id'])) {$lines=1;} else { $lines=0;}
		if ( $lines > 0) {	return($checkuser); } else { return(FALSE);}
	}

	public function GetName($username){
		// returns the firstname of the requested user
		GLOBAL $users;
		$sql="SELECT firstname, lastname from lllbackoffice.user where username = '$username';";
		$getname=$users->querydb($sql);
		$UserName=$getname[0]['firstname']." ".$getname[0]['lastname'];
		return($UserName);
	}

	public function GetNamebyID($id){
		// returns the firstname of the requested user
		// kint::enabled(false);
		GLOBAL $users;
		$sql="SELECT firstname, lastname from lllbackoffice.user where id = '$id';";
		$getname=$users->querydb($sql);
		if (is_array($getname)) {$UserName=array_pop($getname);} else {$UserName='';}
		$TheUser=$UserName['firstname']." ".$UserName['lastname'];
		// d($getname, $TheUser, $id);
		// kint::enabled(false);
		return($TheUser);
	}

	public function GetEmail($username){
		// returns the firstname of the requested user
		GLOBAL $users;
		$sql="SELECT userEmail from lllbackoffice.user where username = '$username';";
		$GetEmail=$users->querydb($sql);
		// d($GetEmail);
		return($GetEmail[0][email]);
	}

	public function Add_User($uid, $fname, $lname, $email, $pwd){
		// Adds a user to the user table
			GLOBAL $users;
			$now = new DateTime();
			$time = $now->format('Y-m-d H:i:s');
			$hashpw=hash('sha256', $pwd);
			$sql="Replace into lllbackoffice.user (username, firstname, lastname, userEmail, password ,active, added_at, last_updated) values ('$uid', '$fname', '$lname', '$email', '$hashpw','1', '$time', '$time');";
			$adduser=$users->querydb($sql);

	}


	public function Delete_User($du_uid, $fname, $lname, $authpwd ){
		// This method does not actually delete a user from the lllbackoffice.user table instaed it simply changes the active flag to 0 so the user will not be considered.
			GLOBAL $users;
			// s($du_uid, $fname, $lname, $authpwd );
			if ($this->Check_User_Exists($du_uid)) {
				$authpwd=hash('sha1',$authpwd);
				$authorizedPW = hash('sha1','DeactivateThisUser');
				if ($authpwd == $authorizedPW) {
					$now = new DateTime();
					$time = $now->format('Y-m-d H:i:s');
					$hashpw=hash('sha1', $pwd);
					$sql="UPDATE lllbackoffice.user SET active=0 WHERE (username='$du_uid' and firstname='$fname' and lastname='$lname');";
					$deluser=$users->querydb($sql);
					$retval='TRUE';
					s($retval);
					return($retval);
				}
			} else {
				// s($retval);
				$retval='FALSE';
				return($retval);
			}
		echo "Retval set to: $retval";
		return($retval);
	}


	public function Set_User_Priv($uid, $priv, $uid_changes){
	// allows the priviledge level to be set for a given user. I can only be set by someone with a higher prib level than the requested level.
	// levels are in the lllbackoffice.userpriv table but here is a list
	// 0  - pending   		-- User has to be approved by the Administrator
	// 1  - reader    		-- Read only access to the documents everyone should have read only access unless specifically indicated otherwise.
	// 2  - editor    		-- This user can check a document out and make changes and check it back in (changes have to be approved by the Administrator or Author)
	// 3  - author    		-- This user can create new documents. All new documents must be approved by the administrator before they will show up in the system.
	// 40 - approver		-- This user can approve documents as far as policy and procedures.
	// 50 - process_owner	-- This user owns the processes and with approver has approval rights.
	// 99 - admin     		-- This user has full access to everything in the system. can add /remove users and docs etc.
	// The Set_User_Priv can only be accomplished by someone with a higher access level than the current or desired access. for example an author can change a pending (0) to
	// an editor (2), but can not change anyone to an author (3) status. Likewise they can not change anyone to a higher level than themselves.
	// Administrators will currently be set manually I may change this to allow the Administrator to add other admins.

			GLOBAL $users;
			// s($uid, $priv, $uid_changes);
			$now = new DateTime();
			$time = $now->format('Y-m-d H:i:s');
			// check to see if requesting user ($uid_changes) has higher perms than user being changed ($uid)
			$sql="select username, userpriv from lllbackoffice.user where username='$uid_changes';";
			$userrequsting_priv=$users->querydb($sql);
			// s($userrequsting_priv);
			$sql="select username, userpriv from lllbackoffice.user where username='$uid';";
			$userexisting_priv=$users->querydb($sql);
			// s($userexisting_priv);
			if (($userrequsting_priv[3][userpriv] <= $userexisting_priv[4][userpriv]) or ($userrequsting_priv[3][userpriv] <= $priv)) { return(FALSE);}
			else {
				$sql="update lllbackoffice.user set userpriv='$priv', last_changed='$time' where username='$uid';";
				$userchanged_priv=$users->querydb($sql);
				// s($userchanged_priv);
				return($userchanged_priv);
			}
	}

	public function Get_User_Priv($uid){

			// Method returns the current priviledge level of the provided user.

			GLOBAL $users;

			$now = new DateTime();
			$time = $now->format('Y-m-d H:i:s');
			$sql="select a.userpriv, b.priviledge from lllbackoffice.user a join lllbackoffice.userpriv b on a.userpriv = b.priv_code where username='$uid';";
			$user_priv=$users->querydb($sql);
			// s($user_priv, $user_priv[3][priviledge]);
			return($user_priv[3][priviledge]);
	}

	public function Get_User_Dept($uid){
			// kint::enabled(false); s($uid);
			// Method returns the current group (VNOC, TN C, DNOC, CNOC, etc.) of the provided user.

			GLOBAL $users;

			$now = new DateTime();
			$time = $now->format('Y-m-d H:i:s');
			$sql="select department from lllbackoffice.user where username='$uid';";
			$user_priv=$users->querydb($sql);
			// s($user_priv, $user_priv[0][department]);
			return($user_priv[0][department]);
	}

	public function User_Change_Password($uid, $oldpwd, $newpwd) {
		GLOBAL $users;
		$now = new DateTime();
		$time = $now->format('Y-m-d H:i:s');
		$sql="select password from lllbackoffice.user where username='$uid';";
		$userpwd=$users->querydb($sql);
		// d($userpwd);
		if (hash('sha1', $oldpwd) == $userpwd[0][password]) {
			$newpass = hash('sha1', $newpwd);
			// puts the hash of the new password in the db clears teh reset code hash from the table
			$sql2="update lllbackoffice.user set password='$newpass', last_changed='$time' where username='$uid';";
			$userpwdreset=$users->querydb($sql2);
			return(TRUE);
		} else {
			$output = "Sorry incorrect current password provided, please try again!";
			return($output);
		}
	}

	function User_Check_Session($uid)
	{
		// checks to see if the cookie exists for a user and if it does does it match the current user and if so returns true otherwise false.
		if (isset($_COOKIE['uid'])) {if($_COOKIE['uid'] == $uid){return(TRUE);} else {return(FALSE);}}
	}

	public function User_Forgot_Password($uid, $code) {
		// kint::enabled(false);
		GLOBAL $users;
		$now = new DateTime();
		$time = $now->format('Y-m-d H:i:s');
		// s($uid, $code);
		$sql="select userEmail from lllbackoffice.user where username='$uid';";
		$email=$users->querydb($sql);
		$myRecipient=$email[0]['userEmail'];
		// d($email);
		// d($myRecipient);
		// first we will send an email with a random code for the user to copy and paste into the password reset form
		$myMessage = "<html><head><title>Password Reset for VNOC Document Management System</title></head><body><p>Please copy the code between the |'s, go this url:  http://voiptools.windstream.com/test/cms/forgot_password.php</p><strong>The code is:<h2>|".$code."|</h2></strong></body></html>";
		$myFrom="nocdms@vnoc.windstream.com";
		$myReplyTo="nocdms@vnoc.windstream.com";

		$mySubject="Password Reset Code";
		$myHeaders = "MIME-Version: 1.0" . "\r\n";
		$myHeaders .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$myHeaders .= "From: ".$myFrom."\r\n";


		// s($myMessage,$myReplyTo,$myRecipient, $mySubject,$myFrom, $myHeaders  );
		//mail($myRecipient,$mySubject,$myMessage ,$myHeaders);
		if (mail($myRecipient,$mySubject,$myMessage ,$myHeaders)) {
			// next we put the hased version of the code into the database
			$thehash=hash('sha1',$code);
			$sql="update lllbackoffice.user set resetcode='$thehash', last_changed='$time' where username='$uid';";
			$userchanged_pwd=$users->querydb($sql);

			return($code);
		} else {
			return(FALSE);
		}

	}

	public function User_Change_Forgotten_Password($uid, $code, $newpwd) {
		GLOBAL $users;
		$now = new DateTime();
		$time = $now->format('Y-m-d H:i:s');
		$sql="select resetcode from lllbackoffice.user where username='$uid';";
		$userpwd=$users->querydb($sql);
		if (hash('sha1', $code) == $userpwd[0][resetcode]) {
			$newpwd = hash('sha1', $newpwd);
			// puts the hash of the new password in the db clears teh reset code hash from the table
			$sql2="update lllbackoffice.user set password='$newpwd', resetcode='', last_changed='$time' where username='$uid';";
			$userpwdreset=$users->querydb($sql2);
			return(TRUE);
		} else {
			$output = "Sorry incorrect code provided, please try again!";
			return($output);
		}
	}

	public function User_Admin_Change_Password($uid, $newpwd) {
		GLOBAL $users;
		$now = new DateTime();
		$time = $now->format('Y-m-d H:i:s');
		$newpwd = hash('sha1', $newpwd);
			// puts the hash of the new password in the db clears teh reset code hash from the table
			$sql2="update lllbackoffice.user set password='$newpwd', resetcode='', last_changed='$time' where username='$uid';";
			$userpwdreset=$users->querydb($sql2);
			// d($userpwdreset);
			return($userpwdreset);

	}

	public function userAdminActivity($update, $username)
	{
		// update new table useradmin
		GLOBAL $users;
		$sql="insert into lllbackoffice.useradmin (admin_userid, userinfo, ts) values('$username', '$update', now());";
		$updated=$users->querydb($sql);
		return($updated);
	}

	public function __deconstruct(){
		// Clear global vars
		GLOBAL $users;
		$users = '';
		$sql = '';
	}
}


