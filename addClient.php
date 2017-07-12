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
 		<label for="firstVisit">First Visit:&nbsp;</label><input type="date" name="firstVisit" id="firstVisit"><br>
 		<label for="phone">Phone Number:&nbsp;</label><input type='tel' pattern='\d{3}[\-]\d{3}[\-]\d{4}' name='phone' title='Phone Number (Format: +99(99)9999-9999)'> <br>
 		<label for="email">Email:&nbsp;</label><input type="email" name="email" autocomplete="off"><br>
 		<div class="text-center">
	 		<span class="pull-left">
		 		<label class="col-sm-6" for="city">City:&nbsp;</label>
		 		<input class="col-sm-2" type="text" name="city">
	 		</span>
	 		<span class="pull-right">
		 		<label  class="col-sm-6" for="state">State (IN):&nbsp;</label>
		 		<input class="col-sm-2 text-center" type="text" name="state" value="IN">
	 		</span>
	 		<br>
	 		<label for="birthmonth">Birthday Month:&nbsp;</label><input id="birthmonth" type="range" min="1" max="12" step="1" onchange="printValue('birthmonth','bmonth');" /><input id='bmonth' type='text' size='2'/><br>
	 		<label for="birthday">Birthday Day:&nbsp;</label><input id="birthday" type="range" min="1" max="31" step="1" onchange="printValue('birthday','bdate');" /><input id='bdate' type='text' size='2'/><br>
 		</div>
		<br>
 		<div class="text-center"><input type="submit" name="submit" value="Submit"></div>



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

	<script>
			function printValue(input, output){
				str invalue= input.value;
				output.innerhtml=invalue;
			}

	</script>


	</body>
</html>

<?php 
//end
 ?>