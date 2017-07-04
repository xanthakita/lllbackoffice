<?php 
/*
 ====================================
 Jonathan Wagner
 xanthakita@gmail.com
 NOC Tools Response Team
 ====================================
 FILE NAME:          logout.php
  TAB SIZE:          4
 SOFT TABS:          NO
 ====================================
 Copywrite @2015
 
	Login verifys access and access level
	access levels: 
	admin: can do anything
	manager: can add and delete people
	user: can add and edit customers can mark customers inactive
 */ 

//setcookie("userid", "test_value", time() + (60 * 30), "/"); // 86400 = 1 day
	if (isset($_COOKIE["userid"])) {
        setcookie("userid", "", time() =10, "/");
		header('location: login.php');
	} 
?>