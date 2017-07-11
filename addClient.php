<?php 
/*
 ====================================
 Jonathan Wagner
 xanthakita@gmail.com
 Wild Bunch Productions
 ====================================
 FILE NAME:          addClient.php
  TAB SIZE:          4
 SOFT TABS:          NO
 ====================================
 Copywrite @2017
 */

	error_reporting(E_ALL);
	if (!isset($_COOKIE["userid"])) {
		header('location: login.php');
	} else {
		$username=$_COOKIE["userid"];
	}
	?>

<!DOCTYPE HTML>

<html>
	<head>
		<title>Lori's Lovely Lashes Backoffice</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />

		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		
<?php include('Classes/include.php'); ?> 
	</head>
	<body>
    <div class="container text-center">

	<!-- Header -->
					<header id="header" class="alt">
						<span class="logo"><img src="images/lll-small-logo.png" alt="" /></span>
						<h1>Add Client</h1>

					</header>
<div class="col-sm-12 col-lg-offset-3">
 <form class="col-sm-6" action="clientcontroller.php" method="post" accept-charset="utf-8" enctype="multipart/form-data">
 		<input type="hidden" name="act" value="addclient">
 		<h3> Fill out the following fields </h3>
 		<label for="firstVisit">First Visit:</label><input type="date" name="firstVisit" id="firstVisit">
 		<label for="pwd1">Password:</label><input type="password" name="pwd1" value="" >
 		<label for="pwd2">Verify Password:</label> <input type="password" name="pwd2" value="" >
 		<label for="firstname">Firstname:</label> <input type="text" name="firstname" value="" >
 		<label for="lastname">Lastname:</label> <input type="text" name="lastname" value="">
 		<label for="email">Email:</label> <input type="email" name="email" value="">
 		<label for="artistimage">Artist Image:</label><input type="file" name="artistimage" id="artistimage" /><br>
 		<input type="submit" name="submit" value="Submit">
 </form>
 </div>


</div><!-- /.container -->
   <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>

<?php 
//end
 ?>