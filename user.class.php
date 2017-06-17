<?php
ini_set("allow_url_include", true);
// include_once('/var/www/html/Classes/kint/Kint.class.php');  //debug functions
require_once("include.php");

$users = '';


// kint::enabled(false);



Class User {
	// The User class is where all the work is done which involves users There are two tables accessed:
	// dms.user and dms.userpriv
	// Each method is named to be clear as to what it's purpose is. adding comments for each one.

	public function __construct($username) {
		// basic constructor for user it establishes a connection to the database which is used in each of the methods

		GLOBAL $users;
		GLOBAL $thisuser;
		$thisuser = $username;
		// print "In BaseClass constructor\n";
		require('/var/www/html/Classes/mydbi.php');
		require_once('/var/www/html/Classes/mydbconnect.class.php');
		$dbname = 'dms';
		$link=mysql_connect($mysqlserver, $mysqlusername, $mysqlpassword) or die ("Error connecting to mysql server: ".mysql_error());
		s($link, $mysqlserver, $mysqlusername, $mysqlpassword, $dbname);
		mysql_select_db($dbname, $link) or die ("Error selecting specified database on mysql server: ".mysql_error());
		$users = new mydbconnect;
	}


	public function login($uid, $pwd){
			GLOBAL $thisuser;
			// kint::enabled(false); d($uid);
			$authorized = $this->Check_User_Auth($uid,$pwd);
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
			$sql="SELECT active from dms.user where (username = '$uid');";
			$getuser=$users->querydb($sql);
			// dd($getuser);
		
	}

	public function Check_User_Auth($uid,$pwd){
		// is called by $this->login in order to verify the correct password was passed to the login method.
			GLOBAL $users;
			$sql="SELECT username, firstname, lastname, userEmail, userpriv, department, deptId, password, id from dms.user where (username = '$uid' and active='1');";
			// d($sql);
			$getuser=$users->querydb($sql);


		$ch = curl_init("http://166.102.188.239/ata-tools/ldaptest.php?username=$uid&password=$pwd");
		// kint::enabled(false); d($ch);
		// $ch = curl_init("http://166.102.188.239/jonathan/adldap.php?username=$uid&password=$pwd");
			$fp = fopen("./authcheck.txt", "w");
			curl_setopt($ch, CURLOPT_FILE, $fp);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_exec($ch);
			curl_close($ch);
			fclose($fp);
// kint::enabled(false);
// d(sizeof($getuser));
			if (filesize("./authcheck.txt") > 0) {
					passthru("echo '' >> ./auth.log; cat ./authcheck.txt >> ./auth.log");
			//if (hash('sha1',$pwd) == $getuser[1]['password']) {
			// since it's possible someone who isn't in the system can successfully log in and see the base docs check to see if the query returned anything
				if (sizeof($getuser)==0) { //user has valid CSO but is not active in the system
					passthru("echo '' >> ./usernotinsystem.log; cat ./authcheck.txt >> ./usernotinsystem.log");
					$fp=fopen("./authcheck.txt","r");
					$authed=fread($fp, filesize("./authcheck.txt"));
					fclose($fp);
					$loggeduser=json_decode($authed);
					d($loggeduser[0], $authed);
					$splitat=strpos($loggeduser[0][1],' ');
					$firstname=substr($loggeduser[0][1],0,$splitat);
					$lastname=substr($loggeduser[0][1],$splitat+1);

					// d($firstname, $lastname);

					$userArray = array(
						"username" => $loggeduser[0][0],
						"firstname" => $firstname,
						"lastname" => $lastname,
						"userEmail" => $loggeduser[0][3],
						"userpriv" => '1',
						"department" => 'NOC',
						"deptId" => $loggeduser[0][6],
						"id" => '0'
						);
				} else {
					// d($getuser);
				$userArray = array(
					"username" => $getuser[0]['username'],
					"firstname" => $getuser[0]['firstname'],
					"lastname" => $getuser[0]['lastname'],
					"userEmail" => $getuser[0]['userEmail'],
					"userpriv" => $getuser[0]['userpriv'],
					"department" => $getuser[0]['department'],
					"deptId" => $getuser[0]['deptId'],
					"id" => $getuser[0]['id']
					);
				}


					// d($userArray);
				$userJson=json_encode($userArray);
				return($userJson);
			} else { return(FALSE); }
	}


	public function Check_User_Exists($uid){
		// called by $this->login first to verify that the user attempting to log in exists
			GLOBAL $users;
			$getuser='';
			$sql="SELECT * from dms.user where (username = '$uid' and active = 1);";
			$checkuser=$users->querydb($sql);
			// s($checkuser);
			if (isset($checkuser[0]['id'])) {$lines=1;} else { $lines=0;}
			if ( $lines > 0) {	return(TRUE); } else { return(FALSE);}
	}

	public function User_Listing($status){
		// called by $this->login first to verify that the user attempting to log in exists
			GLOBAL $users;
			$getuser='';
			$sql="SELECT * from dms.user where active='$status';";
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
		$sql="update dms.user set active=0 where username='$username';";
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
		$sql="update dms.user set active=1 where username='$username';";
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
		$sql="update dms.user set userpriv='$user_priv' where username='$username';";
		$checkuser=$users->querydb($sql);
		// d($checkuser);
		if (isset($checkuser[0]['id'])) {$lines=1;} else { $lines=0;}
		if ( $lines > 0) {	return($checkuser); } else { return(FALSE);}
	}

	public function GetName($username){
		// returns the firstname of the requested user
		GLOBAL $users;
		$sql="SELECT firstname, lastname from dms.user where username = '$username';";
		$getname=$users->querydb($sql);
		$UserName=$getname[0]['firstname']." ".$getname[0]['lastname'];
		return($UserName);
	}

	public function GetNamebyID($id){
		// returns the firstname of the requested user
		// kint::enabled(false);
		GLOBAL $users;
		$sql="SELECT firstname, lastname from dms.user where id = '$id';";
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
		$sql="SELECT userEmail from dms.user where username = '$username';";
		$GetEmail=$users->querydb($sql);
		// d($GetEmail);
		return($GetEmail[0][email]);
	}

	public function Add_User($uid, $fname, $lname, $email, $department, $user_priv){
		// Adds a user to the dms.user table
			GLOBAL $users;
			$now = new DateTime();
			$time = $now->format('Y-m-d H:i:s');
			//$hashpw=hash('sha1', $pwd);
			$sql="Replace into dms.user (username, firstname, lastname, userpriv, userEmail, created_at, activated_at, active, department, deptId) values ('$uid', '$fname', '$lname', '$user_priv', '$email', '$time', '$time', 1, '$department' , (select id from dms.departments where department='".$department."' ));";
			$adduser=$users->querydb($sql);

	}


	public function Delete_User($du_uid, $fname, $lname, $authpwd ){
		// This method does not actually delete a user from the dms.user table instaed it simply changes the active flag to 0 so the user will not be considered.
			GLOBAL $users;
			// s($du_uid, $fname, $lname, $authpwd );
			if ($this->Check_User_Exists($du_uid)) {
				$authpwd=hash('sha1',$authpwd);
				$authorizedPW = hash('sha1','DeactivateThisUser');
				if ($authpwd == $authorizedPW) {
					$now = new DateTime();
					$time = $now->format('Y-m-d H:i:s');
					$hashpw=hash('sha1', $pwd);
					$sql="UPDATE dms.user SET active=0 WHERE (username='$du_uid' and firstname='$fname' and lastname='$lname');";
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
	// levels are in the dms.userpriv table but here is a list
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
			$sql="select username, userpriv from dms.user where username='$uid_changes';";
			$userrequsting_priv=$users->querydb($sql);
			// s($userrequsting_priv);
			$sql="select username, userpriv from dms.user where username='$uid';";
			$userexisting_priv=$users->querydb($sql);
			// s($userexisting_priv);
			if (($userrequsting_priv[3][userpriv] <= $userexisting_priv[4][userpriv]) or ($userrequsting_priv[3][userpriv] <= $priv)) { return(FALSE);}
			else {
				$sql="update dms.user set userpriv='$priv', last_changed='$time' where username='$uid';";
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
			$sql="select a.userpriv, b.priviledge from dms.user a join dms.userpriv b on a.userpriv = b.priv_code where username='$uid';";
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
			$sql="select department from dms.user where username='$uid';";
			$user_priv=$users->querydb($sql);
			// s($user_priv, $user_priv[0][department]);
			return($user_priv[0][department]);
	}

	public function User_Change_Password($uid, $oldpwd, $newpwd) {
		GLOBAL $users;
		$now = new DateTime();
		$time = $now->format('Y-m-d H:i:s');
		$sql="select password from dms.user where username='$uid';";
		$userpwd=$users->querydb($sql);
		// d($userpwd);
		if (hash('sha1', $oldpwd) == $userpwd[0][password]) {
			$newpass = hash('sha1', $newpwd);
			// puts the hash of the new password in the db clears teh reset code hash from the table
			$sql2="update dms.user set password='$newpass', last_changed='$time' where username='$uid';";
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
		$sql="select userEmail from dms.user where username='$uid';";
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
			$sql="update dms.user set resetcode='$thehash', last_changed='$time' where username='$uid';";
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
		$sql="select resetcode from dms.user where username='$uid';";
		$userpwd=$users->querydb($sql);
		if (hash('sha1', $code) == $userpwd[0][resetcode]) {
			$newpwd = hash('sha1', $newpwd);
			// puts the hash of the new password in the db clears teh reset code hash from the table
			$sql2="update dms.user set password='$newpwd', resetcode='', last_changed='$time' where username='$uid';";
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
			$sql2="update dms.user set password='$newpwd', resetcode='', last_changed='$time' where username='$uid';";
			$userpwdreset=$users->querydb($sql2);
			// d($userpwdreset);
			return($userpwdreset);

	}

	public function userAdminActivity($update, $username)
	{
		// update new table useradmin
		GLOBAL $users;
		$sql="insert into dms.useradmin (admin_userid, userinfo, ts) values('$username', '$update', now());";
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


