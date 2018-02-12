<?php 
/*
 ====================================
 Jonathan Wagner
 Xanthakita@gmail.com
 Wild Bunch Productions
 ====================================
 FILE NAME:          include.php
  TAB SIZE:          4
 SOFT TABS:          NO
 ====================================
 Copywrite @2017
 */
 require_once('/var/www/html/Classes/loggen.class.php');
 $username="";
 	if (!isset($log)){
	 	$log = new logGen('xanthakita','./backoffice.log',TRUE);
	}
	// error_reporting(E_ALL);
	$script=$log->thisScript();
	$log->logthis(LOG_DEBUG, "script: $script");
	$log->logthis(LOG_DEBUG, "COOKIES".print_r($_COOKIE, TRUE));
	if (($script!="login.php") AND (!isset($_COOKIE["uid"]))) {
		$log->logthis(LOG_DEBUG, 'User not loggedin. going to login.php');
		header('location: login.php');
	} else {
		$username=$_COOKIE["uid"];
		$log->logThis(LOG_DEBUG, "User logged in: $username");
		require_once('user.class.php');
		$artist = new User($username);
		$artistsList=$artist->Get_Artists();
		$log->logthis(LOG_DEBUG, "artists: $artistsList");
		if (isset($_GET['client'])){
			$clientid=$_GET['client'];
		}
	}
 ?>

	<link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32" />
	<link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16" />
	<link rel=icon href=favicon.png sizes="16x16" type="image/png">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

