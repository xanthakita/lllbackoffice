<?php 
	// Class for controlling the documents for the NOC Document Management System (DMS)
	ini_set("allow_url_include", true);

	include_once('/var/www/html/Classes/kint/Kint.class.php');  //debug functions

	kint::enabled(false); // kint::enabled(true);

 bst
 ?>
 <!DOCTYPE html>
<html>
<head>
	<title>User Login Test</title>
</head>
<body>
<form action="usercontroller.php" method="POST" accept-charset="utf-8">
	<h1>Login</h1>
	<strong>Username: <input type="text" name="username" value="" placeholder="User Name"><br>
	<input type="hidden" name="act" value="reset">
	Current Password: <input type="password" name="password" value="Current Password" placeholder="Current Password"><br>
	New Password: <input type="password" name="newpassword" value="New Password" placeholder="New Password"><br>
	<input type="submit" name="Change_Password" value="Change Password"><br>
</form>

<form action="usercontroller.php" method="POST" accept-charset="utf-8">
	<h1>Login</h1>
	<strong>Username: <input type="text" name="username" value="" placeholder="User Name"><br>
	<input type="hidden" name="act" value="forgot">
	<input type="submit" name="Forgot_Password" value="Forgot Password"><br>
</form>

</body>
</html>