<!DOCTYPE html>
<html>
<head>
	<title>LLLBackOffice New User Signup</title>
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


<?php include('Classes/include.php'); ?>
</head>
<body>

<?php 
 	ini_set("allow_url_include", true);
 	//include_once("include.php");
 	    // require_once('/var/www/html/Classes/kint/Kint.class.php');
 	     //kint::enabled(false);
 	if (isset($_SESSION['username'])) {$username=$_SESSION['username'];}

 	if ( isset($_SESSION['errorstring']) ) {
 		echo $_SESSION['errorstring']."<br>"; 
 		$_SESSION['errorstring']="";
 	}
 ?>
<div class="container">
<div class="well text-center">
<div class="col-sm-12 col-lg-offset-4">
 <form action="usercontroller.php" method="post" accept-charset="utf-8" enctype="multipart/form-data">
 		<input type="hidden" name="act" value="adduser">
 		<h3> Please enter the following to signup for access to LLLBackoffice System </h3>
 		<label for="username">Username (first initial lastname i.e. jsmith):</label><input type="text" name="username" value="<?php echo $username; ?>"><br>
 		<label for="pwd1">Password:</label><input type="password" name="pwd1" value="" >
 		<label for="pwd2">Verify Password:</label> <input type="password" name="pwd2" value="" ><br> 
 		<label for="firstname">Firstname:</label> <input type="text" name="firstname" value="" >
 		<label for="lastname">Lastname:</label> <input type="text" name="lastname" value=""><br>
 		<label for="email">Email:</label> <input type="email" name="email" value=""><br>
 		<label for="artistimage">Artist Image:</label><input type="file" name="artistimage" id="artistimage" /><br /><br>
 		<input type="submit" name="submit" value="Submit"><br>
 </form>
 </div>
	</div>
</div>
<!-- <script>
document.getElementById('artistimage').addEventListener('change', function(){
    var file = this.files[0];
    // This code is only for demo ...
    console.log("name : " + file.name);
    console.log("size : " + file.size);
    console.log("type : " + file.type);
    console.log("date : " + file.lastModified);
}, false);
</script> -->
</body>
</html>