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
 Copywrite @2015
 
	Login verifys access and access level
	access levels: 
	admin: can do anything
	manager: can add and delete people
	user: can add and edit customers can mark customers inactive
 */ 

//setcookie("userid", "test_value", time() + (60 * 30), "/"); // 86400 = 1 day
	if (isset($_COOKIE["userid"])) {
		header('location: index.php');
	} 
session_name('lllbackoffice');
session_start();
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
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/prettyPhoto.css" rel="stylesheet">
    <link href="../css/animate.css" rel="stylesheet">
    <link href="../css/main.css" rel="stylesheet">
    <script src="../assets/jquery/jquery-1.10.2.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/prettify/run_prettify.js"></script>
    <link href="../assets/bootstrap-dialog/css/bootstrap-dialog.min.css" rel="stylesheet" type="text/css" />
    <script src="../assets/bootstrap-dialog/js/bootstrap-dialog.min.js"></script>
    <!--[if lt IE 9]>
    <script src="../js/html5shiv.js"></script>
    <script src="../js/respond.min.js"></script>
    <![endif]-->

    <link rel="shortcut icon" href="../images/ico/favicon.ico">
    <link rel='stylesheet' type='text/css' href='/DataTables-1.10.4/media/css/jquery.dataTables.css'>
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../images/ico/apple-touch-icon-57-precomposed.png">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <script>
    function downloadthis(ID){
        document.getElementById("btn"+ID).style.visibility = 'hidden';
        document.getElementById("checkin"+ID).style.visibility = 'visible';
        document.getElementById("Form-"+ID).submit();
    } 
    </script>


    <script  type="text/javascript">
        $( document ).ready(function() {
             //$(ResetPassword).hide(0);
             $(AddUser).hide(0);
	<?php if ($_COOKIE['ListCat'] == 0) {?>
	$(Categories).hide(0); 
	<?php } else {setcookie("ListCat", 0);}?>
    <?php if ($_COOKIE['ListActive'] == 0) {?>
    	$(ListUsers).hide(0); 
    <?php } else {setcookie("ListActive", 0);}?>
});

    </script>     
    <script  type="text/javascript">
/* Script by: www.jtricks.com
 * Version: 20090221
 * Latest version:
 * www.jtricks.com/javascript/blocks/showinghiding.html
 */
function showPageElement(what)
{
    var obj = typeof what == 'object'
        ? what : document.getElementById(what);

    obj.style.display = 'inline';
    return false;
}

function hidePageElement(what)
{
    var obj = typeof what == 'object'
        ? what : document.getElementById(what);

    obj.style.display = 'none';
    return false;
}

function togglePageElementVisibility(what)
{
    var obj = typeof what == 'object'
        ? what : document.getElementById(what);

    if (obj.style.display == 'none')
        obj.style.display = 'inline';
    else
        obj.style.display = 'none';
    return false;
}

//-->
    </script>
<!-- The following javascript simply copies data from teh username field to a hidden field for a different submit. -->
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script>
      function test(){
        var f1 = document.getElementById("username");
        var f2 = document.getElementById("username2");
        f2.value = f1.value;
      }
    </script>

<?php include('Classes/include.php'); ?>
</head>
<body>
    <header class="navbar navbar-inverse navbar-fixed-top wet-asphalt" role="banner">
        <div class="container">
            <div class="navbar-header row-fluid">

                <a class="navbar-brand" href="http://voiptools.windstream.com/index.php"><img src="../images/winNocLogo.jpg" height="95" alt="logo"></a>
            </span>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                </button>
        </div>


            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="http://voiptools.windstream.com/index.php">Home</a></li>
                </ul>
            </div>
        </div>
    </header>
    <center>
<div class="row-fluid">
<div class="span3"></div>
<div class="span6">
    <div class="well well-lg input-group">
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
     <div class="row row-fluid"></div>
     <div class="row row-fluid"></div>
    <form action="usercontroller.php" method="POST" accept-charset="utf-8">
	   <h1>Lories Lovely Lashes Backoffice Login</h1>
	   <label for="username">Username:</label><input type="text" id="username" name="username" onblur="test()"><br>
	   <label for="password">Password:</label><input type="password" name="password" ><br>
	   <input type="hidden" name="act" value="login" >
	   <span class="glyphicon glyphicon-log-in"></span><button type="submit" name="Login" value="Login" class="btn btn-default">Login</button>
    </form>
    </div>
	<div class="well well-sm input-group">
		<form action="usercontroller.php" method="POST" accept-charset="utf-8">
		If you have forgotten your password, Click here:<br>
		<input type="hidden" id="username2" name="username">
		<input type="hidden" name="act" value="forgot" >
		<span class="glyphicon glyphicon-wrench"></span><button type="submit" name="Send_Rest_Code" value="Send Reset Code" class="btn btn-danger">Send Reset Code</button>
		</form>
	</div>  

    <div class="well well-sm input-group">
    <form action="usercontroller.php" method="POST" accept-charset="utf-8">
    If you need to be setup on the lllbackoffice system please sign up to get access.<br>
    	<input type="hidden" name="act" value="signup" >
    	<span class="glyphicon glyphicon-pencil"></span><button type="submit" name="signup" value="Signup for Access" class="btn btn-caution">Signup for Access</button><br>
    </form>
    </div>
</div>
<div class="span3"></div>
</div>
</center>
</body>
</html>
?>