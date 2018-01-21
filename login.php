<?php 
/*
 ====================================
 Jonathan Wagner
 xanthakita@gmail.com
 Wild Bunch Productions
 ====================================
 FILE NAME:          login.php
  TAB SIZE:          4
 SOFT TABS:          NO
 ====================================
 Copywrite @2017
 

 */ 
 session_name('lllbackoffice');

require_once('Classes/include.php');
$log->logthis(LOG_DEBUG, "Entered index.php");
//setcookie("userid", "test_value", time() + (60 * 30), "/"); // 86400 = 1 day
	if (isset($_COOKIE["userid"])) {
		header('location: index.php');
	} 

ini_set("allow_url_include", true);
require_once('./user.class.php');
require_once('./mystring.class.php');

 ?>
<head>
	<title> LLLBackoffice Login</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="LLL Backoffice Login page">
    <meta name="author" content="Jonathan Wagner">
    <link rel="stylesheet" href="assets/css/main.css" />
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">

    <link rel="shortcut icon" href="../images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../images/ico/apple-touch-icon-57-precomposed.png">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<!-- The following javascript simply copies data from teh username field to a hidden field for a different submit. -->
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<!-- 	<script>
      function test(){
        var f1 = document.getElementById("username");
        var f2 = document.getElementById("username2");
        f2.value = f1.value;
      }
    </script> -->

</head>
<body>
    <header class="navbar navbar-inverse navbar-fixed-top wet-asphalt" role="banner">
        <div class="text-center">
            <h1>Login to LLL Backoffice</h1>
        </div>
    </header>
    <!-- <body> -->
    <div class="container">
    <div><br><br><br><br><br></div>
    <div class="col-lg-6 col-lg-offset-3">
    <div class="well well-lg input-group text-center">
    <span class="icon-bar"></span>
    <span class="icon-bar">
                <a href="http://lllbackoffice.com/index.php"><img src="images/lll-small-logo.png" height="95" alt="logo"></a><br></span>
    <span class="icon-bar"></span>
     <div class="row row-fluid"></div>
     <div class="row row-fluid"></div>
    <form class="text-center" action="usercontroller.php" method="POST" accept-charset="utf-8">
	   <h1>Lori's Lovely Lashes Backoffice Login</h1>
	   <span class="label label-important" for="username">Username:</span><input type="text" id="username" name="username" placeholder="username"><br>
	   <label class="label label-important" for="password">Password:</label><input type="password" name="password"  placeholder="password"><br>
	   <input type="hidden" name="act" value="login" >
	   <span class="glyphicon glyphicon-log-in">&nbsp;</span><button type="submit" name="Login" value="Login" class="btn btn-success">Login</button>
    </form>
    </div>
<!-- 	<div class="well well-sm input-group">
		<form action="usercontroller.php" method="POST" accept-charset="utf-8">
		If you have forgotten your password, Click here:<br>
		<input type="hidden" id="username2" name="username">
		<input type="hidden" name="act" value="forgot" >
		<span class="glyphicon glyphicon-wrench"></span><button type="submit" name="Send_Rest_Code" value="Send Reset Code" class="btn btn-danger">Send Reset Code</button>
		</form>
	</div>   -->

    <div class="well well-sm input-group text-center">
    <form action="usercontroller.php" method="POST" accept-charset="utf-8">
    <h3>If you need to be setup on the lllbackoffice system please sign up to get access.</h3>
    	<input type="hidden" name="act" value="signup" >
    	<span class="glyphicon glyphicon-pencil">&nbsp;</span><button type="submit" name="signup" value="Signup for Access" class="btn btn-warning">Signup for Access</button><br>
    </form>
    </div>
</div>
</div>
</body>
</html>
